<?php

namespace SalimHosen\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use File;

class ParseLanguage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'language:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse Language Keys from the views';

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
        $this->info('Parsing Language keys from files...');

        $files = $this->getDirContents(base_path());

        $langs = [];

        foreach ($files as $filename) {

            // File must be a blade file
            if( strpos($filename, ".blade.php") ){

                $html = strip_tags(file_get_contents($filename));

                $parts = explode("__(", $html);

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

        $target_file = base_path()."/lang/en.json";
        Storage::delete($target_file);
        File::put($target_file, json_encode($langs));

        $this->info("Success! Total ".count($langs)." Keys Inserted");
        $this->info('Finished Parsing');
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
}
