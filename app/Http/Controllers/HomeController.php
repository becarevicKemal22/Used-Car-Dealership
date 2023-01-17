<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

        $latest = Cache::get('latest-vehicles', function () {
            $temp = Vehicle::latest()->take(3)->get();
            Cache::put('latest-vehicles', $temp, now()->addMinutes(30));
            return $temp;
        });

        $discounted_vehicles = Cache::get('discounted-vehicles', function () {
            $temp = Vehicle::where('discount_price', '>', 0)->take(5)->get();
            Cache::put('discounted-vehicles', $temp, now()->addMinutes(30));
            return $temp;
        });
        
        return view('home', ['vehicles' => $vehicles, 'latest' => $latest, 'discounted_vehicles' => $discounted_vehicles]);
    }
}
