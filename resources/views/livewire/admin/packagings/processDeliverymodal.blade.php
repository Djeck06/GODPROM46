<form wire:submit.prevent="save">
<x-modal.dialog wire:model.defer="showprocessDeliveryModal" cssWidth="sm:w-6/12">
    <x-slot name="title">{{__("Delivery processing")}}</x-slot>

    <x-slot name="content">

        <div class="md:grid md:grid-cols-1 md:gap-6">
            
            @if(!is_null($editing->order))
                @php
                $order =$editing->order
                @endphp
            <div class="lg:flex lg:items-center lg:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        {{ __('Packaging #') . $order->reference }}
                    </h2>
                    <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <!-- Heroicon name: solid/briefcase -->
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                            </svg>
                            @if($editing->lastStatus ) {{ __('Status: ') . $editing->lastStatus->label }} @endif
                        </div>
                    
                        
                    
                    </div>
                </div>
            </div>
            <div class="mt-5">

                <div class="md:grid md:grid-cols-5 md:gap-6">
                    <div class="mt-5 md:mt-0 md:col-span-4">
                        
                        
                        <div class="p-4 bg-gray-100 rounded">
                            <h3 class="text-lg font-bold leading-6 text-gray-900">
                                {{ __('Transporter Informations') }}
                            </h3>
                            <ul>
                                @php
                                    $transporter = $editing->lastpackaging_delivery->transporter 
                                @endphp
                                <li class="py-3 w-full flex items-center justify-between text-sm">
                                    <span>{{ __('Full name') }} :</span>
                                    <span class="font-bold text-gray-900">{{ $transporter->lastname }} {{ $transporter->firstname }}</span>
                                </li>
                                <li class="py-3 w-full flex items-center justify-between text-sm">
                                    <span>{{ __('Immatriculation véhicule') }} :</span>
                                    <span class="font-bold text-gray-900">{{ $transporter->registration_number  }}</span>
                                </li>
                                
                            </ul>
                        
                        </div>
                        
                        
                            
                        <div class="py-5">
                            <div class="border-t border-gray-400"></div>
                        </div>

                        <div class="sm:grid sm:grid-cols-5 sm:gap-x-12 ">
                            <div class="col-span-2 sm:col-span-2">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-5">Jours d'enlèvement</h3>
                            </div>

                            @php 
                                $dateOptions = ['enableTime' => false, 'dateFormat' => 'Y-m-d', 'minDate' => 'today'];
                            @endphp
                            
                            <div class="col-span-3 sm:col-span-3">
                                
                                <x-input.time :options="$dateOptions" wire:model.defer="editing.departure_date" placeholder="Date d'enlèvements" />
                                @error('editing.departure_date')
                                    <div class="mt-1 text-red-500 text-sm">
                                        {{ $message }}</div>
                                @enderror
                        
                            </div>
                          
                        </div>
  
                        
                    </div>
                    

                    <div class="md:col-span-1">
                        
                        <div class="">
                            <img class="w-full p-2 border border-gray-100 mb-2"
                                src="{{ asset('orders/qrcode/' . $editing->order->reference . '.svg') }}"
                                alt="{{ __('Order ' . $editing->order->reference . ' QRCODE') }}">

                            @if(!is_null($editing->order->codebar))
                            <img class="w-full p-2 border border-gray-100 mb-2 mt-5" src="{{'data:image/png;base64,' . $editing->order->codebar }} " alt="{{ __('Order ' . $editing->order->reference . ' BARCODE') }}">

                            @endif

                        </div>
                        
                    </div>
                </div>
            </div>
            @endif
        </div>

        

    </x-slot>

    <x-slot name="footer">
        <x-button.secondary wire:click="$set('showprocessDeliveryModal', false)">Annuler</x-button.primary>

        <x-button.primary type="submit">Enregistrer</x-button.primary>
    </x-slot>

   
</x-modal.dialog>
</form>