@props([
    'error' => null,
    'options' => []
])

<div
    x-data="{ value: @entangle($attributes->wire('model')) }"
    x-on:change="value = $event.target.value"
    x-init="flatpickr($refs.input, {{ json_encode($options) }})"
>
    <input 
        {{ $attributes->whereDoesntStartWith('wire:model') }} 
        x-ref="input"
        x-bind:value="value" 
        type="text" 
        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" 
    />
</div>