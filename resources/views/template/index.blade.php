<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="/images/logo-jbt.png" type="image/x-icon" />
    <title>PLN Bali</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">
    <script src="/js/jsmpeg.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/home.js'])
</head>

<body class="bg-gray-100">

    <nav x-data="{ open: false }" class="bg-main shadow-lg">
        <div class="px-2 mx-auto max-w-7xl sm:px-4 lg:px-8">
            <div class="flex items-center justify-between h-14 lg:h-16">
                <div class="flex items-center space-x-1 lg:space-x-2">
                    <x-application-logo></x-application-logo>

                    <div class="hidden lg:flex lg:items-center lg:space-x-0.5">
                        <a href="/"
                            class="flex items-center px-2.5 py-2 text-xs xl:text-sm font-medium text-white rounded-lg transition-colors duration-150 {{ request()->is('/') ? 'bg-white/20 shadow-sm' : 'hover:bg-white/10' }}">
                            <svg class="w-4 h-4 mr-1 xl:w-5 xl:h-5 xl:mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            Dashboard
                        </a>
                        <a href="/matrix"
                            class="flex items-center px-2.5 py-2 text-xs xl:text-sm font-medium text-white rounded-lg transition-colors duration-150 {{ request()->is('matrix*') ? 'bg-white/20 shadow-sm' : 'hover:bg-white/10' }}">
                            <svg class="w-4 h-4 mr-1 xl:w-5 xl:h-5 xl:mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                            </svg>
                            Matrix
                        </a>
                        <a href="/vendor"
                            class="flex items-center px-2.5 py-2 text-xs xl:text-sm font-medium text-white rounded-lg transition-colors duration-150 {{ request()->is('vendor*') ? 'bg-white/20 shadow-sm' : 'hover:bg-white/10' }}">
                            <svg class="w-4 h-4 mr-1 xl:w-5 xl:h-5 xl:mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M0 2a2 2 0 0 1 2-2h7l2 2h7a2 2 0 0 1 2 2v2H0V2Zm0 4v11a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6H0Z" />
                            </svg>
                            Vendor
                        </a>
                        <a href="/camera"
                            class="flex items-center px-2.5 py-2 text-xs xl:text-sm font-medium text-white rounded-lg transition-colors duration-150 {{ request()->is('camera*') ? 'bg-white/20 shadow-sm' : 'hover:bg-white/10' }}">
                            <svg class="w-4 h-4 mr-1 xl:w-5 xl:h-5 xl:mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4.5 3A2.5 2.5 0 0 0 2 5.5V11h16V5.5A2.5 2.5 0 0 0 15.5 3h-11Z" />
                                <path d="M18 13H2v1.5A2.5 2.5 0 0 0 4.5 17h11a2.5 2.5 0 0 0 2.5-2.5V13Z" />
                            </svg>
                            CCTV
                        </a>
                        <a href="/pekerjaan"
                            class="flex items-center px-2.5 py-2 text-xs xl:text-sm font-medium text-white rounded-lg transition-colors duration-150 {{ request()->is('pekerjaan*') ? 'bg-white/20 shadow-sm' : 'hover:bg-white/10' }}">
                            <svg class="w-4 h-4 mr-1 xl:w-5 xl:h-5 xl:mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 0 0 0 2h2a1 1 0 1 0 0-2H9Z" />
                                <path fill-rule="evenodd" d="M4 5a2 2 0 0 1 2-2 3 3 0 0 0 3 3h2a3 3 0 0 0 3-3 2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5Zm3 4a1 1 0 0 0 0 2h.01a1 1 0 1 0 0-2H7Zm3 0a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H10Zm-3 4a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H7Zm3 0a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H10Z" clip-rule="evenodd" />
                            </svg>
                            Pekerjaan
                        </a>
                        <a href="/kartu"
                            class="flex items-center px-2.5 py-2 text-xs xl:text-sm font-medium text-white rounded-lg transition-colors duration-150 {{ request()->is('kartu*') ? 'bg-white/20 shadow-sm' : 'hover:bg-white/10' }}">
                            <svg class="w-4 h-4 mr-1 xl:w-5 xl:h-5 xl:mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 0a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4Zm0 4h12v2H4V4Zm0 4h12v2H4V8Zm0 4h8v2H4v-2Z" />
                            </svg>
                            SIM Card
                        </a>
                    </div>
                </div>

                <div class="flex items-center space-x-1 lg:space-x-2">
                    <div class="hidden lg:flex lg:items-center lg:space-x-1">
                        @if(auth()->user()?->isAdmin())
                        <a href="/user"
                            class="flex items-center px-2.5 py-2 text-xs xl:text-sm font-medium text-white rounded-lg transition-colors duration-150 {{ request()->is('user*') ? 'bg-white/20 shadow-sm' : 'hover:bg-white/10' }}">
                            <svg class="w-4 h-4 mr-1 xl:w-5 xl:h-5 xl:mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="hidden xl:inline">User Setting</span>
                        </a>
                        @endif
                        <a href="/profile"
                            class="flex items-center px-2.5 py-2 text-xs xl:text-sm font-medium text-white rounded-lg transition-colors duration-150 hover:bg-white/10">
                            <svg class="w-4 h-4 mr-1 xl:w-5 xl:h-5 xl:mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                            </svg>
                            <span class="hidden xl:inline">Profile</span>
                        </a>
                        <form action="/signout" method="get" class="m-0">
                            <button type="submit"
                                class="flex items-center px-2.5 py-2 text-xs xl:text-sm font-medium text-white bg-red-500/80 rounded-lg transition-colors duration-150 hover:bg-red-600">
                                <svg class="w-4 h-4 mr-1 xl:w-5 xl:h-5 xl:mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span class="hidden xl:inline">Sign out</span>
                            </button>
                        </form>
                    </div>

                    <button @click="open = !open" class="inline-flex items-center p-2 text-white rounded-lg lg:hidden hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/30">
                        <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="open" x-cloak class="lg:hidden border-t border-white/20">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="/"
                    class="flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg {{ request()->is('/') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    Dashboard
                </a>
                <a href="/matrix"
                    class="flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg {{ request()->is('matrix*') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                    </svg>
                    Matrix
                </a>
                <a href="/vendor"
                    class="flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg {{ request()->is('vendor*') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M0 2a2 2 0 0 1 2-2h7l2 2h7a2 2 0 0 1 2 2v2H0V2Zm0 4v11a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6H0Z" />
                    </svg>
                    Data Vendor
                </a>
                <a href="/camera"
                    class="flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg {{ request()->is('camera*') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4.5 3A2.5 2.5 0 0 0 2 5.5V11h16V5.5A2.5 2.5 0 0 0 15.5 3h-11Z" />
                        <path d="M18 13H2v1.5A2.5 2.5 0 0 0 4.5 17h11a2.5 2.5 0 0 0 2.5-2.5V13Z" />
                    </svg>
                    Data CCTV
                </a>
                <a href="/pekerjaan"
                    class="flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg {{ request()->is('pekerjaan*') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 0 0 0 2h2a1 1 0 1 0 0-2H9Z" />
                        <path fill-rule="evenodd" d="M4 5a2 2 0 0 1 2-2 3 3 0 0 0 3 3h2a3 3 0 0 0 3-3 2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5Zm3 4a1 1 0 0 0 0 2h.01a1 1 0 1 0 0-2H7Zm3 0a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H10Zm-3 4a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H7Zm3 0a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H10Z" clip-rule="evenodd" />
                    </svg>
                    Pekerjaan
                </a>
                <a href="/kartu"
                    class="flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg {{ request()->is('kartu*') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 0a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4Zm0 4h12v2H4V4Zm0 4h12v2H4V8Zm0 4h8v2H4v-2Z" />
                    </svg>
                    SIM Card
                </a>
                @if(auth()->user()?->isAdmin())
                <a href="/user"
                    class="flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg {{ request()->is('user*') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    User Setting
                </a>
                @endif
                <hr class="border-white/20 my-2">
                <a href="/profile"
                    class="flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg hover:bg-white/10">
                    <svg class="w-5 h-5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                    </svg>
                    Profile
                </a>
                <form action="/signout" method="get">
                    <button type="submit"
                        class="flex items-center w-full px-3 py-2 text-sm font-medium text-white bg-red-500/80 rounded-lg hover:bg-red-600">
                        <svg class="w-5 h-5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Sign out
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="mx-auto">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
