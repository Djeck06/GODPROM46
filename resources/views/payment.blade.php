<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>{{ __('Payment Confirmation') }} - {{ config('app.name', 'Laravel') }}</title>

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.min.js"></script>
    <script src="https://js.stripe.com/v3"></script>
</head>
<body class="font-sans text-gray-600 bg-gray-100 leading-normal p-4 h-full">
    <div id="app" class="h-full md:flex md:justify-center md:items-center">
        <div class="w-full max-w-lg">
            <h1 class="text-4xl font-bold text-center p-4 sm:p-6 mt-4">
                Your {{ $amount }} payment
            </h1>

            <!-- Status Messages -->
            <p class="flex items-center bg-red-100 border border-red-200 px-5 py-2 rounded-lg text-red-500" v-if="errorMessage">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="flex-shrink-0 w-6 h-6">
                    <path class="fill-current text-red-300" d="M12 2a10 10 0 1 1 0 20 10 10 0 0 1 0-20z"/>
                    <path class="fill-current text-red-500" d="M12 18a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm1-5.9c-.13 1.2-1.88 1.2-2 0l-.5-5a1 1 0 0 1 1-1.1h1a1 1 0 0 1 1 1.1l-.5 5z"/>
                </svg>

                <span class="ml-3">@{{ errorMessage }}</span>
            </p>

            <div class="bg-white rounded-lg shadow-xl p-4 sm:p-6 mt-4">
                @if($payment->status === 'succeeded' || session()->has('success'))
                <div >
                    <h2 class="text-xl mb-4 text-gray-600">
                        Payment Successful
                    </h2>

                    <p class="mb-6">
                        This payment was successfully confirmed.
                    </p>
                </div>
                @elseif($payment->status === 'processing')
                <div>
                    <h2 class="text-xl mb-4 text-gray-600">
                        Payment Processing
                    </h2>

                    <p class="mb-6">
                        This payment is currently processing. Refresh this page from time to time to see its status.
                    </p>
                </div>
                @elseif($payment->status === 'canceled')
                <div >
                    <h2 class="text-xl mb-4 text-gray-600">
                        Payment Canceled
                    </h2>

                    <p class="mb-6">
                        This payment was canceled.
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
                                Confirm Your Payment
                            </h2>

                            <p class="mb-6">
                                A valid payment method is needed to process your payment. Please confirm your payment by filling out your payment details below.
                            </p>

                            <!-- Payment Method -->
                            <label for="paymentMethod" class="inline-block text-sm text-gray-700 font-semibold mb-2">
                                Payment Method
                            </label>

                            <div v-if="paymentMethods.length > 1">
                                <p class="text-sm mb-3">
                                    Please select the payment method which you'd like to use.
                                </p>

                                <select
                                    id="paymentMethod"
                                    required
                                    class="inline-block bg-gray-100 border border-gray-300 rounded-lg w-full px-4 py-3 mb-3 focus:outline-none"
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
                                    Your payment will be processed by @{{ paymentMethodTitle }}.
                                </p>
                            </div>

                            <!-- Name -->
                            <label for="name" class="inline-block text-sm text-gray-700 font-semibold mb-2">
                                Full name
                            </label>

                            <input
                                id="name"
                                type="text" placeholder="Jane Doe"
                                required
                                class="inline-block bg-gray-100 border border-gray-300 rounded-lg w-full px-4 py-3 mb-3 focus:outline-none"
                                v-model="name"
                            />

                            <!-- E-mail Address -->
                            <label for="email" class="inline-block text-sm text-gray-700 font-semibold mb-2">
                                E-mail address
                            </label>

                            <input
                                id="email"
                                type="text" placeholder="jane@example.com"
                                required
                                class="inline-block bg-gray-100 border border-gray-300 rounded-lg w-full px-4 py-3 mb-3 focus:outline-none"
                                v-model="email"
                            />

                            <div v-if="paymentElement">
                                <!-- Stripe Payment Element -->
                                <label for="payment-element" class="inline-block text-sm text-gray-700 font-semibold mb-2">
                                    Payment details
                                </label>

                                <div id="payment-element" ref="paymentElement" class="bg-gray-100 border border-gray-300 rounded-lg p-4 mb-6"></div>
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

                                    Remember payment method for future usage
                                </label>

                                <p v-if="['bancontact', 'ideal', 'sepa_debit'].includes(paymentMethod.type)" class="text-xs text-gray-400 mb-6">
                                    By providing your payment information and confirming this payment, you authorise (A) and Stripe, our payment service provider, to send instructions to your bank to debit your account and (B) your bank to debit your account in accordance with those instructions. As part of your rights, you are entitled to a refund from your bank under the terms and conditions of your agreement with your bank. A refund must be claimed within 8 weeks starting from the date on which your account was debited. Your rights are explained in a statement that you can obtain from your bank. You agree to receive notifications for future debits up to 2 days before they occur.
                                </p>
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
                                Processing...
                            </span>
                            <span v-else>
                                Confirm your {{ $amount }} payment with @{{ paymentMethodTitle }}
                            </span>
                        </button>
                    </form >
                </div>
                @endif


                <button @click="goBack" ref="goBackButton" data-redirect="{{ $redirect }}"
                   class="inline-block w-full px-4 py-3 bg-gray-100 hover:bg-gray-200 text-center text-gray-600 rounded-lg">
                    Go back
                </button>
            </div>

            <p class="text-center text-gray-500 text-sm mt-4 pb-4">
                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>
        </div>
    </div>

    <script>
        window.stripe = Stripe('{{ $stripeKey }}');

        new Vue({
            el: '#app',

            data() {
                return {
                    paymentIntent: {},
                    payment: @json($payment),
                    paymentMethod: null,
                    name: '{{ $customer->name }}',
                    email: '{{ $customer->email}}',
                    paymentElement: null,
                    remember: false,
                    isPaymentProcessing: false,
                    errorMessage: '{{ $errorMessage }}'
                }
            },

            mounted: function () {
                this.configurePayment();
                // this.configurePayment(this.paymentIntent);
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
                    // return methods.filter(method => this.paymentIntent.payment_method_types.includes(method.type))
                }
            },

            methods: {
                // configurePayment: function (paymentIntent) {
                configurePayment: function () {
                    // Set the payment intent object...
                    // this.paymentIntent = paymentIntent;

                    // Set the allowed payment methods based on the payment method types of the intent...
                    // const paymentMethodTypes = paymentIntent.payment_method_types;
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

                configureStripeElements: function () {
                    // Stripe Elements are only needed when a payment method is required.
                    if (this.payment.status !== 'pending') {
                        return;
                    }

                    // Create the Stripe element based on the currently selected payment method...
                    if (this.paymentMethod.element) {
                        const appearance = {
                        theme: 'stripe'
                        };

                        //const secret = this.paymentIntent.client_secret;

                        // Pass the appearance object to the Elements instance
                        
                        const elements = stripe.elements();
                        // this.paymentElement = elements.create(
                        //     this.paymentMethod.element, this.paymentMethod.options ?? {}
                        // );
                        this.paymentElement = elements.create('card');
                        
                        this.paymentElement.update({
                                value: {
                                },
                                hidePostalCode: true ,
                            });


                    }  else {
                        this.paymentElement = null;
                    }

                    if (this.paymentElement) {
                        this.$nextTick(() => {
                            // Clear the payment element first, otherwise Stripe Elements will emit a warning...
                            //document.getElementById("payment-element").innerHTML = "";
                            this.paymentElement.clear();
                            console.log('ty',this.paymentElement)
                            this.paymentElement.mount('#payment-element');

                        })
                    }
                },

                confirmPaymentMethod: function () {
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
                        // if (this.paymentIntent.status === 'requires_payment_method') {
                        //     data.payment_method.card = this.paymentElement;
                        // } else if (
                        //     this.paymentIntent.status === 'requires_action' ||
                        //     this.paymentIntent.status === 'requires_confirmation'
                        // ) {
                        //     data.payment_method = this.paymentIntent.payment_method.id;
                        // }

                        //paymentPromise = stripe.confirmCardPayment(secret, data);
                        console.log("attempting");
                        stripe.createPaymentMethod({
                            type: 'card',
                            card: this.paymentElement,
                            billing_details: {
                            name: 'Jenny Rosen',
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
                  
                   // paymentPromise.then(result => this.confirmCallback(result));
                },

                confirmCallback: function (result) {
                    this.isPaymentProcessing = false;

                    if (result.error) {
                        if (result.error.code === '{{ Stripe\ErrorObject::CODE_PARAMETER_INVALID_EMPTY }}') {
                            this.errorMessage = 'Please provide your name and e-mail address.';
                        } else {
                            this.errorMessage = result.error.message;
                        }

                        if (result.error.payment_intent) {
                            this.configurePayment(result.error.payment_intent);

                            this.configureStripeElements();
                        }
                    } else {
                        this.configurePayment(result.paymentIntent);
                    }
                },

                goBack: function () {
                    const button = this.$refs.goBackButton;
                    const redirect = new URL(button.dataset.redirect);

                    redirect.searchParams.append(
                        'success', this.payment.status === 'succeeded' ? 'true' : 'false'
                        // 'success', this.paymentIntent.status === 'succeeded' ? 'true' : 'false'
                    );

                    if (this.errorMessage) {
                        redirect.searchParams.append('message', this.errorMessage);
                    }

                    window.location.href = redirect;
                },
            },
        })
    </script>
</body>
</html>
