<div class="p-6 sm:p-8">
    <div class="py-4 space-y-4">
        <div class="flex justify-between">
            <div class="w-1/4 flex space-x-4">
                <x-input.text wire:model="filters.search" placeholder="Rechercher un transporteur..." />
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
                    <x-table.heading>Nom</x-table.heading>
                    <x-table.heading>Prénom</x-table.heading>
                    <x-table.heading>Téléphone</x-table.heading>
                    <x-table.heading>Immatriculation véhicule</x-table.heading>
                    <x-table.heading>Code NAF</x-table.heading>
                    <x-table.heading>Numéro TVA</x-table.heading>
                    <x-table.heading>Numéro Siren</x-table.heading>
                    <x-table.heading>Numéro Siret</x-table.heading>
                    <x-table.heading>Statut</x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @forelse ($transporters as $transporter)
                        <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $transporter->id }}">
                            <x-table.cell class="pr-0">
                                <x-input.checkbox value="{{ $transporter->id }}" />
                            </x-table.cell>
                            <x-table.cell>
                                <span class="">{{ $transporter->lastname }}</span>
                            </x-table.cell>
                            <x-table.cell>
                                <span class="">{{ $transporter->firstname }}</span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="inline-flex space-x-2 truncate text-sm leading-5">
                                    {{ $transporter->phone }}
                                </span>
                            </x-table.cell>
                            <x-table.cell>
                                <span class="inline-flex space-x-2 truncate text-sm leading-5">
                                    {{ $transporter->register_number }}
                                </span>
                            </x-table.cell>
                            <x-table.cell>
                                <span class="inline-flex space-x-2 truncate text-sm leading-5">
                                    {{ $transporter->naf_code }}
                                </span>
                            </x-table.cell>
                            <x-table.cell>
                                <span class="inline-flex space-x-2 truncate text-sm leading-5">
                                    {{ $transporter->tva_number }}
                                </span>
                            </x-table.cell>
                            <x-table.cell>
                                <span class="inline-flex space-x-2 truncate text-sm leading-5">
                                    {{ $transporter->siren_number }}
                                </span>
                            </x-table.cell>
                            <x-table.cell>
                                <span class="inline-flex space-x-2 truncate text-sm leading-5">
                                    {{ $transporter->siret_number }}
                                </span>
                            </x-table.cell>
                            

                           

                            <x-table.cell>
                               
                                <span class="bg-red-100 font-semibold inline-flex px-2 py-1 rounded-2xl text-red-800 text-xs">{{ $transporter->status_name }}</span>
            
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex justify-center items-center">
                                <x-button class="flex items-center mr-3 " >
                                        Détail
                                    </x-button>
                                    <x-button class="flex items-center mr-3 "   wire:click="edit({{ $transporter->id }})" >
                                            <x-icon.edit class="w-4" />Modifier
                                    </x-button>

                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="11">
                                <div class="flex justify-center items-center space-x-2">
                                    <x-icon.inbox class="h-5 w-5 text-cool-gray-400" />
                                    <span class="font-medium py-8 text-cool-gray-400 text-md">Aucun transpoteur défini!
                                    </span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>

            </x-table>

            <div>
                {{ $transporters->links() }}
            </div>
        </div>
    </div>

    <!-- Save  Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model.defer="showEditModal" cssWidth="sm:w-8/12">
            <x-slot name="title">Editer un transporteur</x-slot>

            <x-slot name="content">
                <div class="sm:grid sm:grid-cols-2 sm:gap-x-12 ">
                
                    <x-input.group for="lastname" label="Nom" :error="$errors->first('editing.lastname')">
                        <x-input.text wire:model.defer="editing.lastname" id="lastname" placeholder="Nom" />
                    </x-input.group>

                    <x-input.group for="firstname" label="Prénoms" :error="$errors->first('editing.firstname')">
                        <x-input.text wire:model.defer="editing.firstname" id="firstname" placeholder="Prénoms" />
                    </x-input.group>
                    <x-input.group for="phone" label="Numéro de téléphone" :error="$errors->first('editing.phone')">
                        <x-input.text wire:model.defer="editing.phone" id="phone" placeholder="Numéro de téléphone" />
                    </x-input.group>
                    <x-input.group for="description" label="Description"
                        :error="$errors->first('editing.description')">
                        <x-input.textarea wire:model.defer="editing.description" id="description"
                            placeholder="Description" />
                    </x-input.group>
                    
                </div>
                <div class="font-extrabold tracking-tight leading-none sm:border-t sm:py-5">
                    Info sur le véhicule
                </div>
                <div class="sm:grid sm:grid-cols-2 sm:gap-x-12 ">
                
                    

                    <x-input.group for="tva_number" label="Numéro TVA" :error="$errors->first('editing.tva_number')">
                        <x-input.text wire:model.defer="editing.tva_number" id="tva_number" placeholder="Numéro TVA" />
                    </x-input.group>

                    <x-input.group for="siren_number" label="Numéro sirène" :error="$errors->first('editing.siren_number')">
                        <x-input.text wire:model.defer="editing.siren_number" id="siren_number" placeholder="Numéro sirène" />
                    </x-input.group>

                    <x-input.group for="siret_number" label="Numéro SIRET" :error="$errors->first('editing.siret_number')">
                        <x-input.text wire:model.defer="editing.siret_number" id="siret_number" placeholder="Numéro SIRET" />
                    </x-input.group>

                    <x-input.group for="naf_code" label="Code NAF" :error="$errors->first('editing.naf_code')">
                        <x-input.text wire:model.defer="editing.naf_code" id="naf_code" placeholder="Code NAF" />
                    </x-input.group>

                </div>
                <div class="font-extrabold tracking-tight leading-none sm:border-t sm:py-5">
                    Documents
                </div>
                <div class="sm:grid sm:grid-cols-2 sm:gap-x-12 ">
                    @forelse ($files as $key => $t)
                    <div class="sm:grid sm:grid-cols-2  ">
                    
                        <x-input.group label="{{$fileslongnames[$key]['label']}}" for="{{$key}}" :error="$errors->first('files.'.$key)">
                            <x-input.file-upload wire:model.defer="files.{{$key}}" id="{{$key}}" name="{{$key}}" >
                            
                                <div wire:loading wire:target="files.{{$key}}">Uploading...</div>
                            
                            </x-input.file-upload>
                        </x-input.group>
                        <div class="sm:grid sm:grid-cols-1">
                        @if ($files[$key])
                            @if(collect(['jpg', 'png', 'jpeg', 'webp'])->contains($t->getClientOriginalExtension()))
                                <span class="h-12 w-12  overflow-hidden bg-gray-100">
                                    <img src="{{ $t->temporaryUrl() }}" alt="Profile Photo">
                                </span> 
                            @else

                                <span class="h-12 w-12  overflow-hidden bg-gray-100">
                                    <svg class="h-12 w-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </span>
                            @endif
                        @else
                            @if(array_key_exists('model',$fileslongnames[$key]))
                                @if(collect(['jpg', 'png', 'jpeg', 'webp'])->contains($fileslongnames[$key]['model']['extension']) )
                                    <span class="h-12 w-12  overflow-hidden bg-gray-100">
                                        <img src="{{ $fileslongnames[$key]['model']['fileUrl'] }}" alt="Profile Photo">
                                    </span> 
                                @else
                                
                                    <span class="h-12 w-12  overflow-hidden bg-gray-100">
                                        <svg class="h-12 w-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        
                                    </span>
                                    {{ $fileslongnames[$key]['model']['file_name'] }}
                                @endif
                                  
                            @endif

                        @endif
                        </div>
                    </div>
                    
                    
                    @endforeach

                </div>
               
               
                
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Annuler</x-button.primary>

                <x-button.primary type="submit">Enregistrer</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>
