<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public function create(){
        return view('manufacturers.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string',
        ]);
        Manufacturer::create($validated);
        return redirect()->back()->with('status', 'Marka uspjesno dodana.');
    }
}
