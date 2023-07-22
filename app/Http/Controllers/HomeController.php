<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index(){
        return view("buyer.home");
    }

    public function supplier(){

        $company = Auth::user()->companies()->find(session('company')) ?: Auth::user()->companies()->first();
        if(!$company) return redirect()->route("company-setup.create");

        return view("supplier.home");
    }


}
