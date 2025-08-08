<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property-read Collection<int, Role> $roles
 * @property-read Collection<int, Property> $properties
 * @property-read Collection<int, Booking> $bookings
 * @method bool hasRole(string|array|\Spatie\Permission\Contracts\Role $roles, string $guard = null)
 * @method bool hasAnyRole(string|array|\Spatie\Permission\Contracts\Role $roles, string $guard = null)
 * @method bool hasAllRoles(string|array|\Spatie\Permission\Contracts\Role $roles, string $guard = null)
 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany roles()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany properties()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany bookings()
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'facebook_id',
        'google_id',
        'social_tokens',
        'avatar_url',
        'phone',
        'date_of_birth',
        'profile_image',
        'bio',
        'preferred_language',
        'preferred_currency',
        'timezone',
        'emergency_contact_name',
        'emergency_contact_phone',
        'government_id_type',
        'government_id_number',
        'government_id_verified_at',
        'phone_verified_at',
        'is_host_verified',
        'host_verification_documents',
        'host_verified_at',
        'recommendation_preferences',
        'mfa_enabled',
        'mfa_secret',
        'backup_codes',
        'last_activity_at',
        'risk_score',
        'device_fingerprints',
        'security_preferences',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'identity_verified_at' => 'datetime',
            'is_identity_verified' => 'boolean',
            'password' => 'hashed',
            'date_of_birth' => 'date',
            'government_id_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'host_verified_at' => 'datetime',
            'host_verification_documents' => 'array',
            'recommendation_preferences' => 'array',
            'backup_codes' => 'array',
            'last_activity_at' => 'datetime',
            'risk_score' => 'decimal:2',
            'device_fingerprints' => 'array',
            'security_preferences' => 'array',
            'social_tokens' => 'array',
        ];
    }

    /**
     * Get the properties owned by the user
     */
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    /**
     * Get the bookings made by the user
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the reviews written by this user (as guest)
     */
    public function reviewsAsGuest(): HasMany
    {
        return $this->hasMany(Review::class, 'guest_id');
    }

    /**
     * Get the reviews received by this user (as host)
     */
    public function reviewsAsHost(): HasMany
    {
        return $this->hasMany(Review::class, 'host_id');
    }

    /**
     * Get the saved searches for this user
     */
    public function savedSearches(): HasMany
    {
        return $this->hasMany(SavedSearch::class);
    }

    /**
     * Get the transactions for the user
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the identity verification for this user
     */
    public function identityVerification()
    {
        return $this->hasOne(IdentityVerification::class);
    }

    /**
     * Check if user has completed identity verification
     */
    public function isIdentityVerified(): bool
    {
        return $this->is_identity_verified === true;
    }

    /**
     * Check if user has pending identity verification
     */
    public function hasPendingVerification(): bool
    {
        return $this->identityVerification && $this->identityVerification->status === 'pending';
    }

    /**
     * Get verification status badge
     */
    public function getVerificationStatusBadgeAttribute(): string
    {
        if ($this->is_identity_verified) {
            return '<span class="badge badge-success"><i class="fas fa-check-circle"></i> Verified</span>';
        }
        
        if ($this->hasPendingVerification()) {
            return '<span class="badge badge-warning"><i class="fas fa-clock"></i> Pending</span>';
        }
        
        return '<span class="badge badge-secondary"><i class="fas fa-times-circle"></i> Not Verified</span>';
    }
}
