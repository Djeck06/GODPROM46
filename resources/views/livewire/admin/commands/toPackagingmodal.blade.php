<form wire:submit.prevent="save">
<x-modal.dialog wire:model.defer="showToPackagingModal" cssWidth="sm:w-6/12">
    <x-slot name="title">{{__("Send to packaging")}}</x-slot>

    <x-slot name="content">
        <div class="font-extrabold tracking-tight leading-none sm:border-t sm:py-5">
            {{__('Select a transporter')}}
        </div>
        <div class="sm:grid sm:grid-cols-1 sm:gap-x-12 ">
            <div class="p-2 sm:p-4">
                <div class="flex justify-between">
                    <div class="w-1/4 flex space-x-4 mt-1 sm:mt-1 mb-5 sm:mb-5">
                        <x-input.text wire:model="filters.search" placeholder="Rechercher un transporteur..." />
                    </div>
                </div>
                <div class="flex-col space-y-4">
                    <x-table>
                        <x-slot name="head">
                            <x-table.heading>
                            
                            </x-table.heading>
                            <x-table.heading>Nom</x-table.heading>
                            <x-table.heading>Prénom</x-table.heading>
                            <x-table.heading>Téléphone</x-table.heading>
                            <x-table.heading>Immatriculation véhicule</x-table.heading>
                            <x-table.heading>Statut</x-table.heading>
                        </x-slot>

                        <x-slot name="body">
                            @forelse ($transporters as $transporter)
                                <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $transporter->id }}">
                                    <x-table.cell class="pr-0">
                                        <x-input.radio wire:model="editing.transporter_id" value="{{ $transporter->id }}" />
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
                                            {{ $transporter->registration_number }}
                                        </span>
                                    </x-table.cell>
                                    <x-table.cell>
                                    
                                        <span class="bg-red-100 font-semibold inline-flex px-2 py-1 rounded-2xl text-red-800 text-xs">{{ $transporter->status_name }}</span>
                    
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
        </div>
           
        <div class="mt-1 sm:mt-0 sm:col-span-2">
            @if ($errors->first('editing.transporter_id'))
                <div class="mt-1 text-red-500 text-sm">{{ $errors->first('editing.transporter_id') }}</div>
            @endif
        </div>
        
    </x-slot>

    <x-slot name="footer">
        <x-button.secondary wire:click="$set('showToPackagingModal', false)">Annuler</x-button.primary>

        <x-button.primary type="submit">Enregistrer</x-button.primary>
    </x-slot>

   
</x-modal.dialog>
</form>