<?php

namespace App\Helpers;

use App\Models\InstamojoToken;
use App\Models\Institute\Information\Course;
use App\Models\PaymentInstamojoPaymentDetails;
use App\Models\PaymentInstamojoRequest;
use App\Models\PaymentInstamojoResponseRaw;
use App\Models\PaymentMethod;
use App\Models\PaymentMode;
use App\Models\Season;
use App\Models\StudentRegistration;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Modules\Backend\Entities\Tax;
use Illuminate\Support\Facades\Http;

class InstaMojoHelper
{


    public static function pay($name, $email, $phone, $referralCode, $institute_id, $course_id, $student_id, $purpose,  $amount, $sac_code_id = 0, $tax_type_id = 0, $tax_id = 0, $billing_account_id = 0, $location = 0)
    {

        $tx = Tax::where('id', $tax_id)->first();
        $taxpercentage = $tx->percentage;
        $token = self::getToken();
        $amount = Helper::chargeableamount($tax_type_id, $taxpercentage, $amount);
        $amount_without_tax = Helper::amountWithoutTax($tax_type_id, $taxpercentage, $amount);

        return self::CreatePaymentRequest($institute_id, $course_id, $student_id, $purpose, $name, $email, $phone, $referralCode, $amount, $token, $sac_code_id, $tax_type_id, $tax_id, $billing_account_id, $amount_without_tax, $location);
    }


