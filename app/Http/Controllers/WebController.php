<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use SalimHosen\Core\Models\Country;
use SalimHosen\Core\Models\State;

class WebController extends Controller
{

    public function index(Request $request)
    {

        return view('web.index');
    }


    public function aboutus(Request $request)
    {


        return view('web.aboutus');
    }

    public function contact(Request $request)
    {


        return view('web.single_contact');
    }

    public function getstate(Request $request)
    {
        $states = State::where('country_id',$request->country)->get();
        $output = "";
        foreach($states as $state)
        {
            $output .= "<option value='".$state->id."'>". $state->name ."</option>";
        }
        return  $output;
    }



}
