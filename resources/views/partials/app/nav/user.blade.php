<div class="flex space-x-4 items-center">
    @if (Auth::check() && Auth::user()->type == 'client')
        <a href="{{ route('quotation.create') }}"
            class="border border-blue-500 px-4 py-2 rounded text-blue-500 text-sm font-semibold header-btn">{{ __('Send') }}</a>
    @endif

    @if (Auth::check() && Auth::user()->type == 'transporter')
        <a href="#"
            class="border border-blue-500 px-4 py-2 rounded text-blue-500 text-sm font-semibold header-btn">{{ __('Transport') }}</a>
    @endif

    <div class="hidden sm:flex sm:items-center sm:ml-6">
        @include('partials.app.nav.languages')
    </div>

    @guest
        <a href="{{ route('login') }}"
            class="border border-blue-500 px-4 py-2 rounded text-blue-500 text-sm font-semibold login-btn">{{ __('Login') }}</a>
        <a href="{{ route('register') }}"
            class="px-4 py-2 rounded text-white bg-blue-500 hover:bg-blue-700 text-sm font-semibold register-btn">{{ __('Register') }}</a>
    @endguest

    @auth
        <span>
            <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
        </span>
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out header-btn">
                    <div>{{ Auth::user()->full_name }}</div>

                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-responsive-nav-link href="#">Mon Profil</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </x-slot>
        </x-dropdown>
    @endauth

</div>
