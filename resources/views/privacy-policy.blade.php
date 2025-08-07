<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Privacy Policy - HomyGo</title>
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
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Privacy Policy</h1>
        <p class="text-gray-600">Last updated: {{ date('F j, Y') }}</p>
      </div>

      <!-- Content -->
      <div class="prose prose-gray max-w-none">
        <div class="mb-6">
          <p class="text-lg text-gray-700 mb-4">
            <strong>HomyGo</strong> is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our platform at homygo.com and use our services.
          </p>
          <p class="text-gray-600">
            By using our platform, you agree to the collection and use of information in accordance with this Privacy Policy.
          </p>
        </div>

        <!-- Section 1 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">1. Information We Collect</h2>
          <p class="text-gray-700 mb-4">We may collect the following types of personal and usage information:</p>
          
          <h3 class="text-xl font-medium text-gray-900 mb-3">A. Personal Information</h3>
          <ul class="list-disc list-inside space-y-2 text-gray-700 mb-4">
            <li>Name</li>
            <li>Email address</li>
            <li>Phone number</li>
            <li>Physical address (for renters and property listings)</li>
            <li>Government-issued ID (for verification purposes)</li>
            <li>Bank account or e-wallet details (for deposits/withdrawals)</li>
          </ul>

          <h3 class="text-xl font-medium text-gray-900 mb-3">B. Usage Information</h3>
          <ul class="list-disc list-inside space-y-2 text-gray-700">
            <li>IP address</li>
            <li>Browser type and version</li>
            <li>Pages visited and time spent</li>
            <li>Cookies and session data</li>
          </ul>
        </div>

        <!-- Section 2 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">2. How We Use Your Information</h2>
          <p class="text-gray-700 mb-4">We use your information to:</p>
          <ul class="list-disc list-inside space-y-2 text-gray-700">
            <li>Create and manage your user account</li>
            <li>Verify your identity (KYC)</li>
            <li>Enable property bookings and payments</li>
            <li>Facilitate communication between renters and landlords</li>
            <li>Improve our services and customer support</li>
            <li>Send transactional and promotional emails (only with consent)</li>
            <li>Comply with legal and regulatory obligations</li>
          </ul>
        </div>

        <!-- Section 3 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">3. How We Share Your Information</h2>
          <p class="text-gray-700 mb-4">We do not sell your personal data. However, we may share your information with:</p>
          <ul class="list-disc list-inside space-y-2 text-gray-700">
            <li>Service providers (e.g. payment processors, SMS/email services)</li>
            <li>Landlords or renters (only relevant information necessary for rental transactions)</li>
            <li>Law enforcement or legal authorities (if required by law)</li>
            <li>Third-party analytics tools (aggregated, anonymized data only)</li>
          </ul>
        </div>

        <!-- Section 4 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">4. Your Privacy Rights</h2>
          <p class="text-gray-700 mb-4">You have the right to:</p>
          <ul class="list-disc list-inside space-y-2 text-gray-700">
            <li>Access the personal data we hold about you</li>
            <li>Correct any inaccurate or incomplete data</li>
            <li>Request deletion of your account and data</li>
            <li>Withdraw your consent for marketing communications</li>
            <li>File a complaint with a data protection authority</li>
          </ul>
        </div>

        <!-- Section 5 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">5. Cookies and Tracking Technologies</h2>
          <p class="text-gray-700 mb-4">We use cookies and similar technologies to:</p>
          <ul class="list-disc list-inside space-y-2 text-gray-700 mb-4">
            <li>Remember your preferences</li>
            <li>Keep you logged in</li>
            <li>Analyze usage patterns</li>
            <li>Enhance your experience on our platform</li>
          </ul>
          <p class="text-gray-700">You can manage your cookie preferences in your browser settings.</p>
        </div>

        <!-- Section 6 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">6. Data Retention</h2>
          <p class="text-gray-700 mb-4">We retain your personal data only as long as:</p>
          <ul class="list-disc list-inside space-y-2 text-gray-700 mb-4">
            <li>Your account is active</li>
            <li>Necessary to provide our services</li>
            <li>Required by applicable laws (e.g., tax, audit)</li>
          </ul>
          <p class="text-gray-700">After this period, your data will be securely deleted or anonymized.</p>
        </div>

        <!-- Section 7 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">7. Security Measures</h2>
          <p class="text-gray-700 mb-4">We use industry-standard security practices to protect your data:</p>
          <ul class="list-disc list-inside space-y-2 text-gray-700 mb-4">
            <li>SSL encryption</li>
            <li>Access controls</li>
            <li>Secure cloud infrastructure</li>
            <li>Regular security audits</li>
          </ul>
          <p class="text-gray-700">However, no method of transmission over the internet is 100% secure.</p>
        </div>

        <!-- Section 8 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">8. Children's Privacy</h2>
          <p class="text-gray-700">
            HomyGo is not intended for individuals under the age of 18. We do not knowingly collect data from minors. If we learn that a child has provided personal data, we will delete it immediately.
          </p>
        </div>

        <!-- Section 9 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">9. Changes to This Policy</h2>
          <p class="text-gray-700">
            We may update this Privacy Policy from time to time. Changes will be posted on this page with an updated revision date.
          </p>
        </div>

        <!-- Section 10 -->
        <div class="mb-8">
          <h2 class="text-2xl font-semibold text-gray-900 mb-4">10. Contact Us</h2>
          <p class="text-gray-700 mb-4">If you have any questions or concerns about this Privacy Policy, please contact us at:</p>
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
