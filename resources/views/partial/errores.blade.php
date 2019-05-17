@if (Session::has('error'))
    <div class="alert alert-danger mt-4" role="alert">
        {{ Session::get('error') }}
    </div>
@endif
