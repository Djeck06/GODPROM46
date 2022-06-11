<div 
    x-init="flatpickr($refs.datetimewidget, {wrap: true, enableTime: true, dateFormat: 'Y-m-d H:i', altFormat: 'F j, Y', time_24hr: true, minDate: new Date().fp_incr(1), maxDate: new Date().fp_incr(15), minTime: '08:00', maxTime: '16:00'});"
    x-ref="datetimewidget" class="flatpickr container mx-auto col-span-6 sm:col-span-6">
    <div class="flex align-middle align-content-center">
        <input x-ref="datetime" type="text" id="datetime" data-input placeholder="Select.."
        {{ $attributes->merge(['class' => 'mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md' ]) }} />
    </div>

</div>

@once
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endonce
