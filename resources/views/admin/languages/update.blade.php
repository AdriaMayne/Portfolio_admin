@extends('templates.main')

@section('own_css')
    <link href="{{ asset('css/crud.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h4 class="text-center my-4 my-md-5">Editar LENGUAJE</h4>
        @include('partial.errores')
        <form action="{{ action('LanguageController@update', [$language->id]) }}" method="POST" enctype="multipart/form-data">
                @method('put')
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Nombre *</label>
                    <input type="text" name="name" id="name" class="form-control col-12" placeholder="Introduce el nombre" value="{{ $language->name }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="category">Categoria *</label>
                    <select name="category" id="category" class="form-control" required>
                        @if ((old('category') == 1) || ($language->category == 1)))
                            <option value=0>Frontend</option>
                            <option value=1 selected>Backend</option>
                        @else
                            <option value=0>Frontend</option>
                            <option value=1>Backend</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label id="percentageRangeLabel" for="percentage">Porcentaje *</label>
                    @if (old('percentage'))
                        <input type="range" class="custom-range" min="0" max="100" step="1" id="percentage" name="percentage" value="{{ old('percentage') }}">
                    @else
                        <input type="range" class="custom-range" min="0" max="100" step="1" id="percentage" name="percentage" value="{{ $language->percentage }}">
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="image">Imagen *</label>
                    <div class="row mb-3">
                        <a class="mx-auto" data-toggle="modal" data-target="#modalTestNew">
                            <img id="thumbnail" class="img-thumbnail mx-auto" src="{{ asset($original_image) }}">
                        </a>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="image" id="image" class="custom-file-input" value="{{ old('image') }}">
                    <label class="custom-file-label" for="image">{{ $language->image}}</label>
                    </div>
                </div>
            </div>
            <div class="form-row">
                    <div class="form-group col-12 mt-2">
                        <div class="custom-control custom-checkbox">
                            @if ($language->visible == 1)
                                <input type="checkbox" class="custom-control-input" id="visible" name="visible" value="{{ $language->visible }}" checked>
                            @else
                                <input type="checkbox" class="custom-control-input" id="visible" name="visible" value="{{ $language->visible }}">
                            @endif
                            <label class="custom-control-label" for="visible">Visible</label>
                        </div>
                    </div>
                </div>
            <div class="form-row">
                <div class="form-group col-md-12 mb-2 mt-2">
                    <a href="{{ url('/languages') }}" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left mr-2"></i> Volver</a>
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
