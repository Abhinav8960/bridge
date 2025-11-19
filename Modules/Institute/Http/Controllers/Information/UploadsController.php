<?php

namespace Modules\Institute\Http\Controllers\Information;

use Modules\Institute\Http\Controllers\BaseController;

class UploadsController extends BaseController
{

    
    public function uploads()
    {
        return view('institute::information.uploads.upsert');
    }
}
