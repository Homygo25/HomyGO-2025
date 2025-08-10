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
        // Ensure Vite works in production even if manifest is missing
        if (app()->environment('production')) {
            Vite::useCspNonce();
            
            // Handle missing manifest gracefully
            if (!file_exists(public_path('build/manifest.json'))) {
                // Create a minimal manifest if it doesn't exist
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
        }
    }
}
