<?php

namespace App\Observers;

use App\Models\Institute\Information\Course;
use App\Models\PaymentInstamojoRequest;
use App\Models\StudentCourseEnrollment;

class PaymentInstamojoRequestObserver
{
    /**
     * Handle the PaymentInstamojoRequest "created" event.
     *
     * @param  \App\Models\PaymentInstamojoRequest  $paymentInstamojoRequest
     * @return void
     */
    public function created(PaymentInstamojoRequest $paymentInstamojoRequest)
    {
        $this->studentenrollment($paymentInstamojoRequest);
    }

    /**
     * Handle the PaymentInstamojoRequest "updated" event.
     *
     * @param  \App\Models\PaymentInstamojoRequest  $paymentInstamojoRequest
     * @return void
     */
    public function updated(PaymentInstamojoRequest $paymentInstamojoRequest)
    {
        $this->studentenrollment($paymentInstamojoRequest);
    }

    /**
     * Handle the PaymentInstamojoRequest "deleted" event.
     *
     * @param  \App\Models\PaymentInstamojoRequest  $paymentInstamojoRequest
     * @return void
     */
    public function deleted(PaymentInstamojoRequest $paymentInstamojoRequest)
    {
        //
    }

    /**
     * Handle the PaymentInstamojoRequest "restored" event.
     *
     * @param  \App\Models\PaymentInstamojoRequest  $paymentInstamojoRequest
     * @return void
     */
    public function restored(PaymentInstamojoRequest $paymentInstamojoRequest)
    {
        //
    }

    /**
     * Handle the PaymentInstamojoRequest "force deleted" event.
     *
     * @param  \App\Models\PaymentInstamojoRequest  $paymentInstamojoRequest
     * @return void
     */
    public function forceDeleted(PaymentInstamojoRequest $paymentInstamojoRequest)
    {
        //
    }

    private function studentenrollment($paymentInstamojoRequest)
    {
        if ($paymentInstamojoRequest->order_status == true && $paymentInstamojoRequest->is_refund == false) {

            $cor =  Course::where('id', $paymentInstamojoRequest->course_id)->first();

            $maxid =  StudentCourseEnrollment::max('id');
            $model = new StudentCourseEnrollment();
            $model->payment_request_id = $paymentInstamojoRequest->id;
            $model->institute_id = $paymentInstamojoRequest->institute_id;
            $model->course_id = $paymentInstamojoRequest->course_id;
            $model->course_title = $cor->course_title;
            $model->duration = $cor->duration;           
            
            $model->student_id = $paymentInstamojoRequest->student_id;
            $model->sac_code_id = $paymentInstamojoRequest->sac_code_id;
            $model->tax_type_id = $paymentInstamojoRequest->tax_type_id;
            $model->tax_id = $paymentInstamojoRequest->tax_id;
            $model->purpose = $paymentInstamojoRequest->purpose;
            $model->buyer_name = $paymentInstamojoRequest->buyer_name;
            $model->email = $paymentInstamojoRequest->email;
            $model->phone = $paymentInstamojoRequest->phone;
            $model->amount = $paymentInstamojoRequest->amount;
            $model->amount_without_tax = $paymentInstamojoRequest->amount_without_tax;
            $model->amount_charged = $paymentInstamojoRequest->amount_charged;

            $model->booking_fees = $cor->category->booking_fees;
            $model->course_fees = $cor->total_fees;
            $model->course_discount_percentage     = $cor->discount;
            $model->course_discount_rupees = round(($cor->total_fees * $cor->discount) / 100, 2);
            $model->invoice_number = "SPHERION/SB/" . date('y') . '/' . sprintf('%06d', ($maxid + 1));
            $model->location = $paymentInstamojoRequest->location;
            $model->booking_date = \Carbon\Carbon::now()->format('Y-m-d');
            $model->is_refund = $paymentInstamojoRequest->is_refund;
            $model->refund_reason = $paymentInstamojoRequest->refund_reason;
            $model->save();
        }
    }
}
