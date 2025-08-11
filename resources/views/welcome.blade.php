{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'HomyGO') }} - Exclusive Rentals in Cagayan de Oro</title>
    
    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Custom font from Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-bg {
            background-image: linear-gradient(rgba(17, 24, 39, 0.6), rgba(17, 24, 39, 0.6)), 
                              url('https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
    {{-- Header --}}
    <header class="absolute top-0 left-0 z-50 w-full p-4 md:px-8 bg-transparent">
        <div class="flex items-center justify-between mx-auto max-w-7xl">
            <div class="text-xl font-bold text-white tracking-tight">
                <a href="{{ route('welcome') }}">HomyGO</a>
            </div>
            <nav class="hidden md:flex space-x-6 text-white font-medium">
                <a href="{{ route('welcome') }}" class="hover:text-teal-300 transition-colors">Home</a>
                <a href="#properties" class="hover:text-teal-300 transition-colors">Properties</a>
                <a href="#host" class="hover:text-teal-300 transition-colors">Become a Host</a>
                <a href="#contact" class="hover:text-teal-300 transition-colors">Contact</a>
            </nav>
            <div class="hidden md:flex space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="text-white font-medium hover:text-teal-300 transition-colors">Sign In</a>
                    <a href="{{ route('register') }}" class="bg-white text-gray-900 px-4 py-2 rounded-full font-bold shadow-lg hover:bg-gray-200 transition-colors">Sign Up</a>
                @else
                    @if(Auth::user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" class="text-white font-medium hover:text-teal-300 transition-colors">Admin</a>
                    @elseif(Auth::user()->hasRole('landlord'))
                        <a href="{{ route('landlord.dashboard') }}" class="text-white font-medium hover:text-teal-300 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('renter.dashboard') }}" class="text-white font-medium hover:text-teal-300 transition-colors">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-white text-gray-900 px-4 py-2 rounded-full font-bold shadow-lg hover:bg-gray-200 transition-colors">Sign Out</button>
                    </form>
                @endguest
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main>
        {{-- Hero Section --}}
        <section class="relative h-[80vh] md:h-[90vh] flex items-center justify-center text-white hero-bg">
            <div class="relative z-10 text-center max-w-4xl px-4">
                <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-4">Find your exclusive stay in Cagayan de Oro.</h1>
                <p class="text-lg md:text-xl font-medium opacity-90 mb-8">
                    Discover hand-picked properties for your perfect visit.
                </p>

                {{-- Search Bar --}}
                <form action="{{ route('properties.index') }}" method="GET" class="bg-white p-2 md:p-4 rounded-full shadow-2xl flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
                    @csrf
                    <div class="flex items-center w-full md:w-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-500 ml-3"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        <input type="text" name="location" placeholder="Location" class="w-full bg-transparent px-2 py-3 md:py-2 text-gray-800 placeholder-gray-400 focus:outline-none" value="Cagayan de Oro"/>
                    </div>
                    <div class="flex items-center w-full md:w-auto md:border-l border-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-500 ml-3"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg>
                        <input type="date" name="check_in" class="w-full bg-transparent px-2 py-3 md:py-2 text-gray-800 placeholder-gray-400 focus:outline-none"/>
                    </div>
                    <div class="flex items-center w-full md:w-auto md:border-l border-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-500 ml-3"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        <input type="number" name="guests" placeholder="Guests" class="w-full bg-transparent px-2 py-3 md:py-2 text-gray-800 placeholder-gray-400 focus:outline-none" min="1" value="2"/>
                    </div>
                    <button type="submit" class="w-full md:w-auto bg-teal-500 text-white font-bold px-8 py-3 rounded-full hover:bg-teal-600 transition-colors shadow-md flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="md:mr-0"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        <span class="md:hidden ml-2">Search</span>
                    </button>
                </form>
            </div>
        </section>
};

        {{-- Features Section --}}
        <section class="py-16 md:py-24 bg-gray-50">
            <div class="mx-auto max-w-7xl px-4 text-center">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Why choose HomyGO?</h2>
                <p class="text-lg text-gray-600 mb-12 max-w-2xl mx-auto">
                    We provide a seamless and secure platform with verified hosts and curated properties.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-8 bg-white rounded-xl shadow-lg border border-gray-200">
                        <div class="mb-4 flex justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-teal-500"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Verified Listings</h3>
                        <p class="text-gray-600">Every property is hand-inspected and verified for quality and accuracy.</p>
                    </div>
                    <div class="p-8 bg-white rounded-xl shadow-lg border border-gray-200">
                        <div class="mb-4 flex justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-teal-500"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">24/7 Guest Support</h3>
                        <p class="text-gray-600">Our dedicated support team is available around the clock to assist you.</p>
                    </div>
                    <div class="p-8 bg-white rounded-xl shadow-lg border border-gray-200">
                        <div class="mb-4 flex justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-teal-500"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Exclusive Experiences</h3>
                        <p class="text-gray-600">Access unique local experiences and amenities available only to our guests.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Featured Listings --}}
        <section class="py-16 md:py-24 bg-white">
            <div class="mx-auto max-w-7xl px-4">
                <h2 class="text-3xl md:text-4xl font-extrabold text-center mb-12">Featured Properties</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @php
                        $listings = [
                            [
                                'image' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                                'title' => 'Modern Condo near Centrio Mall',
                                'price' => '₱2,500 / night',
                                'rating' => 4.8,
                                'amenities' => ['2 Beds', '1 Bath', 'WiFi'],
                            ],
                            [
                                'image' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                                'title' => 'Cozy Studio near Liceo U',
                                'price' => '₱1,800 / night',
                                'rating' => 4.9,
                                'amenities' => ['1 Bed', '1 Bath', 'Pet-friendly'],
                            ],
                            [
                                'image' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                                'title' => 'Riverfront Apartment with City View',
                                'price' => '₱3,500 / night',
                                'rating' => 5.0,
                                'amenities' => ['3 Beds', '2 Baths', 'Parking'],
                            ],
                        ];
                    @endphp
                    @foreach($listings as $listing)
                        <div class="bg-gray-100 rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-[1.02]">
                            <div class="relative h-60">
                                <img src="{{ $listing['image'] }}" alt="{{ $listing['title'] }}" class="w-full h-full object-cover">
                                <div class="absolute top-4 right-4 bg-teal-500 text-white px-3 py-1 rounded-full font-bold text-sm flex items-center">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg> {{ $listing['rating'] }}
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2">{{ $listing['title'] }}</h3>
                                <p class="text-gray-500 font-medium mb-4">{{ $listing['price'] }}</p>
                                <div class="flex flex-wrap gap-4 text-gray-600">
                                    @foreach($listing['amenities'] as $amenity)
                                        <span class="flex items-center text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="M2 20v-8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v8"/><path d="M4 10V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v4"/><path d="M15 10v6a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-6"/><path d="M7 10v4a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-4"/></svg>
                                            {{ $amenity }}
                                        </span>
                                    @endforeach
                                </div>
                                <a href="{{ route('properties.index') }}" class="block mt-6 w-full bg-gray-900 text-white py-3 text-center rounded-full font-bold hover:bg-gray-700 transition-colors">
                                    View Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>        {{-- Why Choose Us Section --}}  
        <section class="py-16 md:py-24 bg-gray-50">  
            <div class="mx-auto max-w-7xl px-4">  
                <div class="md:grid md:grid-cols-2 md:gap-12">  
                    <div class="text-center md:text-left mb-10 md:mb-0">  
                        <p class="text-teal-500 text-sm font-bold uppercase mb-2">Our Promise</p>  
                        <h2 class="text-3xl md:text-4xl font-extrabold leading-tight">  
                            A rental platform designed for our city.  
                        </h2>  
                        <p class="mt-4 text-lg text-gray-600">  
                            We go beyond the typical rental experience by focusing exclusively on what makes our city great.  
                        </p>  
                    </div>  
                    <div class="space-y-8">  
                        @php  
                            $benefits = [  
                                ['title' => 'Local Expertise', 'description' => 'Our team lives and breathes Cagayan de Oro, ensuring you get the best local recommendations and support.'],  
                                ['title' => 'Hand-Picked Properties', 'description' => 'We don't just list properties; we curate them. Every home is selected for its unique charm and quality.'],  
                                ['title' => 'Community Focused', 'description' => 'HomyGO is built by locals, for locals. We support our community by featuring small businesses and local hosts.'],  
                            ];  
                        @endphp  
                        @foreach($benefits as $benefit)  
                            <div class="flex items-start">  
                                <div class="flex-shrink-0">  
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-teal-500 mt-1"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>  
                                </div>  
                                <div class="ml-4">  
                                    <h3 class="text-xl font-bold mb-1">{{ $benefit['title'] }}</h3>  
                                    <p class="text-gray-600">{{ $benefit['description'] }}</p>  
                                </div>  
                            </div>  
                        @endforeach  
                    </div>  
                </div>  
            </div>  
        </section>  

        {{-- CTA Section --}}  
        <section class="py-20 bg-gray-900 text-white text-center">  
            <div class="mx-auto max-w-3xl px-4">  
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Become a HomyGO Host</h2>  
                <p class="text-lg font-medium opacity-90 mb-8">  
                    Share your space with a community of vetted guests. It's simple, secure, and rewarding.  
                </p>  
                @guest  
                    <a href="{{ route('register') }}" class="bg-teal-500 text-white font-bold px-8 py-4 rounded-full shadow-lg hover:bg-teal-600 transition-colors inline-block">  
                        Start Hosting Today  
                    </a>  
                @else  
                    <a href="{{ route('properties.create') }}" class="bg-teal-500 text-white font-bold px-8 py-4 rounded-full shadow-lg hover:bg-teal-600 transition-colors inline-block">  
                        List Your Property  
                    </a>  
                @endguest  
            </div>  
        </section>  
    </main>  

    {{-- Footer --}}  
    <footer class="bg-gray-800 text-gray-400 py-12">  
        <div class="mx-auto max-w-7xl px-4">  
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">  
                <div>  
                    <h4 class="text-white font-bold mb-4">HomyGO</h4>  
                    <p>Exclusive rentals for your city.</p>  
                </div>  
                <div>  
                    <h4 class="text-white font-bold mb-4">Company</h4>  
                    <ul class="space-y-2">  
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>  
                        <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>  
                        <li><a href="#" class="hover:text-white transition-colors">Press</a></li>  
                    </ul>  
                </div>  
                <div>  
                    <h4 class="text-white font-bold mb-4">Support</h4>  
                    <ul class="space-y-2">  
                        <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>  
                        <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>  
                        <li><a href="#" class="hover:text-white transition-colors">Trust & Safety</a></li>  
                    </ul>  
                </div>  
                <div>  
                    <h4 class="text-white font-bold mb-4">Connect</h4>  
                    <div class="flex space-x-4">  
                        <a href="#" class="hover:text-white transition-colors">  
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">  
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>  
                            </svg>  
                        </a>  
                        <a href="#" class="hover:text-white transition-colors">  
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">  
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>  
                            </svg>  
                        </a>  
                        <a href="#" class="hover:text-white transition-colors">  
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">  
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001z"/>  
                            </svg>  
                        </a>  
                    </div>  
                </div>  
            </div>  
            <div class="border-t border-gray-700 pt-8 text-center text-sm">  
                <p>&copy; {{ date('Y') }} HomyGO, Inc. All rights reserved.</p>  
            </div>  
        </div>  
    </footer>  
</body>  
</html>

// Why choose us section - as a more detailed list of benefits
const WhyChooseUs = () => {
  const benefits = [
    { title: 'Local Expertise', description: 'Our team lives and breathes Cagayan de Oro, ensuring you get the best local recommendations and support.' },
    { title: 'Hand-Picked Properties', description: 'We don\'t just list properties; we curate them. Every home is selected for its unique charm and quality.' },
    { title: 'Community Focused', description: 'Homygo is built by locals, for locals. We support our community by featuring small businesses and local hosts.' },
  ];

  return (
    <section className="py-16 md:py-24 bg-gray-50">
      <div className="mx-auto max-w-7xl px-4">
        <div className="md:grid md:grid-cols-2 md:gap-12">
          <div className="text-center md:text-left mb-10 md:mb-0">
            <p className="text-teal-500 text-sm font-bold uppercase mb-2">Our Promise</p>
            <h2 className="text-3xl md:text-4xl font-extrabold leading-tight">
              A rental platform designed for our city.
            </h2>
            <p className="mt-4 text-lg text-gray-600">
              We go beyond the typical rental experience by focusing exclusively on what makes our city great.
            </p>
          </div>
          <div className="space-y-8">
            {benefits.map((benefit, index) => (
              <div key={index} className="flex items-start">
                <div className="flex-shrink-0">
                  <CheckCircle size={24} className="text-teal-500 mt-1" />
                </div>
                <div className="ml-4">
                  <h3 className="text-xl font-bold mb-1">{benefit.title}</h3>
                  <p className="text-gray-600">{benefit.description}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
};


// Call-to-action section
const CTASection = () => {
  return (
    <section className="py-20 bg-gray-900 text-white text-center">
      <div className="mx-auto max-w-3xl px-4">
        <h2 className="text-3xl md:text-4xl font-extrabold mb-4">Become a Homygo Host</h2>
        <p className="text-lg font-medium opacity-90 mb-8">
          Share your space with a community of vetted guests. It's simple, secure, and rewarding.
        </p>
        <button className="bg-teal-500 text-white font-bold px-8 py-4 rounded-full shadow-lg hover:bg-teal-600 transition-colors">
          Start Hosting Today
        </button>
      </div>
    </section>
  );
};

// Footer component
const Footer = () => {
  const currentYear = new Date().getFullYear();

  return (
    <footer className="bg-gray-800 text-gray-400 py-12">
      <div className="mx-auto max-w-7xl px-4">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
          <div>
            <h4 className="text-white font-bold mb-4">Homygo</h4>
            <p>Exclusive rentals for your city.</p>
          </div>
          <div>
            <h4 className="text-white font-bold mb-4">Company</h4>
            <ul className="space-y-2">
              <li><a href="#" className="hover:text-white transition-colors">About Us</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Careers</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Press</a></li>
            </ul>
          </div>
          <div>
            <h4 className="text-white font-bold mb-4">Support</h4>
            <ul className="space-y-2">
              <li><a href="#" className="hover:text-white transition-colors">Help Center</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Contact Us</a></li>
              <li><a href="#" className="hover:text-white transition-colors">Trust & Safety</a></li>
            </ul>
          </div>
          <div>
            <h4 className="text-white font-bold mb-4">Connect</h4>
            <div className="flex space-x-4">
              <a href="#" className="hover:text-white transition-colors"><Car /></a>
              <a href="#" className="hover:text-white transition-colors"><Dog /></a>
              <a href="#" className="hover:text-white transition-colors"><Heart /></a>
            </div>
          </div>
        </div>
        <div className="border-t border-gray-700 pt-8 text-center text-sm">
          <p>&copy; {currentYear} Homygo, Inc. All rights reserved.</p>
        </div>
      </div>
    </footer>
  );
};

export default App;
