<x-guest-layout>
    @include('partials.app.sections', [
    'title' => getTitle(__('Login')),
    'description' => getDescription(),
    ])

    @include('partials.app.page-header', ['title' => __('Login')])

    <div class="py-12">
        <div class="container">
            <div class="flex flex-wrap items-center">
                <div class="w-full lg:w-2/5 px-3">
                    <x-auth-card>
                        <x-slot name="header">
                            <span class="mb-2 text-gray-500 text-lg">{{ __('Login') }}</span>
                            <h1 class="mb-6 text-3xl text-semibold">{{ __('Join the community') }}</h1>
                        </x-slot>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="bg-red-100 mb-4 p-4 rounded" :errors="$errors" />

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <x-label for="email" class="sr-only" :value="__('Email')" />

                                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email')" :placeholder="__('Email')" required autofocus />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-label for="password" class="sr-only" :value="__('Password')" />

                                <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                    :placeholder="__('Password')" required autocomplete="current-password" />
                            </div>

                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox"
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                        name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                        href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif

                                <x-button class="ml-3">
                                    {{ __('Log in') }}
                                </x-button>
                            </div>
                        </form>
                    </x-auth-card>
                </div>
                <div class="w-full lg:w-3/5 px-3">
                    <img src="{{ asset('images/illustrations/mobile-login.svg') }}" class="w-100" />
                </div>
            </div>
        </div>
    </div>



</x-guest-layout>
