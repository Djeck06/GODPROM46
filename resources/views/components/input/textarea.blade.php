@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }}  {!! $attributes->merge(['class' => 'shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md', 'row' => 3]) !!}></textarea>