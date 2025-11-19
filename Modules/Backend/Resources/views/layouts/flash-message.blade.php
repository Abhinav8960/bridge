@if ($message = Session::get('success'))
    <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span
                aria-hidden="true">&times;</span></button>
    </div>
@endif

@if ($message = Session::get('error'))
    <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div id="alert" class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
    </div>
@endif

@if ($message = Session::get('info'))
    <div id="alert" class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
    </div>
@endif


