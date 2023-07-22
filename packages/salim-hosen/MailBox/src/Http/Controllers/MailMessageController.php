<?php

namespace SalimHosen\MailBox\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SalimHosen\Core\Models\Company;
use SalimHosen\Core\Models\Country;
use DB;
use Auth;
use SalimHosen\EmailMarketing\Models\Sender;
use SalimHosen\EmailMarketing\Models\Template;
use SalimHosen\Core\Models\State;
use SalimHosen\MailBox\Http\Requests\Company\SendMailMessageRequest;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MailMessageController extends Controller
{

    private $client;

    public function __construct()
    {


        $this->middleware("auth:sanctum");

        $config = \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', env("SENDINBLUE_API_KEY"));

        $this->client = new \SendinBlue\Client\Api\TransactionalEmailsApi(
            new \GuzzleHttp\Client(),
            $config
        );

    }

    public function index(Request $request)
    {

        $senders = Sender::all();
        $templates = Template::all();
        return view('mailbox::mailmessage.create', compact("senders", "templates"));
    }

    public function create()
    {
        $senders = Sender::all();
        return view('company::company.create', compact("senders"));
    }

    public function filterEmails($str){

        $emails = explode(",",$str);
        $filtered = [];
        foreach($emails as $email){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($filtered, [
                    "email" => $email
                ]);
            }
        }
        return $filtered;
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

    public function store(SendMailMessageRequest $request)
    {
        $sender = $this->getSender($request->sender);

        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
        $sendSmtpEmail['subject'] = $request->subject;
        $sendSmtpEmail['htmlContent'] = $request->content;
        // $sendSmtpEmail['sender'] = array(intval($request->sender));
        $sendSmtpEmail['sender'] =  ['email' => $sender['email'], 'name' => $sender['name']];

        $sendSmtpEmail['to'] = $this->filterEmails($request->to);
        $request->cc && $sendSmtpEmail['cc'] = $this->filterEmails($request->cc);
        $request->bcc && $sendSmtpEmail['bcc'] = $this->filterEmails($request->bcc);

        $sendSmtpEmail['replyTo'] = array('email' => $sender['email'], 'name' => $sender['name']);
        $sendSmtpEmail['headers'] = array('Some-Custom-Name' => 'unique-id-1234');
        $sendSmtpEmail['params'] = array('parameter' => 'My param value', 'subject' => 'New Subject');

        $this->client->sendTransacEmail($sendSmtpEmail);

        return redirect()->back()->with("success", __("Sent Successfully"));
    }

    public function show(Company $companies)
    {
        return view('company::company.show', compact('companies'));
    }

    public function edit(Company $company)
    {
        $countries = Country::all();
        $states = State::all();
        return view('company::company.edit', compact('countries', 'company', 'states'));
    }

    public function update(SendMailMessageRequest $request, Company $company)
    {

    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with("success", __("Deleted Successfully"));
    }

    public function setCompany($company_id){
        session()->put("company", $company_id);
        return redirect()->back();
    }
}
