@props(['active'])

@php
$classes = $active ?? false ? 'menu-item flex items-center text-white opacity-100 text-sm py-4 pl-6 bg-yellow-500' : 'menu-item flex items-center text-white opacity-75 hover:opacity-100 text-sm py-4 pl-6 hover:bg-yellow-400';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>