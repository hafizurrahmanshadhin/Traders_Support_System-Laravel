<?php

namespace App\Http\Controllers\Frontend\Pro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Boost;

class ProBoostController extends Controller
{
   public function index(){
        $boost=Boost::all();
        return view('frontend.layouts.pro.pro-dashboard',compact('boost'));
   }
}
