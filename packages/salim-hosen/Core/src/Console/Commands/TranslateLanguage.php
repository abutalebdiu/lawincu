<?php

namespace SalimHosen\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use File;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateLanguage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'language:translate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Translate Language Files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $source = $this->ask('Translate From?', config('app.locale', 'en'));
        $target = $this->ask('Target Locale?', 'ar');

        $target_file = base_path()."/lang/".$target.".json";
        $source_file = base_path()."/lang/".$source.".json";

        // delete existing target file
        Storage::delete($target_file);

        $contents = json_decode(File::get($source_file), true);

        $html = "";
        $i = 0;
        $keys = array_keys($contents);
        foreach ($contents as $key => $value) {
            // $html .= $i++."- ".$key."|";
            $html .= $key."|";
        }
        $html = rtrim($html, "|");

        $translated = GoogleTranslate::trans($html, $target, $source);
        $translated_array = explode("|", $translated);

        // $new_translated = [];
        foreach ($translated_array as $i => $value) {
            // $value = explode("-", $value)[1];
            // array_push($new_translated, $value);
            $contents[$keys[$i]] = $value;
        }

        // $filtered = [];
        // $i = 0;
        // foreach ($contents as $key => $value) {
        //     $filtered[$key] = $new_translated[$i++];
        // }

        File::put($target_file, json_encode($contents, JSON_UNESCAPED_UNICODE));
        $this->info("Success! Total ".count($contents)." Translated");
    }
}
