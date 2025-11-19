@if ($message = Session::get('success'))
    <div class="modal fade show" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="SuccessModalLabel" style="display: block; padding-left: 0px;" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #f9fbfb">
                <div class="modal-header">
                    <h5 class="modal-title" id="SuccessModalLabel"><img src="/assets/img/faces/mnemonic-bridge.png"
                            alt="" style="width:30px;max-width:30px">Skoodos Bridge</h5>
                </div>
                <div class="modal-body">
                    <strong>{{ $message }}</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary successbtn modaldismiss"
                        data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    <script>
        $(".modaldismiss").click(function() {
            $('.modal').remove();
            $('.modal-backdrop').remove();
        });
    </script>
@endif

@if ($message = Session::get('error'))

    <div class="card-shadow modal fade show" id="staticBackdropLive" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLiveLabel" style="display: block; padding-left: 0px;"
        aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #f9fbfb">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLiveLabel"><img
                            src="assets/img/faces/mnemonic-bridge.png" alt=""
                            style="width:30px;max-width:30px">Skoodos Bridge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong>{{ $message }}</strong>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-primary successbtn">Ok</button>
                </div>
            </div>
        </div>
    </div>
@endif

@if ($message = Session::get('warning'))
    {{-- <div id="alert" class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
    </div> --}}
    <div class="card-shadow modal fade show" id="staticBackdropLive" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLiveLabel" style="display: block; padding-left: 0px;"
        aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #f9fbfb">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLiveLabel"><img
                            src="assets/img/faces/mnemonic-bridge.png" alt=""
                            style="width:30px;max-width:30px">Skoodos Bridge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong>{{ $message }}</strong>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-primary successbtn">Ok</button>
                </div>
            </div>
        </div>
    </div>
@endif

@if ($message = Session::get('info'))

    <div class="card-shadow modal fade show" id="staticBackdropLive" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLiveLabel" style="display: block; padding-left: 0px;"
        aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #f9fbfb">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLiveLabel"><img
                            src="assets/img/faces/mnemonic-bridge.png" alt=""
                            style="width:30px;max-width:30px">Skoodos Bridge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong>{{ $message }}</strong>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-primary successbtn">Ok</button>
                </div>
            </div>
        </div>
    </div>
@endif

