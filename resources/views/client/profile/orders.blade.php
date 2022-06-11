@extends('client.global')

@section('content')
    @include('partials.app.page-header', ['title' => $title])

    <div class="py-12">
        <div class="container">
            @include('client.profile.tabs')

            <div class="mt-6">
                <livewire:client.account.orders />
            </div>

        </div>
    </div>
@endsection
