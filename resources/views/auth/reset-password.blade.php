<x-guest-layout>
    @include('partials.app.sections', [
    'title' => getTitle(__('Reset Password')),
    'description' => getDescription(),
    ])

    @include('partials.app.page-header', ['title' => __('Reset Password')])

    <div class="py-12">
        <div class="container">
            <div class="flex flex-wrap items-center">
                <div class="w-full lg:w-2/5 px-3">
                    <x-auth-card>
                        <x-slot name="header">
                            <h1 class="lg:text-3xl text-xl font-semibold mb-6">{{ __('Reset password') }}</h1>
                        </x-slot>

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <!-- Email Address -->
                            <div>
                                <x-label for="email" :value="__('Email')" />

                                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email', $request->email)" required autofocus />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-label for="password" :value="__('Password')" />

                                <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                    required />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                    name="password_confirmation" required />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button>
                                    {{ __('Reset Password') }}
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
