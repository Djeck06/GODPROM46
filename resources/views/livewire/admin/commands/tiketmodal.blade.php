<x-modal.dialog wire:model.defer="showTiketModal" cssWidth="sm:w-4/12">
    <x-slot name="title">{{__("Ticket")}}</x-slot>

    <x-slot name="content">

        <div class="md:grid md:grid-cols-1 md:gap-6">
                
                <div class="mt-5">

                    <div class="lg:flex lg:items-center lg:justify-between">
                        <div class="flex-1 min-w-0">
                            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                                {{ __('Order #') . $editing->reference }}</h2>
                            
                        </div>
                        
                    </div>

                    <div class="md:grid md:grid-cols-5 md:gap-6">
                        <div class="mt-5 md:mt-0 md:col-span-5">
                            
                           
                            <div class="mt-5 md:col-span-2">
                                <div class="space-y-12 lg:space-y-0 lg:grid lg:grid-cols-4 ">
                                    <div class=" border-t-2 border-l-2 border-r-2 border-gray-800 p-4">
                                        
                                        
                                            <h1 class=" font-semibold  text-6xl mt-4">{{ __('Ex') }}</h4>
                                        
                                    </div>

                                    <div class="border-t-2 border-r-2 border-gray-800 p-4">
                                        <address class="mt-4">
                                            <p >{{ __('o') }} <i class="text-3xl ">{{ __('68') }}</i></p>
                                           
                                        </address>
                                    </div>

                                    <div class=" border-t-2 border-r-2 border-gray-800 p-4">
                                        <address class="mt-4">
                                            <p >{{ __('TG') }} <i class="text-3xl ">{{$editing->delivery_city  }}</i></p>
                                        </address>
                                      
                                    </div>
                                    
                                    <div class=" border-t-2 border-r-2 border-gray-800 lg:grid lg:grid-cols-1">
                                       
                                            <div class="border-b-2 border-gray-800 p-4 ">
                                                
                                            </div>

                                            <div class=" border-gray-800 p-4  ">
                                               
                                            </div>
                                        
                                    </div>
                                </div>

                               
                                <div class="space-y-12 lg:space-y-0 lg:grid lg:grid-cols-3 ">
                                    <div class="border-l-2 border-t-2  border-gray-800 p-4">
                                   
                                        <address class="mt-4">
                                            
                                            <p>@if(!is_null($editing->deliveryCountry)){{ $editing->delivery_city }}, {{ $editing->deliveryCountry->name }}@endif</p>
                                            <p>{{ __('Tel: ') }} {{ $editing->delivery_phone }}</p>

                                        </address>
                                    </div>

                                    <div class="border-l-2 border-t-2 border-gray-800 p-4">
                                        <address class="mt-4">
                                            <p>{{ __('PHP') }} :xxxxxxxxxxx  from @if(!is_null($editing->created_at)){{$editing->created_at->toFormattedDateString()}} @endif</p>
                                        </address>
                                    </div>

                                    <div class="border-l-2 border-t-2 border-r-2 border-gray-800 p-4">
                                        
                                    </div>
                                    
                                </div>

                                <div class="space-y-12 lg:space-y-0 lg:grid lg:grid-cols-2 ">
                                    <div class="border-l-2 border-t-2 border-gray-800 ">
                                        <div class="space-y-12 lg:space-y-0 lg:grid lg:grid-cols-2 ">
                                            <div class="border-r-2  border-gray-800 p-4">
                                                <address class="mt-4">
                                                    <p>{{ $editing->pickup_address }}</p>
                                                    <p>@if(!is_null($editing->pickupCountry)){{ $editing->pickup_city }}, {{ $editing->pickupCountry->name }}@endif</p>
                                                    <p>{{ __('Tel: ') }} {{ $editing->delivery_phone }}</p>

                                                </address>
                                            </div>

                                            <div class=" border-r-2 border-gray-800 p-4">
                                               
                                                <address class="mt-4">
                                                    <p>{{ $editing->pickup_address }}</p>
                                                    <p>@if(!is_null($editing->pickupCountry)){{ $editing->pickup_city }}, {{ $editing->pickupCountry->name }}@endif</p>
                                                </address>
                                            </div>
                                        </div>
                                        <div class="space-y-12 lg:space-y-0 lg:grid lg:grid-cols-1 ">
                                            <div class="border-t-2 border-r-2 border-gray-800 p-4">
                                               
                                                <address class="mt-4">
                                                    <p>{{ __('UM') }} {{ __('WGHT') }} {{ __('VOL') }}</p>

                                                </address>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border-t-2 border-r-2  border-gray-800 p-4">
                                        <h4 class="font-semibold">{{ __('Pickup Address') }}</h4>
                                        <address class="mt-4">
                                            <p>{{ $editing->pickup_address }}</p>
                                            <p>@if(!is_null($editing->pickupCountry)){{ $editing->pickup_city }}, {{ $editing->pickupCountry->name }}@endif</p>
                                        </address>
                                    </div>

                                   
                                    
                                </div>

                                <div class="space-y-12 lg:space-y-0 lg:grid lg:grid-cols-1 ">
                                    <div class="border-2 border-gray-800 p-4">
                                        <p>{{ __('Ref Client: ') }} {{ $editing->reference }}</p>

                                    </div>
                                </div>

                                <div class="space-y-12 lg:space-y-0 lg:grid lg:grid-cols-2 ">
                                    <div class="border-l-2 border-b-2 border-gray-800 p-4">
                                        <div class="w-8/12">
                                            <img class="w-full p-2 border border-gray-100 mb-2"
                                                src="{{ asset('orders/qrcode/' . $editing->reference . '.svg') }}"
                                                alt="{{ __('Order').' '. $editing->reference . ' QRCODE'}}">

                                        </div>
                                    </div>

                                    <div class=" border-b-2 border-r-2 border-gray-800 p-4">
                                        <div class="w-8/12">

                                            @if(!is_null($editing->codebar))
                                            <img class="w-full p-2 border border-gray-100 mb-2 mt-5" src="{{'data:image/png;base64,' . $editing->codebar }} " alt="{{ __('Order ' . $editing->reference . ' BARCODE') }}">

                                            @endif
                                        </div>
                                    </div>

                                </div>
                                
                            </div>
                           
                        </div>
                        

                        
                    </div>
                </div>
            
            
        </div>

    </x-slot>

    <x-slot name="footer">
        <x-button.secondary wire:click="$set('showTiketModal', false)">Fermer</x-button.secondary>
    </x-slot>
</x-modal.dialog>