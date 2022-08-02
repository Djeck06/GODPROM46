<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <link rel="shortcut icon" type="image/x-icon"  href="{{ asset('images/favicon.png') }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @livewireStyles
        @stack('css')

        <!-- Scripts -->
        {{--<script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('js/admin.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.min.js"></script>
    <script src="https://js.stripe.com/v3"></script>

    </head>
    <body class="font-sans antialiased flex flex-col min-h-screen">
        @include('partials.app.header')
        <!-- Page Content -->
        <main class="main relative flex-grow"  id="app">
            {{ $slot }}
        </main>

        @include('partials.app.footer')
        @stack('js')
        {{-- <x-notification /> --}}
        @livewireScripts
    </body>
</html>
