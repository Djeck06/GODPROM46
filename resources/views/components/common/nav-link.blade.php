@props(['active'])

@php
$classes = $active ?? false ? 'menu-item flex items-center text-blue-700 opacity-100 text-sm py-2.5 px-4 bg-yellow-500 rounded' : 'menu-item flex items-center text-white opacity-75 hover:opacity-100 text-sm py-2.5 px-4 hover:bg-yellow-400 hover:text-blue-700 rounded';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
