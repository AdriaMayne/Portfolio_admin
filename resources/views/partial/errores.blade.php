@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible mt-4" role="alert">
        <h4 class="alert-heading">Error!</h4>
        <p>{{ Session::get('error') }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (Session::has('success'))
    <div class="alert alert-success alert-dismissible mt-4" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
