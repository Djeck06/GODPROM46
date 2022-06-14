<div class="p-6 sm:p-8">
    <div class="py-4 space-y-4">
        <div class="flex justify-between">
            <div class="w-1/4 flex space-x-4">
                <x-input.text wire:model="filters.search" placeholder="Rechercher un order..." />
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
                    <x-table.heading sortable multi-column wire:click="sortBy('name')"
                        :direction="$sorts['name'] ?? null">Réference</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('name')"
                        :direction="$sorts['name'] ?? null">Client</x-table.heading>
                    <x-table.heading>Ville de livraison</x-table.heading>
                    <x-table.heading>Numéro de téléphone de livraison</x-table.heading>
                    <x-table.heading>Total</x-table.heading>
                    <x-table.heading>Statut</x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @forelse ($orders as $order)
                        <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $order->id }}">
                            <x-table.cell class="pr-0">
                                <x-input.checkbox value="{{ $order->id }}" />
                            </x-table.cell>

                            <x-table.cell>
                                <span class="">{{ $order->id }}</span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="inline-flex space-x-2 truncate text-sm leading-5">
                                    {{ $order->name }}
                                </span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class=""></span>
                            </x-table.cell>
                            <x-table.cell>
                                <span class=""></span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="">1000 £</span>
                            </x-table.cell>

                            <x-table.cell>
                                @if ($order->is_active)
                                    <span
                                        class="bg-green-100 font-semibold inline-flex px-2 py-1 rounded-2xl text-green-800 text-xs">Actif</span>
                                @else
                                    <span
                                        class="bg-red-100 font-semibold inline-flex px-2 py-1 rounded-2xl text-red-800 text-xs">Inactif</span>
                                @endif
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex justify-center items-center">
                                    <x-button class="flex items-center mr-3 " >
                                        Détail
                                    </x-button>

                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="5">
                                <div class="flex justify-center items-center space-x-2">
                                    <x-icon.inbox class="h-5 w-5 text-cool-gray-400" />
                                    <span class="font-medium py-8 text-cool-gray-400 text-md">Aucun order défini!
                                    </span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>

            </x-table>

            <div>
                {{ $orders->links() }}
            </div>
        </div>
    </div>

    <!-- Save  Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model.defer="showEditModal">
            <x-slot name="title">Editer un order</x-slot>

            <x-slot name="content">
                <x-input.group for="name" label="Nom du order" :error="$errors->first('editing.name')">
                    <x-input.text wire:model.defer="editing.name" id="name" placeholder="Nom" />
                </x-input.group>

                <x-input.group for="description" label="Description du order"
                    :error="$errors->first('editing.description')">
                    <x-input.textarea wire:model.defer="editing.description" id="description"
                        placeholder="Description" />
                </x-input.group>

                <x-input.group label="Image" for="photo" :error="$errors->first('editing.image')">
                    <x-input.file-upload wire:model="editing.image" id="photo">
                        {{-- <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                        @if ($editing['image'])
                            <img src="{{ $upload->temporaryUrl() }}" alt="Profile Photo">
                        @else
                            <img src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">
                        @endif
                    </span> --}}
                    </x-input.file-upload>
                </x-input.group>

                <x-input.group for="is_active" label="Statut" :error="$errors->first('editing.is_active')">
                    <x-input.checkbox wire:model.defer="editing.is_active" id="is_active" />
                    <label class="text-sm ml-2 text-gray-700" for="is_active">Activer</label>
                </x-input.group>


            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Annuler</x-button.primary>

                    <x-button.primary type="submit">Enregistrer</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>
