<?php

namespace Modules\Institute\Http\Controllers\Information;

use App\Models\Institute;
use App\Models\Institute\Information\General;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Institute\Http\Controllers\BaseController;
use Modules\Institute\Http\Requests\Information\General\StoreGeneralRequest;
use Modules\Institute\Http\Requests\Information\General\UpdateGeneralRequest;

class GeneralController extends BaseController
{

 
    
    public function general()
    {
      
        return view('institute::information.general.upsert');
    }
}
