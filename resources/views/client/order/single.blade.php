@extends('client.global')

@section('content')
    @include('partials.app.page-header', ['title' => $title])

    <div class="py-12">
        <div class="container">
            <!-- This example requires Tailwind CSS v2.0+ -->
            @include('client.order.inc.header', ['order' => $order])

            <div class="mt-5">

                <div class="md:grid md:grid-cols-5 md:gap-6">
                    <div class="mt-5 md:mt-0 md:col-span-4">
                        @include('client.order.inc.menu', ['order' => $order])
                        <div class="md:col-span-1">
                            <div class="p-4 bg-gray-100 rounded">
                                <h3 class="text-lg font-bold leading-6 text-gray-900">
                                    {{ __('Order summary') }}
                                </h3>
                                <ul>
                                    <li class="py-3 w-full flex items-center justify-between text-sm">
                                        <span>{{ __('Subtotal') }}</span>
                                        <span class="font-bold text-gray-900">{{ $order->price   }}€</span>
                                    </li>
                                    <li class="py-3 w-full flex items-center justify-between text-sm">
                                        <span>{{ __('Insurance Fees') }}</span>
                                        <span class="font-bold text-gray-900">{{ $order->insurance }}€</span>
                                    </li>
                                    <li
                                        class="py-3 w-full flex items-center justify-between text-md border-t border-gray-20">
                                        <span class="font-semibold text-gray-800">{{ __('Total') }}</span>
                                        <span class="font-bold text-gray-900">{{ $order->total }}€</span>
                                    </li>
                                </ul>
                              
                            </div>
                        </div>
                        <div class="mt-5 md:col-span-2">
                            <div class="mt-2 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-2 lg:gap-x-6">
                                <div class="border-2 border-blue-400 p-4 rounded">
                                    <h4 class="font-semibold">{{ __('Pickup Address') }}</h4>
                                    <address class="mt-4">
                                        <p>{{ $order->pickup_address }}</p>
                                        <p>{{ $order->pickup_city }}, @if(!is_null( $order->pickupCountry)) {{ $order->pickupCountry->name }} @endif</p>
                                    </address>
                                </div>
                                <div class="border-2 border-blue-400 p-4 rounded">
                                    <h4 class="font-semibold">{{ __('Delivery Address') }}</h4>
                                    <address class="mt-4">
                                        <p>{{ $order->delivery_address }}</p>
                                        <p>{{ __('Tel: ') }} {{ $order->delivery_phone }}</p>
                                        <p>{{ $order->delivery_city }}, @if(!is_null( $order->deliveryCountry)) {{ $order->deliveryCountry->name }} @endif</p>
                                    </address>
                                </div>
                            </div>

                            <div class="py-5">
                                <div class="border-t border-gray-400"></div>
                            </div>


                            <ul role="list" class="-my-6 divide-y divide-gray-200">
                                @foreach ($order->items as $item)
                                    <li class="flex py-6">
                                        <div
                                            class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                            <img src="{{ $item->package->image ? asset($item->package->image) : asset('images/package/default.jpeg') }}"
                                                alt="Package image" class="h-full w-full object-cover object-center">
                                        </div>

                                        <div class="ml-4 flex flex-1 flex-col">
                                            <div>
                                                <div class="flex justify-between text-base font-medium text-gray-900">
                                                    <h3>
                                                        <a href="#"> {{ $item->package->name }} </a>
                                                    </h3>
                                                    <p class="ml-4">{{ $item->quantity *  $item->price }}€</p>
                                                </div>
                                                {{--<p class="mt-1 text-sm text-gray-500">{{ $item->package->name }}</p> --}}
                                            </div>
                                            <div class="flex flex-1 items-end justify-between text-sm">
                                                <p class="text-gray-500">
                                                    {{ $item->quantity }} x {{ $item->price }}€
                                                    @if ($item->has_insurance)
                                                        <br><span
                                                            class="text-gray-3000">{{ __('Insurance Fees: ') . '5€' }}</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

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
                    </div>
                    

                    <div class="md:col-span-1">
                        
                        @include('client.order.inc.sidebar', ['order' => $order])
                        
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
