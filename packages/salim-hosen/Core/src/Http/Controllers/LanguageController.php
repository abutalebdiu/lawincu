<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Core\Models\Language;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Storage;
use File;
use DB;
use SalimHosen\Core\Models\Country;
use SalimHosen\Core\Http\Requests\StoreLanguageRequest;
use SalimHosen\Core\Http\Requests\UpdateLanguageRequest;
use Illuminate\Contracts\Cache\Factory;
use SalimHosen\Core\Http\Resources\LanguageResource;
use SalimHosen\Core\Models\Setting;

class LanguageController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum")->except(["index","setLanguage"]);
    }

    public function index()
    {
        $languages = Language::all();
        if(request()->routeIs("api.*")){
            return LanguageResource::collection($languages);
        }
        return view('core::language.index', compact('languages'));
    }

    public function setLanguage($lang){

        session()->put("language", $lang);
        $language = Language::where("code", $lang)->first();
        if($language) session()->put("lang_dir", $language->direction);

        return redirect()->back();
    }

    public function keywords($locale){
        $path = base_path()."/resources/lang/$locale.json";
        $contents = json_decode(File::get($path), true);
        return view('core::language.keywords', compact('contents'));
    }

    public function create(){
        $countries = Country::all();
        return view('core::language.create', compact('countries'));
    }


    public function store(StoreLanguageRequest $request)
    {

        DB::beginTransaction();
        try{

            $language = Language::create([
                "name" => $request->name,
                "country_id" => $request->country,
                "code" => strtolower($request->code),
                "direction" => $request->direction,
                "is_active" => $request->is_active ? true : false,
            ]);


            $this->googleTranslateLanguageFile(app()->getLocale(), config('app.locale'), $request->code);

            DB::commit();
            return redirect()->route("languages.index")->with("success", __("Created Successfully"));

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }

    }


    public function show($id)
    {


    }


    public function edit(Language $language)
    {

        $countries = Country::all();
        return view('core::language.edit', compact('language', 'countries'));

    }


    public function update(UpdateLanguageRequest $request, Language $language)
    {

        $language->update([
            "name" => $request->name,
            "country_id" => $request->country,
            "code" => $request->code,
            "direction" => $request->direction,
            "is_active" => $request->is_active ? true : false,
        ]);

        return redirect()->route("languages.index")->with("success", __("Updated Successfully"));

    }


    public function updateTranslation(Request $request, $locale){

        $request->request->remove('_token');
        $request->request->remove('_method');

        $translations = "{\n";

        foreach($request->all() as $k => $v){
            $k = str_replace("_", " ", $k);
            $translations .= '"'.$k.'"'.": ".'"'.$v.'"'.",\n";
        }

        $translations = rtrim($translations, ",\n");
        $translations .= "\n}";

        $path = base_path()."/resources/lang/$locale.json";

        if(file_exists($path)){
            File::put($path, $translations);
        }

        return redirect()->back()->with("success", __("Updated Successfully"));

    }


    public function destroy($id)
    {
        $language = Language::find($id);
        $path = base_path()."/resources/lang/$language->locale.json";
        Storage::delete($path);
        $language->delete();

        return redirect()->route("languages.index")->with("success", __("Deleted Successfully"));

    }



    // Retrive all files under specific folder
    public function getDirContents($dir, &$results = array()) {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                $this->getDirContents($path, $results);
                $results[] = $path;
            }
        }

        return $results;
    }

    // parse translation string from those view
    public function parseStringFromView(){

        $bladeviews = $this->getDirContents(base_path()."/resources/views");
        $packageviews = $this->getDirContents(base_path()."/packages");

        $files = array_merge($bladeviews, $packageviews);

        $langs = [];

        foreach ($files as $filename) {

            if( strpos($filename, ".blade.php") ){

                $html = strip_tags(file_get_contents($filename));

                $parts = explode("__(",$html);

                for($i = 0; $i < count($parts); $i++){
                    if($i == 0) continue;

                    $pos = strpos($parts[$i], ")");
                    $v = trim(substr($parts[$i], 0, $pos), "\"");
                    $v = trim($v, "'");

                    // $v = "\"$v\"".  ": "  . "\"$v\", <br/>";

                    if(!array_key_exists($v, $langs)){
                        $langs[$v] = ucwords($v);
                    }

                }
            }

        }

        $target_file = base_path()."/resources/lang/en.json";
        Storage::delete($target_file);
        File::put($target_file, json_encode($langs));
        return "Success! Total ".count($langs)." Keys Inserted";
    }





    public function googleTranslateLanguageFile($source, $target){

        $target_file = base_path()."/resources/lang/".$target.".json";
        $source_file = base_path()."/resources/lang/".$source.".json";

        // delete existing target file
        Storage::delete($target_file);

        $contents = json_decode(File::get($source_file), true);

        $html = "";
        $i = 0;
        foreach ($contents as $key => $value) {
            $html .= $i++."- ".$key."|";
        }
        $html = rtrim($html, "|");

        $translated = GoogleTranslate::trans($html, $target, $source);
        $translated_array = explode("|", $translated);

        $new_translated = [];
        foreach ($translated_array as $value) {
            $value = explode("-", $value)[1];
            array_push($new_translated, $value);
        }

        $filtered = [];
        $i = 0;
        foreach ($contents as $key => $value) {
            $filtered[$key] = $new_translated[$i++];
        }

        File::put($target_file, json_encode($filtered, JSON_UNESCAPED_UNICODE));
        return "Success! Total ".count($filtered)." Translated";
    }


    public function makeDefault($language_id, Factory $cache){

        $language = Language::findOrFail($language_id);

        $setting = Setting::where("key", "language")->first();
        if(!$setting){
            $setting = new Setting();
        }

        $setting->key = "language";
        $setting->value = $language->code;
        $setting->save();

        $cache->forget('settings');

        return redirect()->back()->with("success", __("Changed Successfully"));
    }

}
