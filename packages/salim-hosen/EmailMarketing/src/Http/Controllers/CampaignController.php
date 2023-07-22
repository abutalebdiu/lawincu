<?php

namespace SalimHosen\EmailMarketing\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\EmailMarketing\Http\Requests\Campaign\StoreCampaignRequest;
use SalimHosen\EmailMarketing\Http\Requests\Campaign\UpdateCampaignRequest;
use SalimHosen\EmailMarketing\Models\Campaign;
use SalimHosen\EmailMarketing\Models\MailingList;
use SalimHosen\EmailMarketing\Models\Sender;
use SalimHosen\EmailMarketing\Models\Template;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class CampaignController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }


    public function index(){
        abort_if(Gate::denies('access_campaign'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $campaigns = Campaign::where("company_id", getCompanyId())->get();

        return view("emailmarketing::campaign.index", compact("campaigns"));
    }

    public function create(){
        abort_if(Gate::denies('create_campaign'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $templates = Template::where("company_id", getCompanyId())->get();
        $senders = Sender::where("company_id", getCompanyId())->get();
        $lists = MailingList::where("company_id", getCompanyId())->get();

        $client = new \SendinBlue\Client\Api\SendersApi(
            new \GuzzleHttp\Client(),
            \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', env("SENDINBLUE_API_KEY"))
        );
        $sb_senders = [];
        foreach($client->getSenders()->getSenders() as $sb){
            if($sb['active'])
            array_push($sb_senders,$sb['email']);
        }

        return view("emailmarketing::campaign.create", compact("templates", "senders", "lists", "sb_senders"));
    }

    public function getSender($id){

        $client = new \SendinBlue\Client\Api\SendersApi(
            new \GuzzleHttp\Client(),
            \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', env("SENDINBLUE_API_KEY"))
        );

        $senders = $client->getSenders()->getSenders();
        $sender = null;
        $s = Sender::find($id);
        foreach ($senders as $sendr) {
            if($sendr['email'] == $s->email) $sender = $sendr;
        }

        return $sender;
    }


    public function store(StoreCampaignRequest $request){

        abort_if(Gate::denies('create_campaign'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try{

            $sender = $this->getSender($request->sender);

            $list_ids = [];
            $exclude_list_ids = [40];
            $mailing_lists = MailingList::where("company_id", getCompanyId())->get();
            foreach ($mailing_lists as $list) {
                $api_data = json_decode($list->api_data);
                if(in_array($list->id, $request->lists)) array_push($list_ids, $api_data->id);
                else array_push($exclude_list_ids, $api_data->id);
            }


            // $list_ids = array_values($request->lists);
            $now = new \DateTime(null, new \DateTimeZone($request->timezone));
            $minutes_to_add = 5;
            $now->add(new \DateInterval('PT' . $minutes_to_add . 'M'));

            $emailCampaigns = new \SendinBlue\Client\Model\CreateEmailCampaign();
            $emailCampaigns['tag'] = 'myTag';
            $emailCampaigns['sender'] =  array('name' => $sender['name'], 'email' =>  $sender['email']);
            $emailCampaigns['name'] = $request->name;
            // $emailCampaigns['templateId'] = 1;
            $emailCampaigns['htmlContent'] = $request->content;
            $emailCampaigns['scheduledAt'] = $now;
            $emailCampaigns['subject'] = $request->subject;
            $emailCampaigns['replyTo'] = $sender['email'];
            $emailCampaigns['toField'] = '{{contact.FIRSTNAME}} {{contact.LASTNAME}}';
            $emailCampaigns['recipients'] =  array(
                'listIds' => $list_ids, 'exclusionListIds' => $exclude_list_ids
            );
            // $emailCampaigns['attachmentUrl'] = 'https://sponsorsincu.com/';
            $emailCampaigns['inlineImageActivation'] = false;
            $emailCampaigns['mirrorActive'] = false;
            $emailCampaigns['recurring'] = false;
            $emailCampaigns['type'] = 'classic';
            $emailCampaigns['header'] = 'If you are not able to see this mail, click {here}';
            $emailCampaigns['footer'] = 'If you wish to unsubscribe from our newsletter, click {here}';
            $emailCampaigns['utmCampaign'] = 'My utm campaign value';
            $emailCampaigns['params'] = array('PARAMETER' => 'My param value', 'ADDRESS' => 'Seattle, WA', 'SUBJECT' => 'New Subject');

            $client = new \SendinBlue\Client\Api\EmailCampaignsApi(
                new \GuzzleHttp\Client(),
                \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', env("SENDINBLUE_API_KEY"))
            );

            $client->createEmailCampaign($emailCampaigns);

            Campaign::create([
                "company_id" => getCompanyId(),
                "name" => $request->name,
                "subject" => $request->subject,
                "from_name" => $sender['name'],
                "from_email" => $sender['email'],
                "reply_to" => $sender['email'],
                "content" => $request->content,
                "recipients" => json_encode($list_ids)
            ]);

            return redirect()->route("campaigns.index")->with("success", __("Sent Successfully"));

        }catch(\Exception $e){
            throw $e;
        }
    }

    // public function store(StoreCampaignRequest $request){
    //     abort_if(Gate::denies('create_campaign'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    //     try{

    //         $sender = $this->getSender($request->sender);


    //         $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
    //         $sendSmtpEmail['subject'] = $request->subject;
    //         $sendSmtpEmail['htmlContent'] = $request->content;
    //         // $sendSmtpEmail['sender'] = array(intval($request->sender));
    //         $sendSmtpEmail['sender'] =  ['email' => $sender['email'], 'name' => $sender['name']];

    //         $emails = [];
    //         $mailing_lists = MailingList::whereIn("id", $request->lists)->where("company_id", getCompanyId())->get();
    //         foreach ($mailing_lists as $list) {
    //             foreach($list->contacts as $contact){
    //                 if($contact->email && filter_var($contact->email, FILTER_VALIDATE_EMAIL)){
    //                     array_push($emails, [
    //                         "name" => $contact->name,
    //                         "email" => $contact->email
    //                     ]);
    //                 }
    //             }
    //         }

    //         $sendSmtpEmail['to'] = $emails;

    //         $sendSmtpEmail['replyTo'] = array('email' => $sender['email'], 'name' => $sender['name']);
    //         $sendSmtpEmail['headers'] = array('Some-Custom-Name' => 'unique-id-1234');
    //         $sendSmtpEmail['params'] = array('parameter' => 'My param value', 'subject' => 'New Subject');

    //         $client = new \SendinBlue\Client\Api\TransactionalEmailsApi(
    //             new \GuzzleHttp\Client(),
    //             \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', env("SENDINBLUE_API_KEY"))
    //         );
    //         $client->sendTransacEmail($sendSmtpEmail);

    //         Campaign::create([
    //             "company_id" => getCompanyId(),
    //             "name" => $request->name,
    //             "subject" => $request->subject,
    //             "mailing_list",
    //             "from_name" => $sender['name'],
    //             "from_email" => $sender['email'],
    //             "reply_to" => $sender['email'],
    //             "content" => $request->content,
    //             "recipients" => json_encode(array_column($emails, 'email'))
    //         ]);

    //         return redirect()->route("campaigns.index")->with("success", __("Sent Successfully"));

    //     }catch(\Exception $e){
    //         throw $e;
    //     }
    // }


    public function show(Campaign $campaign){
        abort_if(Gate::denies('access_campaign'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view("emailmarketing::campaign.show", compact("campaign"));

    }

    public function edit(Campaign $campaign){
        abort_if(Gate::denies('edit_campaign'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view("emailmarketing::campaign.edit", compact("campaign"));

    }

    public function update(UpdateCampaignRequest $request, Campaign $campaign){



    }

    public function destroy(Campaign $campaign){
        abort_if(Gate::denies('delete_campaign'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $campaign->delete();
        return redirect()->route("campaigns.index")->with("success", __("Deleted Successfully"));

    }
}
