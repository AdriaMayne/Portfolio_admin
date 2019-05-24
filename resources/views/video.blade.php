@extends('templates.main')

@section('title')
Vídeo - AdriaMayne
@endsection

@section('own_css')
    <link href="{{ asset('css/video.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row images text-center my-4">
        <a id="AdriaMayne_logo" class="col-6 col-md-3">
            <img src="{{ asset('media/img/logo.png') }}" alt="AdriaMayne Logo">
        </a>
        <a id="CookingMate_logo" class="col-6 col-md-3">
            <img src="{{ asset('media/img/CookingMate_logo.png') }}" alt="CookingMate Logo">
        </a>
        <a id="Adami_logo" class="col-6 col-md-3">
            <img src="{{ asset('media/img/Adami_logo.png') }}" alt="Adami Logo">
        </a>
        <a id="Petlinks_logo" class="col-6 col-md-3">
            <img src="{{ asset('media/img/Petlinks_logo.png') }}" alt="Petlinks Logo">
        </a>
    </div>
    <div class="embed-responsive embed-responsive-16by9">
        <video id="video" class="embed-responsive-item" controls autoplay="autoplay" class="mx-auto mt-4" style="width: 100%; height: auto; "><source src="{{ asset('media/video/AdriaMayne_Projects.mp4')}}" type="video/mp4"></video>
    </div>
    {{-- <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
    </div> --}}
</div>
<script src="{{ asset('js/video.js') }}"></script>
@endsection
