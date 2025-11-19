<?php

namespace App\Http\Controllers;

use App\Helpers\InstaMojoHelper;
use App\Models\PaymentInstamojoRequest;
use App\Models\StudentCourseEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Backend\Entities\BillingAccount;
use Modules\Backend\Entities\TaxBreakup;

class PaymentInstamojoRequestController extends Controller
{
    public function initiatePayment($id)
    {
        $decrypted = decrypt($id);
        $model = PaymentInstamojoRequest::where('id', $decrypted)->firstOrFail();
        return redirect()->to($model->longurl);
    }


    public function reinitiatePayment($id)
    {

        $decrypted = decrypt($id);

        $model = PaymentInstamojoRequest::where('id', $decrypted)->firstOrFail();
        $payment =   InstaMojoHelper::pay($model->buyer_name, $model->email, $model->phone, $model->referral_code, $model->institute_id, $model->course_id, $model->student_id, $model->purpose,  $model->amount, $model->sac_code_id, $model->tax_type_id, $model->tax_id, $model->location);
        return redirect()->route('payment.initiate', ['id' => encrypt($payment)]);
    }




    public function getresponse(Request $request)
    {
        $model = PaymentInstamojoRequest::where('payment_request_id', $request->payment_request_id)->firstOrFail();
        Log::channel('instmojo')->info("getresponse: " . $request);

        $model->payment_status = $request->payment_status;
        $model->payment_id = $request->payment_id;
        $model->save();



        return redirect()->route('payment.paymentload', ['payment' => $request->payment_id]);
    }

    public function paymentload($payment_id)
    {
        $payment =  InstaMojoHelper::PaymentDeatils($payment_id);


        $model = PaymentInstamojoRequest::where('id', $payment)->firstOrFail();


        if ($model->order_status == NULL && $model->success == false) {
            return redirect()->route('payment.failure', ['payment_id' => $model->payment_id]);
        } elseif ($model->order_status == 1) {
            return redirect()->route('payment.thank-you', ['payment_id' => $model->payment_id]);
        } else {
            return redirect()->route('payment.initiated', ['payment_id' => $model->payment_id]);
        }
    }


    public function webhook(Request $request)
    {
        Log::channel('instmojo')->info($request);
    }

    public function success($payment_id)
    {
        $payment = $this->getPaymentDeatils($payment_id);
        return view('page.instamojo.payment-success', compact(['payment']));
    }

    public function failure($payment_id)
    {
        $payment = $this->getPaymentDeatils($payment_id);
        return view('page.instamojo.payment-failure', compact(['payment']));
    }

    public function initiated($payment_id)
    {
        $payment = $this->getPaymentDeatils($payment_id);
        return view('page.instamojo.initiated', compact(['payment']));
    }

    private function getPaymentDeatils($payment_id)
    {
        return PaymentInstamojoRequest::where('payment_id', $payment_id)->latest()->firstOrFail();
    }

    public function invoice($payment_id)
    {
        $decrypted = decrypt($payment_id);
        $enrollment =  StudentCourseEnrollment::where(['student_id' => \Auth::guard('students')->user()->id, 'payment_request_id' => $decrypted])->firstOrFail();
        $taxbreakup =  TaxBreakup::where(['tax_id' => $enrollment->tax_id])->latest()->get()->toArray();
        $booking_account = BillingAccount::where('id', $enrollment->billing_account_id)->first();

        if($enrollment->is_refund == 1){
            return view('page.instamojo.invoice_refund', compact(['enrollment', 'taxbreakup', 'booking_account']));

        }
        return view('page.instamojo.invoice', compact(['enrollment', 'taxbreakup', 'booking_account']));
    }



}
