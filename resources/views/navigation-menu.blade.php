<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-mark class="block h-9 w-auto"/>
                    </a>
                    @include('components.dark-mode-switcher')
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if(auth()->guest())
                        @if (Route::has('login'))
                            <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                                {{ __('Login') }}
                            </x-nav-link>
                        @endif
                        @if (Route::has('register'))
                            <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                                {{ __('Register') }}
                            </x-nav-link>
                        @endif
                    @endif
                    <x-nav-link href="{{ route('ride.search') }}" :active="request()->routeIs('ride.search')">
                        {{ __('Search ride') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('ride.create') }}" :active="request()->routeIs('ride.create')">
                        {{ __('Create ride') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('ride.my-rides') }}" :active="request()->routeIs('ride.my-rides')">
                        {{ __('My rides') }}
                    </x-nav-link>
                    <x-nav-link class="relative" href="{{ route('messaging.conversation.list') }}"
                                :active="request()->routeIs('messaging.conversation.list')">
                        {{ __('Messages') }}
                        @if($unreadMessages)
                            <div
                                class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900">
                                *
                            </div>
                        @endif
                    </x-nav-link>
                </div>
            </div>

            @include('navigation.desktop-nav')

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    @include('navigation.mobile-nav')
</nav>
