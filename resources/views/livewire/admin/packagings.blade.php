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

    

    <x-modal.dialog wire:model.defer="showDetailModal" cssWidth="sm:w-8/12">
        <x-slot name="title">Consulter une commande</x-slot>

        <x-slot name="content">

           

        </x-slot>

        <x-slot name="footer">
            <x-button.secondary wire:click="$set('showDetailModal', false)">Fermer</x-button.secondary>
        </x-slot>
    </x-modal.dialog>

    <livewire:admin.commands.tiketmodal />
    <livewire:admin.commands.processdeliverymodal  />
    <livewire:admin.commands.deliverymodal  />
    
</div>
