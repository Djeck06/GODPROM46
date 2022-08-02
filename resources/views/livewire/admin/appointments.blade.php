<div class="p-6 sm:p-8">

    
    <div class="py-4 space-y-4">
        @if(isset($etat))
        <div class="flex justify-between">
            <div class=" flex space-x-6">
                <div class="text-2xl font-extrabold tracking-tight leading-none">
                    {{$secondtitle}}
                </div>
            </div>

           
        </div>
        @endif
        <div class="flex justify-between">
            <div class="w-1/4 flex space-x-4">
                <x-input.text wire:model="filters.search" placeholder="Rechercher une commande..." />
            </div>

            <div class="space-x-2 flex items-center">
                <x-input.group borderless paddingless for="perPage" label="Par Page">
                    <x-input.select wire:model="perPage" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </x-input.select>
                </x-input.group>

                <x-button.primary wire:click="create">
                    <x-icon.plus /> Nouveau
                </x-button.primary>
                @php
                    $mess_age = __('are you sure') ;
                @endphp
                @if(isset($etat) && $etat == "paid")
                <x-button.primary wire:click.prevent="sendToPackaging" onclick="confirm('{{ $mess_age  }}')">
                    <x-icon.plus /> {{__('send to packaging')}}
                </x-button.primary>
                @endif

            </div>
        </div>

        <div class="flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading>
                        <x-input.checkbox  wire:model ="selectAll"/>
                    </x-table.heading>
                    <x-table.heading>Date et Heure</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('name')"
                        :direction="$sorts['name'] ?? null">Réference
                    </x-table.heading>
                    <x-table.heading>Ville d'enlèvement</x-table.heading>
                    <x-table.heading>Adresse d'Enlevement</x-table.heading>
                    <x-table.heading>Rendez-vous</x-table.heading>
                    <x-table.heading>Statut</x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @forelse ($datas as $el)
                        <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $el->id }}">
                            <x-table.cell class="pr-0">
                                <x-input.checkbox value="{{ $el->id }}" wire:model="selectedsdata" />
                            </x-table.cell>

                            <x-table.cell>
                                <span class="">{{ $el->created_at->diffForHumans()  }}<br> {{ $el->created_at->toAtomString()  }}</span>
                            </x-table.cell>
                           
                            <x-table.cell>
                                <span class="">{{ $el->order->reference }}</span>
                            </x-table.cell>


                            <x-table.cell>
                                <span class="">{{ $el->order->pickup_city }}</span>
                            </x-table.cell>
                            <x-table.cell>
                                <span class="">{{ $el->order->pickup_address }}</span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="">
                                    {{ $el->appointment_date->format('Y-m-d') .' ' . $el->appointment_start .' to ' . $el->appointment_end }}

                                </span>
                            </x-table.cell>

                            <x-table.cell>
                                @if($el->lastStatus)<span class="{{ $el->lastStatus->color }} font-semibold inline-flex px-2 py-1 rounded-2xl text-gray-800 text-xs">{{ $el->lastStatus->label }}</span> @endif
                            </x-table.cell>


                            <x-table.cell>
                                <div class="flex justify-center items-center">
                                    

                                   
                                    <x-button.dropdown :align="'right'" :btnClasses="'bg-blue-100 mr-3'" :width="40" class="bg-white" style="right: 4em; top: -1em;"  >
                                        <x-slot name="trigger">
                                           ...
                                         
                                        </x-slot>

                                        <x-slot name="content">
                                            <a href="#" class="block px-4 py-2 hover:bg-blue-400 hover:text-white" wire:click="show({{ $el->id }})" >
                                                Détail
                                            </a>
                                            @foreach ($el->privatestate as $state)
                                                @if(!is_null($state['nextactionname']) )
                                                    <a href="javascript:void(0)" class="block px-4 py-2 hover:bg-blue-400 hover:text-white" wire:click="next('{{ $state['nextactionname']}}', {{$el->id }})" >
                                                        {{ __($state['nextactionname']) }}
                                                    </a>
                                                @endif
                                            @endforeach

                                            <a href="javascript:void(0)" class="block px-4 py-2 hover:bg-blue-400 hover:text-white" wire:click="tiket({{ $el->id }})" >
                                                Etiquette
                                            </a>

                                            

                                           
                                          
                                        </x-slot>
                                    </x-button.dropdown>

                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="11">
                                <div class="flex justify-center items-center space-x-2">
                                    <x-icon.inbox class="h-5 w-5 text-cool-gray-400" />
                                    <span class="font-medium py-8 text-cool-gray-400 text-md">Aucun Rendez-vous
                                    </span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>

            </x-table>

            <div>
                {{ $datas->links() }}
            </div>
        </div>
    </div>

    <!-- Save  Modal -->
  
    <x-modal.dialog wire:model.defer="showDetailModal" cssWidth="sm:w-8/12">
        <x-slot name="title">Consulter une commande</x-slot>

        <x-slot name="content">

            <div class="md:grid md:grid-cols-1 md:gap-6">
                @if(!is_null($selectappointment))
                @include('client.order.inc.header', ['order' => $selectappointment])
                  
                @endif
                <div class="mt-5">

                    <div class="md:grid md:grid-cols-5 md:gap-6">
                        <div class="mt-5 md:mt-0 md:col-span-4">
                            @if(!is_null($selectappointment))
                                @include('client.order.inc.menu', ['order' => $selectappointment])

                            @endif
                            <div class="md:col-span-1">
                                <div class="p-4 bg-gray-100 rounded">
                                    <h3 class="text-lg font-bold leading-6 text-gray-900">
                                        {{ __('Order summary') }}
                                    </h3>
                                    <ul>
                                        <li class="py-3 w-full flex items-center justify-between text-sm">
                                            <span>{{ __('Subtotal') }}</span>
                                            <span class="font-bold text-gray-900">{{ $selectappointment->price   }}€</span>
                                        </li>
                                        <li class="py-3 w-full flex items-center justify-between text-sm">
                                            <span>{{ __('Insurance Fees') }}</span>
                                            <span class="font-bold text-gray-900">{{ $selectappointment->insurance }}€</span>
                                        </li>
                                        <li
                                            class="py-3 w-full flex items-center justify-between text-md border-t border-gray-20">
                                            <span class="font-semibold text-gray-800">{{ __('Total') }}</span>
                                            <span class="font-bold text-gray-900">{{ $selectappointment->total }}€</span>
                                        </li>
                                    </ul>
                                
                                </div>
                            </div>
                            <div class="mt-5 md:col-span-2">
                                <div class="mt-2 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-2 lg:gap-x-6">
                                    <div class="border-2 border-blue-400 p-4 rounded">
                                        <h4 class="font-semibold">{{ __('Pickup Address') }}</h4>
                                        <address class="mt-4">
                                            <p>{{ $selectappointment->pickup_address }}</p>
                                            <p>@if(!is_null($selectappointment->pickupCountry)){{ $selectappointment->pickup_city }}, {{ $selectappointment->pickupCountry->name }}@endif</p>
                                        </address>
                                    </div>
                                    <div class="border-2 border-blue-400 p-4 rounded">
                                        <h4 class="font-semibold">{{ __('Delivery Address') }}</h4>
                                        <address class="mt-4">
                                            <p>{{ $selectappointment->delivery_address }}</p>
                                            <p>{{ __('Tel: ') }} {{ $selectappointment->delivery_phone }}</p>
                                            <p>@if(!is_null($selectappointment->deliveryCountry)){{ $selectappointment->delivery_city }}, {{ $selectappointment->deliveryCountry->name }}@endif</p>
                                        </address>
                                    </div>
                                </div>

                                <div class="py-5">
                                    <div class="border-t border-gray-400"></div>
                                </div>


                              

                                @if ($selectappointment->notes)
                                    <div class="py-5">
                                        <div class="border-t border-gray-400"></div>
                                    </div>

                                    <div class="border-2 border-blue-400 p-4 rounded">
                                        <h4 class="font-semibold">{{ __('Additional notes') }}</h4>
                                        <p>{{ $selectappointment->notes }}</p>
                                    </div>
                                @endif

                                
                            </div>
                        </div>
                        

                        <div class="md:col-span-1">
                            @if(!is_null($selectappointment))

                                @include('client.order.inc.sidebar', ['order' => $selectappointment])

                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-button.secondary wire:click="$set('showDetailModal', false)">Fermer</x-button.secondary>
        </x-slot>
    </x-modal.dialog>
    
    
    <livewire:admin.commands.assignmodal/>
    <livewire:admin.commands.tiketmodal  />


</div>
