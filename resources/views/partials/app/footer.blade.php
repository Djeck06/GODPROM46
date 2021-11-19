<footer>
    <div class="bg-gray-200 py-10">
        <div class="container">
            <div class="flex lg:gap-4 gap-y-3 flex-wrap">
                <div class="lg:w-4/12 w-full">
                    <img src="{{ asset('images/logo-Godprom.png') }}" alt="" class="mb-4 md:mb-6 w-16">
                    <p class="leading-7">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="mb-5 lg:w-4/12">
                    <h4 class="text-xl mb-3 font-semibold text-gray-600">{{ __('Informations') }}</h4>
                    <ul class="list-unstyled space-y-2">
                        <li><a href="#" class="">{{ __('Terms & Conditions') }}</a></li>
                        <li><a href="#" class="">{{ __('Privacy Policy') }}</a></li>
                        <li><a href="#" class="">{{ __('Support') }}</a></li>
                        <li><a href="#" class="">{{ __('FAQ') }}</a></li>
                    </ul>
                </div>

                <div class="mb-5">
                    <h4 class="text-xl mb-3 font-semibold text-gray-600">{{ __('About us') }}</h4>
                    <ul class="list-unstyled space-y-2">
                        <li><a href="#" class="">{{ __('About us') }}</a></li>
                        <li><a href="#" class="">{{ __('Blog') }}</a></li>
                        <li><a href="#" class="">{{ __('FAQ') }}</a></li>
                        <li><a href="#" class="">{{ __('Contact us') }}</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <div class="bg-gray-200 border-t border-gray-300">
        <div class="container">
            <div class="py-3 text-sm">
                <div class="flex flex-col items-center justify-between lg:flex-row">
                    <div class="flex space-x-2 ">
                        <a href="#">Facebook</a>
                        <a href="#">Twitter</a>
                        <a href="#">{{ __('Terms') }}</a>
                    </div>
                    <p class="capitalize">GodProm © copyright 2021</p>
                </div>
            </div>
        </div>
    </div>
</footer>
