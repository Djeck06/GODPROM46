<div>
    <form method="POST" action="{{ route('quotation.store') }}">
        @csrf
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Package Informations') }}</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Provide informations about your packages') }}
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="sm:overflow-hidden">
                    <div class="px-4">
                        <div class="grid grid-cols-6 gap-6" x-data="{others: false}">
                            <div class="col-span-12">
                                <x-inputs.label>{{ __('Package type') }}</x-inputs.label>
                                <select name="package-type" autocomplete="package-type"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    x-model="pType">
                                    <option :value="standard">{{ __('Package Standard') }}</option>
                                    <option :value="medium">{{ __('Package Moyen Standard') }}</option>
                                    <option :value="other">{{ __('Others') }}</option>
                                </select>
                            </div>
                            <div class="col-span-12" id="other-object" x-show="{pType == 'other'}">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-inputs.label>{{ __('Object Name') }}</x-inputs.label>
                                        <x-inputs.text name="name" placeholder="{{ __('e.g. Carton') }}" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <x-inputs.label>{{ __('Quantity') }}</x-inputs.label>
                                        <x-inputs.text type="number" name="quantity" value="1" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <x-inputs.label>{{ __('Weight by unit') }}</x-inputs.label>
                                        <x-inputs.text type="number" name="weight"
                                            placeholder="{{ __('Weight (in Kg)') }}" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-2"></div>

                                    <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                        <x-inputs.label>{{ __('Length') }}</x-inputs.label>
                                        <x-inputs.text type="number" name="weight"
                                            placeholder="{{ __('Length (in Cm)') }}" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                        <x-inputs.label>{{ __('Width') }}</x-inputs.label>
                                        <x-inputs.text type="number" name="weight"
                                            placeholder="{{ __('Width (in Cm)') }}" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                        <x-inputs.label>{{ __('Height') }}</x-inputs.label>
                                        <x-inputs.text type="number" name="weight"
                                            placeholder="{{ __('Height (in Cm)') }}" />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden sm:block" aria-hidden="true">
            <div class="py-5">
                <div class="border-t border-gray-200"></div>
            </div>
        </div>

        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Addresses') }}</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Provide informations about pickup and delivery addresses') }}
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="sm:overflow-hidden">
                    <div class="px-4">
                        <div class="grid grid-cols-6 gap-6">
                            <fieldset class="col-span-12 mb-2" x-data="{headOffice: false}">
                                <legend class="text-base font-medium text-gray-900 mb-2.5">
                                    {{ __('Pick Up Address') }}
                                </legend>

                                <div class="col-span-6">
                                    <div class="flex items-start mb-2">
                                        <div class="flex items-center h-5">
                                            <input id="headOffice" name="headOffice" type="checkbox" value="yes"
                                                @click="headOffice = !headOffice"
                                                class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="headOffice"
                                                class="font-medium text-gray-700">{{ __('Head Office') }}</label>
                                            <p class="text-gray-500">
                                                {{ __('Bring your package to the head office') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-6 gap-6" x-show="headOffice">
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-inputs.label>{{ __('Pick Up Country') }}</x-inputs.label>
                                        <select id="country" name="country" autocomplete="country-name"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option>Togo</option>
                                            <option>Ghana</option>
                                            <option>France</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-inputs.label>{{ __('Pick Up City') }}</x-inputs.label>
                                        <x-inputs.text name="city" placeholder="{{ __('e.g. Lomé') }}" />
                                    </div>

                                    <div class="col-span-6">
                                        <x-inputs.label>{{ __('Pick Up Address') }}</x-inputs.label>
                                        <x-inputs.text name="address"
                                            placeholder="{{ __('e.g. Boluevard du 30 Aout') }}" />
                                    </div>

                                </div>

                            </fieldset>

                            <fieldset class="col-span-12">
                                <legend class="text-base font-medium text-gray-900 mb-2.5">
                                    {{ __('Delivery Address') }}
                                </legend>

                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-inputs.label>{{ __('Delivery Country') }}</x-inputs.label>
                                        <select id="country" name="country" autocomplete="country-name"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option>Togo</option>
                                            <option>Ghana</option>
                                            <option>France</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-inputs.label>{{ __('Delivery City') }}</x-inputs.label>
                                        <x-inputs.text name="city" placeholder="{{ __('e.g. Lomé') }}" />
                                    </div>

                                    <div class="col-span-6">
                                        <x-inputs.label>{{ __('Delivery Address') }}</x-inputs.label>
                                        <x-inputs.text name="address"
                                            placeholder="{{ __('e.g. Boluevard du 30 Aout') }}" />
                                    </div>

                                </div>

                            </fieldset>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden sm:block" aria-hidden="true">
            <div class="py-5">
                <div class="border-t border-gray-200"></div>
            </div>
        </div>

        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Additional Informations') }}</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Provide informations about your quote request') }}
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="sm:overflow-hidden">
                    <div class="px-4">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6">
                                <x-inputs.label>{{ __('Additional Informations') }}</x-inputs.label>
                                <x-inputs.textarea name="name" placeholder="{{ __('Notes...') }}" />
                                <p class="mt-2 text-sm text-gray-500">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden sm:block" aria-hidden="true">
            <div class="py-5">
                <div class="border-t border-gray-200"></div>
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
