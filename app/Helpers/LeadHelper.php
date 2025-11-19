<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class LeadHelper
{

    const POST_LEAD_URL = "https://app.spherionsolutions.com/public/api/post_leads";

    public static function returnResponse($response)
    {
        return $response->object();
    }

    public static function getContactLead($contact)
    {

        $response = Http::acceptJson()->withHeaders([
            'Authorization' => 'qPGvS5VDCLxIJvgdMnzxUZkLYWehgFfqRszFr68QXfpCkiRlGA',
        ])->post(SELF::POST_LEAD_URL, [
            'name' => $contact->name,
            'email' => $contact->email,
            'phone' => $contact->phone,
            'api_scope' => "contact",
            'project_alias' => "bridge",
            'additional_fields' => [
                [
                    'field_label' => 'type',
                    'field_value' => $contact->type,
                ],
                [
                    'field_label' => 'message',
                    'field_value' => $contact->message,
                ],
            ],
        ]);

        return self::returnResponse($response);
    }

    public static function getEnrollLead($contact)
    {
        $response = Http::acceptJson()->withHeaders([
            'Authorization' => 'MomQ3vNfWhr9OsAU9hJ9No0KyEvl51npJSw3DvwLZqXG92UTTn',
        ])->post(SELF::POST_LEAD_URL, [
            'name' => $contact->name,
            'email' => $contact->email,
            'phone' => $contact->phone,
            'api_scope' => "enroll",
            'project_alias' => "bridge",
            'additional_fields' => [
                [
                    'field_label' => 'institute',
                    'field_value' => $contact->institute,
                ],
                [
                    'field_label' => 'city',
                    'field_value' => $contact->city,
                ],
            ],

        ]);
        return self::returnResponse($response);

    }
}


