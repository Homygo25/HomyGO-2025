<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomyGo - Your Property Rental Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-purple-600 via-blue-600 to-indigo-800 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white bg-opacity-10 backdrop-blur-md border-b border-white border-opacity-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                            <span class="text-purple-600 font-bold text-xl">H</span>
                        </div>
                        <span class="ml-3 text-white text-xl font-bold">HomyGo</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-white hover:text-purple-200 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                    <a href="{{ route('register') }}" class="bg-white text-purple-600 hover:bg-purple-50 px-4 py-2 rounded-md text-sm font-medium">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                            <span class="block">Find Your Perfect</span>
                            <span class="block text-purple-200">Rental Home</span>
                        </h1>
                        <p class="mt-3 text-base text-purple-100 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Discover amazing properties, connect with trusted hosts, and enjoy seamless booking experiences with our AI-powered recommendations.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ route('properties.index') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-purple-600 bg-white hover:bg-purple-50 md:py-4 md:text-lg md:px-10">
                                    Browse Properties
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-500 hover:bg-purple-400 md:py-4 md:text-lg md:px-10">
                                    Get Started
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-12 bg-white bg-opacity-10 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-purple-200 font-semibold tracking-wide uppercase">Features</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-white sm:text-4xl">
                    Everything you need for property rental
                </p>
            </div>

            <div class="mt-10">
                <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                    <!-- AI Recommendations -->
                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-purple-500 text-white">
                            <i class="fas fa-brain"></i>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-white">AI Recommendations</p>
                        <p class="mt-2 ml-16 text-base text-purple-100">
                            Get personalized property suggestions powered by advanced AI algorithms.
                        </p>
                    </div>

                    <!-- Social Login -->
                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-purple-500 text-white">
                            <i class="fab fa-facebook"></i>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-white">Social Login</p>
                        <p class="mt-2 ml-16 text-base text-purple-100">
                            Quick signup with Facebook and Google for faster access.
                        </p>
                    </div>

                    <!-- Secure Platform -->
                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-purple-500 text-white">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-white">Enterprise Security</p>
                        <p class="mt-2 ml-16 text-base text-purple-100">
                            Advanced security with rate limiting and threat protection.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Social Login Section -->
    <div class="bg-purple-50 bg-opacity-10 backdrop-blur-md">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
                <div>
                    <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                        Join with your favorite social account
                    </h2>
                    <p class="mt-3 max-w-3xl text-lg text-purple-100">
                        Skip the lengthy signup process. Connect with Facebook or Google and start browsing properties immediately.
                    </p>
                </div>
                <div class="mt-8 grid grid-cols-2 gap-4 lg:mt-0">
                    <a href="{{ route('auth.social.redirect', 'facebook') }}" class="flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <i class="fab fa-facebook-f mr-2"></i>
                        Facebook
                    </a>
                    <a href="{{ route('auth.social.redirect', 'google') }}" class="flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                        <i class="fab fa-google mr-2"></i>
                        Google
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-black bg-opacity-20 backdrop-blur-md">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-sm font-semibold text-purple-200 tracking-wider uppercase">Company</h3>
                    <ul class="mt-4 space-y-4">
                        <li><a href="#" class="text-purple-100 hover:text-white">About</a></li>
                        <li><a href="{{ route('privacy-policy') }}" class="text-purple-100 hover:text-white">Privacy Policy</a></li>
                        <li><a href="{{ route('terms-of-service') }}" class="text-purple-100 hover:text-white">Terms of Service</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-purple-200 tracking-wider uppercase">Properties</h3>
                    <ul class="mt-4 space-y-4">
                        <li><a href="{{ route('properties.index') }}" class="text-purple-100 hover:text-white">Browse</a></li>
                        <li><a href="#" class="text-purple-100 hover:text-white">List Property</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-purple-200 tracking-wider uppercase">Account</h3>
                    <ul class="mt-4 space-y-4">
                        <li><a href="{{ route('login') }}" class="text-purple-100 hover:text-white">Login</a></li>
                        <li><a href="{{ route('register') }}" class="text-purple-100 hover:text-white">Sign Up</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-purple-200 tracking-wider uppercase">Debug</h3>
                    <ul class="mt-4 space-y-4">
                        <li><a href="{{ route('health-check') }}" class="text-purple-100 hover:text-white">Health Check</a></li>
                        <li><a href="/debug/db" class="text-purple-100 hover:text-white">Database Test</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 border-t border-purple-200 border-opacity-20 pt-8">
                <p class="text-base text-purple-100 text-center">
                    &copy; 2025 HomyGo. All rights reserved. Built with Laravel & AI.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
