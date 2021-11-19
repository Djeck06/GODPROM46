<x-app-layout>
    @include('partials.app.sections', [
    'title' => getTitle($title),
    'description' => getDescription($description),
    ])

    @include('partials.app.page-header', ['title' => $title,])

    @yield('content')

    @include('partials.app.download-app')
</x-app-layout>
