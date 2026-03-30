<form action="{{ route('vendor.credential.send') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="modal fade" id="sendCredentialModal" tabindex="-1" aria-labelledby="sendCredentialModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendCredentialModalLabel">Vendor Credential</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                            <div>
                                <Label>Mobile Number</Label>
                                <input class="form-control" type="text" name="mobile" value="">
                                <input class="form-control" id="vendorId" type="hidden" name="vendor" value="">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
            </div>
        </div>
    </div>
</form>
