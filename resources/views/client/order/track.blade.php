@extends('client.global')

@section('content')
    @include('partials.app.page-header', ['title' => $title])

    <div class="py-12">
        <div class="container">
            @include('client.order.inc.header', ['order' => $order])
            

            <div class="mt-5">
                <div class="md:grid md:grid-cols-5 md:gap-6">
                    <div class="mt-5 md:mt-0 md:col-span-4">
                        @include('client.order.inc.menu', ['order' => $order])

                        <div class="mt-5 md:col-span-2">
                            <h2>HISTORY</h2>
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
