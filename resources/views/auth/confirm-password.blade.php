<x-guest-layout>
    @include('partials.app.sections', [
    'title' => getTitle(__('Confirm Password')),
    'description' => getDescription(),
    ])

    @include('partials.app.page-header', ['title' => __('Confirm Password')])

    <div class="py-12">
        <div class="container">
            <div class="flex flex-wrap items-center">
                <div class="w-full lg:w-2/5 px-3">
                    <x-auth-card>
                        <x-slot name="header">
                            <h1 class="lg:text-3xl text-xl font-semibold mb-6">{{ __('Reset password') }}</h1>
                        </x-slot>

                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                        </div>

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <!-- Password -->
                            <div>
                                <x-label for="password" :value="__('Password')" />

                                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                    autocomplete="current-password" />
                            </div>

                            <div class="flex justify-end mt-4">
                                <x-button type="submit">
                                    {{ __('Confirm') }}
                                </x-button>
                            </div>
                        </form>
                    </x-auth-card>
                </div>
                <div class="w-full lg:w-3/5 px-3">
                    <img src="{{ asset('images/illustrations/forgot-pwd.svg') }}" class="w-100" />
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
