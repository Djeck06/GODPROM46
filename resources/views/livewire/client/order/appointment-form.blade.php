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
                <x-input.group for="appointment_date" label="{{ __('Appointment Date') }}" :error="$errors->first('appointment_date')">
                    <x-input.date wire:model="appointment_date" id="appointment_date" placeholder="MM/DD/YYYY" />
                    {{-- <x-input.text placeholder="{{ __('Appointment Date') }}" /> --}}
                </x-input.group>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showModal', false)">{{ __('Cancel') }}</x-button.secondary>

                <x-button.primary type="submit">{{ __('Save') }}</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>
