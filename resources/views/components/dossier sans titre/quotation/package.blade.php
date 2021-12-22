<div class="border-b border-gray-200 my-3 pb-2" x-data="{objectType: 'standard'}">
    <div class="flex space-x-2 items-center">
        <div class="w-full" {{ $attributes->class(['w-10/12' => $key > 0]) }}>
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-12">
                    <x-inputs.label>{{ __('Package type') }}</x-inputs.label>
                    <select autocomplete="package-type"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        @change="objectType = $event.target.value" wire:model.defer="items.{{ $key }}.type">
                        <option value="">{{ __('Choose a type of package') }}</option>
                        <option value="standard">{{ __('Package Standard') }}</option>
                        <option value="medium">{{ __('Package Moyen Standard') }}</option>
                        <option value="other">{{ __('Others') }}</option>
                    </select>
                    {{-- @if($errors->get('items' . $key . 'type')) 
                        <div class="mt-1 text-red-500 text-sm">{{ $errors->first('items' . $key . 'type') }}</div>
                    @endif

                    @php
                        print_r('VALUE' . $errors->has('items' . $key . 'name'));
                    @endphp --}}

                    <div class="w-full mt-2 px-4 py-3 leading-normal text-sm text-blue-700 bg-blue-100 rounded-lg"
                        x-show="objectType === 'standard'">
                        <h4 class="font-semibold">{{ __("Standard Package's dimensions") }}</h4>
                        <p>{{ __('Length : 70 cm Width : 80 cm Height : 65 cm.') }}</p>
                    </div>

                    <div class="w-full mt-2 px-4 py-3 leading-normal text-sm text-blue-700 bg-blue-100 rounded-lg"
                        x-show="objectType === 'medium'">
                        <h4 class="font-semibold">{{ __("Medium package's dimensions") }}</h4>
                        <p>{{ __('Length : 35 cm Width : 40cm Height : 65cm.') }}</p>
                    </div>

                    <div class="w-full mt-2 px-4 py-3 leading-normal text-sm text-blue-700 bg-blue-100 rounded-lg"
                        x-show="objectType === 'other'">
                        <h4 class="font-semibold">{{ __('Other') }}</h4>
                        <p>{{ __('Add your custom dimensions') }}</p>
                    </div>

                </div>
                <div class="col-span-6 sm:col-span-8">
                    <x-inputs.label>{{ __('Object Name') }}</x-inputs.label>
                    <x-inputs.text placeholder="{{ __('e.g. Carton') }}"
                        wire:model.defer="items.{{ $key }}.name" />
                     {{-- @if($errors->get('items' . $key . 'name')) 
                        <div class="mt-1 text-red-500 text-sm">{{ $errors->first('items' . $key . 'name') }}</div>
                    @endif --}}
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-inputs.label>{{ __('Quantity') }}</x-inputs.label>
                    <x-inputs.text type="number" wire:model.defer="items.{{ $key }}.quantity" />
                    {{-- @error('items.' . $key . 'quantity') <div class="mt-1 text-red-500 text-sm">{{ $message }}
                        </div>
                    @enderror --}}
                </div>
            </div>

            <div class="grid grid-cols-6 gap-6 mt-2">
                <div class="col-span-12" x-show="objectType === 'other'">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                            <x-inputs.label>{{ __('Weight by unit') }}</x-inputs.label>
                            <x-inputs.text type="number" placeholder="{{ __('Weight (in Kg)') }}"
                                wire:model.defer="items.{{ $key }}.weight" />
                            {{-- @error('items.' . $key . 'weight') <div class="mt-1 text-red-500 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror --}}
                        </div>

                        <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                            <x-inputs.label>{{ __('Length') }}</x-inputs.label>
                            <x-inputs.text type="number" placeholder="{{ __('Length (in Cm)') }}"
                                wire:model.defer="items.{{ $key }}.length" />
                            {{-- @error('items.' . $key . 'length') <div class="mt-1 text-red-500 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror --}}
                        </div>

                        <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                            <x-inputs.label>{{ __('Width') }}</x-inputs.label>
                            <x-inputs.text type="number" placeholder="{{ __('Width (in Cm)') }}"
                                wire:model.defer="items.{{ $key }}.width" />
                            {{-- @error('items.' . $key . 'width') <div class="mt-1 text-red-500 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror --}}
                        </div>

                        <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                            <x-inputs.label>{{ __('Height') }}</x-inputs.label>
                            <x-inputs.text type="number" placeholder="{{ __('Height (in Cm)') }}"
                                wire:model.defer="items.{{ $key }}.height" />
                            {{-- @error('items.' . $key . 'height') <div class="mt-1 text-red-500 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror --}}
                        </div>

                        <div class="col-span-12">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center">
                                <label for="photo" class="block text-sm leading-5 font-medium text-gray-700">
                                    {{ __('Object picture') }}
                                </label>

                                <span class="h-12 w-12 rounded overflow-hidden bg-gray-100">
                                    <svg class="h-full w-full text-gray-300" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </span>

                                <x-inputs.text type="file" wire:model="items.{{ $key }}.upload" />

                                {{-- <x-inputs.file-upload wire:model="items.{{ $key }}.upload">
                                    
                                </x-inputs.file-upload> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-6 gap-6 mt-2">
                <div class="col-span-12">
                    <x-inputs.label class="inline-flex items-center">
                        <x-inputs.checkbox
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            wire:model.defer="items.{{ $key }}.has_insurance" value="yes" />
                        <span
                            class="ml-2 text-sm text-gray-600">{{ __('Subscribe insurance for this package') }}</span>
                    </x-inputs.label>

                </div>
            </div>
        </div>

        @if ($key > 0)
            <div class="w-2/12 text-right">
                <button wire:click.prevent="removeItem({{ $key }})" type="button"
                    class="py-2 px-3 border border-red-300 rounded-md text-sm leading-4 font-medium text-red-700 hover:text-red-500 focus:outline-none focus:border-red-300 focus:shadow-outline-blue active:bg-red-50 active:text-red-800 transition duration-150 ease-in-out">{{ __('Remove') }}</button>
            </div>
        @endif
    </div>
</div>
