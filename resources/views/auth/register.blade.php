<x-guest-layout>
    @include('partials.app.sections', [
    'title' => getTitle(__('Register')),
    'description' => getDescription(),
    ])

    @include('partials.app.page-header', ['title' => __('Register')])

    <div class="py-12">
        <div class="container">
            <div class="flex flex-wrap items-center">
                <div class="w-full lg:w-2/5 px-3">
                    <x-auth-card>
                        <x-slot name="header">
                            <span class="mb-2 text-gray-500 text-lg">{{ __('Register') }}</span>
                            <h1 class="mb-6 text-3xl text-semibold">{{ __('Join the community') }}</h1>
                        </x-slot>

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="bg-red-100 mb-4 p-4 rounded" :errors="$errors" />

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="flex lg:flex-row flex-col lg:space-x-2">
                                <div class="flex-1">
                                    <x-label for="first_name" class="sr-only" :value="__('First name')" />
                                    <x-input.text id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                        :placeholder="__('First name')" :value="old('first_name')" required autofocus />
                                </div>

                                <div class="flex-1 lg:mt-0 sm:mt-4">
                                    <x-label for="last_name" class="sr-only" :value="__('Last name')" />
                                    <x-input.text id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                        :placeholder="__('Last name')" :value="old('last_name')" required autofocus />
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-label for="email" class="sr-only" :value="__('Email')" />

                                <x-input.text id="email" class="block mt-1 w-full" type="email" name="email"
                                    :placeholder="__('Email')" :value="old('email')" required />
                            </div>

                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="radio"
                                        class="border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                        name="type" value="client"
                                        {{ old('type') !== null && !old('type') == 'client' ? 'checked' : '' }}
                                        required>

                                    <span
                                        class="ml-2 text-sm text-gray-600">{{ __('I send or receive packages (Client)') }}</span>
                                </label>
                            </div>

                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="radio"
                                        class="border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                        name="type" value="transporter"
                                        {{ old('type') !== null && !old('type') == 'transporter' ? 'checked' : '' }}
                                        required>

                                    <span
                                        class="ml-2 text-sm text-gray-600">{{ __('I do transportation (Transporter)') }}</span>
                                </label>
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-label for="password" class="sr-only" :value="__('Password')" />

                                <x-input.text id="password" class="block mt-1 w-full" type="password" name="password"
                                    :placeholder="__('Password')" required autocomplete="new-password" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-label for="password_confirmation" class="sr-only"
                                    :value="__('Confirm Password')" />

                                <x-input.text id="password_confirmation" class="block mt-1 w-full" type="password"
                                    name="password_confirmation" :placeholder="__('Confirm Password')" required />
                            </div>

                            <div class="block mt-4">
                                <label for="terms" class="inline-flex items-center">
                                    <input id="terms" type="checkbox"
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                        name="terms" value="true" {{ !old('terms') ?: 'checked' }}>
                                    <span class="ml-2 text-sm text-gray-600">{{ __('I read and agree with') }} <a
                                            class="underline text-sm text-gray-600 hover:text-gray-900"
                                            href="#">{{ __('Terms and Conditions') }}</a> </span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                    href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>

                                <x-button class="ml-4" type="submit">
                                    {{ __('Register') }}
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
