<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialAuthController extends Controller
{
    /**
     * Redirect to social provider
     */
    public function redirectToProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'google'])) {
            return redirect()->route('login')->with('error', 'Unsupported social provider.');
        }

        try {
            return Socialite::driver($provider)->redirect();
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Unable to authenticate with ' . ucfirst($provider) . '. Please try again.');
        }
    }

    /**
     * Handle social provider callback
     */
    public function handleProviderCallback($provider)
    {
        if (!in_array($provider, ['facebook', 'google'])) {
            return redirect()->route('login')->with('error', 'Unsupported social provider.');
        }

        try {
            $socialUser = Socialite::driver($provider)->user();
            
            // Check if user already exists with this social provider
            $existingUser = User::where('provider', $provider)
                               ->where('provider_id', $socialUser->getId())
                               ->first();

            if ($existingUser) {
                // Update user info and login
                $this->updateUserFromSocial($existingUser, $socialUser, $provider);
                Auth::login($existingUser);
                
                return $this->redirectToDashboard($existingUser);
            }

            // Check if user exists with same email but different provider
            $emailUser = User::where('email', $socialUser->getEmail())->first();
            
            if ($emailUser) {
                // Link this social account to existing user
                $this->linkSocialAccount($emailUser, $socialUser, $provider);
                Auth::login($emailUser);
                
                return $this->redirectToDashboard($emailUser);
            }

            // Create new user
            $newUser = $this->createUserFromSocial($socialUser, $provider);
            Auth::login($newUser);

            return $this->redirectToDashboard($newUser);

        } catch (Exception $e) {
            \Log::error('Social authentication error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Authentication failed. Please try again.');
        }
    }

    /**
     * Create a new user from social data
     */
    private function createUserFromSocial($socialUser, $provider)
    {
        $user = User::create([
            'name' => $socialUser->getName() ?: $socialUser->getNickname() ?: 'User',
            'email' => $socialUser->getEmail(),
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'provider_token' => $socialUser->token,
            'avatar' => $socialUser->getAvatar(),
            'email_verified_at' => now(), // Social logins are considered verified
            'password' => null, // No password for social users
        ]);

        // Assign default role
        $user->assignRole('renter'); // Default to renter role

        return $user;
    }

    /**
     * Update existing user with social data
     */
    private function updateUserFromSocial($user, $socialUser, $provider)
    {
        $user->update([
            'provider_token' => $socialUser->token,
            'avatar' => $socialUser->getAvatar() ?: $user->avatar,
            'email_verified_at' => $user->email_verified_at ?: now(),
        ]);

        return $user;
    }

    /**
     * Link social account to existing user
     */
    private function linkSocialAccount($user, $socialUser, $provider)
    {
        $user->update([
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'provider_token' => $socialUser->token,
            'avatar' => $socialUser->getAvatar() ?: $user->avatar,
            'email_verified_at' => $user->email_verified_at ?: now(),
        ]);

        return $user;
    }

    /**
     * Redirect user to appropriate dashboard based on role
     */
    private function redirectToDashboard($user)
    {
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
        } elseif ($user->hasRole('landlord')) {
            return redirect()->route('owner.dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
        } else {
            return redirect()->route('renter.dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
        }
    }

    /**
     * Unlink social account
     */
    public function unlinkAccount(Request $request)
    {
        $user = Auth::user();
        
        // Don't unlink if user has no password (social-only account)
        if (!$user->password) {
            return back()->with('error', 'Cannot unlink social account. Please set a password first.');
        }

        $user->update([
            'provider' => null,
            'provider_id' => null,
            'provider_token' => null,
        ]);

        return back()->with('success', 'Social account unlinked successfully.');
    }
}
