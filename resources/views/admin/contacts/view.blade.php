@extends('templates.main')

@section('own_css')
    <link href="{{ asset('css/crud.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h4 class="text-center font-weight-bold my-4 my-md-5">Mensaje</h4>
        <p class="row lead">From: {{ $contact->name }}</p>
        <p class="row lead">Subject: {{ $contact->subject }}</p>
        <p class="row lead">Fecha: {{ $contact->date }}</p>
        <p class="row lead">Message:</p>
        <div class="col-11 offset-1">
            <p class="row lead text-justify">{{ $contact->message }}</p>
        </div>
        <div class="row mt-5">
            <div class="form-group">
                <a href="{{ url('/contacts') }}" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left mr-2"></i> Volver</a>
                <a href="mailto:{{ $contact->email }}" class="btn btn-primary btn-lg"><i class="fas fa-paper-plane"></i> Contestar</a>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/events.js') }}"></script>
    <script src="{{ asset('js/modals.js') }}"></script>
@endsection

