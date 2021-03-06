<aside class="relative bg-blue-600  w-64 hidden sm:block shadow-xl" :class="{'-translate-x-full': !navOpen}">
    <div class="p-6">
        <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">{{ config('app.name', 'GodProm') }}</a>
        {{-- <button
            class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
            <i class="fas fa-plus mr-3"></i> New Report
        </button> --}}
    </div>

    <nav class="text-white text-base font-semibold pt-3">
        @include('partials.admin.nav')
    </nav>
</aside>
