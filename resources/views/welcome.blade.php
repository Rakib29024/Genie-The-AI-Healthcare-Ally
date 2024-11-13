<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Fresh AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      .logo {
          width: 48px;
          height: 48px;
          transform: scale(1.8);
      }

      .cutom-btn {
          width: 200px;
          font-weight: bold;
          background: #d82100;
      }

      .cutom-btn:hover {
          background: #000a1f;
          box-shadow: 0 0 400px 200px rgb(0 42 87);
      }

      .custom-gradient {
          background: linear-gradient(18deg, #35031e, #000359);
      }

      .loader-section {
          position: relative;
      }

      .loader {
          position: absolute;
          top: 50%;
          left: 50%;
          width: 50px;
          height: 50px;
          transform: translate(-50%, -50%);
          border-radius: 50%;
          /* Circular shape */
          background: radial-gradient(circle, rgba(0, 13, 131, 0), rgba(5, 11, 68, 0.295));
          animation: pulse 2s infinite ease-in-out, waveLight 1.5s infinite cubic-bezier(0.4, 0, 0.2, 1);
      }

      @keyframes pulse {

          0%,
          100% {
              width: 50px;
              height: 50px;
          }

          50% {
              width: 100px;
              height: 100px;
          }
      }

      @keyframes waveLight {

          0%,
          100% {
              opacity: 1;
              filter: drop-shadow(0 0 10px rgba(8, 24, 167, 0.3)) drop-shadow(0 0 40px rgba(0, 60, 255, 0.6)) drop-shadow(0 0 80px rgba(255, 255, 255, 0.8));
          }

          50% {
              opacity: .8;
              filter: drop-shadow(0 0 20px rgba(8, 24, 167, 0.6)) drop-shadow(0 0 80px rgba(0, 60, 255, 1)) drop-shadow(0 0 150px rgba(255, 255, 255, 1));
          }
      }

      .text-shadow {
          text-shadow: 0px 14px 15px rgb(12 25 87 / 98%)
      }
      </style>
</head>

<body class="custom-gradient overflow-hidden">
    <div class="h-screen flex items-center justify-center text-white text-center">
        <div>
            <div class="flex justify-center loader-section">
                <svg id="aiChatBackgroundLogo" class="loader" xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 214 214" fill="none">
                    <g opacity="0.5" filter="url(#filter0_f_18051_3015)">
                    <path d="M164.771 106.773C156.816 106.773 149.467 105.266 142.474 102.297C135.477 99.2296 129.304 95.0495 124.129 89.874C118.954 84.6986 114.774 78.5266 111.707 71.5299C108.736 64.5345 107.23 57.1843 107.23 49.2285C107.23 49.1022 107.128 49 107.002 49C106.876 49 106.773 49.1022 106.773 49.2285C106.773 57.1831 105.219 64.532 102.152 71.5299C99.1807 78.5266 95.0501 84.6986 89.8747 89.874C84.7005 95.0495 78.5278 99.2289 71.5318 102.296C64.5358 105.266 57.1843 106.773 49.2285 106.773C49.1022 106.773 49 106.876 49 107.002C49 107.128 49.1022 107.23 49.2285 107.23C57.1824 107.23 64.5339 108.785 71.5318 111.852C78.5291 114.825 84.7011 118.956 89.8747 124.129C95.0501 129.306 99.1813 135.477 102.153 142.476C105.219 149.47 106.773 156.816 106.773 164.771C106.773 164.897 106.876 164.999 107.002 164.999C107.128 164.999 107.23 164.897 107.23 164.771C107.23 156.814 108.736 149.468 111.706 142.476C114.774 135.477 118.953 129.305 124.129 124.129C129.303 118.954 135.474 114.824 142.474 111.852C149.469 108.786 156.818 107.23 164.771 107.23C164.898 107.23 165 107.128 165 107.002C165 106.876 164.898 106.773 164.771 106.773Z" fill="url(#paint0_linear_18051_3015)"></path>
                    </g>
                    <path d="M164.771 106.773C156.816 106.773 149.467 105.266 142.474 102.297C135.477 99.2296 129.304 95.0495 124.129 89.874C118.954 84.6986 114.774 78.5266 111.707 71.5299C108.736 64.5345 107.23 57.1843 107.23 49.2285C107.23 49.1022 107.128 49 107.002 49C106.876 49 106.773 49.1022 106.773 49.2285C106.773 57.1831 105.219 64.532 102.152 71.5299C99.1807 78.5266 95.0501 84.6986 89.8747 89.874C84.7005 95.0495 78.5278 99.2289 71.5318 102.296C64.5358 105.266 57.1843 106.773 49.2285 106.773C49.1022 106.773 49 106.876 49 107.002C49 107.128 49.1022 107.23 49.2285 107.23C57.1824 107.23 64.5339 108.785 71.5318 111.852C78.5291 114.825 84.7011 118.956 89.8747 124.129C95.0501 129.306 99.1813 135.477 102.153 142.476C105.219 149.47 106.773 156.816 106.773 164.771C106.773 164.897 106.876 164.999 107.002 164.999C107.128 164.999 107.23 164.897 107.23 164.771C107.23 156.814 108.736 149.468 111.706 142.476C114.774 135.477 118.953 129.305 124.129 124.129C129.303 118.954 135.474 114.824 142.474 111.852C149.469 108.786 156.818 107.23 164.771 107.23C164.898 107.23 165 107.128 165 107.002C165 106.876 164.898 106.773 164.771 106.773Z" fill="url(#paint1_linear_18051_3015)"></path>
                    <defs>
                    <filter id="filter0_f_18051_3015" x="0" y="0" width="214" height="213.999" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                    <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"></feBlend>
                    <feGaussianBlur stdDeviation="24.5" result="effect1_foregroundBlur_18051_3015"></feGaussianBlur>
                    </filter>
                    <linearGradient id="paint0_linear_18051_3015" x1="85.1019" y1="123.981" x2="137.576" y2="79.7391" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#217BFE"></stop>
                    <stop offset="0.27" stop-color="#078EFB"></stop>
                    <stop offset="0.776981" stop-color="#A190FF"></stop>
                    <stop offset="1" stop-color="#BD99FE"></stop>
                    </linearGradient>
                    <linearGradient id="paint1_linear_18051_3015" x1="85.1019" y1="123.981" x2="137.576" y2="79.7391" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#217BFE"></stop>
                    <stop offset="0.27" stop-color="#078EFB"></stop>
                    <stop offset="0.776981" stop-color="#A190FF"></stop>
                    <stop offset="1" stop-color="#BD99FE"></stop>
                    </linearGradient>
                    </defs>
                </svg>
              </div>
          
            <h1 class="text-7xl font-bold mb-4 mt-8" style="color: #a8d7ff;position: relative;z-index: 10;">GENIE : THE AI HEALTH ALLY</h1>
            {{-- <p class="text-xl mb-6">THE AI HEALTH ASSITANCE FOR WOMEN</p> --}}
            <div class="flex space-x-6 justify-center mt-16">
              @if (Route::has('login'))
                @auth
                  <a href="{{ url('/dashboard') }}" 
                     class="cutom-btn rounded-md px-6 py-3 text-white transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Dashboard
                  </a>
                @else
                  <a href="{{ route('login') }}" 
                     class="rounded-md cutom-btn px-6 py-3 text-white transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Log in
                  </a>
      
                  @if (Route::has('register'))
                    <a href="{{ route('register') }}" 
                       class="rounded-md cutom-btn px-6 py-3 text-white transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:hover:text-white/80 dark:focus-visible:ring-white">
                      Register
                    </a>
                  @endif
                @endauth
              @endif
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>     
</body>
</html>