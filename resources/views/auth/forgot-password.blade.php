<x-guest-layout>
    @include('partials.app.sections', [
    'title' => getTitle(__('Forgot Password')),
    'description' => getDescription(),
    ])

    @include('partials.app.page-header', ['title' => __('Forgot Password')])

    <div class="py-12">
        <div class="container">
            <div class="flex flex-wrap items-center">
                <div class="w-full lg:w-2/5 px-3">
                    <x-auth-card>
                        <x-slot name="header">
                            <h1 class="lg:text-3xl text-xl font-semibold mb-6">{{ __('Reset password') }}</h1>
                        </x-slot>

                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </div>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <x-label for="email" :value="__('Email')" />

                                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email')" required autofocus />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button>
                                    {{ __('Email Password Reset Link') }}
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
