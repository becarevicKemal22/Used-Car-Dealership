<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ManufacturerController extends Controller
{
    public function create(){
        Gate::authorize('create');
        return view('manufacturers.create');
    }
    
    public function store(Request $request){
        Gate::authorize('create');
        $validated = $request->validate([
            'name' => 'required|string',
        ]);
        Manufacturer::create($validated);
        return redirect()->back()->with('status', 'Marka uspjesno dodana.');
    }
}
