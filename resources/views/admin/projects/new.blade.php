@extends('templates.main')

@section('title')
Projects - New
@endsection

@section('own_js_top')
    <script src="{{ asset('libs/Bootstrap-Select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('libs/Bootstrap-Select/js/defaults-es_ES.js') }}"></script>
@endsection

@section('own_css')
    <link href="{{ asset('libs/Bootstrap-Select/css/bootstrap-select.css') }}" rel="stylesheet">
    <link href="{{ asset('css/crud.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h4 class="text-center my-4 my-md-5">Nuevo PROYECTO</h4>
        @include('partial.errores')
        <form action="{{ action('ProjectController@store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="title">Título *</label>
                    <input type="text" name="title" id="title" class="form-control col-12" placeholder="Introduce el título" value="{{ old('title') }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="description">Descripción *</label>
                    <textarea type="text" name="description" id="description" class="form-control col-12" placeholder="Description" maxlength="480" rows="4" required>{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="logo">Logo *</label>
                    <div class="row mb-3">
                        <a class="mx-auto" data-toggle="modal" data-target="#modalTestNew">
                            <img id="thumbnail_logo" class="img-thumbnail mx-auto" src="{{ asset('media/img/default_image.png') }}">
                        </a>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="logo" id="logo" class="custom-file-input" value="{{ old('logo') }}" required>
                        <label id="logo-label" class="custom-file-label" for="logo">Seleccionar Archivo</label>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="mockup">Mockup *</label>
                    <div class="row mb-3">
                        <a class="mx-auto" data-toggle="modal" data-target="#modalTestNew">
                            <img id="thumbnail_mockup" class="img-thumbnail mx-auto" src="{{ asset('media/img/default_image.png') }}">
                        </a>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="mockup" id="mockup" class="custom-file-input" value="{{ old('mockup') }}" required>
                        <label id="mockup-label" class="custom-file-label" for="mockup">Seleccionar Archivo</label>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12 mt-2">
                    <label for="tags">Tags</label>
                    <select name="tags[]" id="tags" class="selectpicker form-control" data-live-search="true" title="Select tags" multiple data-actions-box="true" data-size="5">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12 mt-2">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="visible" name="visible" value="1" checked>
                        <label class="custom-control-label" for="visible">Visible</label>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12 mb-2 mt-2">
                    <a href="{{ url('/projects') }}" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left mr-2"></i> Volver</a>
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
