<x-app-layout>
    @include('partials.app.sections', [
    'title' => getTitle($title),
    ])

    @yield('content')
</x-app-layout>