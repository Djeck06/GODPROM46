<div class="flex flex-col max-w-md mx-auto mt-10 pt-6 sm:pt-0">
    @isset($header)
        <div>
            {{ $header }}
        </div>
    @endisset

    <div class="">
        {{ $slot }}
    </div>
</div>