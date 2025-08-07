<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Terms of Service - HomyGo</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50">
  <!-- Header -->
  <header class="bg-white shadow-sm border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Logo -->
        <div class="flex items-center">
          <a href="{{ url('/') }}" class="flex items-center space-x-3">
            <img src="{{ asset('H.svg') }}" alt="HomyGo Logo" class="h-8 w-8">
            <span class="text-2xl font-bold text-gray-900">HomyGo</span>
          </a>
        </div>
        
        <!-- Navigation -->
        <nav class="flex items-center space-x-4">
          <a href="{{ url('/') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
            Home
          </a>
          @auth
            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
              Dashboard
            </a>
          @else
            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
              Sign In
            </a>
            <a href="{{ route('register') }}" class="btn-primary">
              Get Started
            </a>
          @endauth
        </nav>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="dashboard-card">
      <!-- Page Header -->
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Terms of Service</h1>
        <p class="text-gray-600">Last updated: {{ date('F j, Y') }}</p>
      </div>

      <!-- Content -->
      <div class="prose prose-gray max-w-none">
        <div class="mb-6">
          <p class="text-lg text-gray-700">
            Welcome to <strong>HomyGo</strong>. These Terms of Service ("Terms") govern your access to and use of our platform. By registering, browsing, or using HomyGo's services, you agree to be bound by these Terms.
          </p>
        </div>

        <!-- Section 1 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">1. Overview</h2>
          <p class="text-gray-700">
            HomyGo is a digital platform that connects renters with property owners or landlords. We facilitate property listings, bookings, payments, and secure communication.
          </p>
        </div>

        <!-- Section 2 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">2. Eligibility</h2>
          <p class="text-gray-700 mb-4">You may only use HomyGo if:</p>
          <ul class="list-disc list-inside space-y-2 text-gray-700 mb-4">
            <li>You are at least 18 years old</li>
            <li>You have the legal capacity to enter into contracts</li>
            <li>You provide accurate and truthful information</li>
          </ul>
          <p class="text-gray-700">We reserve the right to verify identities and reject or remove users who fail to comply.</p>
        </div>

        <!-- Section 3 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">3. Account Responsibilities</h2>
          <ul class="list-disc list-inside space-y-2 text-gray-700">
            <li>You are responsible for maintaining the confidentiality of your account and password.</li>
            <li>You must notify us immediately if you suspect unauthorized access.</li>
            <li>You are responsible for all activity under your account.</li>
          </ul>
        </div>

        <!-- Section 4 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">4. Platform Usage</h2>
          <p class="text-gray-700 mb-4">You agree not to:</p>
          <ul class="list-disc list-inside space-y-2 text-gray-700 mb-4">
            <li>Post fraudulent or misleading listings</li>
            <li>Violate any applicable housing or rental laws</li>
            <li>Circumvent HomyGo systems to avoid platform fees</li>
            <li>Use bots or scripts to access or scrape the platform</li>
            <li>Harass, threaten, or abuse other users</li>
          </ul>
          <p class="text-gray-700 text-sm bg-yellow-50 p-3 rounded-md border border-yellow-200">
            <strong>⚠️ Warning:</strong> Violation may result in account suspension or permanent ban.
          </p>
        </div>

        <!-- Section 5 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">5. Booking, Payments & Fees</h2>
          <ul class="list-disc list-inside space-y-2 text-gray-700">
            <li>Bookings made through HomyGo are binding agreements between renter and property owner.</li>
            <li>HomyGo may charge service or platform fees, disclosed at checkout.</li>
            <li>Payments are processed via secure third-party systems.</li>
            <li>Refunds and cancellations are governed by the individual listing's policy and HomyGo's dispute resolution guidelines.</li>
          </ul>
        </div>

        <!-- Section 6 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">6. Content Policy</h2>
          <ul class="list-disc list-inside space-y-2 text-gray-700">
            <li>You retain ownership of your content (e.g., photos, descriptions, reviews).</li>
            <li>You grant HomyGo a non-exclusive, worldwide license to use, display, and distribute your content on the platform.</li>
            <li>We may remove content that is illegal, discriminatory, or violates our standards.</li>
          </ul>
        </div>

        <!-- Section 7 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">7. Data Privacy & DPA Compliance</h2>
          <div class="bg-blue-50 p-4 rounded-lg border border-blue-200 mb-4">
            <p class="text-blue-900 font-medium mb-2">🇵🇭 Philippines Data Privacy Act Compliance</p>
            <p class="text-blue-800 text-sm">HomyGo complies with the Data Privacy Act of 2012 (Republic Act No. 10173) of the Philippines.</p>
          </div>
          
          <p class="text-gray-700 mb-4">By using HomyGo, you agree that:</p>
          <ul class="list-disc list-inside space-y-2 text-gray-700 mb-4">
            <li>Your personal data may be collected, stored, and processed solely for legitimate business purposes such as account management, identity verification, and transaction facilitation.</li>
            <li>Your data will be protected by physical, organizational, and technical measures aligned with the National Privacy Commission (NPC) standards.</li>
            <li>You may request access to, correction of, or deletion of your personal data at any time.</li>
            <li>We will not sell, rent, or share your personal data with third parties without your consent, unless required by law.</li>
          </ul>
          <p class="text-gray-700">
            For more information, see our <a href="{{ route('privacy-policy') }}" class="text-blue-600 hover:underline">Privacy Policy</a>.
          </p>
        </div>

        <!-- Section 8 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">8. Fair Housing & Non-Discrimination Policy</h2>
          <div class="bg-green-50 p-4 rounded-lg border border-green-200 mb-4">
            <p class="text-green-900 font-medium">✊ Equal Housing Opportunity</p>
            <p class="text-green-800 text-sm">HomyGo supports equal access to housing opportunities and prohibits any form of discrimination.</p>
          </div>
          
          <p class="text-gray-700 mb-4">Users may not discriminate against renters or property owners on the basis of:</p>
          <ul class="list-disc list-inside space-y-2 text-gray-700 mb-4">
            <li>Race, color, religion, or national origin</li>
            <li>Gender, sexual orientation, or marital status</li>
            <li>Disability or medical condition</li>
            <li>Age (except as permitted by law)</li>
            <li>Income source (e.g., employment, pension, remittances)</li>
          </ul>
          
          <div class="bg-red-50 p-4 rounded-lg border border-red-200 mb-4">
            <p class="text-red-900 font-medium text-sm">⚖️ Legal Compliance</p>
            <p class="text-red-800 text-sm">Violations of this policy may result in account removal and legal consequences under applicable laws (e.g., RA 7277 – Magna Carta for Disabled Persons, RA 9262 – Anti-Violence Against Women and Children Act).</p>
          </div>
          
          <p class="text-gray-700">We reserve the right to review and moderate listings or conversations flagged for discriminatory language.</p>
        </div>

        <!-- Section 9 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">9. Disclaimers</h2>
          <ul class="list-disc list-inside space-y-2 text-gray-700">
            <li>HomyGo acts as a facilitator, not a party to rental agreements.</li>
            <li>We do not guarantee the availability, condition, or legality of listed properties.</li>
            <li>Use the platform at your own risk. We are not liable for damages, losses, or disputes arising between users.</li>
          </ul>
        </div>

        <!-- Section 10 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">10. Limitation of Liability</h2>
          <p class="text-gray-700 mb-4">To the extent permitted by law:</p>
          <ul class="list-disc list-inside space-y-2 text-gray-700">
            <li>HomyGo shall not be liable for indirect or incidental damages.</li>
            <li>Our total liability for claims shall not exceed the amount paid to us in the last 12 months.</li>
          </ul>
        </div>

        <!-- Section 11 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">11. Termination</h2>
          <p class="text-gray-700 mb-4">We may suspend or terminate your access to HomyGo at any time, with or without notice, for:</p>
          <ul class="list-disc list-inside space-y-2 text-gray-700 mb-4">
            <li>Violating these Terms</li>
            <li>Engaging in illegal or abusive conduct</li>
            <li>Failing verification or fraud checks</li>
          </ul>
          <p class="text-gray-700">You may delete your account anytime via your dashboard or by contacting support.</p>
        </div>

        <!-- Section 12 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">12. Governing Law</h2>
          <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <p class="text-gray-700 mb-2">These Terms are governed by the laws of the <strong>Republic of the Philippines</strong>.</p>
            <p class="text-gray-700">Any disputes shall be settled in the courts of <strong>Quezon City, Metro Manila</strong>, unless otherwise required by law.</p>
          </div>
        </div>

        <!-- Section 13 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">13. Changes to Terms</h2>
          <p class="text-gray-700">
            We may update these Terms periodically. Continued use of the platform after updates constitutes your agreement to the new terms.
          </p>
        </div>

        <!-- Section 14 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">14. Contact Us</h2>
          <p class="text-gray-700 mb-4">If you have questions about these Terms, you may reach us at:</p>
          <div class="bg-gray-50 p-4 rounded-lg">
            <p class="text-gray-700 mb-2">
              <span class="font-medium">📧 Email:</span> 
              <a href="mailto:support@homygo.com" class="text-blue-600 hover:underline">support@homygo.com</a>
            </p>
            <p class="text-gray-700">
              <span class="font-medium">🌐 Website:</span> 
              <a href="{{ url('/') }}" class="text-blue-600 hover:underline">{{ url('/') }}</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-white border-t mt-16">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
      <div class="text-center text-gray-600">
        <p>&copy; {{ date('Y') }} HomyGo. All rights reserved.</p>
        <div class="mt-2 space-x-4">
          <a href="{{ route('privacy-policy') }}" class="text-blue-600 hover:underline">Privacy Policy</a>
          <span>•</span>
          <a href="{{ route('terms-of-service') }}" class="text-blue-600 hover:underline">Terms of Service</a>
          <span>•</span>
          <a href="#" class="text-blue-600 hover:underline">Contact</a>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>
