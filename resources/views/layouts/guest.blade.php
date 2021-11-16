<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div class="font-sans antialiased">
        <div class="flex flex-col justify-between min-h-screen bg-gray-100">
            @include('layouts.nav')


            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <foote class="border-t">
                <div class="lg:mb-5 py-3 text-sm text-gray-400">
                    <div
                        class="flex flex-col items-center justify-between lg:flex-row max-w-6xl mx-auto lg:space-y-0 space-y-3">
                        <div class="flex space-x-2 ">
                            <a href="#">Facebook</a>
                            <a href="#">Twitter</a>
                            <a href="#">{{ __('Terms') }}</a>
                        </div>
                        <p class="capitalize">GodProm © copyright 2021</p>
                    </div>
                </div>
            </foote>
        </div>
    </div>
</body>

</html>
