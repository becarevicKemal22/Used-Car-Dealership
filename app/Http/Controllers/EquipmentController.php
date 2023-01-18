<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EquipmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(){
        return view('equipment.create');
    }
    
    public function store(Request $request){
        $validated = $request->validate([
            'equipment_name' => 'required|string',
        ]);
        Equipment::create($validated);
        return redirect()->back()->with('status', 'Oprema uspjesno dodana.');
    }
}