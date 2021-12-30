@props(['title', 'active'])

<div class="block" x-data="{open: false}" x-init="open = {{ $active ? 'true' : 'false' }}">
    <div @click="open = !open"
        class="flex items-center justify-between hover:bg-yellow-500 hover:text-white cursor-pointer py-2.5 px-4 rounded">
        <div class="flex items-center space-x-2 opacity-75 hover:opacity-100 text-sm">
            {!! $title !!}
        </div>

        <svg x-show="open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
        </svg>
        <svg x-show="!open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </div>
    <div x-show="open" class="text-sm border-l-2 border-yellow-500 mx-6 my-2.5 px-2.5 flex flex-col gap-y-1">
        {{ $slot }}
    </div>
</div>
