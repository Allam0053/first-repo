<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboardcotroller extends Controller
{
    public function index(){
    	return view('dashboard');
    }
}
