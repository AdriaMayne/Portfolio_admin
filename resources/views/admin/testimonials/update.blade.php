@extends('templates.main')

@section('own_css')
    <link href="{{ asset('css/crud.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h4 class="text-center my-4 my-md-5">Editar TESTIMONIAL</h4>
        @include('partial.errores')
        <form action="{{ action('TestimonialController@update', [$testimonial->id]) }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="title">Título *</label>
                    <input type="text" name="title" id="title" class="form-control col-12" placeholder="Introduce el título" value="{{ $testimonial->title }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="order">Orden *</label>
                    <select name="order" id="order" class="form-control" required>
                        @foreach ($orderNumbers as $orderNumber)
                            @if ($orderNumber == $testimonial->order)
                                <option value="{{ $orderNumber }}" selected> {{ $orderNumber }}</option>
                            @else
                                <option value="{{ $orderNumber }}"> {{ $orderNumber }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Nombre *</label>
                    <input type="text" name="name" id="name" class="form-control col-12" placeholder="Introduce el nombre" value="{{ $testimonial->name }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="url">URL *</label>
                    <input type="text" name="url" id="url" class="form-control col-12" placeholder="Introduce la URL" value="{{ $testimonial->url }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="message">Mensaje *</label>
                    <textarea name="message" id="message" class="form-control col-12" placeholder="Introduce el mensaje" rows="3" required>{{ $testimonial->message }}</textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="image">Imagen *</label>
                    <div class="row mb-3">
                        <a class="mx-auto" data-toggle="modal" data-target="#modalTestNew">
                            <img id="thumbnail" class="img-thumbnail mx-auto" src="{{ asset('media/img/default_image.png') }}">
                        </a>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="image" id="image" class="custom-file-input" value="{{ old('image') }}" required>
                        <label class="custom-file-label" for="image">Seleccionar Archivo</label>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12 mb-2 mt-4">
                    <a href="{{ url('/testimonials') }}" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left mr-2"></i> Volver</a>
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-plus mr-2"></i> Añadir</button>
                </div>
            </div>
            <small class="mx-0 p-0">Los campos indicados con * son obligatorios.</small>
        </form>
        <div class="modal fade" id="modalTestNew" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/events.js') }}"></script>
    <script src="{{ asset('js/modals.js') }}"></script>
@endsection
