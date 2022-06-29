@extends('client.global')

@section('content')
    @include('partials.app.page-header', ['title' => $title])

    <div class="py-12">
        <div class="container">
            <!-- This example requires Tailwind CSS v2.0+ -->
            
            <div class="mt-5">

                <div class="md:grid md:grid-cols-5 md:gap-6">
                    <div class="mt-5 md:mt-0 md:col-span-4">
                        
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
                        <div class="py-5">
                            <div class="border-t border-gray-400"></div>
                        </div>
                        <form action="{{route('processPayment')}}" method="POST" id="subscribe-form">

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="form-group" style="display:none ;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="subscription-option">
                                            <label for="plan-silver">
                                            <span class="plan-price">${{$order->total}}</span>
                                            </label>
                                           
                                            <x-input.text  class="block mt-1 w-full"  name="price" value="{{$order->total}}"  required />


                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            @csrf
                            
                            <div class="stripe-errors"></div>
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                            @endforeach
                            </div>
                            @endif
                            
                            
                            
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="sm:overflow-hidden">
                                <div class="px-4">
                                    <div class="items-wrapper">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <x-input.label>{{ __('Card Holder Name') }}</x-input.label>
                                                <x-input.text placeholder="{{ __('e.g. ....') }}" :id="'card-holder-name'"  value="{{$user->first_name.' '.$user->last_name}}"/>
                                
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                
                                            </div>

                                            <div class="col-span-6">
                                                 <x-input.label>{{ __('Credit or debit card') }}</x-input.label>
                                                <div id="card-element" class="">   </div>

                                                <div id="payment-element">
                                                    <!-- Elements will create form elements here -->
                                                </div>
                                                <!-- Used to display form errors. -->
                                                <div id="card-errors" role="alert"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 text-right sm:px-6">
                            
                            <button type="button"  id="card-button" data-secret="{{ $intent->client_secret }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <!-- Heroicon name: solid/check -->
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ __('Pay') }}
                            </button>
                        </div>
                        </form>

                    </div>
                   
                </div>
            </div>



        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.min.js"></script>
    <script src="https://js.stripe.com/v3"></script>
<script>
    window.stripe = Stripe('{{ $stripeKey }}');

    var elements = stripe.elements();
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

// const options = {
//   clientSecret: '{{$stripeKey }}',
//   // Fully customizable with appearance API.
//   appearance: {/*...*/},
// };

// // Set up Stripe.js and Elements to use in checkout form, passing the client secret obtained in step 2
// const elements = stripe.elements(options);

// // Create and mount the Payment Element
// const paymentElement = elements.create('payment');
// paymentElement.mount('#payment-element');

    var card = elements.create('card', {hidePostalCode: false});
    card.mount('#card-element');
    console.log(document.getElementById('card-element'));
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;    
    cardButton.addEventListener('click', async (e) => {
        console.log("attempting");
        const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: card,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );        
        if (error) {
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
        }else {
            paymentMethodHandler(setupIntent.payment_method);
        }
    });

    function paymentMethodHandler(payment_method) {
        var form = document.getElementById('subscribe-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'payment_method');
        hiddenInput.setAttribute('value', payment_method);
        form.appendChild(hiddenInput);
        form.submit();
    }
</script>
@endpush 
