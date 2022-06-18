{{-- Step1: Countries --}}
{{-- Step2: PACKAGES --}}
{{-- Step3: Notes --}}
{{-- Step4: Recap + paiement --}}

<div>
    <form wire:submit.prevent="save">
        @csrf
        
        @if (!$showSummary)
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Addresses') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Provide informations about pickup and delivery addresses') }}
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="sm:overflow-hidden">
                        <div class="px-4">
                            <div class="items-wrapper">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-input.label>{{ __('Pick Up Country') }}</x-input.label>
                                        <select id="country" wire:model.defer="order.pickup_country"
                                            autocomplete="country-name"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option value="">{{ __('Select a country') }}</option>
                                            @foreach ($this->pickupCountries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('order.pickup_country')
                                            <div class="mt-1 text-red-500 text-sm">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-input.label>{{ __('Pick Up City') }}</x-input.label>
                                        <x-input.text wire:model.defer="order.pickup_city"
                                            placeholder="{{ __('e.g. Lomé') }}" />
                                        @error('order.pickup_city')
                                            <div class="mt-1 text-red-500 text-sm">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-span-6">
                                        <x-input.label>{{ __('Pick Up Address') }}</x-input.label>
                                        <x-input.text wire:model.defer="order.pickup_address"
                                            placeholder="{{ __('e.g. Boluevard du 30 Aout') }}" />
                                        @error('order.pickup_address')
                                            <div class="mt-1 text-red-500 text-sm">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-6 gap-6 mt-10">
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-input.label>{{ __('Delivery Country') }}</x-input.label>
                                        <select id="deliveryCountry" wire:model.defer="order.delivery_country"
                                            autocomplete="country-name"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option value="">{{ __('Select a country') }}</option>
                                            @foreach ($this->deliveryCountries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('order.delivery_country')
                                            <div class="mt-1 text-red-500 text-sm">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-input.label>{{ __('Delivery City') }}</x-input.label>
                                        <x-input.text wire:model.defer="order.delivery_city"
                                            placeholder="{{ __('e.g. Paris') }}" />
                                        @error('order.pickup_city')
                                            <div class="mt-1 text-red-500 text-sm">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-input.label>{{ __('Delivery Address') }}</x-input.label>
                                        <x-input.text wire:model.defer="order.delivery_address"
                                            placeholder="{{ __('e.g. Boluevard du 30 Aout') }}" />
                                        @error('order.delivery_address')
                                            <div class="mt-1 text-red-500 text-sm">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-input.label>{{ __('Delivery Phone') }}</x-input.label>
                                        <x-input.text wire:model.defer="order.delivery_phone"
                                            placeholder="{{ __('+33 xx xx xx xx xx xx') }}" />
                                        @error('order.delivery_phone')
                                            <div class="mt-1 text-red-500 text-sm">
                                                {{ $message }}</div>
                                        @enderror
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
                        <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Package Informations') }}</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Provide informations about your packages') }}
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="sm:overflow-hidden">
                        <div class="px-4">
                            <div class="items-wrapper">
                                @foreach ($items as $key => $value)
                                    <x-quotation.package :key="$key" :packages="$this->packages" />
                                    @error('items.' . $key . '.name')
                                        <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                @endforeach

                            </div>

                            <div class="flex justify-end sm:pt-5">
                                <button type="button" wire:click.prevent="addItem()"
                                    class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                                    {{ __('Add object') }}
                                </button>
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
                        <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Additional Informations') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Provide informations about your quote request') }}
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="sm:overflow-hidden">
                        <div class="px-4">
                            <div class="grid grid-cols-6 gap-6 mb-4">
                                <div class="col-span-6">
                                    <x-input.label>{{ __('Additional Informations') }}</x-input.label>
                                    <x-input.textarea wire:model.defer="order.notes" rows="4"
                                        placeholder="{{ __('Notes...') }}" />
                                    <p class="mt-2 text-sm text-gray-500">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-4 py-3 text-right sm:px-6">
                <button type="cancel"
                    class="inline-flex justify-center py-2 px-4 border border-gray-500 shadow-sm text-sm font-medium rounded-md text-gray-600 bg-white hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    {{ __('Cancel') }}
                </button>
                <button type="button"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    wire:click.prevent="doSummary">
                    {{ __('Next') }}
                </button>
            </div>
        @else
            <div class="p-12 bg-white shadow rounded">
                <h2 class="font-bold leading-10 mb-5 text-3xl">{{ __('Your order') }}</h2>

                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                            @foreach ($prices as $item)
                                <li class="flex py-6">
                                    <div
                                        class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                        <img src="{{ $item['image'] }}" alt="Package image"
                                            class="h-full w-full object-cover object-center">
                                    </div>

                                    <div class="ml-4 flex flex-1 flex-col">
                                        <div>
                                            <div class="flex justify-between text-base font-medium text-gray-900">
                                                <h3>
                                                    <a href="#"> {{ $item['package_name'] }} </a>
                                                </h3>
                                                <p class="ml-4">{{ $item['total'] }}€</p>
                                            </div>
                                            {{-- <p class="mt-1 text-sm text-gray-500">{{ $item['package_name'] }}</p> --}}
                                        </div>
                                        <div class="flex flex-1 items-end justify-between text-sm">
                                            <p class="text-gray-500">
                                                {{ $item['quantity'] }} x {{ $item['price'] }}€
                                                @if ($item['insurance_price'] > 0)
                                                    <br><span
                                                        class="text-gray-3000">{{ __('Insurance Fees: ') }}{{ $item['insurance_price'] }}€</span>
                                                @endif
                                            </p>

                                            {{-- <div class="flex">
                                                <button type="button"
                                                    class="font-medium text-indigo-600 hover:text-indigo-500">{{ __('Remove') }}</button>
                                            </div> --}}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <div class="py-5">
                            <div class="border-t border-gray-400"></div>
                        </div>

                        <div class="mt-2 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-2 lg:gap-x-6">
                            <div class="border-2 border-blue-400 p-4 rounded">
                                <h4 class="font-semibold">{{ __('Pickup Address') }}</h4>
                                <address class="mt-4">
                                    <p>{{ $order->pickup_address }}</p>
                                    <p>{{ $order->pickup_city }}, {{ $prices[0]['pickup_country_name'] }}</p>
                                </address>
                            </div>
                            <div class="border-2 border-blue-400 p-4 rounded">
                                <h4 class="font-semibold">{{ __('Delivery Address') }}</h4>
                                <address class="mt-4">
                                    <p>{{ $order->delivery_address }}</p>
                                    <p>{{ __('Tel: ') }} {{ $order->delivery_phone }}</p>
                                    <p>{{ $order->delivery_city }}, {{ $prices[0]['delivery_country_name'] }}</p>
                                </address>
                            </div>
                        </div>

                        @if ($order->notes)
                            <div class="py-5">
                                <div class="border-t border-gray-400"></div>
                            </div>

                            <div class="border-2 border-blue-400 p-4 rounded">
                                <h4 class="font-semibold">{{ __('Additional notes') }}</h4>
                                <p>{{ $order->notes }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="md:col-span-1">
                        <div class="p-4 bg-gray-100 rounded">
                            <h3 class="text-lg font-bold leading-6 text-gray-900">
                                {{ __('Order summary') }}
                            </h3>
                            <ul>
                                <li class="py-3 w-full flex items-center justify-between text-sm">
                                    <span>{{ __('Subtotal') }}</span>
                                    <span class="font-bold text-gray-900">{{ $summary['subtotal'] }}€</span>
                                </li>
                                <li class="py-3 w-full flex items-center justify-between text-sm">
                                    <span>{{ __('Insurance Fees') }}</span>
                                    <span class="font-bold text-gray-900">{{ $summary['insurance'] }}€</span>
                                </li>
                                <li
                                    class="py-3 w-full flex items-center justify-between text-md border-t border-gray-20">
                                    <span class="font-semibold text-gray-800">{{ __('Total') }}</span>
                                    <span class="font-bold text-gray-900">{{ $summary['total'] }}€</span>
                                </li>
                            </ul>
                            <div class="mt-6">
                                <a href="#" wire:click="save" wire:loading.attr="disabled"
                                    class="flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-blue-700">
                                    <span wire:loading.remove>{{ __('Checkout') }}</span>
                                    <span wire:loading>{{ __('Proceed to checkout...') }}</span>
                                </a>
                            </div>
                            <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                <p>
                                    or <button type="button" wire:click="$toggle('showSummary')"
                                        class="font-medium text-blue-600 hover:text-blue-500">{{ __('Continue Shopping') }}
                                        →</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        @endif
    </form>
</div>

{{-- @push('js')
    <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>
    <script>
        paypal.Buttons({
            // Call your server to set up the transaction
            createOrder: function(data, actions) {
                return fetch('/api/paypal/order/create', {
                    method: 'POST',
                    body: JSON.stringify({
                        'course_id': "{{ $course->id }}",
                        'user_id': "{{ auth()->user()->id }}",
                        'amount': $("#paypalAmount").val(),
                    })
                }).then(function(res) {
                    //res.json();
                    return res.json();
                }).then(function(orderData) {
                    //console.log(orderData);
                    return orderData.id;
                });
            },

            // Call your server to finalize the transaction
            onApprove: function(data, actions) {
                return fetch('/api/paypal/order/capture', {
                    method: 'POST',
                    body: JSON.stringify({
                        orderId: data.orderID,
                        payment_gateway_id: $("#payapalId").val(),
                        user_id: "{{ auth()->user()->id }}",
                    })
                }).then(function(res) {
                    // console.log(res.json());
                    return res.json();
                }).then(function(orderData) {

                    // Successful capture! For demo purposes:
                    //  console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    iziToast.success({
                        title: 'Success',
                        message: 'Payment completed',
                        position: 'topRight'
                    });
                });
            }

        }).render('#paypal-button-container');
    </script>
@endpush --}}
