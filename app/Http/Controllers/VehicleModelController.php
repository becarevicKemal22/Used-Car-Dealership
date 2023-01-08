<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Models\VehicleModel;

class VehicleModelController extends Controller
{
    public function create(){
        $manufacturers = Manufacturer::all();
        return view('vehicleModels.create', ['manufacturers' => $manufacturers]);
    }

    public function store(Request $request){

        $validated = $request->validate([
            'name' => 'required|string',
            'manufacturer_id' => 'required|integer',
        ]);
        $model = VehicleModel::create($validated);
        return redirect()->back()->with('status', 'Model uspjesno dodan.');
    }
}
