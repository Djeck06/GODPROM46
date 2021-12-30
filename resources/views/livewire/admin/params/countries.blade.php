<div class="p-6 sm:p-8">
    <div class="py-4 space-y-4">
        <div class="flex justify-between">
            <div class="w-1/4 flex space-x-4">
                <x-input.text wire:model="filters.search" placeholder="Rechercher un pays..." />
            </div>

            <div class="space-x-2 flex items-center">
                <x-input.group borderless paddingless for="perPage" label="Par Page">
                    <x-input.select wire:model="perPage" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </x-input.select>
                </x-input.group>

                {{-- <livewire:import-transactions /> --}}
                <x-button.secondary wire:click="$toggle('showImportModal')" class="flex items-center space-x-2">
                    <x-icon.upload class="text-cool-gray-500" /> <span>Importer</span>
                </x-button.secondary>

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
                    <x-table.heading sortable multi-column wire:click="sortBy('name')"
                        :direction="$sorts['name'] ?? null" class="">Pays</x-table.heading>
                    <x-table.heading>Code Pays</x-table.heading>
                    <x-table.heading>Pays de Départ</x-table.heading>
                    <x-table.heading>Pays de Destination</x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @forelse ($countries as $country)
                        <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $country->id }}">
                            <x-table.cell class="pr-0">
                                <x-input.checkbox value="{{ $country->id }}" />
                            </x-table.cell>

                            <x-table.cell>
                                <span class="inline-flex space-x-2 truncate text-sm leading-5">
                                    {{ $country->name }}
                                </span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="">{{ $country->code }}</span>
                            </x-table.cell>

                            <x-table.cell>
                                @if ($country->is_pickup_country)
                                    <span
                                        class="bg-green-100 font-semibold inline-flex px-2 py-1 rounded-2xl text-green-800 text-xs">Pays
                                        de départ</span>
                                @else
                                    <span
                                        class="bg-gray-100 font-semibold inline-flex px-2 py-1 rounded-2xl text-gray-800 text-xs">
                                        N/A </span>
                                @endif

                            </x-table.cell>

                            <x-table.cell>
                                @if ($country->is_delivery_country)
                                    <span
                                        class="bg-green-100 font-semibold inline-flex px-2 py-1 rounded-2xl text-green-800 text-xs">Pays
                                        de destination</span>
                                @else
                                    <span
                                        class="bg-gray-100 font-semibold inline-flex px-2 py-1 rounded-2xl text-gray-800 text-xs">
                                        N/A </span>
                                @endif
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex justify-center items-center">
                                    <x-button.link class="flex items-center mr-3"
                                        wire:click="edit({{ $country->id }})">
                                        <x-icon.edit class="w-4" />Modifier
                                    </x-button.link>

                                </div>
                            </x-table.cell>


                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="6">
                                <div class="flex justify-center items-center space-x-2">
                                    <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                    <span class="font-medium py-8 text-cool-gray-400 text-xl">Aucun pays dans le
                                        système</span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>

            </x-table>

            <div>
                {{ $countries->links() }}
            </div>
        </div>
    </div>

    <!-- Import Modal -->
    <form wire:submit.prevent="import">
        <x-modal.dialog wire:model="showImportModal">
            <x-slot name="title">Importation de pays</x-slot>

            <x-slot name="content">
                <div class="py-12 flex flex-col items-center justify-center ">
                    <div class="flex items-center space-x-2 text-xl">
                        <x-icon.upload class="text-cool-gray-400 h-8 w-8" />
                        <x-input.file-upload wire:model="upload" id="upload">
                            <span class="text-cool-gray-500 font-bold">Fichier CSV</span>
                        </x-input.file-upload>
                    </div>
                    @error('upload') <div class="mt-3 text-red-500 text-sm">{{ $message }}</div> @enderror
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showImportModal', false)">Annuler</x-button.secondary>

                <x-button.primary type="submit">Importer</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>

    <!-- Save Country Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model.defer="showEditModal">
            <x-slot name="title">Modifier un pays</x-slot>

            <x-slot name="content">
                <x-input.group for="name" label="Pays" :error="$errors->first('editing.name')">
                    <x-input.text wire:model.defer="editing.name" id="name" placeholder="Pays" />
                </x-input.group>

                <x-input.group for="code" label="Code Pays" :error="$errors->first('editing.code')">
                    <x-input.text wire:model.defer="editing.code" id="code" placeholder="Code Pays" />
                </x-input.group>

                <x-input.group for="" label="Options" :error="$errors->first('editing.is_pickup_country')">
                    <div class="flex items-start mb-4">
                        <div class="flex items-center h-5">
                            <x-input.checkbox wire:model.defer="editing.is_pickup_country" id="is_pickup_country" />
                        </div>

                        <div class="ml-3 text-sm">
                            <label for="is_pickup_country" class="font-medium text-gray-700">Pays de départ</label>
                            <p class="text-gray-500">Cochez cet option pour afficher le pays dans la liste des pays de
                                départ de colis.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <x-input.checkbox wire:model.defer="editing.is_delivery_country" id="is_delivery_country" />
                        </div>

                        <div class="ml-3 text-sm">
                            <label for="is_delivery_country" class="font-medium text-gray-700">Pays de
                                destination</label>
                            <p class="text-gray-500">Cochez cet option pour afficher le pays dans la liste des pays de
                                destination de colis.</p>
                        </div>
                    </div>

                </x-input.group>

                {{-- <x-input.group for="status" label="Status" :error="$errors->first('editing.status')">
                    <x-input.select wire:model="editing.status" id="status">
                        @foreach (App\Models\Transaction::STATUSES as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </x-input.select>
                </x-input.group> --}}

                {{-- <x-input.group for="date_for_editing" label="Date" :error="$errors->first('editing.date_for_editing')">
                    <x-input.date wire:model="editing.date_for_editing" id="date_for_editing" />
                </x-input.group> --}}
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Annuler</x-button.primary>

                    <x-button.primary type="submit">Enregistrer</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>

    <!-- Delete Country Modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Supprimer un pays</x-slot>

            <x-slot name="content">
                <div class="py-8 text-cool-gray-700">Etes-vous sûr? Cet action est irreversible.</div>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button.primary>

                    <x-button.primary type="submit">Delete</x-button.primary>
            </x-slot>
        </x-modal.confirmation>
    </form>
</div>
