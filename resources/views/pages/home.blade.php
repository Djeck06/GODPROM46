<x-app-layout>
    @include('partials.app.sections', [
    'title' => $title,
    'description' => getDescription($description),
    ])

    <section class="xl:bg-contain bg-top bg-no-repeat -mt-24 pt-24 bg-gradient-to-r from-transparent  to-blue-100- relative flex items-center justify-center overflow-hidden">
        <div class="container mx-auto z-20">
            <div class="flex flex-wrap items-center -mx-3">
                <div class="w-full lg:w-2/5 px-3">
                    <div class="max-w-lg lg:max-w-md mx-auto lg:mx-0 mb-8 text-center lg:text-left">
                        <h2 class="text-3xl lg:text-4xl mb-4 font-bold font-heading ">
                            Livraison - Transport <br>
                            <span class="text-white">Import - Export</span>
                        </h2>
                        <p class="text-white leading-relaxed"> <strong class="text-blue-500">GODPROM46</strong> est une société de transport intra-communautaire et internationale,
                        vos livraisons sont faites dans des délais express.</p>
                        <p class="text-white leading-relaxed mt-3 text-sm">Nos prestations spécifiques sont liées à nos services proposés.</p>
                    </div>
                    <div class="text-center lg:text-left">
                        <a class="tracking-wide hover-up-2 block sm:inline-block py-4 px-8 mb-4 sm:mb-0 sm:mr-3 text-xs text-white text-center font-semibold leading-none bg-blue-500 hover:bg-blue-700 rounded"
                            href="{{ route('quotation.create') }}">{{ __('Get started') }}</a>
                        <a href="{{ route('how', app()->getLocale()) }}"
                            class="block sm:inline-block hover-up-2 py-4 px-8 text-xs text-blueGray-500 hover:text-blueGray-600 text-center font-semibold leading-none bg-white border border-blueGray-200 hover:border-blueGray-300 rounded">{{ __('How it works?') }}</a>
                    </div>
                </div>
                <div class="w-full lg:w-3/5 px-3 mb-12 lg:mb-0">
                    <div class="lg:h-128 flex items-center justify-center">
                        <img class="lg:max-w-lg" src="{{ asset('images/delivery-man-3.png') }}"
                            alt="">
                    </div>
                </div>
            </div>
        </div>

        <video autoplay loop muted class="absolute z-10 w-auto min-w-full min-h-full max-w-none">
            <source
                src="{{ asset('videos/video.mp4') }}"
                type="video/mp4" />
            Your browser does not support the video tag.
        </video>
    </section>

    {{-- <div class="relative flex items-center justify-center h-screen overflow-hidden">
        <div class="container">
            <div class="relative z-30 p-5 text-2xl text-white bg-blue-300 bg-opacity-50 rounded">
                Welcome to my site!
            </div>
        </div>
        <video autoplay loop muted class="absolute z-10 w-auto min-w-full min-h-full max-w-none">
            <source
                src="{{ asset('videos/video.mp4') }}"
                type="video/mp4" />
            Your browser does not support the video tag.
        </video>
    </div> --}}

    <section class="pt-20 pb-24 bg-blueGray-50" id="how-we-work">
        <div class="container">
            <div class="flex flex-wrap items-center justify-between max-w-2xl lg:max-w-full mb-12">
                <div class="w-full lg:w-1/2 mb-4 lg:mb-0">
                    <h2 class="text-3xl md:text-4xl font-bold font-heading">
                        <span>{{ __('Find out how') }}</span><br>
                        <span class="text-blue-500">{{ __('Our services work!') }}</span>
                    </h2>
                </div>
                <div class="w-full lg:w-1/2 lg:pl-16">
                    <p class="text-blueGray-400 leading-loose"> Dans votre espace client vous avez la possibilité de gérer, piloter et contrôler tous notre service proposé. Nous vous offrons une responsabilité contractuelle avantageuse tout au long de la logistique. Notre circuit se résume en trois principales étapes :</p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 -mb-6 text-center">
                <div class="hover-up-5 w-full md:w-1/2 lg:w-1/3 px-3 mb-6">
                    <div class="p-12 bg-white shadow rounded">
                        <div
                            class="flex w-12 h-12 mx-auto items-center justify-center text-blue-800 font-bold font-heading bg-blue-200 rounded-full">
                            1</div>
                        <img class="h-48 mx-auto my-4" src="{{ asset('images/illustrations/request-msg.svg') }}"
                            alt="">
                        <h3 class="mb-2 font-bold font-heading">{{ __('Packaging') }}</h3>
                        <p class="text-sm text-blueGray-400 leading-relaxed">Vous avez le choix du conditionnement (carton standard et semi standard   assurance comprise dans les deux cas).</p>
                    </div>
                </div>
                <div class="hover-up-5 w-full md:w-1/2 lg:w-1/3 px-3 mb-6">
                    <div class="p-12 bg-white shadow rounded">
                        <div
                            class="flex w-12 h-12 mx-auto items-center justify-center text-blue-800 font-bold font-heading bg-blue-200 rounded-full">
                            2</div>
                        <img class="h-48 mx-auto my-4" src="{{ asset('images/illustrations/bill.svg') }}" alt="">
                        <h3 class="mb-2 font-bold font-heading">{{ __('Payment') }}</h3>
                        <p class="text-sm text-blueGray-400 leading-relaxed"> Vous pouvez effectuer votre payement par virement bancaire ou par Paypal en toute tranquilité en nous suivant étapes par étapes. </p>
                    </div>
                </div>
                <div class="hover-up-5 w-full lg:w-1/3 px-3 mb-6">
                    <div class="p-12 bg-white shadow rounded">
                        <div
                            class="flex w-12 h-12 mx-auto items-center justify-center text-blue-800 font-bold font-heading bg-blue-200 rounded-full">
                            3</div>
                        <img class="h-48 mx-auto my-4" src="{{ asset('images/illustrations/packages.svg') }}" alt="">
                        <h3 class="mb-2 font-bold font-heading">{{ __('Removal and Tracking') }}</h3>
                        <p class="text-sm text-blueGray-400 leading-relaxed">Vous avez le choix de choisir les dates qui vous seront proposées.
                            Suivez vos envois et recevez la position exacte de vos colis.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    @include('partials.app.download-app')
</x-app-layout>
