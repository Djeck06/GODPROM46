<section class="-mt-24 pt-40 pb-12 bg-gradient-to-r from-transparent to-blue-100">
    <div class="container">
        <h1 class="text-2xl lg:text-4xl font-bold mb-5 wow animate__ animate__fadeInUp animated animated"
            style="visibility: visible; animation-name: fadeInUp;">{{ $title }}</h1>
        <ul class="flex text-gray-500 text-sm lg:text-sm pb-12 wow animate__ animate__fadeInUp animated animated"
            style="visibility: visible; animation-name: fadeInUp;">
            <li class="inline-flex items-center">
                <a href="{{ route('home', app()->getLocale()) }}" class="hover:text-blue-500 text-gray-800">{{ __('Home') }}</a>
                <svg fill="currentColor" viewBox="0 0 20 20" class="h-5 w-auto text-gray-300">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </li>
            <li class="inline-flex items-center text-gray-400">
                <span>{{ $title }}</span>
            </li>
        </ul>
    </div>
</section>
