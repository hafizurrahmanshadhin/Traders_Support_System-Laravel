<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ChooseBusiness;
use App\Models\FindingThePerfectMatche;
use App\Models\HelpBusiness;
use App\Models\Testimonial;
use App\Models\TradesmanSpecific;

class HomeController extends Controller {
    public function index() {
        $testimonials             = Testimonial::where('status', 'active')->get();
        $tradesmanSpecific        = TradesmanSpecific::latest('id')->first();
        $helpBusinessesPro        = HelpBusiness::where('type', 'pro')->where('status', 'active')->get();
        $helpBusinessesTrade      = HelpBusiness::where('type', 'trade')->where('status', 'active')->get();
        $chooseBusinessesPro      = ChooseBusiness::where('type', 'pro')->where('status', 'active')->get();
        $chooseBusinessesTrade    = ChooseBusiness::where('type', 'trade')->where('status', 'active')->get();
        $findingThePerfectMatches = FindingThePerfectMatche::where('status', 'active')->get();

        return view("frontend.layouts.home.index", compact(
            "testimonials",
            "tradesmanSpecific",
            "helpBusinessesPro",
            "helpBusinessesTrade",
            "chooseBusinessesPro",
            "chooseBusinessesTrade",
            "findingThePerfectMatches",
        ));
    }
}
