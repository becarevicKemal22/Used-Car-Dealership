<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\Gate;

class VehicleModelController extends Controller
{
    public function create(){
        $this->authorize('create');
        $manufacturers = Manufacturer::all();
        return view('vehicleModels.create', ['manufacturers' => $manufacturers]);
    }
    
    public function store(Request $request){
        $this->authorize('create');
        $validated = $request->validate([
            'name' => 'required|string',
            'manufacturer_id' => 'required|integer',
        ]);
        $model = VehicleModel::create($validated);
        return redirect()->back()->with('status', 'Model uspjesno dodan.');
    }
}
