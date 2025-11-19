<form id="itemId" method="post" enctype="multipart/form-data">
    @csrf
    @method('DELETE')
    <div class="modal fade" id="deleteItemModal" tabindex="-1" aria-labelledby="deleteItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo"
                style="background-image: url('{{ asset('assets/backend/assets/img/Alert-Box.jpg') }}'); background-repeat: no-repeat; height:225px; width:400px;">
                <div class="modal-header" style="border: 0px">
                    {{-- <h6 class="modal-title">Vertically centered Modal</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button> --}}
                </div>
                <div class="modal-body" style="margin-top: 50px; text-align: center; font-size: larger;">
                    <p style="margin: 0px">Are You Sure You Want To Delete:</p>
                    <b><p id="itemname"></p></b>
                </div>
                <div class="modal-footer" style="justify-content: center;padding: 0px;border:0px; margin-bottom: 20px;">
                    <button class="cusbtn ripple btn btn-outline-primary" type="button submit">Yes</button>
                    <button class="cusbtn ripple btn btn-outline-primary" data-bs-dismiss="modal" type="button">No</button>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
    .cusbtn{
        padding: 0.25rem 0.78rem;
    }
</style>