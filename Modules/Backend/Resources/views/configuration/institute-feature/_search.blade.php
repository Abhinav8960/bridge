<form class="align-items-center">
    <div class="row">
        <div class="col-md-6">
            @include('backend::includes._pagesize')
        </div>
        <div class="col-md-6">
            <div class="row float-end">
                <div class="col-auto">
                    <label class="visually-hidden" for="name">Name</label>
                    <input class="form-control" id="name" type="text" placeholder="Name" name="name"
                        value="{{ $request['name'] ? $request['name'] : '' }}" onblur="setTimeout(this.form.submit(), 3000)">
                </div>  
                
            </div>
        </div>
    </div>
</form>
