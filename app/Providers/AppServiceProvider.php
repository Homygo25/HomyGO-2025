<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Vite;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production and handle proxy headers
        if (app()->environment('production') || $this->isSecureConnection()) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
            \Illuminate\Support\Facades\URL::forceRootUrl(config('app.url'));
            
            // Force secure cookies
            config([
                'session.secure' => true,
                'session.same_site' => 'lax' // Changed from 'none' to 'lax' for better compatibility
            ]);
            
            Vite::useCspNonce();
        }
        
        // Handle missing manifest gracefully (regardless of environment)
        if (!file_exists(public_path('build/manifest.json'))) {
            $this->createViteFallbacks();
        }
    }

    /**
     * Create Vite fallback files when manifest is missing
     */
    private function createViteFallbacks(): void
    {
        // Create build directory
        $buildDir = public_path('build');
        if (!is_dir($buildDir)) {
            mkdir($buildDir, 0755, true);
        }
        
        // Create minimal manifest
        $manifest = [
            'resources/css/app.css' => [
                'file' => 'assets/app.css',
                'isEntry' => true
            ],
            'resources/js/app.js' => [
                'file' => 'assets/app.js',
                'isEntry' => true
            ]
        ];
        
        file_put_contents(
            public_path('build/manifest.json'),
            json_encode($manifest, JSON_PRETTY_PRINT)
        );
        
        // Create minimal CSS and JS files
        $assetsDir = public_path('build/assets');
        if (!is_dir($assetsDir)) {
            mkdir($assetsDir, 0755, true);
        }
        
        file_put_contents(public_path('build/assets/app.css'), '/* Fallback CSS */');
        file_put_contents(public_path('build/assets/app.js'), '/* Fallback JS */');
    }

    /**
     * Check if the connection is secure (handles proxy headers)
     */
    private function isSecureConnection(): bool
    {
        // Check standard HTTPS indicators
        if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
            return true;
        }

        // Check proxy headers (common with Render.com, Cloudflare, etc.)
        $proxyHeaders = [
            'HTTP_X_FORWARDED_PROTO',
            'HTTP_X_FORWARDED_PROTOCOL', 
            'HTTP_X_FORWARDED_SSL',
            'HTTP_X_URL_SCHEME'
        ];

        foreach ($proxyHeaders as $header) {
            if (!empty($_SERVER[$header])) {
                $value = strtolower($_SERVER[$header]);
                if (in_array($value, ['https', 'on', '1', 'true'])) {
                    return true;
                }
            }
        }

        // Check if port is 443 (standard HTTPS port)
        if (!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) {
            return true;
        }

        return false;
    }
}
