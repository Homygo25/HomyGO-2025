<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - HomyGo</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center px-4 bg-gray-50">
  <div class="w-full max-w-sm dashboard-card">
    
    <!-- Logo -->
    <div class="flex justify-center mb-6">
      <a href="{{ url('/') }}">
        <img src="{{ asset('H.svg') }}" alt="HomyGo Logo" class="h-10 w-10 hover:scale-110 transition-transform duration-300">
      </a>
    </div>

    <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">Create Account</h2>

    <!-- Social Registration Buttons -->
    <div class="mb-6">
      <div class="grid grid-cols-2 gap-3">
        <!-- Facebook Registration -->
        <a href="{{ route('auth.social.redirect', 'facebook') }}" 
           class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors">
          <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M20 10C20 4.477 15.523 0 10 0S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z" clip-rule="evenodd"/>
          </svg>
          <span class="ml-2">Facebook</span>
        </a>

        <!-- Google Registration -->
        <a href="{{ route('auth.social.redirect', 'google') }}" 
           class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors">
          <svg class="w-5 h-5" viewBox="0 0 24 24">
            <path fill="#4285f4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
            <path fill="#34a853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
            <path fill="#fbbc05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
            <path fill="#ea4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
          </svg>
          <span class="ml-2">Google</span>
        </a>
      </div>

      <div class="relative mt-6">
        <div class="absolute inset-0 flex items-center">
          <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center text-sm">
          <span class="px-2 bg-gray-50 text-gray-500">Or sign up with email</span>
        </div>
      </div>
    </div>

    <!-- Registration Form -->
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
      @csrf
      
      <!-- Name Field -->
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
        <input 
          type="text" 
          id="name" 
          name="name" 
          value="{{ old('name') }}"
          required 
          autofocus
          autocomplete="name"
          class="form-input @error('name') border-red-500 @enderror"
        />
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Email Field -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input 
          type="email" 
          id="email" 
          name="email" 
          value="{{ old('email') }}"
          required 
          autocomplete="username"
          class="form-input @error('email') border-red-500 @enderror"
        />
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password Field -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input 
          type="password" 
          id="password" 
          name="password" 
          required 
          autocomplete="new-password"
          class="form-input @error('password') border-red-500 @enderror"
        />
        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Confirm Password Field -->
      <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input 
          type="password" 
          id="password_confirmation" 
          name="password_confirmation" 
          required 
          autocomplete="new-password"
          class="form-input @error('password_confirmation') border-red-500 @enderror"
        />
        @error('password_confirmation')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- User Type Selection -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">I want to:</label>
        <div class="grid grid-cols-2 gap-3">
          <label class="relative">
            <input type="radio" name="user_type" value="renter" class="peer sr-only" checked>
            <div class="w-full p-3 border-2 border-gray-300 rounded-lg cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-gray-50 transition-colors">
              <div class="text-center">
                <svg class="w-6 h-6 mx-auto mb-1 text-gray-600 peer-checked:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <span class="text-sm font-medium text-gray-900">Find Properties</span>
              </div>
            </div>
          </label>
          <label class="relative">
            <input type="radio" name="user_type" value="landlord" class="peer sr-only">
            <div class="w-full p-3 border-2 border-gray-300 rounded-lg cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-gray-50 transition-colors">
              <div class="text-center">
                <svg class="w-6 h-6 mx-auto mb-1 text-gray-600 peer-checked:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2V7"/>
                </svg>
                <span class="text-sm font-medium text-gray-900">List Properties</span>
              </div>
            </div>
          </label>
        </div>
      </div>

      <!-- Terms and Conditions -->
      <div class="flex items-start">
        <input 
          id="terms" 
          type="checkbox" 
          required
          class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 mt-1" 
        >
        <label for="terms" class="ml-2 block text-sm text-gray-700">
          I agree to the <a href="{{ route('terms-of-service') }}" class="text-blue-600 hover:underline">Terms of Service</a> and <a href="{{ route('privacy-policy') }}" class="text-blue-600 hover:underline">Privacy Policy</a>
        </label>
      </div>

      <!-- Register Button -->
      <button 
        type="submit" 
        class="btn-primary w-full"
      >
        Create Account
      </button>
    </form>

    <!-- Footer Links -->
    <div class="mt-6">
      <p class="text-xs text-gray-500 text-center">
        Already have an account?
        <a href="{{ route('login') }}" class="underline hover:text-black transition">Sign in</a>
      </p>
    </div>
  </div>
</body>
</html>
