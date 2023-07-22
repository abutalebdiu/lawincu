<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use SalimHosen\Inventory\Models\Product;
use SalimHosen\Sales\Models\Order;
use SalimHosen\Support\Models\CustomerQuery;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index(){

        if(getAuthRole() != "admin"){
            return redirect()->route("home.".getAuthRole());
        }


        return view("core::home.index");
    }

}
