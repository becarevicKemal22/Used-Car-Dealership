<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $vehicles = Vehicle::all();

        $latest = Vehicle::whereNotIn('status', ['u_dolasku'])->orWhere('status', '=', null)->latest()->take(3)->get();

        $discounted_vehicles = Vehicle::where('discount_price', '>', 0)->take(5)->get();

        $uDolasku = Vehicle::where('status', '=', 'u_dolasku')->take(3)->get();

        //Get paths for image logos where they exist
        $manufacturers = Manufacturer::all();
        $manufacturer_logo_paths = [];
        foreach ($manufacturers as $manufacturer){
            if(Storage::disk('s3')->exists('assets/carLogos/'.strtolower($manufacturer->name).'.png')){
                $manufacturer_logo_paths[$manufacturer->id] = Storage::disk('s3')->url('assets/carLogos/'.strtolower($manufacturer->name).'.png');
            }
        }

        return view('home', ['vehicles' => $vehicles, 'latest' => $latest, 'discounted_vehicles' => $discounted_vehicles, 'uDolasku' => $uDolasku, 'logos' => $manufacturer_logo_paths]);
    }
}
