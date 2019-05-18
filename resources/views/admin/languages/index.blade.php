@extends('templates.main')

@section('content')
    <div class="container-fluid">
        <div class="card mt-2">
            <div class="card-body">
                <a class="btn btn-primary" href="{{ url('languages/create') }}">Nuevo LENGUAJE</a>
                @include('partial.errores')
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-body">
                <form action="{{ url('languages') }}" method="get">
                        <div class="form-group my-2 col-12 mx-auto">
                            <label for="search" class="">Búsqueda</label>
                            <div class="row">
                                <div class="col-10">
                                    <input id="search" class="form-control" name="search" type="text" placeholder="" value="{{ $search }}">
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-secondary col-10">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <table class="table table-striped table-hover table-responsive-lg mt-5 text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Porcentaje</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Visible</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($languages as $language)
                        <tr>
                            <td>{{ $language->id }}</td>
                            <td>{{ $language->name }}</td>
                            <td>{{ $language->percentage }}</td>
                            <td>{{ $language->image }}</td>
                            <td>{{ $language->category }}</td>
                            <td>{{ $language->visible }}</td>
                            <td class="col-button">
                                <form action="{{ action('LanguageController@edit', [$language->id]) }}" method="get">
                                    <button type="submit" class="btn btn-secondary btn-sm float-right"><i class="fas fa-edit"></i> EDITAR</button>
                                </form>
                            </td>
                            <td class="col-button">
                                <button type="button" class="btn btn-danger btn-sm ml-3 float-right" data-toggle="modal" data-target="#modalLanguages" data-id="{{ $language->id }}" data-name="{{ $language->name }}" data-action="{{ action('LanguageController@destroy', [$language->id]) }}"><i class="fas fa-trash"></i> BORRAR</button>
                            </td>
                        </tr>
                        @empty
                            <td>No se han encontrado registros en la BD.</td>
                            <td></td><td></td>
                            <td></td><td></td>
                            <td></td><td></td>
                            <td></td>
                        @endforelse
                    </tbody>
                </table>
                {{ $languages->appends(['search' => $search])->links() }}
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalLanguages" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Seguro que quieres eliminar el registro?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form class="form-inline my-2 my-lg-0" id="modal-form" action="" method="POST">
                        @method('delete')
                        @csrf
                        <div class="form-group">
                            <button type="submit" name="BORRAR" class="btn btn-danger">BORRAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/modals.js') }}"></script>
@endsection
