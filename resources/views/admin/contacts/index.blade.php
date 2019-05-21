@extends('templates.main')

@section('title')
Contacts - Index
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card mt-2">
            <div class="card-body">
                <form action="{{ url('contacts') }}" method="get">
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
                            <th scope="col">#</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->date }}</td>
                            <td class="col-button">
                                <a class="btn btn-secondary btn-sm float-right" href="{{ action('ContactController@show', [$contact->id]) }}"><i class="fas fa-eye"></i> VER</a>
                            </td>
                            <td class="col-button">
                                <button type="button" class="btn btn-danger btn-sm ml-3 float-right" data-toggle="modal" data-target="#modalContacts" data-id="{{ $contact->id }}" data-subject="{{ $contact->subject }}" data-name="{{ $contact->name }}" data-email="{{ $contact->email }}" data-message="{{ $contact->message }}" data-action="{{ action('ContactController@destroy', [$contact->id]) }}"><i class="fas fa-trash"></i> BORRAR</button>
                            </td>
                        </tr>
                        @empty
                            <td>No se han encontrado registros en la BD.</td>
                            <td></td><td></td><td></td>
                            <td></td><td></td><td></td>
                        @endforelse
                    </tbody>
                </table>
                {{ $contacts->appends(['search' => $search])->links() }}
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalContacts" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
