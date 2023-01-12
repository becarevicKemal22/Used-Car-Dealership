<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class VehicleTypeController extends Controller
{
    public function create(){
        Gate::authorize('create-type');
        return view('vehicleTypes.create');
    }
    
    public function store(Request $request){
        Gate::authorize('create-type');
        $validated = $request->validate([
            'name' => 'required|string',
        ]);
        VehicleType::create($validated);
        return redirect()->back()->with('status', 'Tip uspjesno dodan.');
    }
}
