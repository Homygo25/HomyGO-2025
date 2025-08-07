<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $property->title }} - Homygo</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
      background-color: #f8f9fa;
    }
    
    .card-shadow {
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen">

  <!-- Header -->
  <header class="bg-white/95 backdrop-blur-sm shadow-sm fixed top-0 left-0 right-0 z-50">
    <div class="flex items-center justify-between px-4 py-3">
      <!-- Logo -->
      <div class="flex items-center">
        <a href="{{ Auth::user() && Auth::user()->hasRole('landlord') ? route('owner.dashboard') : route('renter.dashboard') }}">
          <img src="{{ asset('header.svg') }}" alt="Homygo" class="h-8" />
        </a>
      </div>
      
      <!-- User Info & Menu -->
      @auth
        <div class="flex items-center space-x-3">
          <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
          <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">
            {{ substr(Auth::user()->name, 0, 1) }}
          </div>
          <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 px-2 py-1 rounded">
              Logout
            </button>
          </form>
        </div>
      @else
        <div class="flex items-center space-x-2">
          <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 px-2 py-1 rounded">Login</a>
          <a href="{{ route('register') }}" class="text-sm bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">Sign Up</a>
        </div>
      @endauth
    </div>
  </header>

  <!-- Main Content -->
  <main class="pt-20 px-4 pb-8">
    <div class="max-w-md mx-auto space-y-6">

      @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
          {{ session('success') }}
        </div>
      @endif

      <!-- Property Image -->
      <div class="bg-white rounded-lg card-shadow overflow-hidden">
        @if($property->image)
          <img src="{{ asset('storage/' . $property->image) }}" 
               alt="{{ $property->title }}" 
               class="w-full h-64 object-cover">
        @else
          <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
            </svg>
          </div>
        @endif
      </div>

      <!-- Property Details -->
      <div class="bg-white rounded-lg card-shadow p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $property->title }}</h1>
        
        <!-- Location -->
        <div class="flex items-center text-gray-600 mb-4">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
          {{ $property->location }}
        </div>

        <!-- Price -->
        <div class="mb-6">
          <span class="text-3xl font-bold text-green-600">₱{{ number_format($property->price_per_night) }}</span>
          <span class="text-gray-600">/night</span>
        </div>

        <!-- Description -->
        <div class="mb-6">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">Description</h3>
          <p class="text-gray-700 leading-relaxed">{{ $property->description }}</p>
        </div>

        <!-- Property Owner -->
        <div class="border-t pt-4 mb-6">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">Property Owner</h3>
          <div class="flex items-center">
            <div class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">
              {{ substr($property->user->name, 0, 1) }}
            </div>
            <div>
              <p class="font-medium text-gray-800">{{ $property->user->name }}</p>
              <p class="text-sm text-gray-600">Property Owner</p>
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="space-y-3">
          @auth
            @if(!Auth::user()->hasRole('landlord') || Auth::id() !== $property->user_id)
              <!-- Book Now Button for Renters -->
              <a href="{{ route('bookings.create', $property) }}" class="block w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-medium transition-colors duration-200 text-center">
                Book This Property
              </a>
              <button class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-lg font-medium transition-colors duration-200">
                Contact Owner
              </button>
            @endif

            @if(Auth::id() === $property->user_id)
              <!-- Owner Actions -->
              <div class="flex space-x-3">
                <a href="{{ route('properties.edit', $property) }}" 
                   class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-medium transition-colors duration-200 text-center">
                  Edit Property
                </a>
                <form method="POST" action="{{ route('properties.destroy', $property) }}" class="flex-1">
                  @csrf
                  @method('DELETE')
                  <button type="submit" 
                          onclick="return confirm('Are you sure you want to delete this property?')"
                          class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-medium transition-colors duration-200">
                    Delete
                  </button>
                </form>
              </div>
            @endif
          @else
            <!-- Guest Actions -->
            <div class="text-center py-4">
              <p class="text-gray-600 mb-4">Please login to book this property</p>
              <div class="space-y-2">
                <a href="{{ route('login') }}" 
                   class="block w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-medium transition-colors duration-200 text-center">
                  Login to Book
                </a>
                <a href="{{ route('register') }}" 
                   class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-lg font-medium transition-colors duration-200 text-center">
                  Create Account
                </a>
              </div>
            </div>
          @endauth
        </div>
      </div>

      <!-- Back Button -->
      <div class="text-center mt-8">
        <a href="{{ url()->previous() }}" 
           class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
          </svg>
          Back
        </a>
      </div>

    </div>
  </main>

</body>
</html>
