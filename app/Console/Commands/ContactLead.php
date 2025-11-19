<?php

namespace App\Console\Commands;

use App\Helpers\LeadHelper;
use App\Models\Contact;
use App\Models\EnrollContact;
use App\Models\InstituteContact;
use Illuminate\Console\Command;

class ContactLead extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Contact:Lead';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'to fetch data from  db then send to api';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $contacts  = Contact::where('api_status', false)->limit(30)->get();


        foreach ($contacts as $contact) {
            $response = LeadHelper::getContactLead($contact);
            \Log::channel('lead')->info('Lead Helper : ' . json_encode($response));
            $res = json_decode(json_encode($response), true);

            Contact::where('id', $contact->id)->update([
                'api_status' => isset($res['status']) ? $res['status'] : 0,
                'api_message' => isset($res['message']) ? $res['message'] : NUll,
            ]);
        }




        return Command::SUCCESS;
    }
}
