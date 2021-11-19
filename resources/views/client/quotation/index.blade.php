@extends('client.global')

@section('content')
    @include('partials.app.page-header', ['title' => $title,])

    <div class="py-12">
        <div class="container">
            <livewire:client.quotation-form />

        </div>
    </div>

@endsection
