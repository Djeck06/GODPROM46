<x-guest-layout>
    @include('partials.app.sections', [
    'title' => getTitle(__('Verify email')),
    'description' => getDescription(),
    ])

    @include('partials.app.page-header', ['title' => __('Verify email')])

    <div class="py-12">
        <div class="container">
            <div class="flex flex-wrap justify-center items-center">
                <div class="bg-white p-6 shadow max-w-md">
                    <x-auth-card>
                        <x-slot name="header">
                            <h1 class="lg:text-3xl text-xl font-semibold mb-6">{{ __('Verify email') }}</h1>
                        </x-slot>

                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif

                        <div class="mt-4 flex items-center justify-between">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <div>
                                    <x-button>
                                        {{ __('Resend Verification Email') }}
                                    </x-button>
                                </div>
                            </form>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </x-auth-card>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
