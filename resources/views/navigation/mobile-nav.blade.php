<!-- Responsive Navigation Menu -->
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
        @if(auth()->guest())
            @if (Route::has('login'))
                <x-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-responsive-nav-link>

            @endif
            @if (Route::has('register'))
                <x-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            @endif
        @endif
        <x-responsive-nav-link href="{{ route('ride.search') }}" :active="request()->routeIs('ride.search')">
            {{ __('Search ride') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="{{ route('ride.create') }}" :active="request()->routeIs('ride.create')">
            {{ __('Create ride') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="{{ route('ride.my-rides') }}" :active="request()->routeIs('ride.my-rides')">
            {{ __('My rides') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="{{ route('messaging.conversation.list') }}"
                               :active="request()->routeIs('messaging.conversation.list')">
            {{ __('Messages') }}
            @if($unreadMessages)
                <div
                    class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900">
                    *
                </div>
            @endif
        </x-responsive-nav-link>
    </div>

    <!-- Responsive Settings Options -->
    @if(!auth()->guest())
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">

            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                             alt="{{ Auth::user()->name }}"/>
                    </div>
                @endif

                <div>
                    <div
                        class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ my_profile_url() }}"
                                       :active="request()->routeIs('user.show')">
                    {{ __('Public profile') }}
                </x-responsive-nav-link>


                <x-responsive-nav-link href="{{ route('profile.show') }}"
                                       :active="request()->routeIs('profile.show')">
                    {{ __('Settings') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}"
                                           :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                           @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                                           :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}"
                                               :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-switchable-team :team="$team" component="responsive-nav-link"/>
                    @endforeach
                @endif
            </div>
        </div>
    @endif

    <!-- Language -->
    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
        <div class="flex items-center px-4">
            <div>
                <div
                    class="font-medium text-base text-gray-800 dark:text-gray-200 font-bold">{{ __('Country') }}</div>
            </div>
        </div>

        <div class="mt-3 space-y-1">
            @foreach(get_available_countries() as $countryInEnglish => $countryInNative)
                <x-responsive-nav-link href="{{ change_country_url($countryInEnglish) }}"
                                       :active="request()->routeIs('change.localization')">
                    {{ $countryInNative }}
                </x-responsive-nav-link>
            @endforeach

        </div>

    </div>

</div>
