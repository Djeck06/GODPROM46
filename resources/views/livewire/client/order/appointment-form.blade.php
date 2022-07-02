<div>
    @if ($order->status == 'paid')
        @if ($order->info->appointment_date)
            <span class="text-sm text-gray-500"></span>
            <span class="hidden sm:block">
                <button type="button" wire:click="$toggle('showModal')" 
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <!-- Heroicon name: solid/pencil -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ __('Appointment Date: ') . $order->info->appointment_date->format('Y-m-d H:i') }}
                </button>
            </span>
        @else
            <span class="hidden sm:block">
                <button type="button" wire:click="$toggle('showModal')" 
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <!-- Heroicon name: solid/pencil -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ __('Set Appointment Date') }}
                </button>
            </span>
        @endif


    @endif

    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model="showModal">
            <x-slot name="title">{{ __('Set Appointment Date') }}</x-slot>

            <x-slot name="content">
           
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
                            
                            <x-input.time :options="$dateOptions" wire:model.defer="appointment_day" placeholder="Date d'enlèvements" />
                            {{--
                            <x-input.text 
                            x-init="flatpickr($refs.datetimewidget, {wrap: true, enableTime: false, dateFormat: 'Y-m-d H:i'});"
                            x-ref="datetimewidget"
                            wire:model.defer="settings.appointmentStart" placeholder="Date d'enlèvements" /> 
                            --}}

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
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showModal', false)">{{ __('Cancel') }}</x-button.secondary>

                <x-button.primary type="submit">{{ __('Save') }}</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>
