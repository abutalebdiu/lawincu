<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use SalimHosen\Core\Models\Contact;
use SalimHosen\Core\Imports\BulkImport;
use SalimHosen\EmailMarketing\Models\MailingList;
use Validator;
use DB;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class BulkUploadController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function processBulkImport(Request $request)
    {
        DB::beginTransaction();
        try {

            $filename = $request->input('filename', false);
            $path     = storage_path('app/bulk_import/' . $filename);

            $fields = $request->input('fields', false);
            $model = $request->input('modelName', false);

            // check if has header
            $hasHeader = $request->input('hasHeader', false);
            $contents = Excel::toArray(new BulkImport(), $path);

            $batch_id = Str::random(16);

            $rows   = [];
            $i = $hasHeader ? 1 : 0;

            $additional_data = json_decode($request->additional_data, true);

            for($j = $i; $j < count($contents[0]); $j++){
                $r = [];
                foreach ($fields as $k => $field) {
                    if($field)
                        $r[$field] = $contents[0][$j][$k];
                }
                $r["company_id"] = getCompanyId();
                $r["batch_id"] = $batch_id;
                // $r['contact_type'] = $request->redirect == "contacts.index" ? 1 : 0;

                array_push($rows, array_merge($r, $additional_data));
            }

            $for_insert = array_chunk($rows, 100);
            foreach ($for_insert as $insert_item) {
                $model::insert($insert_item);
            }


            // if($request->mailing_list){
            //     $mailing_list = MailingList::find($request->mailing_list);
            //     $contacts = Contact::where('batch_id', $batch_id)->pluck("id");
            //     $mailing_list->contacts()->attach($contacts);
            // }

            DB::commit();
            File::delete($path);
            session()->flash('success', __("Imported Successfully"));
            return redirect($request->input('redirect')."?batch_id=".$batch_id);

        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    public function parseBulkImport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'mimes:csv,xls,xlsx',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with("error", $validator->errors()->first());
        }

        // check if has header
        $hasHeader = $request->input('header', false) ? true : false;
        $contents = Excel::toArray(new BulkImport(), request()->file('file'));

        // populate headers and rows
        $headers = [];
        $rows   = [];

        foreach ($contents[0][0] as $value) {
            array_push($headers, $value);
        }

        $i = $hasHeader ? 1 : 0;
        for($j = $i; $j < count($contents[0]); $j++){
            array_push($rows, $contents[0][$j]);
        }

        // save file for future use
        $file = $request->file("file");

        $filename = Str::random(10) .".".$file->getClientOriginalExtension();
        $file->storeAs('bulk_import', $filename);

        // get fillables
        $modelName = $request->input('model', false);
        $model     = new $modelName();
        $fillables = $model->getFillable();

        $redirect = $request->redirect_url;
        $routeName = $request->post_route;
        $additional_data = $request->additional_data;

        return view('core::bulkImport.parseInput', compact('headers', 'filename', 'fillables', 'hasHeader', 'modelName', 'rows', 'redirect', 'routeName', 'additional_data'));
    }


}
