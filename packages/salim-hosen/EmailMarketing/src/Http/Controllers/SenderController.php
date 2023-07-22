<?php


namespace SalimHosen\EmailMarketing\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\EmailMarketing\Http\Requests\Sender\StoreSenderRequest;
use SalimHosen\EmailMarketing\Http\Requests\Sender\UpdateSenderRequest;
use SalimHosen\EmailMarketing\Models\Sender;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class SenderController extends Controller
{

    private $client;

    public function __construct()
    {
        $this->middleware("auth:sanctum");


        $config = \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', env("SENDINBLUE_API_KEY"));

        $this->client = new \SendinBlue\Client\Api\SendersApi(
            new \GuzzleHttp\Client(),
            $config
        );

    }

    public function index(){
        abort_if(Gate::denies('access_sender'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $senders = Sender::where("company_id", getCompanyId())->get();
        $sb_senders = [];
        foreach($this->client->getSenders()->getSenders() as $sb){
            if($sb['active'])
            array_push($sb_senders,$sb['email']);
        }
        return view("emailmarketing::senders.index", compact("senders", "sb_senders"));

    }

    public function create(){
        abort_if(Gate::denies('create_sender'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view("emailmarketing::senders.create");

    }


    public function store(StoreSenderRequest $request){

        abort_if(Gate::denies('create_sender'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $createSender = new \SendinBlue\Client\Model\CreateSender();
        $createSender['name'] = $request->name;
        $createSender['email'] = $request->email;
        $this->client->createSender($createSender);

        Sender::create([
            "name" => $request->name,
            "email" => $request->email,
            "company_id" => getCompanyId()
        ]);

        return redirect()->route("senders.index")->with("success", __("Created Successfully"));

    }

    public function edit(Sender $sender){
        abort_if(Gate::denies('edit_sender'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view("emailmarketing::senders.edit", compact("sender"));

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

    public function update(UpdateSenderRequest $request, Sender $sender){
        abort_if(Gate::denies('edit_sender'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $updateSender = new \SendinBlue\Client\Model\UpdateSender();
        $updateSender['name'] = $request->name;
        $updateSender['email'] = $request->email;

        $s = $this->getSender($sender->id);
        $this->client->updateSender($s['id'], $updateSender);

        $sender->update([
            "name" => $request->name,
            "email" => $request->email
        ]);

        return redirect()->route("senders.index")->with("success", __("Update Successfully"));

    }

    public function destroy(Sender $sender){
        abort_if(Gate::denies('delete_sender'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $sender->delete();
        return redirect()->route("senders.index")->with("success", __("Deleted Successfully"));

    }
}
