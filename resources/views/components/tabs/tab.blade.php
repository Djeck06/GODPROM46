@props(['url', 'active' => request()->url() === $url])

<li class="mr-2">
    <a href="{{ $url }}" @class([
        'inline-flex',
        'py-4',
        'px-4',
        'text-sm',
        'font-medium',
        'text-center',
        'rounded-t-lg',
        'border-b-2',
        'group',
        'text-gray-500 border-transparent hover:text-gray-600 hover:border-gray-300' => !$active,
        'text-blue-600 border-blue-600 active' => $active,
    ])>
        {{ $slot }}
    </a>
</li>
