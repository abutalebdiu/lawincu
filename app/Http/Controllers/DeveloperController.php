<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SalimHosen\Blog\Models\Category;

class DeveloperController extends Controller
{
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

    public function parseLang(){


        $files = $this->getDirContents(base_path()."/packages/salim-hosen/Theme/src/Asougexpress/views");

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

        foreach ($langs as $key => $value) {
            echo '"'.$key.'" : '.'"'.$value.'",<br/>';
        }

        dd("done");
    }


    public function parseFileLang(){

        $langs = [];

        $filename = base_path()."/packages/salim-hosen/Theme/src/Asoug/views/auth/supplier-login.blade.php";
        // File must be a blade file
        $html = strip_tags(file_get_contents($filename));

        $parts = explode("__(", $html);

        for($i = 0; $i < count($parts); $i++){
            if($i == 0) continue;

            $pos = strpos($parts[$i], ")");
            if($parts[$i][$pos-1] != '"'){
                continue;
            }

            $v = trim(substr($parts[$i], 0, $pos), "\"");
            $v = trim($v, "'");

            // $v = "\"$v\"".  ": "  . "\"$v\", <br/>";

            if(!array_key_exists($v, $langs)){
                $langs[$v] = ucwords($v);
            }

        }

        foreach ($langs as $key => $value) {
            echo '"'.$key.'" : '.'"'.$value.'",<br/>';
        }

        dd("done");


    }



