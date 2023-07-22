<?php

namespace SalimHosen\Core\Http\Traits;

use SalimHosen\Core\Models\Contact;
use SalimHosen\EmailMarketing\Models\MailingList;

trait SendinBlueTrait
{

    public function getSbContacts($limit = 50, $offset = 0){
        $config = \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', env('SENDINBLUE_API_KEY'));

        $apiInstance = new \SendinBlue\Client\Api\ContactsApi(
            new \GuzzleHttp\Client(),
            $config
        );

        $result = $apiInstance->getContacts($limit, $offset);
        return $result;
    }


    public function storeSbContact($email){

        // $contact = $this->getSbContact($email);
        // if($contact) return;

        $config = \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', env('SENDINBLUE_API_KEY'));

        $apiInstance = new \SendinBlue\Client\Api\ContactsApi(
            new \GuzzleHttp\Client(),
            $config
        );
        $createContact = new \SendinBlue\Client\Model\CreateContact(); // Values to create a contact
        $createContact['email'] = $email;

        $mailing_lists = MailingList::whereIn("id", request()->mailing_lists)->get();
        $lists_ids = [];

        foreach ($mailing_lists as $ml) {
            $api_data = json_decode($ml->api_data);
            array_push($lists_ids, $api_data->id);
        }

        $createContact['listIds'] = $lists_ids;


        try {
            $result = $apiInstance->createContact($createContact);
            return $result;
        } catch (\Exception $e) {
            return null;
        }

    }

    public function getSbContact($email){

        $config = \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', env('SENDINBLUE_API_KEY'));

        $apiInstance = new \SendinBlue\Client\Api\ContactsApi(
            new \GuzzleHttp\Client(),
            $config
        );

        $identifier = $email;

        try {
            $result = $apiInstance->getContactInfo($identifier);
            return $result;
        } catch (\Exception $e) {
            return null;
        }

    }


    public function updateSbContact($email){

        $contact = $this->getSbContact($email);

        if($contact){
            $config = \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', env('SENDINBLUE_API_KEY'));

            $apiInstance = new \SendinBlue\Client\Api\ContactsApi(
                new \GuzzleHttp\Client(),
                $config
            );
            $identifier = $email;

            $updateContact = new \SendinBlue\Client\Model\UpdateContact();
            $mailing_lists = MailingList::whereIn("id", request()->mailing_lists)->get();
            $lists_ids = [];

            foreach ($mailing_lists as $ml) {
                $api_data = json_decode($ml->api_data);
                array_push($lists_ids, $api_data->id);
            }

            $updateContact['listIds'] = $lists_ids;
            $updateContact['attributes'] = array('EMAIL'=> $email);

            $apiInstance->updateContact($identifier, $updateContact);
        }else{
            $this->storeSbContact($email);
        }

    }

    public function deleteSbContact($email){

        $contact = $this->getSbContact($email);

        if($contact){

            $config = \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', env('SENDINBLUE_API_KEY'));

            $apiInstance = new \SendinBlue\Client\Api\ContactsApi(
                new \GuzzleHttp\Client(),
                $config
            );
            $identifier = $email;

            $apiInstance->deleteContact($identifier);

        }

    }


    public function sbBatchInsert($mailing_list, $batch_id){

        $contacts = Contact::where("batch_id", $batch_id)->get();
        $mailing_list = MailingList::findOrFail(request('mailing_list'))->first();
        $api_data = json_decode($mailing_list->api_data);

        $config = \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', env('SENDINBLUE_API_KEY'));

        $apiInstance = new \SendinBlue\Client\Api\ContactsApi(
            new \GuzzleHttp\Client(),
            $config
        );
        $requestContactImport = new \SendinBlue\Client\Model\RequestContactImport();

        // NAME;SURNAME;EMAILSmith;John;john.smith@example.comRoger;Ellie;ellie36@example.com
        $body = "EMAIL\n";
        foreach($contacts as $contact){
            if($contact->email){
                $body .= $contact->email."\n";
            }
        }

        $requestContactImport['fileBody'] = $body;
        $requestContactImport['listIds'] = [$api_data->id];
        $requestContactImport['emailBlacklist'] = false;
        $requestContactImport['smsBlacklist'] = false;
        $requestContactImport['updateExistingContacts'] = true;
        $requestContactImport['emptyContactsAttributes'] = false;

        try {
            $result = $apiInstance->importContacts($requestContactImport);
            return $result;
        } catch (\Exception $e) {
            return null;
        }

    }
}
