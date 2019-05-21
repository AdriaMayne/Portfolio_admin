@extends('templates.main')

@section('title')
Tags - Index
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card mt-2">
            <div class="card-body">
                <form class="form-inline" action="{{ action('TagController@store') }}" method="POST">
                    @csrf
                    <div class="input-group mb-1 col-md-10">
                        <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Nuevo tag" autofocus>
                    </div>
                    <div class="input-group mb-1 col-md-2">
                        <button type="submit" class="btn btn-primary btn-lg col-md-12 mx-auto"><i class="fas fa-plus mr-2"></i> Añadir</button>
                    </div>
                </form>
                @include('partial.errores')
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-body">
                <form action="{{ url('tags') }}" method="get">
                        <div class="form-group my-2 col-12 mx-auto">
                            <label for="search" class="">Búsqueda</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input id="search" class="form-control mt-1" name="search" type="text" placeholder="" value="{{ $search }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-secondary mt-1 col-md-10">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <table class="table table-striped table-hover table-sm mt-5 text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th hidden scope="col">#</th>
                            <th scope="col">Título</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tags as $tag)
                        <tr>
                            <td hidden>{{ $tag->id }}</td>
                            <td>{{ $tag->title }}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm ml-3" data-toggle="modal" data-target="#modalTags" data-id="{{ $tag->id }}" data-title="{{ $tag->title }}" data-action="{{ action('TagController@destroy', [$tag->id]) }}"><i class="fas fa-trash"></i> BORRAR</button>
                            </td>
                        </tr>
                        @empty
                            <td>No se han encontrado registros en la BD.</td>
                            <td></td>
                        @endforelse
                    </tbody>
                </table>
                {{ $tags->appends(['search' => $search])->links() }}
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTags" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