    private static function CreatePaymentRequest($institute_id, $course_id, $student_id, $purpose, $name, $email, $phone, $referralCode, $amount, $token, $sac_code_id, $tax_type_id, $tax_id, $billing_account_id, $amount_without_tax, $location)
    {

        $cor =  Course::where('id', $course_id)->first();


        $model = new PaymentInstamojoRequest();
        $model->institute_id            = $institute_id;
        $model->course_id               = $course_id;
        $model->course_title            = $cor->course_title;
        $model->duration                = $cor->duration;
        $model->course_fees             = $cor->total_fees;
        $model->course_discount         = $cor->discount;
        $model->student_id              = $student_id;
        $model->purpose                 = $purpose;
        $model->buyer_name              = $name;
        $model->email                   = $email;
        $model->phone                   = $phone;
        $model->amount                  = $amount;
        $model->amount_without_tax      = $amount_without_tax;
        $model->amount_charged          = $amount;

       
        $model->sac_code_id             = $sac_code_id;
        $model->tax_type_id             = $tax_type_id;
        $model->tax_id                  = $tax_id;
        $model->billing_account_id      = $billing_account_id;
        $model->referral_code           = $referralCode;
        $model->location                = $location;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('INSTAMOJO_PAYMENT_REQUEST_URL'));
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));

        $payload = array(
            'purpose' => $purpose,
            'amount' => $amount,
            'buyer_name' => $name,
            'email' => $email,
            'phone' => $phone,
            'redirect_url' => route('payment.response'),
            'send_email' => 'false',
            'webhook' => route('payment.webhook'),
            'allow_repeated_payments' => 'False'
        );

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);
        $resp = json_decode($response, true);
        $model->payment_request_id                      = $resp['id'];
        $model->user                                    = $resp['user'];
        $model->payment_status                          = $resp['status'];
        $model->sms_status                              = $resp['sms_status'];
        $model->email_status                            = $resp['email_status'];
        $model->shorturl                                = $resp['shorturl'];
        $model->longurl                                 = $resp['longurl'];
        $model->redirect_url                            = $resp['redirect_url'];
        $model->webhook                                 = $resp['webhook'];
        $model->scheduled_at                            = $resp['scheduled_at'];
        $model->expires_at                              = $resp['expires_at'];
        $model->allow_repeated_payments                 = $resp['allow_repeated_payments'];
        $model->mark_fulfilled                          = $resp['mark_fulfilled'];
        $model->payment_request_created_at              = $resp['created_at'];
        $model->payment_request_modified_at             = $resp['modified_at'];
        $model->resource_uri                            = $resp['resource_uri'];

        $model->save();

        $raw = new PaymentInstamojoResponseRaw();
        $raw->request_id = $model->id;
        $raw->payment_request_id = $resp['id'];
        $raw->response = $response;
        $raw->save();

        return $model->id;
    }

    // private static function getamount($event, $chapter, $season)
    // {
    //     $model =  Season::where(['theme_id' => $event, 'chapter_id' => $chapter, 'season' => $season])->first();
    //     return Helper::chargeableamount($model->tax_type_id, $model->tax->percentage, $model->booking_amount);
    // }

    // private static function amount_without_tax($event, $chapter, $season)
    // {
    //     $model =  Season::where(['theme_id' => $event, 'chapter_id' => $chapter, 'season' => $season])->first();
    //     return Helper::amountWithoutTax($model->tax_type_id, $model->tax->percentage, $model->booking_amount);
    // }


    private static function storeToken($response)
    {
        $resp = json_decode($response, true);
        $model = new InstamojoToken();
        $model->access_token = $resp['access_token'];
        $model->expires_in = $resp['expires_in'];
        $seconds = ($resp['expires_in'] + 1) / 10;
        $model->expires_in_datetime = \Carbon\Carbon::now()->addSeconds($seconds)->format('Y-m-d H:i:s');
        $model->scope = $resp['scope'];
        $model->token_type = $resp['token_type'];
        $model->save();
        return $model->access_token;
    }

    public static function getToken()
    {
        $token = InstamojoToken::where('expires_in_datetime', '>', \Carbon\Carbon::now()->subSeconds(300)->format('Y-m-d H:i:s'))->latest()->first();
        if (empty($token)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, env('INSTAMOJO_ACCESS_TOKEN_URL'));
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

            $payload = array(
                'grant_type' => 'client_credentials',
                'client_id' => env('INSTAMOJO_CLIENT_ID'),
                'client_secret' => env('INSTAMOJO_CLIENT_SECRET')
            );

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
            $response = curl_exec($ch);
            curl_close($ch);
            return SELF::storeToken($response);
        }
        return $token->access_token;
    }


    public static function PaymentDeatils($paymentID)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('INSTAMOJO_PAYMENT_DETAILS_URL') . $paymentID . '/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . SELF::getToken()));

        $response = curl_exec($ch);
        curl_close($ch);

        return Self::paymentResponseCapture($paymentID, $response);
        // return $response;
    }

    private static function storelog($requestId, $response)
    {
        $resp = json_decode($response, true);

        $raw = new PaymentInstamojoResponseRaw();
        $raw->request_id = $requestId;
        $raw->payment_id = isset($resp['id']) ? $resp['id'] : NULL;
        $raw->response = $response;
        $raw->save();
        return;
    }

    public static function paymentResponseCapture($paymentID, $response)
    {
        $resp = json_decode($response, true);

        $model = PaymentInstamojoRequest::where('payment_id', $paymentID)->latest()->first();

        if (isset($resp['id'])) {
            $model->payment_id                  = $resp['id'];
        }
        if (isset($resp['title'])) {
            $model->title                  = $resp['title'];
        }
        if (isset($resp['payment_type'])) {
            $model->payment_type                  = $resp['payment_type'];
        }
        if (isset($resp['payment_request'])) {
            $model->payment_request                  = $resp['payment_request'];
        }
        if (isset($resp['link'])) {
            $model->link                  = $resp['link'];
        }
        if (isset($resp['product'])) {
            $model->product                  = $resp['product'];
        }
        if (isset($resp['seller'])) {
            $model->seller                  = $resp['seller'];
        }
        if (isset($resp['currency'])) {
            $model->currency                  = $resp['currency'];
        }
        if (isset($resp['amount'])) {
            $model->payment_gateway_amount_charged                  = $resp['amount'];
        }
        if (isset($resp['payout'])) {
            $model->payout                  = $resp['payout'];
        }
        if (isset($resp['fees'])) {
            $model->fees                  = $resp['fees'];
        }
        if (isset($resp['total_taxes'])) {
            $model->total_taxes                  = $resp['total_taxes'];
        }
        if (isset($resp['affiliate_id'])) {
            $model->affiliate_id                  = $resp['affiliate_id'];
        }
        if (isset($resp['affiliate_commission'])) {
            $model->affiliate_commission                  = $resp['affiliate_commission'];
        }
        if (isset($resp['instrument_type'])) {
            $model->instrument_type                  = $resp['instrument_type'];
        }
        if (isset($resp['billing_instrument'])) {
            $model->billing_instrument                  = $resp['billing_instrument'];
        }
        if (isset($resp['failure'])) {
            $model->failure                  = $resp['failure'];
        }
        if (isset($resp['created_at'])) {
            $model->payment_order_created_at                  = $resp['created_at'];
        }
        if (isset($resp['updated_at'])) {
            $model->payment_order_created_at                  = $resp['updated_at'];
        }
        if (isset($resp['tax_invoice_id'])) {
            $model->tax_invoice_id                  = $resp['tax_invoice_id'];
        }
        if (isset($resp['resource_uri'])) {
            $model->resource_uri                  = $resp['resource_uri'];
        }
        if (isset($resp['status'])) {
            $model->order_status                  = $resp['status'];
        }
        if (isset($resp['success'])) {
            $model->success                  = $resp['success'];
        }
        if (isset($resp['message'])) {
            $model->message                  = $resp['message'];
        }

        // $model->payment_request             = isset($resp['payment_request']) ? $resp['payment_request'] : NULL;
        // $model->link                        = isset($resp['link']) ? $resp['link'] : NULL;
        // $model->product                     = isset($resp['product']) ? $resp['product'] : NULL;
        // $model->seller                      = isset($resp['seller']) ? $resp['seller'] : NULL;
        // $model->currency                    = isset($resp['currency']) ? $resp['currency'] : NULL;
        // $model->amount                      = isset($resp['amount']) ? $resp['amount'] : NULL;
        // // $model->name                        = isset($resp['name']) ? $resp['name'] : NULL;
        // // $model->email                       = isset($resp['email']) ? $resp['email'] : NULL;
        // // $model->phone                       = isset($resp['phone']) ? $resp['phone'] : NULL;
        // $model->payout                      = isset($resp['payout']) ? $resp['payout'] : NULL;
        $model->fees                        = isset($resp['fees']) ? $resp['fees'] : NULL;
        $model->total_taxes                 = isset($resp['total_taxes']) ? $resp['total_taxes'] : NULL;
        // $model->affiliate_id                = isset($resp['affiliate_id']) ? $resp['affiliate_id'] : NULL;
        // $model->affiliate_commission        = isset($resp['affiliate_commission']) ? $resp['affiliate_commission'] : NULL;
        // $model->instrument_type             = isset($resp['instrument_type']) ? $resp['instrument_type'] : NULL;
        // $model->billing_instrument          = isset($resp['billing_instrument']) ? $resp['billing_instrument'] : NULL;
        // $model->failure                     = isset($resp['failure']) ? $resp['failure'] : NULL;
        // $model->payment_order_created_at          = isset($resp['created_at']) ? $resp['created_at'] : NULL;
        // $model->payment_order_updated_at          = isset($resp['updated_at']) ? $resp['updated_at'] : NULL;

        // $model->tax_invoice_id              = isset($resp['tax_invoice_id']) ? $resp['tax_invoice_id'] : NULL;
        // $model->resource_uri                = isset($resp['resource_uri']) ? $resp['resource_uri'] : NULL;
        // $model->order_status                = isset($resp['status']) ? $resp['status'] : NULL;
        // $model->success                     = isset($resp['success']) ? $resp['success'] : NULL;
        // $model->message                     = isset($resp['message']) ? $resp['message'] : NULL;
        $model->save();

        Self::storelog($model->id, $response);

        // if (isset($resp['status']) && $resp['status'] == true) {
        //     SELF::UserRegisterNow($resp['name'], $resp['email'], substr($resp['phone'], -10), $model);
        // }
        return $model->id;
    }





    public static function refund($payment_Id, $transaction_id, $body, $amount)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('INSTAMOJO_PAYMENT_DETAILS_URL').''. $payment_Id . '/refund/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . SELF::getToken()));


        $payload = array(
            'transaction_id' => $transaction_id,
            'type' => 'TAN',
            // 'body' => 'Need to refund to the buyer.',
            'body' => $body,
            'refund_amount' => $amount
        );

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
        // dd($response);
    }


    public static function getPaymentstatus($payment_request_id)
    {
        $url = env('INSTAMOJO_PAYMENT_DETAILS_URL').''. $payment_request_id . "/";

        

        $response =   Http::withHeaders([
            'Authorization' => 'Bearer ' . SELF::getToken(),
            'accept' => 'application/json',
        ])->get($url);
        return $response->object();
    }
}
