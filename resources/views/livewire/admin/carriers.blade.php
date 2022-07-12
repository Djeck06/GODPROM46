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
                   
                    <x-input.group label="KABIS" for="kabis" :error="$errors->first('files.kabis')">
                        <x-input.file-upload wire:model.defer="files.kabis" id="kabis">
                            <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                @if ($files['kabis'])
                                    <img src="{{ $files['kabis']->temporaryUrl() }}" alt="Profile Photo">
                                @else
                                    <img src="{{ $files['kabis'] }}" alt="Profile Photo">
                                @endif
                            </span> 
                        </x-input.file-upload>
                    </x-input.group>

                   

                    <x-input.group label="URSAF" for="ursaf" :error="$errors->first('files.ursaf')">
                        <x-input.file-upload wire:model="files.ursaf" id="ursaf">
                            <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                @if ($files['ursaf'])
                                    <img src="{{ $files['ursaf']->temporaryUrl() }}" alt="Profile Photo">
                                @elseupload
                                    <img src="{{ $files['ursaf'] }}" alt="Profile Photo">
                                @endif
                            </span>
                        </x-input.file-upload>
                    </x-input.group>

                    <x-input.group label="Licence d'Exploitation" for="lex" :error="$errors->first('files.lex')">
                        <x-input.file-upload wire:model="files.lex" id="lex">
                            <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                @if ($files['lex'])
                                    <img src="{{ $files['lex']->temporaryUrl() }}" alt="Profile Photo">
                                @elseupload
                                    <img src="{{ $files['lex'] }}" alt="Profile Photo">
                                @endif
                            </span>  
                        </x-input.file-upload>
                    </x-input.group>

                    <x-input.group label="Permis de Conduire" for="pdc" :error="$errors->first('files.pdc')">
                        <x-input.file-upload wire:model="files.pdc" id="pdc">
                            <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                @if ($files['pdc'])
                                    <img src="{{ $files['pdc']->temporaryUrl() }}" alt="Profile Photo">
                                @elseupload
                                    <img src="{{ $files['pdc'] }}" alt="Profile Photo">
                                @endif
                            </span>  
                        </x-input.file-upload>
                    </x-input.group> 

                    <x-input.group label="Assurance marchandise" for="asm" :error="$errors->first('files.asm')">
                        <x-input.file-upload wire:model="files.asm" id="asm">
                            <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                @if ($files['asm'])
                                    <img src="{{ $files['asm']->temporaryUrl() }}" alt="Profile Photo">
                                @elseupload
                                    <img src="{{ $files['asm'] }}" alt="Profile Photo">
                                @endif
                            </span>  
                           
                        </x-input.file-upload>
                    </x-input.group>

                    <x-input.group label="Assurance Flotte" for="asf" :error="$errors->first('files.asf')">
                        <x-input.file-upload wire:model="files.asf" id="asf">
                            <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                @if ($files['asf'])
                                    <img src="{{ $files['asf']->temporaryUrl() }}" alt="Profile Photo">
                                @elseupload
                                    <img src="{{ $files['asf'] }}" alt="Profile Photo">
                                @endif
                            </span>  
                        </x-input.file-upload>
                    </x-input.group>

                    <x-input.group label="Assurance Véhicule" for="asv" :error="$errors->first('files.asv')">
                        <x-input.file-upload wire:model="files.asv" id="asv">
                            <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                @if ($files['asv'])
                                    <img src="{{ $files['asv']->temporaryUrl() }}" alt="Profile Photo">
                                @elseupload
                                    <img src="{{ $files['asv'] }}" alt="Profile Photo">
                                @endif
                            </span> 
                            
                        </x-input.file-upload>
                    </x-input.group>

                    <x-input.group label="Carte grise" for="cag" :error="$errors->first('files.cag')">
                        <x-input.file-upload wire:model="files.cag" id="cag">
                            <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                @if ($files['cag'])
                                    <img src="{{ $files['cag']->temporaryUrl() }}" alt="Profile Photo">
                                @elseupload
                                    <img src="{{ $files['cag'] }}" alt="Profile Photo">
                                @endif
                            </span> 
                            
                        </x-input.file-upload>
                    </x-input.group>

                    <x-input.group label="Attestation LCTD" for="alctd" :error="$errors->first('files.alctd')">
                        <x-input.file-upload wire:model="files.alctd" id="alctd">
                            <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                @if ($files['alctd'])
                                    <img src="{{ $files['alctd']->temporaryUrl() }}" alt="Profile Photo">
                                @elseupload
                                    <img src="{{ $files['alctd'] }}" alt="Profile Photo">
                                @endif
                            </span> 
                            
                        </x-input.file-upload>
                    </x-input.group>

                    <x-input.group label="Attestation d'impôts" for="ati" :error="$errors->first('files.ati')">
                        <x-input.file-upload wire:model="files.ati" id="ati">
                            <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                @if ($files['ati'])
                                    <img src="{{ $files['ati']->temporaryUrl() }}" alt="Profile Photo">
                                @elseupload
                                    <img src="{{ $files['ati'] }}" alt="Profile Photo">
                                @endif
                            </span> 
                        </x-input.file-upload>
                    </x-input.group>
                </div>
               
               
                
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Annuler</x-button.primary>

                <x-button.primary type="submit">Enregistrer</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>
