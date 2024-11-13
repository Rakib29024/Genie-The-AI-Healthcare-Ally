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

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            .logo {
                width: 48px;
                height: 48px;
                transform: scale(1.8);
            }

            .loader-section {
                position: relative;
                height: 100px;
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

            .custom-gradient {
                background: linear-gradient(180deg, #ffffff, rgb(99 150 255));
            }

            .header-common-bg {
                background: linear-gradient(0deg, #000000 0%, #070f25 100%);
            }

            .ai-chat-section {
                max-height: 90vh;
                overflow-y: auto;
                position: sticky;
                right: 0;
                display: flex;
                top: 5%;
            }

            /* Custom scrollbar styling */
            .ai-chat-section::-webkit-scrollbar {
                width: 8px;
                /* Scrollbar width */
            }

            .ai-chat-section::-webkit-scrollbar-track {
                background: #031a13;
                /* Track color */
            }

            .ai-chat-section::-webkit-scrollbar-thumb {
                background-color: #002e6b;
                /* Scroll thumb color */
                border-radius: 10px;
                /* Scroll thumb roundness */
                border: 2px solid #031a13;
                /* Adds space around the thumb */
            }

            .ai-chat-section::-webkit-scrollbar-thumb:hover {
                background-color: #002767;
                /* Thumb color on hover */
            }

            .custom-card {
                background: linear-gradient(18deg, #03060f, #01144a);
                box-shadow: 0px 12px 10px 0px #0b2b6c66;
            }

            .custom-label {
                background-color: #012f58;
            }


            .pagination {
                margin: 4px 16px;
                justify-content: space-between;
                display: flex;
                gap: 16px;
                padding: 8px;
            }

            .pagination button {
                border-radius: 4px;
                padding: 4px 8px;
                color: #ccecff;
            }

            .pagination button:hover {
                background: #ccecff;
                color: #071d5f
            }

            .user-content {
                background-color: rgb(231 253 255);
            }

            .ai-chat-section button {
                background-color: rgb(6 66 94);
            }

            .ai-chat-section button:hover {
                box-shadow: 0px 8px 12px 0px #1364875e;
            }

            .common-bg,
            .ai-content {
                background-color: rgb(27 49 79);
                color: ghostwhite;
            }

            .cutom-btn {
                width: 200px;
                font-weight: bold;
                border: 1px solid #7f7fe947;
            }

            .cutom-btn:hover {
                background: #000a1f;
                box-shadow: 0 0 400px 200px rgb(74 161 255 / 33%);
            }

            @keyframes gradient-blur {
                0% {
                    background-position: 0% 50%;
                }

                50% {
                    background-position: 100% 50%;
                }

                100% {
                    background-position: 0% 50%;
                }
            }

            @keyframes color-shift {
                0% {
                    background-image: linear-gradient(to right, #2e94ff, #ffcba4, #ff87ab);
                }

                50% {
                    background-image: linear-gradient(to right, #ffcba4, #ff87ab, #2e94ff);
                }

                100% {
                    background-image: linear-gradient(to right, #ff87ab, #2e94ff, #ffcba4);
                }
            }

            .main-title {
                font-size: 3rem;
                font-weight: bold;
                color: transparent;
                background-size: 200% 200%;
                background-clip: text;
                -webkit-background-clip: text;
                animation: gradient-blur 4s ease-in-out infinite, color-shift 4s ease-in-out infinite;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 custom-gradient">
            <nav x-data="{ open: false }" class="shadow-lg z-50 header-common-bg">
                <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                  <!-- Logo -->
                  <div class="flex-shrink-0">
                      <a class="flex justify-center" href="{{route('dashboard')}}">
                        <dotlottie-player src="https://lottie.host/6b85a101-ff2a-45fa-8563-e7cdc5d35cb5/jp8n68u0na.json" background="transparent" speed="1" class="logo" loop autoplay></dotlottie-player>
                    </a>
                  </div>
                  
                  <!-- Navigation Links -->
                  <div class="flex space-x-6">
                      <a href="{{ route('profile.edit') }}" 
                           class="rounded-md px-6 py-3 text-white cutom-btn text-center">
                          {{auth()->user()->name ?? "Profile"}}
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="flex">
                          @csrf
      
                          <a href="route('logout')" class="rounded-md px-6 py-3 text-white cutom-btn text-center"
                                  onclick="event.preventDefault();
                                              this.closest('form').submit();">
                              {{ __('Log Out') }}
                          </a>
                      </form>

                  </div>
                </div>
            </nav>

            <!-- Page Heading -->
            @isset($header)
                <header class="">
                    <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <footer class="header-common-bg text-white-100 mt-8">
              <div class="container mx-auto p-4">            
                <div class="text-center text-sm text-gray-500">
                  © {{date("Y")}} <a href="https://github.com/rakib29024" class="hover:text-gray-300" target="__blank">Rakib29024</a>. All rights reserved.
                </div>
              </div>
            </footer>
        </div>


        
        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>     
    </body>
</html>