    public function insertCats(){

        $cats = [
            "3D Printing Equipment",
            "Animal Care And Research",
            "Antibodies",
            "Autopsy Supplies",
            "Balances And Scales",
            "Baths",
            "Beakers And Lids",
            "Biochemical Reagents",
            "Bioprocess Systems And Accessories",
            "Blood, Hematology And Coagulation Testing Products",
            "Bottles, Jars And Jugs",
            "Boxes",
            "Buffers And Standards",
            "Burettes",
            "Burners And Lighters",
            "Carboys",
            "Cell Analysis Products",
            "Cell Culture Media",
            "Cell Culture Media, Supplements, And Reagents",
            "Cell Culture Utensils",
            "Cell Lines And Blood Products",
            "Centrifuges",
            "Chemicals",
            "Chromatography Columns And Cartridges",
            "Chromatography Supplies",
            "Chromatography Syringes",
            "Chromatography System",
            "Chromatography Systems",
            "Clamps And Supports",
            "Clinical Analyzers And Instruments",
            "Clinical Specimen Collection",
            "Cold Storage Products",
            "Computers",
            "Counting Devices",
            "Custom Products And Services",
            "Custom Products And Services",
            "Cuvets And Cells",
            "Cylinders",
            "Dataloggers And Recorders",
            "Desiccators",
            "Diagnostic Tests And Controls",
            "Dishes",
            "Dispensers",
            "Dissection Equipment",
            "Documentation And Support Services",
            "Education Supplies",
            "Electron Microscopes",
            "Emergency Response Equipment",
            "Environmental Samplers",
            "Enzymes And Inhibitors",
            "Evaporators",
            "Extraction Systems",
            "Facility Safety And Maintenance",
            "Film And Foil Wrapping And Accessories",
            "Filters And Filtration",
            "First Aid And Medical",
            "Flash And Fuel Equipment",
            "Flasks",
            "Flow Analysis",
            "Food Services",
            "Forensic Consumables",
            "Freeze Dryers",
            "Funnels",
            "Furniture",
            "Gases And Gas Accessories",
            "Gel Electrophoresis Equipment And Supplies",
            "Glassware Washers And Cleaners",
            "Heaters And Heating Mantles",
            "Histology And Cytology",
            "Histology And Cytology",
            "Hotplates And Stirrers",
            "Humidity And Hygrometry",
            "Immunoassay Reagents And Kits",
            "Incubators",
            "Industrial Hygiene And Environmental Monitoring",
            "Lab Electrical Equipment",
            "Laboratory Automation",
            "Laboratory Ventilation",
            "Mailing And Shipping Products",
            "Materials Testing Instruments",
            "Microbial Identification Test Kits",
            "Microbiological Media And Media Additives",
            "Microbiology Equipment",
            "Microbiology Quality Control Supplies",
            "Microbiology Susceptibility Testing",
            "Microplates",
            "Microscope Slides",
            "Microscopes",
            "Mixers",
            "Molecular Biology Reagents And Kits",
            "Nuclear Reactor Measurement Devices",
            "Nucleic Acid Synthesis",
            "Ovens And Furnaces",
            "PCR Equipment And Supplies",
            "Partition Chromatography",
            "Personal Hygiene Products",
            "Personal Protective Equipment",
            "Phase Change Instruments",
            "Pipet Products",
            "Pipette Products",
            "Process Controllers And Analyzers",
            "Process Controllers And Analyzers",
            "Protein Analysis Reagents",
            "Pumps And Tubing",
            "RNAi And RNA Reagents",
            "Racks",
            "Recombinant Proteins",
            "Refractometers",
            "Shakers",
            "Solid Phase Extraction",
            "Sonicators",
            "Specialty Lab Equipment, Instruments, And Apparatuses",
            "Specialty Lab Glassware",
            "Spectroscopy",
            "Sterilizers And Autoclaves",
            "Stoppers And Closures",
            "Surgical Tools",
            "Tanks",
            "Task Lighting",
            "Tensiometry",
            "Thermometers And Temperature Measurement",
            "Timekeeping",
            "Tubes",
            "Turbidity Measurement",
            "Vials",
            "Water Purification",
            "Water And Wastewater Testing Supplies",
            "Western Blot Products",
            "PH And Electrochemistry",
            "3D Printing Equipment",
            "Animal Care and Research",
            "Antibodies",
            "Autopsy Supplies",
            "Balances and Scales",
            "Baths",
            "Beakers and Lids",
            "Biochemical Reagents",
            "Bioprocess Systems and Accessories",
            "Blood, Hematology and Coagulation Testing Products",
            "Bottles, Jars and Jugs",
            "Boxes",
            "Buffers and Standards",
            "Burettes",
            "Burners and Lighters",
            "Carboys",
            "Cell Analysis Products",
            "Cell Culture Media",
            "Cell Culture Media, Supplements, and Reagents",
            "Cell Culture Utensils",
            "Cell Lines and Blood Products",
            "Centrifuges",
            "Chemicals",
            "Chromatography Columns and Cartridges",
            "Chromatography Supplies",
            "Chromatography Syringes",
            "Chromatography System",
            "Chromatography Systems",
            "Clamps and Supports",
            "Clinical Analyzers and Instruments",
            "Clinical Specimen Collection",
            "Cold Storage Products",
            "Computers",
            "Counting Devices",
            "Custom Products and Services",
            "Cuvets and Cells",
            "Cylinders",
            "Dataloggers and Recorders",
            "Desiccators",
            "Diagnostic Tests and Controls",
            "Dishes",
            "Dispensers",
            "Dissection Equipment",
            "Documentation and Support Services",
            "Education Supplies",
            "Electron Microscopes",
            "Emergency Response Equipment",
            "Environmental Samplers",
            "Enzymes and Inhibitors",
            "Evaporators",
            "Extraction Systems",
            "Facility Safety and Maintenance",
            "Film and Foil Wrapping and Accessories",
            "Filters and Filtration",
            "First Aid and Medical",
            "Flash and Fuel Equipment",
            "Flasks",
            "Flow Analysis",
            "Food Services",
            "Forensic Consumables",
            "Freeze Dryers",
            "Funnels",
            "Furniture",
            "Gases and Gas Accessories",
            "Gel Electrophoresis Equipment and Supplies",
            "Glassware Washers and Cleaners",
            "Heaters and Heating Mantles",
            "Histology and Cytology",
            "Hotplates and Stirrers",
            "Humidity and Hygrometry",
            "Immunoassay Reagents and Kits",
            "Incubators",
            "Industrial Hygiene and Environmental Monitoring",
            "Lab Electrical Equipment",
            "Laboratory Automation",
            "Laboratory Ventilation",
            "Mailing and Shipping Products",
            "Materials Testing Instruments",
            "Microbial Identification Test Kits",
            "Microbiological Media and Media Additives",
            "Microbiology Equipment",
            "Microbiology Quality Control Supplies",
            "Microbiology Susceptibility Testing",
            "Microplates",
            "Microscope Slides",
            "Microscopes",
            "Mixers",
            "Molecular Biology Reagents and Kits",
            "Nuclear Reactor Measurement Devices",
            "Nucleic Acid Synthesis",
            "Ovens and Furnaces",
            "PCR Equipment and Supplies",
            "Partition Chromatography",
            "Personal Hygiene Products",
            "Personal Protective Equipment",
            "Phase Change Instruments",
            "Pipet Products",
            "Pipette Products",
            "Process Controllers and Analyzers",
            "Protein Analysis Reagents",
            "Pumps and Tubing",
            "RNAi and RNA Reagents",
            "Racks",
            "Recombinant Proteins",
            "Refractometers",
            "Shakers",
            "Solid Phase Extraction",
            "Sonicators",
            "Specialty Lab Equipment, Instruments, and Apparatuses",
            "Specialty Lab Glassware",
            "Spectroscopy",
            "Sterilizers and Autoclaves",
            "Stoppers and Closures",
            "Surgical Tools",
            "Tanks",
            "Task Lighting",
            "Tensiometry",
            "Thermometers and Temperature Measurement",
            "Timekeeping",
            "Tubes",
            "Turbidity Measurement",
            "Vials",
            "Water Purification",
            "Water and Wastewater Testing Supplies",
            "Western Blot Products",
            "pH and Electrochemistry"
        ];


        \DB::beginTransaction();
        try{
            foreach ($cats as $name) {
                $data['slug']          = Str::slug($name);
                $data['name']          = $name;
                $data['category_id']     = 0;
                $category = Category::create($data);
            }
            \DB::commit();
            dd("done");
        }catch(\Exception $e){
            \DB::rollback();
            throw $e;
        }

    }

}
