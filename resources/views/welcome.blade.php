<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome to Homygo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    html, body {
      margin: 0;
      padding: 0;
      background-color: #f9fafb;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      font-family: 'Segoe UI', sans-serif;
    }

    .logo-container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .logo {
      width: 80px;
      height: 80px;
      animation: dropBounce 1s ease-in, spinFlip 1s ease-in-out 1s, zoomFade 0.7s ease-in-out 2s forwards;
      animation-fill-mode: forwards;
      transform-style: preserve-3d;
      backface-visibility: hidden;
    }

    .loading-text {
      margin-top: 20px;
      font-size: 1.2rem;
      color: #555;
      opacity: 0;
      animation: fadeIn 0.5s 1.8s forwards;
    }

    @keyframes dropBounce {
      0% {
        transform: translateY(-200%) scale(1);
      }
      60% {
        transform: translateY(0%) scale(1.05);
      }
      80% {
        transform: translateY(-15%) scale(0.98);
      }
      100% {
        transform: translateY(0%) scale(1);
      }
    }

    @keyframes spinFlip {
      from {
        transform: translateY(0%) rotateY(0deg);
      }
      to {
        transform: translateY(0%) rotateY(1440deg); /* 4 fast flips */
      }
    }

    @keyframes zoomFade {
      from {
        transform: scale(1) rotateY(1440deg);
        opacity: 1;
      }
      to {
        transform: scale(0.5) translateY(-200px) rotateY(1440deg);
        opacity: 0;
      }
    }

    @keyframes fadeIn {
      to {
        opacity: 1;
      }
    }
  </style>
</head>
<body>
  <div class="logo-container">
    <img src="{{ asset('H.svg') }}" alt="Homygo Logo" class="logo">
    <div class="loading-text">Welcome to Homygo...</div>
  </div>

  <script>
    setTimeout(() => {
      window.location.href = "{{ route('login') }}";
    }, 3000); // matches animation
  </script>
</body>
</html>
