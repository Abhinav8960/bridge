<?php

namespace Modules\Backend\Http\Controllers;

use App\Helpers\InstaMojoHelper;
use App\Models\EnrollContact;
use App\Models\InstamojoRefund;
use App\Models\PaymentInstamojoRequest;
use App\Models\StudentCourseEnrollment;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PaymentReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('backend.auth');
    }

    public function success(Request $request)
    {
        $paymentReport = PaymentInstamojoRequest::filter($request->all())->where(['order_status' => PaymentInstamojoRequest::ORDER_STATUS_SUCCESSFUL])->where('is_refund',false)->latest()->get();

        return view('backend::reports.success', compact('paymentReport', 'request'));
    }


    public function failure(Request $request)
    {

        $paymentReport = PaymentInstamojoRequest::filter($request->all())->where(fn ($query) => $query->where(['order_status' => PaymentInstamojoRequest::ORDER_STATUS_FAILED])->orwhere(['success' => PaymentInstamojoRequest::ORDER_STATUS_FAILED]))->latest()->get();;

        return view('backend::reports.failure', compact('paymentReport', 'request'));
    }


    public function refunded(Request $request)
    {

        $paymentReport = PaymentInstamojoRequest::filter($request->all())->where(['is_refund' => true])->get();

        return view('backend::reports.refunded', compact('paymentReport', 'request'));
    }


    public function refundnow($payment_id, Request $request)
    {
        $decrypted = decrypt($payment_id);


        $refund =  PaymentInstamojoRequest::where(['payment_id' => $decrypted])->firstOrFail();

        $refund->is_refund = true;
        $refund->refund_reason = $request->reason;
        $refund->save();

        $enrollrefund =  StudentCourseEnrollment::where(['payment_request_id' => $refund->id])->firstOrFail();
        $enrollrefund->is_refund = true;
        $enrollrefund->refund_reason = $request->reason;
        if ($enrollrefund->save()) {

            $resp =  InstaMojoHelper::refund($refund->payment_id, $refund->payment_id, $refund->refund_reason, $refund->amount_charged);
            $resp = json_decode($resp,true);
            $model = new InstamojoRefund();
            $model->refund_id = $resp['refund']['id'];
            $model->payment_id = $resp['refund']['payment_id'];
            $model->status = $resp['refund']['status'];
            $model->type = $resp['refund']['type'];
            $model->body = $resp['refund']['body'];
            $model->refund_amount = $resp['refund']['refund_amount'];
            $model->total_amount = $resp['refund']['total_amount'];
            $model->creator_name = $resp['refund']['creator_name'];
            $model->refund_created_at = $resp['refund']['created_at'];
            $model->save();
            return redirect()->back()->with('success', 'Refunded');
        }

        return redirect()->back()->with('error', 'Can not refund');
    }
}
