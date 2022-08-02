<div>
    @if ($editing->lastStatus && in_array( strtolower($editing->lastStatus->label) , ['readytopickup','packageissued']))
        
            <span class="hidden sm:block">

              

                <button type="button" wire:click="next('set_appointment_date', {{$editing->id }})" 
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    
                    <!-- Heroicon name: solid/pencil -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                            clip-rule="evenodd" />
                    </svg>
                    @if (!is_null( $order_appointment))
                            {{__('Appointment Date:').' ' . $order_appointment->appointment_date->format('Y-m-d') .' ' . $order_appointment->appointment_start .' to ' . $order_appointment->appointment_end }}
                    @else
                            {{ __('Set Appointment Date') }}
                    @endif
                </button>
            </span>
   
    @endif

    @if ($editing->lastStatus && in_array( strtolower($editing->lastStatus->label) , ['paid']))
       
            <span class="hidden sm:block">
                <h3 class="text-lg font-bold leading-6 text-gray-900">
                    <span class="text-sm text-blue-300">
                    {{__('Your packages are being delivered') }} ...
                    </span>

                </h3>
                
            </span>
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
                            @error('settings.appointment_start')
                                <div class="mt-1 text-red-500 text-sm">
                                    {{ $message }}</div>
                            @enderror
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
                            
                            <x-input.time :options="$dateOptions" wire:model.defer="settings.appointment_day" placeholder="Date d'enlèvements" />
                            @error('settings.appointment_day')
                                <div class="mt-1 text-red-500 text-sm">
                                    {{ $message }}</div>
                            @enderror
                            {{--
                            <x-input.text 
                            x-init="flatpickr($refs.datetimewidget, {wrap: true, enableTime: false, dateFormat: 'Y-m-d H:i'});"
                            x-ref="datetimewidget"
                            wire:model.defer="settings.appointmentStart" placeholder="Date d'enlèvements" /> 
                            --}}

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
