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
            </div>
        </div>

        <div class="flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading>
                        <x-input.checkbox />
                    </x-table.heading>
                    <x-table.heading>Date et Heure</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('name')"
                        :direction="$sorts['name'] ?? null">Réference</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('name')"
                        :direction="$sorts['name'] ?? null">Client</x-table.heading>
                    <x-table.heading>Ville d'enlèvement</x-table.heading>
                    <x-table.heading>Adresse d'Enlevement</x-table.heading>
                    <x-table.heading>Pays de Livraison</x-table.heading>
                    <x-table.heading>Ville de Livraison</x-table.heading>
                    <x-table.heading>Statut</x-table.heading>
                    <x-table.heading>Niveau</x-table.heading>
                    <x-table.heading>Payement</x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @forelse ($commands as $order)
                        <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $order->id }}">
                            <x-table.cell class="pr-0">
                                <x-input.checkbox value="{{ $order->id }}" wire:model="selectedsdata" />
                            </x-table.cell>

                            <x-table.cell>
                                <span class="">{{ $order->created_at->diffForHumans()  }}<br> {{ $order->created_at->toAtomString()  }}</span>
                            </x-table.cell>
                           
                            <x-table.cell>
                                <span class="">{{ $order->reference }}</span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="inline-flex space-x-2 truncate text-sm leading-5">
                                    {{ $order->name }}
                                </span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="">{{ $order->reference }}</span>
                            </x-table.cell>
                            <x-table.cell>
                                <span class="">{{ $order->pickup_address }}</span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="">{{ $order->name }}</span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="">{{ $order->delivery_city }}</span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="">{{ $order->name }}</span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="">{{ $order->name }}</span>
                            </x-table.cell>

                            <x-table.cell>
                               
                                <span class="bg-red-100 font-semibold inline-flex px-2 py-1 rounded-2xl text-red-800 text-xs">{{ $order->status }}</span>
                                
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex justify-center items-center">
                                    

                                   
                                    <x-button.dropdown :align="'right'" :btnClasses="'bg-blue-600 mr-3'" :width="40" class="bg-white" style="right: 4em; top: -1em;"  >
                                        <x-slot name="trigger">
                                           ...
                                         
                                        </x-slot>

                                        <x-slot name="content">
                                            <a href="#" class="block px-4 py-2 hover:bg-blue-400 hover:text-white" wire:click="show({{ $order->id }})" >
                                                Détail
                                            </a>
                                            @if (in_array( $order->status , ['readytopickup']))
                                            <a href="javascript:void(0)" class="block px-4 py-2 hover:bg-blue-400 hover:text-white" wire:click="assign({{ $order->id }})" >
                                                Assignation
                                            </a>
                                            @endif

                                            <a href="javascript:void(0)" class="block px-4 py-2 hover:bg-blue-400 hover:text-white" wire:click="tiket({{ $order->id }})" >
                                            Etiquette
                                            </a>

                                            

                                           
                                          
                                        </x-slot>
                                    </x-button.dropdown>

                    
                                 
                  

                                    
                                    <div class="flex justify-center items-center">
                                        <x-button class="flex items-center mr-3" wire:click="edit({{ $order->id }})">
                                            <x-icon.edit class="w-4" />Modifier
                                        </x-button>

                                    </div>

                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="11">
                                <div class="flex justify-center items-center space-x-2">
                                    <x-icon.inbox class="h-5 w-5 text-cool-gray-400" />
                                    <span class="font-medium py-8 text-cool-gray-400 text-md">Aucune commande!
                                    </span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>

            </x-table>

            <div>
                {{ $commands->links() }}
            </div>
        </div>
    </div>

    <!-- Save  Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model.defer="showEditModal" cssWidth="sm:w-8/12">
            <x-slot name="title">Editer une commande</x-slot>

            <x-slot name="content">

                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Client') }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Provide informations about client') }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="sm:overflow-hidden">
                            <div class="px-4">
                                <div class="items-wrapper">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-12 sm:col-span-12">
                                           
                                            <x-input.text wire:model.defer="editing.client_id"
                                                placeholder="{{ __('e.g. Boluevard du 30 Aout') }}" type="hidden" />
                                            @error('editing.client_id')
                                                <div class="mt-1 text-red-500 text-sm">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                       
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hidden sm:block" aria-hidden="true">
                    <div class="py-5">
                        <div class="border-t border-gray-200"></div>
                    </div>
                </div>
               
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Addresses') }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Provide informations about pickup and delivery addresses') }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="sm:overflow-hidden">
                            <div class="px-4">
                                <div class="items-wrapper">
                                    <div class="grid grid-cols-6 gap-6">
                                     
                                        <div class="col-span-6 sm:col-span-3">
                                            <x-input.label>{{ __('Pick Up Country') }}</x-input.label>
                                            <select id="country" wire:model.defer="editing.pickup_country"
                                                autocomplete="country-name"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                <option value="">{{ __('Select a country') }}</option>
                                                @foreach ($this->pickupCountries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('editing.pickup_country')
                                                <div class="mt-1 text-red-500 text-sm">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <x-input.label>{{ __('Pick Up City') }}</x-input.label>
                                            <x-input.text wire:model.defer="editing.pickup_city" placeholder="{{ __('e.g. Lomé') }}" />
                                            @error('editing.pickup_city')
                                                <div class="mt-1 text-red-500 text-sm">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-span-6">
                                            <x-input.label>{{ __('Pick Up Address') }}</x-input.label>
                                            <x-input.text wire:model.defer="editing.pickup_address"
                                                placeholder="{{ __('e.g. Boluevard du 30 Aout') }}" />
                                            @error('editing.pickup_address')
                                                <div class="mt-1 text-red-500 text-sm">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-6 gap-6 mt-10">
                                        <div class="col-span-6 sm:col-span-3">
                                            <x-input.label>{{ __('Delivery Country') }}</x-input.label>
                                            <select id="deliveryCountry" wire:model.defer="editing.delivery_country"
                                                autocomplete="country-name"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                <option value="">{{ __('Select a country') }}</option>
                                                @foreach ($this->deliveryCountries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('editing.delivery_country')
                                                <div class="mt-1 text-red-500 text-sm">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <x-input.label>{{ __('Delivery City') }}</x-input.label>
                                            <x-input.text wire:model.defer="editing.delivery_city"
                                                placeholder="{{ __('e.g. Paris') }}" />
                                            @error('editing.delivery_city')
                                                <div class="mt-1 text-red-500 text-sm">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <x-input.label>{{ __('Delivery Address') }}</x-input.label>
                                            <x-input.text wire:model.defer="editing.delivery_address"
                                                placeholder="{{ __('e.g. Boluevard du 30 Aout') }}" />
                                            @error('editing.delivery_address')
                                                <div class="mt-1 text-red-500 text-sm">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <x-input.label>{{ __('Delivery Phone') }}</x-input.label>
                                            <x-input.text wire:model.defer="editing.delivery_phone"
                                                placeholder="{{ __('+33 xx xx xx xx xx xx') }}" />
                                            @error('editing.delivery_phone')
                                                <div class="mt-1 text-red-500 text-sm">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hidden sm:block" aria-hidden="true">
                    <div class="py-5">
                        <div class="border-t border-gray-200"></div>
                    </div>
                </div>

                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Package Informations') }}</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Provide informations about your packages') }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="sm:overflow-hidden">
                            <div class="px-4">
                                <div class="items-wrapper">
                                    @foreach ($items as $key => $value)
                                        <x-quotation.package :key="$key" :packages="$this->packages" />
                                        @error('items.' . $key . '.name')
                                            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    @endforeach

                                </div>

                                <div class="flex justify-end sm:pt-5">
                                    <button type="button" wire:click.prevent="addItem()"
                                        class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                                        {{ __('Add object') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hidden sm:block" aria-hidden="true">
                    <div class="py-5">
                        <div class="border-t border-gray-200"></div>
                    </div>
                </div>

                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Additional Informations') }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Provide informations about your quote request') }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="sm:overflow-hidden">
                            <div class="px-4">
                                <div class="grid grid-cols-6 gap-6 mb-4">
                                    <div class="col-span-6">
                                        <x-input.label>{{ __('Additional Informations') }}</x-input.label>
                                        <x-input.textarea wire:model.defer="editing.notes" rows="4"
                                            placeholder="{{ __('Notes...') }}" />
                                        <p class="mt-2 text-sm text-gray-500">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
               
               
                
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Annuler</x-button.secondary>

                <x-button.primary  type="submit">Enregistrer</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>

    <x-modal.dialog wire:model.defer="showDetailModal" cssWidth="sm:w-8/12">
        <x-slot name="title">Consulter une commande</x-slot>

        <x-slot name="content">

            <div class="md:grid md:grid-cols-1 md:gap-6">
                @if(!is_null($selectorder))
                @include('client.order.inc.header', ['order' => $selectorder])
                  
                @endif
                <div class="mt-5">

                    <div class="md:grid md:grid-cols-5 md:gap-6">
                        <div class="mt-5 md:mt-0 md:col-span-4">
                            @if(!is_null($selectorder))
                                @include('client.order.inc.menu', ['order' => $selectorder])

                            @endif
                            <div class="md:col-span-1">
                                <div class="p-4 bg-gray-100 rounded">
                                    <h3 class="text-lg font-bold leading-6 text-gray-900">
                                        {{ __('Order summary') }}
                                    </h3>
                                    <ul>
                                        <li class="py-3 w-full flex items-center justify-between text-sm">
                                            <span>{{ __('Subtotal') }}</span>
                                            <span class="font-bold text-gray-900">{{ $selectorder->price   }}€</span>
                                        </li>
                                        <li class="py-3 w-full flex items-center justify-between text-sm">
                                            <span>{{ __('Insurance Fees') }}</span>
                                            <span class="font-bold text-gray-900">{{ $selectorder->insurance }}€</span>
                                        </li>
                                        <li
                                            class="py-3 w-full flex items-center justify-between text-md border-t border-gray-20">
                                            <span class="font-semibold text-gray-800">{{ __('Total') }}</span>
                                            <span class="font-bold text-gray-900">{{ $selectorder->total }}€</span>
                                        </li>
                                    </ul>
                                
                                </div>
                            </div>
                            <div class="mt-5 md:col-span-2">
                                <div class="mt-2 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-2 lg:gap-x-6">
                                    <div class="border-2 border-blue-400 p-4 rounded">
                                        <h4 class="font-semibold">{{ __('Pickup Address') }}</h4>
                                        <address class="mt-4">
                                            <p>{{ $selectorder->pickup_address }}</p>
                                            <p>@if(!is_null($selectorder->pickupCountry)){{ $selectorder->pickup_city }}, {{ $selectorder->pickupCountry->name }}@endif</p>
                                        </address>
                                    </div>
                                    <div class="border-2 border-blue-400 p-4 rounded">
                                        <h4 class="font-semibold">{{ __('Delivery Address') }}</h4>
                                        <address class="mt-4">
                                            <p>{{ $selectorder->delivery_address }}</p>
                                            <p>{{ __('Tel: ') }} {{ $selectorder->delivery_phone }}</p>
                                            <p>@if(!is_null($selectorder->deliveryCountry)){{ $selectorder->delivery_city }}, {{ $selectorder->deliveryCountry->name }}@endif</p>
                                        </address>
                                    </div>
                                </div>

                                <div class="py-5">
                                    <div class="border-t border-gray-400"></div>
                                </div>


                                <ul role="list" class="-my-6 divide-y divide-gray-200">
                                @if(!is_null($selectorder))
                                    @foreach ($selectorder->items as $item)
                                        <li class="flex py-6">
                                            <div
                                                class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                                <img src="{{ $item->package->image ? asset($item->package->image) : asset('images/package/default.jpeg') }}"
                                                    alt="Package image" class="h-full w-full object-cover object-center">
                                            </div>

                                            <div class="ml-4 flex flex-1 flex-col">
                                                <div>
                                                    <div class="flex justify-between text-base font-medium text-gray-900">
                                                        <h3>
                                                            <a href="#"> {{ $item->package->name }} </a>
                                                        </h3>
                                                        <p class="ml-4">{{ $item->quantity *  $item->price }}€</p>
                                                    </div>
                                                    {{--<p class="mt-1 text-sm text-gray-500">{{ $item->package->name }}</p> --}}
                                                </div>
                                                <div class="flex flex-1 items-end justify-between text-sm">
                                                    <p class="text-gray-500">
                                                        {{ $item->quantity }} x {{ $item->price }}€
                                                        @if ($item->has_insurance)
                                                            <br><span
                                                                class="text-gray-3000">{{ __('Insurance Fees: ') . '5€' }}</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                                </ul>

                                @if ($selectorder->notes)
                                    <div class="py-5">
                                        <div class="border-t border-gray-400"></div>
                                    </div>

                                    <div class="border-2 border-blue-400 p-4 rounded">
                                        <h4 class="font-semibold">{{ __('Additional notes') }}</h4>
                                        <p>{{ $selectorder->notes }}</p>
                                    </div>
                                @endif

                                
                            </div>
                        </div>
                        

                        <div class="md:col-span-1">
                            @if(!is_null($selectorder))

                                @include('client.order.inc.sidebar', ['order' => $selectorder])

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

    <livewire:admin.commands.assignmodal :order="$selectorder" />
    <livewire:admin.commands.tiketmodal :order="$selectorder" />

</div>
