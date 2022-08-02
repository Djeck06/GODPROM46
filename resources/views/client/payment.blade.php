@extends('client.global')

@section('content')
    @include('partials.app.page-header', ['title' => $title])

    <div class="py-12">
        <div class="container">
            <!-- This example requires Tailwind CSS v2.0+ -->
            
            <div class="mt-5">

                <div class="md:grid md:grid-cols-5 md:gap-6">
                    <div class="mt-5 md:mt-0 md:col-span-4">
                        
                        <div class="bg-blue-50 rounded-lg shadow-xl p-4 sm:p-6 mt-4">
                            @if($payment->lastStatus->label === 'succeeded' || session()->has('success'))
                            <div >
                                <h2 class="text-xl mb-4 text-gray-600">
                                {{ __('Payment Successful')}}
                                </h2>

                                <p class="mb-6">
                                {{ __('This payment was successfully confirmed.')}}'
                                </p>
                            </div>
                            @elseif($payment->lastStatus->label === 'processing')
                            <div>
                                <h2 class="text-xl mb-4 text-gray-600">
                                {{ __('Payment Processing')}}
                                </h2>

                                <p class="mb-6">
                                {{ __('This payment is currently processing. Refresh this page from time to time to see its status.' )}}
                                </p>
                            </div>
                            @elseif($payment->lastStatus->label === 'canceled')
                            <div >
                                <h2 class="text-xl mb-4 text-gray-600">
                                {{ __('Payment Canceled')}}
                                </h2>

                                <p class="mb-6">
                                {{ __('This payment was canceled.' )}}
                                </p>
                            </div>
                            @elseif($errors->any())
                            
                            <div >
                                <h2 class="text-xl mb-4 text-gray-600">
                                {{ __($errors->first())}}
                                </h2>

                                <p class="mb-6">
                                </p>
                            </div>
                            
                            @else
                            <div>
                                <form role="form" action="{{ route('processPayment') }}" method="post"  id="payment-form">
                                    @csrf
                                    <!-- Payment Method Form -->
                                    <div  class="mb-3">
                                        <!-- Instructions -->
                                        <h2 class="text-xl mb-4 text-gray-600">
                                        {{ __('Confirm Your Payment')}}
                                        </h2>

                                        <p class="mb-6">
                                        {{ __('A valid payment method is needed to process your payment. Please confirm your payment by filling out your payment details below.' )}}
                                        </p>
                                        <div class="md:col-span-1">
                                            <div class="p-4 bg-gray-50 border border-gray-100 rounded">
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

                                        <!-- Payment Method -->
                                        

                                        <div v-if="paymentMethods.length > 1">
                                            <p class="text-sm mb-3">
                                            {{ __("Please select the payment method which you'd like to use." ) }}
                                            </p>

                                            <select
                                                id="paymentMethod"
                                                required
                                                class="inline-block  border border-gray-300 rounded-lg w-full px-4 py-3 mb-3 focus:outline-none"
                                                v-model="paymentMethod"
                                                @change="configureStripeElements"
                                            >
                                                <option v-for="option in paymentMethods" v-bind:value="option">
                                                    @{{ option.title }}
                                                </option>
                                            </select>
                                        </div>
                                        <div v-else>
                                            <p class="text-sm mb-3">
                                            {{ __('Your payment will be processed by' )}} @{{ paymentMethodTitle }}.
                                            </p>
                                        </div>

                                        <!-- Name -->
                                        <label for="name" class="inline-block text-sm text-gray-700 font-semibold mb-2">
                                        {{ __('Full name')}}
                                        </label>

                                        <input
                                            id="name"
                                            type="text" placeholder="" value="{{$client->first_name.' '.$client->last_name}}"
                                            required
                                            class="inline-block bg-white border border-gray-300 rounded-lg w-full px-4 py-3 mb-3 focus:outline-none"
                                            v-model="name"
                                        />

                                   
                                        <div v-if="paymentElement">
                                            <!-- Stripe Payment Element -->
                                            <label for="payment-element" class="inline-block text-sm text-gray-700 font-semibold mb-2">
                                            {{ __('Payment details')}}
                                            </label>

                                            <div id="payment-element" ref="paymentElement" class="bg-white border border-gray-300 rounded-lg p-4 mb-6"></div>
                                        </div>

                                        <div v-if="(paymentMethod || {}).remember">
                                            <!-- Remember Payment Method -->
                                            <label for="remember" class="inline-block text-sm text-gray-700 mb-2">
                                                <input
                                                    id="remember"
                                                    type="checkbox"
                                                    required
                                                    class="inline-block mr-1 focus:outline-none"
                                                    v-model="remember"
                                                />

                                                {{ __('Remember payment method for future usage')}}
                                            </label>

                                            <p v-if="['bancontact', 'ideal', 'sepa_debit'].includes(paymentMethod.type)" class="text-xs text-gray-400 mb-6">
                                            {{ __('By providing your payment information and confirming this payment, you authorise (A) and Stripe, our payment service provider, to send instructions to your bank to debit your account and (B) your bank to debit your account in accordance with those instructions. As part of your rights, you are entitled to a refund from your bank under the terms and conditions of your agreement with your bank. A refund must be claimed within 8 weeks starting from the date on which your account was debited. Your rights are explained in a statement that you can obtain from your bank. You agree to receive notifications for future debits up to 2 days before they occur.' )}}                                            </p>
                                        </div>
                                    </div>

                                    <!-- Confirm Payment Method Button -->
                                    <button
                                        class="inline-block w-full px-4 py-3 mb-4 text-white rounded-lg hover:bg-blue-500"
                                        :class="{ 'bg-blue-400': isPaymentProcessing, 'bg-blue-600': ! isPaymentProcessing }"
                                        @click="confirmPaymentMethod"
                                        :disabled="isPaymentProcessing"
                                    >
                                        <span v-if="isPaymentProcessing">
                                        {{ __('Processing')}}...
                                        </span>
                                        <span v-else>
                                        {{ __('Confirm your')}} {{ $order->total }}€ 
                                        </span>
                                    </button>
                                </form >
                            </div>
                            @endif


                            <button @click="goBack" ref="goBackButton" data-redirect="{{ $redirect }}"
                            class="inline-block w-full px-4 py-3 bg-white border border-gray-300 hover:bg-gray-200 text-center text-gray-600 rounded-lg">
                            {{ __('Go back')}}
                            </button>
                        </div>

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

        new Vue({
            el: '#app',

            data() {
                return {
                    paymentIntent: {},
                    payment: @json($payment),
                    paymentMethod: null,
                    // name: '{{ $customer->name }}',
                    name: '{{ $client->first_name." ".$client->last_name }}',
                    email: '{{ $customer->email}}',
                    paymentElement: null,
                    remember: false,
                    isPaymentProcessing: false,
                    errorMessage: '{{ $errorMessage }}'
                }
            },

            mounted: function () {
                this.configurePayment();
                this.configureStripeElements();
            },

            computed: {
                paymentMethodTitle() {
                    return this.paymentMethod ? this.paymentMethod.title : '';
                },

                paymentMethods() {
                    const methods = [
                        { title: 'Card', type: 'card', remember: true, redirects: false, element: 'card' ,  options:{hidePostalCode: true}},
                        { title: 'Alipay', type: 'alipay' },
                        { title: 'BECS Direct Debit', type: 'au_becs_debit', remember: true, redirects: false, element: 'auBankAccount' },
                        { title: 'Bancontact', type: 'bancontact', remember: true },
                        { title: 'EPS', type: 'eps', element: 'epsBank' },
                        { title: 'Giropay', type: 'giropay' },
                        { title: 'iDEAL', type: 'ideal', remember: true, element: 'idealBank' },
                        { title: 'SEPA Debit', type: 'sepa_debit', remember: true, redirects: false, element: 'iban', options: { supportedCountries: ['SEPA'] }}
                    ].map(paymentMethod => {
                        return { remember: false, redirects: true, options: {}, ...paymentMethod }
                    })

                    return methods.filter(method => ['card'].includes(method.type))
                }
            },

            methods: {
                // configurePayment: function (paymentIntent) {
                configurePayment: function () {
                    const paymentMethodTypes = ['card'];

                    // If the previously set payment method isn't available anymore,
                    // update it to either the current one or the first available one...
                    if (this.paymentMethod === null || ! paymentMethodTypes.includes(this.paymentMethod.type)) {
                        const type = this.paymentMethod === null
                            ? ('{{ $paymentMethod }}' ? '{{ $paymentMethod }}' : paymentMethodTypes[0])
                            : (((this.paymentIntent || {}).payment_method || {}).type ?? paymentMethodTypes[0]);

                        this.paymentMethod = this.paymentMethods.filter(
                            paymentMethod => paymentMethod.type === type
                        )[0];
                    }

                   
                },

                configureStripeElements: async function () {
                    // Stripe Elements are only needed when a payment method is required.
                    if (this.payment.status !== 'pending') {
                        return;
                    }

                    // Create the Stripe element based on the currently selected payment method...
                    if (this.paymentMethod.element) {
                        const appearance = {
                            theme: 'stripe'
                        };

                        // Pass the appearance object to the Elements instance
                        
                        const elements =  stripe.elements();
                        this.paymentElement = elements.create('card');
                        this.paymentElement.update({
                            value: {},
                            hidePostalCode: true ,
                        });


                    }  else {
                        this.paymentElement = null;
                    }

                    if (this.paymentElement) {
                        await this.$nextTick(() => {
                            // Clear the payment element first, otherwise Stripe Elements will emit a warning...
                            //document.getElementById("payment-element").innerHTML = "";
                            this.paymentElement.clear();
                            console.log('ty',this.paymentElement)
                            this.paymentElement.mount('#payment-element');

                        })
                    }
                },

                confirmPaymentMethod: async function () {
                    this.isPaymentProcessing = true;
                    this.errorMessage = '';

                    
                    let data = {
                        setup_future_usage: this.paymentMethod.remember && this.remember
                            ? 'off_session'
                            : null,
                        payment_method: {
                            billing_details: { name: this.name, email: this.email }
                        }
                    };
                    let paymentPromise;

                    // Set a return url to redirect the user back to the payment
                    // page after handling the off session payment confirmation.
                   
                    if (this.paymentMethod.type === 'card') {
                
                        stripe.createPaymentMethod({
                            type: 'card',
                            card: this.paymentElement,
                            billing_details: {
                                name: this.name,
                                email: this.email
                            },
                        })
                        .then((result) => {
                            console.log(result)
                            if (result.error) {
                                console.log('err',result.error)

                                var errorElement = document.getElementById('card-errors');
                                errorElement.textContent = result.error.message;
                            }else {

                                
                                
                                console.log(result.paymentMethod)
                                /* paymentMethod contains id, last4, and card type */
                                var paymentMethod = result.paymentMethod['id'];
                                var $form   = document.getElementById('payment-form');

                                const node = document.createElement("input") ;
                                node.setAttribute("type", "hidden");
                                node.setAttribute("name", "stripepaymentMethod");
                                node.setAttribute("value", paymentMethod);

                                const cardtype = document.createElement("input") ;
                                cardtype.setAttribute("type", "hidden");
                                cardtype.setAttribute("name", "card_type");
                                cardtype.setAttribute("value", result.paymentMethod['type']);

                                const ppp = document.createElement("input") ;
                                ppp.setAttribute("type", "hidden");
                                ppp.setAttribute("name", "payment");
                                ppp.setAttribute("value", this.payment.id);


                                $form.appendChild(node);
                                $form.appendChild(cardtype);
                                $form.appendChild(ppp);
                                
                                $form.submit();

                            }
                        });
        
                    }  
                 
                },

                goBack: function () {
                    const button = this.$refs.goBackButton;
                    const redirect = new URL(button.dataset.redirect);

                    redirect.searchParams.append(
                        'success', this.payment.status === 'succeeded' ? 'true' : 'false'
                    );

                    if (this.errorMessage) {
                        redirect.searchParams.append('message', this.errorMessage);
                    }

                    window.location.href = redirect;
                },
            },
        })
    </script>
@endpush 
