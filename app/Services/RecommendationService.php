<?php

namespace App\Services;

use App\Models\User;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RecommendationService
{
    /**
     * Get property recommendations for a user
     */
    public function getRecommendationsForUser(int $userId, int $limit = 10): Collection
    {
        $user = User::find($userId);
        if (!$user) {
            return collect();
        }

        // Get user's booking history and preferences
        $userBookings = Booking::where('user_id', $userId)
            ->with('property')
            ->get();

        // Get user's review patterns
        $userReviews = Review::where('user_id', $userId)
            ->with('property')
            ->get();

        // Calculate preferences based on past behavior
        $preferences = $this->calculateUserPreferences($userBookings, $userReviews);

        // Get recommended properties
        $recommendations = $this->findMatchingProperties($preferences, $limit, $userId);

        return $recommendations;
    }

    /**
     * Calculate user preferences based on booking and review history
     */
    protected function calculateUserPreferences(Collection $bookings, Collection $reviews): array
    {
        $preferences = [
            'price_range' => ['min' => 0, 'max' => PHP_INT_MAX],
            'property_types' => [],
            'locations' => [],
            'amenities' => [],
            'avg_rating' => 0
        ];

        // Analyze booking patterns
        if ($bookings->isNotEmpty()) {
            $prices = $bookings->pluck('property.price')->filter();
            if ($prices->isNotEmpty()) {
                $preferences['price_range'] = [
                    'min' => $prices->min() * 0.8,
                    'max' => $prices->max() * 1.2
                ];
            }

            $preferences['property_types'] = $bookings->pluck('property.type')
                ->filter()
                ->countBy()
                ->sortDesc()
                ->keys()
                ->take(3)
                ->toArray();

            $preferences['locations'] = $bookings->pluck('property.city')
                ->filter()
                ->countBy()
                ->sortDesc()
                ->keys()
                ->take(5)
                ->toArray();
        }

        // Analyze review patterns
        if ($reviews->isNotEmpty()) {
            $preferences['avg_rating'] = $reviews->avg('rating') ?? 0;
        }

        return $preferences;
    }

    /**
     * Find properties matching user preferences
     */
    protected function findMatchingProperties(array $preferences, int $limit, int $excludeUserId): Collection
    {
        $query = Property::where('status', 'available')
            ->where('is_active', true);

        // Apply price range filter
        if (isset($preferences['price_range'])) {
            $query->whereBetween('price', [
                $preferences['price_range']['min'],
                $preferences['price_range']['max']
            ]);
        }

        // Apply property type filter
        if (!empty($preferences['property_types'])) {
            $query->whereIn('type', $preferences['property_types']);
        }

        // Apply location filter
        if (!empty($preferences['locations'])) {
            $query->whereIn('city', $preferences['locations']);
        }

        // Exclude properties owned by the user
        $query->whereHas('owner', function($q) use ($excludeUserId) {
            $q->where('id', '!=', $excludeUserId);
        });

        // Get properties with ratings
        $properties = $query->with(['images', 'owner', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->limit($limit * 2) // Get more to allow for filtering
            ->get();

        // Apply rating filter and sort
        if ($preferences['avg_rating'] > 0) {
            $properties = $properties->filter(function($property) use ($preferences) {
                return ($property->reviews_avg_rating ?? 0) >= ($preferences['avg_rating'] - 0.5);
            });
        }

        // Sort by relevance score
        $properties = $properties->map(function($property) use ($preferences) {
            $property->relevance_score = $this->calculateRelevanceScore($property, $preferences);
            return $property;
        })->sortByDesc('relevance_score');

        return $properties->take($limit)->values();
    }

    /**
     * Calculate relevance score for a property
     */
    protected function calculateRelevanceScore(Property $property, array $preferences): float
    {
        $score = 0;

        // Price relevance (30% weight)
        if (isset($preferences['price_range'])) {
            $priceRange = $preferences['price_range']['max'] - $preferences['price_range']['min'];
            if ($priceRange > 0) {
                $priceDeviation = abs($property->price - (($preferences['price_range']['min'] + $preferences['price_range']['max']) / 2));
                $priceScore = max(0, 1 - ($priceDeviation / ($priceRange / 2)));
                $score += $priceScore * 0.3;
            }
        }

        // Property type relevance (25% weight)
        if (!empty($preferences['property_types']) && in_array($property->type, $preferences['property_types'])) {
            $typeIndex = array_search($property->type, $preferences['property_types']);
            $typeScore = 1 - ($typeIndex / count($preferences['property_types']));
            $score += $typeScore * 0.25;
        }

        // Location relevance (25% weight)
        if (!empty($preferences['locations']) && in_array($property->city, $preferences['locations'])) {
            $locationIndex = array_search($property->city, $preferences['locations']);
            $locationScore = 1 - ($locationIndex / count($preferences['locations']));
            $score += $locationScore * 0.25;
        }

        // Rating relevance (20% weight)
        $propertyRating = $property->reviews_avg_rating ?? 0;
        if ($propertyRating > 0 && $preferences['avg_rating'] > 0) {
            $ratingScore = min(1, $propertyRating / 5); // Normalize to 0-1
            $score += $ratingScore * 0.2;
        }

        return $score;
    }

    /**
     * Get similar properties based on a given property
     */
    public function getSimilarProperties(Property $property, int $limit = 5): Collection
    {
        return Property::where('id', '!=', $property->id)
            ->where('status', 'available')
            ->where('is_active', true)
            ->where(function($query) use ($property) {
                $query->where('type', $property->type)
                      ->orWhere('city', $property->city)
                      ->orWhereBetween('price', [
                          $property->price * 0.8,
                          $property->price * 1.2
                      ]);
            })
            ->with(['images', 'owner'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->limit($limit)
            ->get();
    }

    /**
     * Get trending properties
     */
    public function getTrendingProperties(int $limit = 10): Collection
    {
        return Property::where('status', 'available')
            ->where('is_active', true)
            ->withCount(['bookings' => function($query) {
                $query->where('created_at', '>=', now()->subDays(30));
            }])
            ->withAvg('reviews', 'rating')
            ->orderByDesc('bookings_count')
            ->orderByDesc('reviews_avg_rating')
            ->with(['images', 'owner'])
            ->limit($limit)
            ->get();
    }
}
