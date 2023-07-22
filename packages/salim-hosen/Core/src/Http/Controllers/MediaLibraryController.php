<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SalimHosen\Core\Http\Requests\MediaUpload\StoreMediaUploadRequest;
use SalimHosen\Core\Models\MediaUpload;
use Image;
use Auth;
use File;
use DB;
use Gate;
use SalimHosen\Core\Http\Resources\MediaLibraryResource;
use Symfony\Component\HttpFoundation\Response;

class MediaLibraryController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index(Request $request){

        // abort_if(Gate::denies('access_media_library'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $per_page = $request->per_page ?? 20;

        if($request->q){
            $uploads = MediaUpload::orderBy("created_at", "desc")->where("company_id", getCompanyId())
                ->where("file_name", "like", "%$request->q%")
                ->orWhere("original_name", "like", "%$request->q%")
                ->orWhere("file_type", "like", "%$request->q%")
                ->paginate($per_page);
        }else{
            $uploads = MediaUpload::orderBy("created_at", "desc")->where("company_id", getCompanyId())->paginate($per_page);
        }

        if($request->wantsJson()){
            return MediaLibraryResource::collection($uploads);
        }

        return view("core::media_upload.index", compact("uploads"));
    }

    public function create(){
        return view("core::media_upload.create");
    }

    public function store(StoreMediaUploadRequest $request){

        $type = array(
            "jpg"=>"image",
            "jpeg"=>"image",
            "png"=>"image",
            "svg"=>"image",
            "webp"=>"image",
            "gif"=>"image",
            "mp4"=>"video",
            "mpg"=>"video",
            "mpeg"=>"video",
            "webm"=>"video",
            "ogg"=>"video",
            "avi"=>"video",
            "mov"=>"video",
            "flv"=>"video",
            "swf"=>"video",
            "mkv"=>"video",
            "wmv"=>"video",
            "wma"=>"audio",
            "aac"=>"audio",
            "wav"=>"audio",
            "mp3"=>"audio",
            "zip"=>"archive",
            "rar"=>"archive",
            "7z"=>"archive",
            "doc"=>"document",
            "txt"=>"document",
            "docx"=>"document",
            "pdf"=>"document",
            "csv"=>"document",
            "xml"=>"document",
            "ods"=>"document",
            "xlr"=>"document",
            "xls"=>"document",
            "xlsx"=>"document"
        );

        if($request->hasFile('chosen_file')){

            $upload = new MediaUpload();
            $extension = strtolower($request->file('chosen_file')->getClientOriginalExtension());

            if(isset($type[$extension])){

                $upload->original_name = null;

                $parts = explode('.', $request->file('chosen_file')->getClientOriginalName());
                array_pop($parts);
                $upload->original_name = implode("", $parts);

                $path = $request->file('chosen_file')->store('uploads/all', 'local');

                $size = $request->file('chosen_file')->getSize();

                if($type[$extension] == 'image'){

                    try {

                        $img = Image::make($request->file('chosen_file')->getRealPath())->encode();

                        $height = $img->height();
                        $width = $img->width();

                        if($width > $height && $width > 1500){

                            $img->resize(1500, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });

                        }elseif ($height > 1500) {

                            $img->resize(null, 800, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }

                        $location = public_path('uploads/all');
                        File::isDirectory($location) or File::makeDirectory($location, 0777, true, true);

                        $img->save(public_path($path));
                        clearstatcache();
                        $size = $img->filesize();

                    } catch (\Exception $e) {
                        //dd($e);
                    }
                }


                // $upload->extension = $extension;
                $filename = explode("/", $path);

                $upload->file_name = end($filename);
                $upload->user_id = Auth::user()->id;
                $upload->company_id = getCompanyId();
                $upload->file_type = $type[$extension];
                $upload->file_size = $size;
                $upload->save();
            }
            return '{}';
        }

    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try{
            $media = MediaUpload::where("id", $id)->where("user_id", Auth::user()->id)->first();
            $media->delete();

            // delete file from file system
            if(file_exists(public_path()."/uploads/all/".$media->file_name)) {
                unlink(public_path()."/uploads/all/".$media->file_name);
            }

            DB::commit();
            return redirect()->back()->with("success", __("Deleted Successfully"));

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }
}
