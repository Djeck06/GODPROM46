@props(['id' => null, 'maxWidth' => null , 'cssWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }} :cssWidth="$cssWidth">
    <div class="px-6 py-4">
        <div class="text-lg">
            {{ $title }}
        </div>

        <div class="mt-4" style=" overflow-y: auto;max-height: 80vh;">
            {{ $content }}
        </div>
    </div>

    <div class="px-6 py-4 bg-gray-100 text-right">
        {{ $footer }}
    </div>
</x-modal>
