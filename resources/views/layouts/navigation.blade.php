<nav x-data="{ open: false }" class="bg-main shadow-lg">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center space-x-6">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto" />
                    </a>
                </div>
                <div class="hidden lg:flex lg:items-center lg:space-x-0.5">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <svg class="w-5 h-5 mr-1.5 inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link href="/matrix" :active="request()->is('matrix*')">
                        <svg class="w-5 h-5 mr-1.5 inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                        </svg>
                        {{ __('Matrix') }}
                    </x-nav-link>
                    <x-nav-link href="/vendor" :active="request()->is('vendor*')">
                        <svg class="w-5 h-5 mr-1.5 inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M0 2a2 2 0 0 1 2-2h7l2 2h7a2 2 0 0 1 2 2v2H0V2Zm0 4v11a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6H0Z" />
                        </svg>
                        {{ __('Vendor') }}
                    </x-nav-link>
                    <x-nav-link href="/camera" :active="request()->is('camera*')">
                        <svg class="w-5 h-5 mr-1.5 inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4.5 3A2.5 2.5 0 0 0 2 5.5V11h16V5.5A2.5 2.5 0 0 0 15.5 3h-11Z" />
                            <path d="M18 13H2v1.5A2.5 2.5 0 0 0 4.5 17h11a2.5 2.5 0 0 0 2.5-2.5V13Z" />
                        </svg>
                        {{ __('CCTV') }}
                    </x-nav-link>
                    <x-nav-link href="/pekerjaan" :active="request()->is('pekerjaan*')">
                        <svg class="w-5 h-5 mr-1.5 inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 0 0 0 2h2a1 1 0 1 0 0-2H9Z" />
                            <path fill-rule="evenodd" d="M4 5a2 2 0 0 1 2-2 3 3 0 0 0 3 3h2a3 3 0 0 0 3-3 2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5Zm3 4a1 1 0 0 0 0 2h.01a1 1 0 1 0 0-2H7Zm3 0a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H10Zm-3 4a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H7Zm3 0a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H10Z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Pekerjaan') }}
                    </x-nav-link>
                    <x-nav-link href="/kartu" :active="request()->is('kartu*')">
                        <svg class="w-5 h-5 mr-1.5 inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 0a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4Zm0 4h12v2H4V4Zm0 4h12v2H4V8Zm0 4h8v2H4v-2Z" />
                        </svg>
                        {{ __('SIM Card') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden lg:flex lg:items-center lg:space-x-2 lg:ms-6">
                @if(auth()->user()?->isAdmin())
                <x-nav-link href="/user" :active="request()->is('user*')">
                    <svg class="w-5 h-5 mr-1.5 inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    {{ __('User Setting') }}
                </x-nav-link>
                @endif
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-white/20 rounded-lg hover:bg-white/30 focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="flex lg:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 text-white rounded-lg hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/30">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" x-cloak class="lg:hidden border-t border-white/20">
        <div class="pt-2 pb-3 space-y-1 px-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <svg class="w-5 h-5 mr-2 inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                    <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                    <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                </svg>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/matrix" :active="request()->is('matrix*')">
                <svg class="w-5 h-5 mr-2 inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                </svg>
                {{ __('Matrix') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/vendor" :active="request()->is('vendor*')">
                <svg class="w-5 h-5 mr-2 inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M0 2a2 2 0 0 1 2-2h7l2 2h7a2 2 0 0 1 2 2v2H0V2Zm0 4v11a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6H0Z" />
                </svg>
                {{ __('Vendor') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/camera" :active="request()->is('camera*')">
                <svg class="w-5 h-5 mr-2 inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4.5 3A2.5 2.5 0 0 0 2 5.5V11h16V5.5A2.5 2.5 0 0 0 15.5 3h-11Z" />
                    <path d="M18 13H2v1.5A2.5 2.5 0 0 0 4.5 17h11a2.5 2.5 0 0 0 2.5-2.5V13Z" />
                </svg>
                {{ __('CCTV') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/pekerjaan" :active="request()->is('pekerjaan*')">
                <svg class="w-5 h-5 mr-2 inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 0 0 0 2h2a1 1 0 1 0 0-2H9Z" />
                    <path fill-rule="evenodd" d="M4 5a2 2 0 0 1 2-2 3 3 0 0 0 3 3h2a3 3 0 0 0 3-3 2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5Zm3 4a1 1 0 0 0 0 2h.01a1 1 0 1 0 0-2H7Zm3 0a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H10Zm-3 4a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H7Zm3 0a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H10Z" clip-rule="evenodd" />
                </svg>
                {{ __('Pekerjaan') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/kartu" :active="request()->is('kartu*')">
                <svg class="w-5 h-5 mr-2 inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 0a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4Zm0 4h12v2H4V4Zm0 4h12v2H4V8Zm0 4h8v2H4v-2Z" />
                </svg>
                {{ __('SIM Card') }}
            </x-responsive-nav-link>
        </div>

            @if(auth()->user()?->isAdmin())
            <div class="border-t border-white/20 px-2 pt-2 pb-1">
                <x-responsive-nav-link href="/user" :active="request()->is('user*')">
                    <svg class="w-5 h-5 mr-2 inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    {{ __('User Setting') }}
                </x-responsive-nav-link>
            </div>
            @endif
            <div class="pt-4 pb-2 border-t border-white/20 px-2">
                <div class="px-3 pb-2">
                    <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-white/70">{{ Auth::user()->email }}</div>
                </div>
                <div class="space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
