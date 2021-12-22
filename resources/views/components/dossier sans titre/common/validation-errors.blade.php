@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="flex items-center pb-3 border-b-2 border-red-200">
            <svg class="w-5 h-5 text-red-400 dark:text-red-600 flex-shrink-0 mr-3" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>

            <span class="text-sm font-semibold text-red-800">
                {{ __('There were ' . $errors->count() . ' errors with your submission.') }}
            </span>
        </div>

        <div class="ml-5 pl-1 mt-2">
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>


    </div>
@endif
