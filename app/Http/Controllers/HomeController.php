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

        $latest = Vehicle::whereNotIn('status', ['u_dolasku'])->orWhere('status', '=', null)->latest()->take(3)->get();

        $discounted_vehicles = Vehicle::where('discount_price', '>', 0)->take(5)->get();

        $uDolasku = Vehicle::where('status', '=', 'u_dolasku')->take(3)->get();

        return view('home', ['vehicles' => $vehicles, 'latest' => $latest, 'discounted_vehicles' => $discounted_vehicles, 'uDolasku' => $uDolasku]);
    }
}
