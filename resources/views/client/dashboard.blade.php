@extends('client.global')

@section('content')

    @include('partials.app.page-header', ['title' => $title])

    <div class="py-12">
        <div class="container">
           
           
            <div class="flex flex-wrap items-center">

                <div class="w-full lg:w-2/5 px-3">
                        .        
                </div>
                <div class="w-full lg:w-3/5 px-3">
                    <img src="{{ asset('images/illustrations/mobile-login.svg') }}" class="w-100" />
                </div>
            </div>
            
        </div>
    </div>

@endsection