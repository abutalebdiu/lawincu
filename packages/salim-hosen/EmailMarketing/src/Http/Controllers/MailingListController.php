<?php


namespace SalimHosen\EmailMarketing\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\EmailMarketing\Http\Requests\MailingList\StoreMailingListRequest;
use SalimHosen\EmailMarketing\Http\Requests\MailingList\UpdateMailingListRequest;
use SalimHosen\EmailMarketing\Models\MailingList;
use SalimHosen\Core\Models\Contact;
use SalimHosen\EmailMarketing\Models\Folder;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MailingListController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        abort_if(Gate::denies('access_mailing_list'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $lists = MailingList::where('mailing_list_id', null)->where("company_id", getCompanyId())->get();
        return view("emailmarketing::mailing-list.index", compact("lists"));
    }


    public function create()
    {
        abort_if(Gate::denies('create_mailing_list'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $main_lists = MailingList::where('mailing_list_id', null)
                        ->where("company_id", getCompanyId())->get();
        return view("emailmarketing::mailing-list.create", compact("main_lists"));
    }


    public function store(StoreMailingListRequest $request)
    {
        abort_if(Gate::denies('create_mailing_list'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $config = \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', env("SENDINBLUE_API_KEY"));

        $apiInstance = new \SendinBlue\Client\Api\ContactsApi(
            new \GuzzleHttp\Client(),
            $config
        );

        $createList = new \SendinBlue\Client\Model\CreateList();
        $createList['name'] = $request->list_name;
        $createList['folderId'] = 30;

        try {
            $result = $apiInstance->createList($createList);
            $mailingList = MailingList::create([
                "name" => $request->list_name,
                "company_id" => getCompanyId(),
                "mailing_list_id" => $request->main_list,
                "api_data" => json_encode(["id" => $result['id']])
            ]);

            return redirect()->route("mailing-lists.index")->with("success", __("Created Successfully"));


        } catch (Exception $e) {
            echo 'Exception when calling ContactsApi->createList: ', $e->getMessage(), PHP_EOL;
        }

    }


    public function show(MailingList $mailingList)
    {
        abort_if(Gate::denies('access_mailing_list'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if(request("q")){
            $contacts = $contacts = $mailingList->contacts()
                ->where("name", "like", "%".request()->q."%")
                ->orWhere("email", "like", "%".request()->q."%")
                ->orWhere("phone", "like", "%".request()->q."%")
                ->orWhere("mobile", "like", "%".request()->q."%")
                ->orWhere("fax", "like", "%".request()->q."%")
                ->orWhere("city", "like", "%".request()->q."%")
                ->orWhere("website", "like", "%".request()->q."%")
                ->orWhere("tags", "like", "%".request()->q."%")
                ->orWhere("notes", "like", "%".request()->q."%")
                ->orWhere("contact_type", "like", "%".request()->q."%")
                ->orWhere("title", "like", "%".request()->q."%")
                ->orWhere("gender", "like", "%".request()->q."%")
                ->orWhere("nationality", "like", "%".request()->q."%")
                ->paginate(50)->appends(request()->except('page'));
        }else{
            $contacts = $mailingList->contacts()->paginate(50)->appends(request()->except('page'));
        }
        return view("emailmarketing::mailing-list.show", compact("mailingList", "contacts"));
    }


    public function edit(MailingList $mailingList)
    {
        abort_if(Gate::denies('edit_mailing_list'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $main_lists = MailingList::where('mailing_list_id', null)->where("company_id", getCompanyId())->get();
        return view("emailmarketing::mailing-list.edit", compact("mailingList","main_lists"));
    }


    public function update(UpdateMailingListRequest $request, MailingList $mailingList)
    {
        abort_if(Gate::denies('edit_mailing_list'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $config = \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', env("SENDINBLUE_API_KEY"));

        $apiInstance = new \SendinBlue\Client\Api\ContactsApi(
            new \GuzzleHttp\Client(),
            $config
        );

        $updateList = new \SendinBlue\Client\Model\UpdateList();
        $updateList['name'] = $request->list_name;

        try {

            $api_data = json_decode($mailingList->api_data);
            $apiInstance->updateList($api_data->id, $updateList);

            $mailingList->update([
                "name" => $request->list_name,
                "mailing_list_id" => $request->main_list
            ]);

            return redirect()->route("mailing-lists.index")->with("success", __("Created Successfully"));

        } catch (Exception $e) {
            echo 'Exception when calling ContactsApi->updateList: ', $e->getMessage(), PHP_EOL;
        }

    }


    public function destroy(MailingList $mailingList)
    {
        abort_if(Gate::denies('delete_mailing_list'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $config = \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', env("SENDINBLUE_API_KEY"));

        $apiInstance = new \SendinBlue\Client\Api\ContactsApi(
            new \GuzzleHttp\Client(),
            $config
        );
        $listId = 1;

        try {

            $api_data = json_decode($mailingList->api_data);

            $apiInstance->deleteList($api_data->id);

            $mailingList->delete();
            return redirect()->route('mailing-lists.index')->with("success", __("Deleted Successfully"));

        } catch (Exception $e) {
            echo 'Exception when calling ContactsApi->deleteList: ', $e->getMessage(), PHP_EOL;
        }


    }
}
