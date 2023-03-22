<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Models\VehicleModel;
use App\Models\VehicleType;

class VehicleModelController extends Controller
{
    public function create(){
        $this->authorize('create');
        $manufacturers = Manufacturer::all();
        $vehicle_types = VehicleType::all();
        return view('vehicleModels.create', ['manufacturers' => $manufacturers, 'vehicle_types' => $vehicle_types]);
    }
    
public function store(Request $request){
        $this->authorize('create');
        $validated = $request->validate([
            'name' => 'required|string',
            'manufacturer_id' => 'required|integer',
            'vehicle_type_id' => 'required|integer',
        ]);
        VehicleModel::create($validated);
        return redirect()->back()->with('status', 'Model uspjesno dodan.');
    }
}
