<div class="p-6 sm:p-8" x-data="{showFilters: false}">
    <div class="py-4 space-y-4">
        <div class="flex justify-between">
            <div class="w-1/4 flex space-x-4">
                {{-- <x-input.text wire:model="filters.search" placeholder="Rechercher un package..." /> --}}
                <x-button.link @click="showFilters = !showFilters">
                    Afficher / Cacher les filtres
                </x-button.link>
            </div>

            <div class="space-x-2 flex items-center">
                <x-input.group borderless paddingless for="perPage" label="Par Page">
                    <x-input.select wire:model="perPage" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </x-input.select>
                </x-input.group>
                <x-button.secondary wire:click="showGenerateModal" class="flex items-center space-x-2">
                    <x-icon.load class="text-cool-gray-500" /> <span>Regénérer les prix</span>
                </x-button.secondary>

                <x-button.primary wire:click="create">
                    <x-icon.plus /> Nouveau
                </x-button.primary>
            </div>
        </div>

        <div x-show="showFilters">
            <div class="bg-white p-6 rounded shadow flex relative">
                <span class="text-sm">Filtre TODO!</span>
            </div>
        </div>

        <div class="flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading>
                        <x-input.checkbox />
                    </x-table.heading>
                    <x-table.heading>Package</x-table.heading>
                    <x-table.heading>Pays de départ</x-table.heading>
                    <x-table.heading>Pays de destination</x-table.heading>
                    <x-table.heading>Prix</x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @forelse ($prices as $price)
                        <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $price->id }}">
                            <x-table.cell class="pr-0">
                                <x-input.checkbox value="{{ $price->id }}" />
                            </x-table.cell>

                            <x-table.cell>
                                <span class="inline-flex space-x-2 truncate text-sm leading-5">
                                    {{ $price->package->name }}
                                </span>
                            </x-table.cell>

                            <x-table.cell>
                                <span>{{ $price->pickupCountry->name }}</span>
                            </x-table.cell>

                            <x-table.cell>
                                <span>{{ $price->deliveryCountry->name }}</span>
                            </x-table.cell>
                            <x-table.cell>
                                <span>{{ $price->price }}</span>
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex justify-center items-center">
                                    <x-button.link class="flex items-center mr-3"
                                        wire:click="edit({{ $price->id }})">
                                        <x-icon.edit class="w-4" />Modifier
                                    </x-button.link>

                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="6">
                                <div class="flex justify-center items-center space-x-2">
                                    <x-icon.inbox class="h-5 w-5 text-cool-gray-400" />
                                    <span class="font-medium py-8 text-cool-gray-400 text-md">Aucun prix défini!
                                    </span>
                                    <x-button.secondary class="flex items-center space-x-2"
                                        wire:click="showGenerateModal">
                                        <x-icon.load class="text-cool-gray-500" /> <span>Générer les prix</span>
                                    </x-button.secondary>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>

            </x-table>

            <div>
                {{ $prices->links() }}
            </div>
        </div>
    </div>


    <!-- Save  Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model.defer="showEditModal">
            <x-slot name="title">Editer un prix</x-slot>

            <x-slot name="content">
                <x-input.group for="package" label="Package" :error="$errors->first('editing.package_id')">
                    <x-input.select wire:model.defer="editing.package_id">
                        <option value="">Choisir un package</option>
                        @foreach ($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->name }}</option>
                        @endforeach
                    </x-input.select>
                </x-input.group>

                <x-input.group for="pickup_country" label="Pays de départ"
                    :error="$errors->first('editing.pickup_country_id')">
                    <x-input.select wire:model.defer="editing.pickup_country_id">
                        <option value="">Choisir un pays</option>
                        @foreach ($pickupCountries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </x-input.select>
                </x-input.group>

                <x-input.group for="delivery_country" label="Pays de destination"
                    :error="$errors->first('editing.delivery_country_id')">
                    <x-input.select wire:model.defer="editing.delivery_country_id">
                        <option value="">Choisir un pays</option>
                        @foreach ($pickupCountries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </x-input.select>
                </x-input.group>

                <x-input.group for="price" label="Prix" :error="$errors->first('editing.price')">
                    <x-input.text type="number" wire:model.defer="editing.price" id="price"
                        placeholder="Prix de l'expédition" />
                </x-input.group>

                <x-input.group for="notes" label="Notes" :error="$errors->first('editing.notes')"
                    helpText="Uniquement pour l'administration">
                    <x-input.textarea wire:model.defer="editing.notes" id="notes" placeholder="notes" />
                </x-input.group>


            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Annuler</x-button.primary>

                    <x-button.primary type="submit">Enregistrer</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>

    <!-- Generate Modal -->
    <form wire:submit.prevent="generatePrices">
        <x-modal.dialog wire:model.defer="showGenerateModal">
            <x-slot name="title">Générer les prix</x-slot>

            <x-slot name="content">

                <div class="flex bg-red-100 rounded-lg p-4 mb-4">
                    <svg class="w-5 h-5 text-red-700" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <p class="ml-3 text-sm text-red-700">
                        <span class="font-medium">Attention!</span> Cet action réinitialisera tous les prix.
                    </p>
                </div>

                <x-input.group for="price" label="Prix par défaut" :error="$errors->first('defaultPrice')">
                    <x-input.text type="number" wire:model.defer="defaultPrice" id="price"
                        placeholder="Prix de l'expédition" />
                </x-input.group>

                <x-input.group for="notes" label="Notes par défaut" :error="$errors->first('defaultNotes')"
                    helpText="Uniquement pour l'administration">
                    <x-input.textarea wire:model.defer="defaultNotes" id="notes" placeholder="notes" />
                </x-input.group>

            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showGenerateModal', false)">Annuler</x-button.primary>

                    <x-button.primary type="submit">Enregistrer</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>

</div>
