<?php

namespace App\Helpers;

use App\Models\SmsLog;
use PhpParser\Node\Stmt\Static_;

class SmsHelper
{

    const USER_ID = "Spherion";
    const PASSWORD = "yuxc9509YU";
    const SENDER_ID = "SKOBRG";
    const ENTITY_ID = 1201161891910470181;
    const DOMAIN = "https://skoodosbridge.com";
    const BITLY_DOMAIN = "https://skoodosbridge.com";
    const SALES_CONTACT = "8377838895";


    private static function createlog($phone, $msg, $template_id, $status, $response)
    {
        return  SmsLog::create([
            'user_id' => SELF::USER_ID,
            'password' => SELF::PASSWORD,
            'sender_id' => SELF::SENDER_ID,
            'phone_no' => $phone,
            'msg' => $msg,
            'entity_id' => SELF::ENTITY_ID,
            'template_id' => $template_id,
            'response' => $response,
            'status' => $status,
        ]);
    }

    public static function sendsms($phone, $Msg, $TemplateID)
    {
        $ch = '';
        $url = 'http://allsms.org/api/SmsApi/SendSingleApi?UserID=' . self::USER_ID . '&Password=' . SELF::PASSWORD . '&SenderID=' . SELF::SENDER_ID . '&Phno=' . $phone . '&Msg=' . urlencode($Msg) . '&EntityID=' . SELF::ENTITY_ID . '&TemplateID=' . $TemplateID;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($output);
        $status = false;
        if (strtolower($response->Status ?? '') == "ok") {
            $status = true;
        }

        return SELF::createlog($phone, $Msg, $TemplateID, $status, $output);
        // return $output;
    }


    public static function userRegistration($phone, $name, $password)
    {
        $temId = "1707166366573596815";
        $name = strlen($name) > 25 ? (substr($name, 0, 25) . '...') : $name;
        $msg = "Dear " . $name . ", thanks for registering at " . SELF::DOMAIN . " Use your password " . $password . " to access your account Spherion Solutions";
        return self::sendsms($phone, $msg, $temId);
    }

    public static function userFetchPassword($phone, $name, $password)
    {
        $temId = "1707166366587676835";
        $name = strlen($name) > 25 ? (substr($name, 0, 25) . '...') : $name;
        $msg = "Dear " . $name . ", use your password " . $password . " to login at " . SELF::DOMAIN . " Spherion Solutions";
        return self::sendsms($phone, $msg, $temId);
    }

    public static function loginWithOtp($phone, $name, $otp)
    {
        $temId = "1707166366544132746";
        $name = strlen($name) > 25 ? (substr($name, 0, 25) . '...') : $name;
        $msg = "Dear " . $name . ", use the OTP " . $otp . " to login at " . SELF::DOMAIN . " Spherion Solutions";
        return self::sendsms($phone, $msg, $temId);
    }

    public static function vendorCredentialSend($phone, $instituteName, $username, $password)
    {
        $temId = "1707166366608012063";
        $instituteName = strlen($instituteName) > 25 ? (substr($instituteName, 0, 25) . '...') : $instituteName;
        $url = SELF::short_url(SELF::DOMAIN . "/institutes/loginvendor");
        $msg = "Dear " . $instituteName . ", use your username " . $username . " and password " . $password . " to manage your profile at " . $url . " Spherion Solutions";
        return self::sendsms($phone, $msg, $temId);
    }


    public static function subscriptionRenewal($phone, $instituteName, $period, $expiredOn)
    {
        $temId = "1707166809798572934";
        $instituteName = strlen($instituteName) > 25 ? (substr($instituteName, 0, 25) . '...') : $instituteName;
        $action = "renewed";
        $actionDate = \Carbon\Carbon::now()->format('d M Y');
        $msg = "Dear " . $instituteName . ", your account at " . SELF::DOMAIN . " has been " . $action . " on " . $actionDate . " for " . $period . ". Your subscription would now expire on " . $expiredOn . ". Spherion Solutions";
        return self::sendsms($phone, $msg, $temId);
    }

    // public static function short_url($long_url)
    // {
    //     $api_url = "https://api-ssl.bitly.com/v4/bitlinks";
    //     $token = "fe22c16f3f8aa75e0a21f4934b3ebea6701b6906";
    //     $ch = curl_init($api_url);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["long_url" => $long_url]));
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, [
    //         "Authorization: Bearer $token",
    //         "Content-Type: application/json"
    //     ]);

    //     $arr_result = json_decode(curl_exec($ch));
    //     return  $arr_result->link;
    // }


    public static function short_url($long_url)
    {
        $api_url = "https://api.tinyurl.com/create";
        $token = "1xsQPiOnDHx9Gjd3gt13kyWEW0TAlhuhUgdjerT4mNnpYbAZqOVNDsMbXg3h";
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["url" => $long_url]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $token",
            "accept: application/json",
            "Content-Type: application/json"
        ]);

