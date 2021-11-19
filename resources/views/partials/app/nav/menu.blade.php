<div class="flex items-center space-x-8">
    <ul class="hidden md:flex justify-around space-x-4">
        <li class="py-4">
            <a href="{{ route('home', app()->getLocale()) }}"
                class="hover:text-blue-600 text-gray-500 text-sm font-semibold uppercase">{{ __('Home') }}</a>
        </li>
        <li class="py-4">
            <a href="{{ route('how', app()->getLocale()) }}"
                class="hover:text-blue-600 text-gray-500 text-sm font-semibold uppercase">{{ __('How it works?') }}</a>
        </li>
        <li class="py-4">
            <a href="{{ route('faq', app()->getLocale()) }}" class="hover:text-blue-600 text-gray-500 text-sm font-semibold uppercase">{{ __('FAQ') }}</a>
        </li class="py-4">
        <li class="py-4">
            <a href="{{ route('about', app()->getLocale()) }}"
                class="hover:text-blue-600 text-gray-500 text-sm font-semibold uppercase">{{ __('About') }}</a>
        </li class="py-4">
        <li class="py-4">
            <a href="{{ route('contact', app()->getLocale()) }}"
                class="hover:text-blue-600 text-gray-500 text-sm font-semibold uppercase">{{ __('Contact') }}</a>
        </li>
    </ul>
</div>
