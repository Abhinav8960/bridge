<?php

namespace Modules\Institute\Http\Controllers;

use App\Models\Institute\InstituteStream;
use App\Models\InstituteContact;
use App\Models\InstituteReview;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class InstituteReviewController extends BaseController
{


    public function __construct()
    {
        parent::__construct();
        // $this->authorizeResource(InstituteStream::class, 'streams_in_institute');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        
        $reviews = InstituteReview::where('institute_id',$this->institute()->id)->latest()->paginate($this->pageSize)->withQueryString();
        return view('institute::reviews.index', compact(['reviews']));
    }

    public function leads(){

        $leads = InstituteContact::where('institute_id',$this->institute()->id)->latest()->paginate($this->pageSize)->withQueryString();
        return view('institute::lead.index', compact(['leads']));

    }

    
}
