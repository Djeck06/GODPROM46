<div class="">
    <img class="w-full p-2 border border-gray-100 mb-2"
        src="{{ asset('orders/qrcode/' . $order->reference . '.svg') }}"
        alt="{{ __('Order ' . $order->reference . ' QRCODE') }}">

    @if(!is_null($order->codebar))
    <img class="w-full p-2 border border-gray-100 mb-2 mt-5" src="{{'data:image/png;base64,' . $order->codebar }} " alt="{{ __('Order ' . $order->reference . ' BARCODE') }}">

    @endif

    <a href="{{ asset('orders/qrcode/' . $order->reference . '.svg') }}" download="{{ __('Order_' . $order->reference . '.svg') }}"
        class="flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700">
        <span>{{ __('Download') }}</span>
    </a>
</div>
