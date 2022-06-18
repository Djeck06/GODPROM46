<div class="border-b border-gray-200 my-3 pb-2" x-data="{objectType: null}">
    <div class="flex space-x-2">
        <div class="w-full" {{ $attributes->class(['w-10/12' => $key > 0]) }}>
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <x-input.label>{{ __('Package type') }}</x-input.label>
                    <select autocomplete="package-type"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        @change="objectType = $event.target.value" wire:model.defer="items.{{ $key }}.type">
                        <option value="">{{ __('Choose a type of package') }}</option>
                        @foreach ($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->name }}</option>
                        @endforeach
                    </select>

                    {{-- <span x-text="objectType"></span>

                    @foreach ($packages as $package)
                        <div class="w-full mt-2 px-4 py-3 leading-normal text-sm text-blue-700 bg-blue-100 rounded-lg"
                            x-show="objectType === {{ $package->id }}">
                            <h4 class="font-semibold">{{ __("Description") }} : {{ $package->name }}</h4>
                            <p>{{ $package->description }}</p>
                        </div>
                    @endforeach --}}

                </div>
                {{-- 
                <div class="col-span-6 sm:col-span-8">
                    <x-input.label>{{ __('Object Name') }}</x-input.label>
                    <x-input.text placeholder="{{ __('e.g. Carton') }}"
                        wire:model.defer="items.{{ $key }}.name" />
                     
                </div>
                --}}
                <div class="col-span-6 sm:col-span-3">
                    <x-input.label>{{ __('Quantity') }}</x-input.label>
                    <x-input.text type="number" wire:model.defer="items.{{ $key }}.quantity" />
                    
                </div>
            </div>

            <div class="grid grid-cols-6 gap-6 mt-2">
                <div class="col-span-12">
                    <x-input.label class="inline-flex items-center">
                        <x-input.checkbox
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            wire:model.defer="items.{{ $key }}.has_insurance" value="yes" />
                        <span
                            class="ml-2 text-sm text-gray-600">{{ __('Subscribe insurance for this package') }}</span>
                    </x-input.label>

                </div>
            </div>
        </div>

        @if ($key > 0)
            <div class="w-2/12 text-right">
                <button wire:click.prevent="removeItem({{ $key }})" type="button"
                    class="py-2 px-3 mt-6 border border-red-300 rounded-md text-sm leading-4 font-medium text-red-700 hover:text-red-500 focus:outline-none focus:border-red-300 focus:shadow-outline-blue active:bg-red-50 active:text-red-800 transition duration-150 ease-in-out">{{ __('Remove') }}</button>
            </div>
        @endif
    </div>
</div>
