<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Global API Helper Script -->
        <script>
            // Global API helper functions for HTTPS enforcement
            window.API = {
                baseUrl: '{{ config('app.url') }}',
                
                // Create absolute HTTPS URL from relative path
                url: function(path) {
                    if (path.startsWith('http')) return path;
                    return this.baseUrl + (path.startsWith('/') ? path : '/' + path);
                },
                
                // Get default headers with CSRF token
                headers: function(additionalHeaders = {}) {
                    const headers = {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    };
                    
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    if (csrfToken) {
                        headers['X-CSRF-TOKEN'] = csrfToken;
                    }
                    
                    return { ...headers, ...additionalHeaders };
                },
                
                // Enhanced fetch wrapper that ensures HTTPS
                fetch: function(url, options = {}) {
                    return fetch(this.url(url), {
                        headers: this.headers(options.headers || {}),
                        ...options
                    });
                }
            };
            
            // Override global fetch to use HTTPS by default
            const originalFetch = window.fetch;
            window.fetch = function(url, options = {}) {
                if (typeof url === 'string' && url.startsWith('/')) {
                    return originalFetch(window.API.url(url), options);
                }
                return originalFetch(url, options);
            };
        </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <!-- HomyGo Logo -->
            <div class="flex justify-center mt-8">
                <a href="/">
                    <img src="{{ asset('H.svg') }}" alt="Homygo Logo" class="w-16 h-16 hover:scale-110 transition-transform duration-300">
                </a>
            </div>

            <!-- Login card below -->
            <div class="bg-white rounded-lg shadow-md p-6 max-w-sm mx-auto mt-4 w-full sm:max-w-md">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
