<div>
    <form wire:submit.prevent="save">
        @csrf

        <div class="px-4 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-5">Heures d'enlèvement</h3>
            @php 
                $timeOptions = ['enableTime' => true, 'noCalendar' => true, 'dateFormat' => 'H:i', 'time_24hr' => true];
                $dateOptions = ['enableTime' => false, 'dateFormat' => 'Y-m-d', 'minDate' => 'today'];
            @endphp
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <x-input.label>Heure de début des enlèvements</x-input.label>
                    <x-input.time wire:model.defer="settings.appointment_start" :options="$timeOptions" placeholder="Heure de début des enlèvements" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-input.label>Heure de fin des enlèvements</x-input.label>
                    <x-input.time wire:model.defer="settings.appointment_end" :options="$timeOptions" placeholder="Heure de fin des enlèvements" />
                </div>
            </div>

            <div class="hidden sm:block" aria-hidden="true">
                <div class="py-5">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>

            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-5">Jours d'enlèvement</h3>

            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-2">
                    <x-input.label>Date</x-input.label>
                    
                    <x-input.time :options="$dateOptions" wire:model.defer="appointment_day" placeholder="Heure de début des enlèvements" />

                    {{-- <x-input.text 
                    x-init="flatpickr($refs.datetimewidget, {wrap: true, enableTime: false, dateFormat: 'Y-m-d H:i'});"
                    x-ref="datetimewidget"
                    wire:model.defer="settings.appointmentStart" placeholder="Heure de début des enlèvements" /> --}}

                    <button type="button" class="py-2 px-4 mt-3 border border-gray-500 shadow-sm text-sm font-medium rounded-md text-gray-600 bg-white hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Ajouter</button>
                </div>

                <div class="col-span-6 sm:col-span-4">
                    
                    <x-input.label>Jours d'enlèvements</x-input.label>

                    
                    
                </div>
            </div>

            <div class="hidden sm:block" aria-hidden="true">
                <div class="py-5">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>
        </div>




        <div class="px-4 py-3 text-right sm:px-6">
            <button type="cancel"
                class="inline-flex justify-center py-2 px-4 border border-gray-500 shadow-sm text-sm font-medium rounded-md text-gray-600 bg-white hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                {{ __('Cancel') }}
            </button>
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>


