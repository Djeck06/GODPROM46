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
                        :direction="$sorts['name'] ?? null">Réference Commande</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('name')"
                        :direction="$sorts['name'] ?? null">Client</x-table.heading>
                    <x-table.heading>Adresse </x-table.heading>
                    <x-table.heading>Statut</x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @forelse ($packagings as $items)
                        <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $items->id }}">
                            <x-table.cell class="pr-0">
                                <x-input.checkbox value="{{ $items->id }}" wire:model="selectedsdata" />
                            </x-table.cell>

                            <x-table.cell>
                                <span class="">{{ $items->lastStatus->created_at->diffForHumans()  }}<br> {{ $items->lastStatus->created_at->toAtomString()  }}</span>
                            </x-table.cell>
                           
                            <x-table.cell>
                                <span class="">{{ $items->order->reference }}</span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="inline-flex space-x-2 truncate text-sm leading-5">
                                @if($items->order->client) {{ $items->order->client->last_name}} {{ $items->order->client->first_name}} @endif
                                </span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class=""> {{ $items->order->pickup_city }} {{ $items->order->pickup_address }}</span>
                            </x-table.cell>

                          

                            <x-table.cell>
                                @if($items->lastStatus)<span class="bg-green-100 font-semibold inline-flex px-2 py-1 rounded-2xl text-gray-800 text-xs">{{ $items->lastStatus->label }}</span> @endif
                            </x-table.cell>

                           

                            <x-table.cell>
                                <div class="flex justify-center items-center">
                                    

                                   
                                    <x-button.dropdown :align="'right'" :btnClasses="'bg-blue-600 mr-3'" :width="40" class="bg-white" style="right: 4em; top: -1em;"  >
                                        <x-slot name="trigger">
                                           ...
                                         
                                        </x-slot>

                                        <x-slot name="content">
                                            <a href="#" class="block px-4 py-2 hover:bg-blue-400 hover:text-white" wire:click="show({{ $items->id }})" >
                                                Détail
                                            </a>
                                            @foreach ($items->privatestate as $state)
                                                @if(!is_null($state['nextactionname']) )
                                                    <a href="javascript:void(0)" class="block px-4 py-2 hover:bg-blue-400 hover:text-white" wire:click="next('{{ $state['nextactionname']}}', {{$items->id }})" >
                                                        {{ __($state['nextactionname']) }}
                                                    </a>
                                                @endif
                                            @endforeach

                                            <a href="javascript:void(0)" class="block px-4 py-2 hover:bg-blue-400 hover:text-white" wire:click="tiket({{ $items->id }})" >
                                                Etiquette
                                            </a>

                                            

                                           
                                          
                                        </x-slot>
                                    </x-button.dropdown>

                    
                                 
                  

                                    
                                    <div class="flex justify-center items-center">
                                        <x-button class="flex items-center mr-3" wire:click="edit({{ $items->id }})">
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
                {{ $packagings->links() }}
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

           

        </x-slot>

        <x-slot name="footer">
            <x-button.secondary wire:click="$set('showDetailModal', false)">Fermer</x-button.secondary>
        </x-slot>
    </x-modal.dialog>
    
    <x-modal.dialog wire:model.defer="sendToPackagingModal" cssWidth="sm:w-3/12">
        <x-slot name="title"></x-slot>

        <x-slot name="content">

            <div class="md:grid md:grid-cols-1 md:gap-6">
               
                <div class="mt-5">
                @error('editing.delivery_phone')
                    <div class="mt-1 text-red-500 text-sm">
                        {{ $message }}</div>
                @enderror

                @error('editing.id')
                    <div class="mt-1 text-red-500 text-sm">
                        {{ $message }}</div>
                @enderror

                    {{ $resultmessages }}
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-button.secondary wire:click="$set('sendToPackagingModal', false)">Fermer</x-button.secondary>
        </x-slot>
    </x-modal.dialog>
    
</div>