        $arr_result = json_decode(curl_exec($ch));
        if (isset($arr_result->data->tiny_url)) {
            return  $arr_result->data->tiny_url;
        } else {
            return $long_url;
        }
    }

    public static function instituteAbouttoExpire($phone, $instituteName, $beforedate)
    {
        $temId = "1707166809820323986";
        $instituteName = strlen($instituteName) > 25 ? (substr($instituteName, 0, 25) . '...') : $instituteName;
        $msg = "Dear " . $instituteName . ", your account at " . SELF::DOMAIN . " is about to expire in " . $beforedate . ". Please call at " . SELF::SALES_CONTACT . " to renew the subscription. Spherion Solutions";
        return self::sendsms($phone, $msg, $temId);
    }

    public static function instituteExpired($phone, $instituteName, $onDate)
    {
        $temId = "1707166809804434082";
        $instituteName = strlen($instituteName) > 25 ? (substr($instituteName, 0, 25) . '...') : $instituteName;
        $action = "expired";
        $actionStatus = "renew";
        $msg = "Dear " . $instituteName . ", your account at " . SELF::DOMAIN . " has " . $action . " on " . $onDate . ". Please call at " . SELF::SALES_CONTACT . " to " . $actionStatus . " the subscription. Spherion Solutions";
        return self::sendsms($phone, $msg, $temId);
    }
    // $msg ="Dear {#var#}, your account at {#var#} has {#var#} on {#var#}. Please call at {#var#} to {#var#} your subscription. Spherion Solutions";

    // public static function institutePostExpire($phone, $instituteName, $afterdate)
    // {
    //     $temId = "1707166809804434082";
    //     $action = "expired";
    //     $actionRenew = "renew";
    //     $msg = "Dear ".$instituteName.", your account at ".SELF::DOMAIN." has ".$action." on ".$afterdate.". Please call at ".SELF::SALES_CONTACT." to ".$actionRenew." your subscription. Spherion Solutions";
    //     return self::sendsms($phone, $msg, $temId);
    // }

    public static function instituteSuspended($phone, $instituteName, $onDate)
    {
        $temId = "1707166809804434082";
        $instituteName = strlen($instituteName) > 25 ? (substr($instituteName, 0, 25) . '...') : $instituteName;
        $action = "been suspended";
        $actionStatus = "activate";
        $msg = "Dear " . $instituteName . ", your account at " . SELF::DOMAIN . " has " . $action . " on " . $onDate . ". Please call at " . SELF::SALES_CONTACT . " to " . $actionStatus . " your subscription. Spherion Solutions";
        return self::sendsms($phone, $msg, $temId);
    }

    public static function instituteLead($phone, $instituteName, $username)
    {
        $temId = "1707166366454008224";
        $instituteName = strlen($instituteName) > 25 ? (substr($instituteName, 0, 25) . '...') : $instituteName;
        $user = strlen($username) > 25 ? (substr($username, 0, 25) . '...') : $username;
        $msg = "Dear " . $instituteName . ", you have a new lead from " . $user . ". Access your admin panel now! Spherion Solutions";
        return self::sendsms($phone, $msg, $temId);
    }


    public static function instituteReviewed($phone, $instituteName, $username, $rating)
    {
        $temId = "1707166860850841541";
        $instituteName = strlen($instituteName) > 25 ? (substr($instituteName, 0, 25) . '...') : $instituteName;
        $user = strlen($username) > 25 ? (substr($username, 0, 25) . '...') : $username;
        $domain = self::DOMAIN;
        $msg = "Dear Vendor: " . $instituteName . ", your business listing on " . $domain . " has been rated " . $rating . " by the user: " . $username . " Spherion Solutions";
        return self::sendsms($phone, $msg, $temId);
    }


    public static function UserAssignInternalRole($username, $roleName, $project = "Skoodos Bridge", $phone, $password)
    {
        $temId = "1707167230047676675";
        $project = strlen($project) > 25 ? (substr($project, 0, 25) . '...') : $project;
        $user = strlen($username) > 25 ? (substr($username, 0, 25) . '...') : $username;
        $url = SELF::short_url(SELF::DOMAIN . "/institutes/loginvendor");
        $msg = "Dear Admin User: " . $user . ", you have been assigned a Role: " . $roleName . " for the Project: " . $project . ". Your Login: " . $phone . " Password: " . $password . " URL: " . $url . " Spherion Solutions";
        return self::sendsms($phone, $msg, $temId);
    }


    public static function instituteActivate($phone, $instituteName, $onDate)
    {
        $temId = "1707167230053236333";
        $instituteName = strlen($instituteName) > 25 ? (substr($instituteName, 0, 25) . '...') : $instituteName;
        $actionStatus = "Reactivated";
        $project = "Skoodos Bridge";
        $msg = "Dear Business User: " . $instituteName . ", your account at Project: " . $project . "  has been marked as Status: " . $actionStatus . "  on Date: " . $onDate . " Spherion Solutions";
        return self::sendsms($phone, $msg, $temId);
    }
}
