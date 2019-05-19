@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible mt-4" role="alert">
        <i class="fas fa-exclamation-circle"></i> {{ Session::get('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (Session::has('success'))
    <div class="alert alert-success alert-dismissible mt-4" role="alert">
        <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
