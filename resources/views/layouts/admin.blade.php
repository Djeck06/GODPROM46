<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>
</head>

<body class="bg-gray-100 font-family-nunito flex">
    @include('partials.admin.sidebar')

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        @include('partials.admin.header')

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow">
                {{ $slot }}
            </main>

            @include('partials.admin.footer')
        </div>
    </div>
    @livewireScripts
</body>

</html>
