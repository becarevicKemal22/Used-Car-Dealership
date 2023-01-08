<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicle;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleModel;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::all(); // or add all the queries from the forms or search or whatever
        return view('vehicles.index', ['vehicles' => $vehicles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //auth
        $models = VehicleModel::with('manufacturer')->get();
        return view('vehicles.create', ['models' => $models]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehicle $request)
    {
        //Auth again or just create a gate that automatically does it?
        $validated = $request->validated();
        $post = Vehicle::create($validated);
        return redirect()->route('vozila.index')->with('status', 'Vozilo je uspjesno dodano.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicles.show', ['vehicle' => $vehicle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $models = VehicleModel::with('manufacturer')->get();
        return view('vehicles.edit', ['vehicle' => $vehicle, 'models' => $models]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreVehicle $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $validated = $request->validated();
        $vehicle->fill($validated);
        $vehicle->save();

        $request->session()->flash('status', 'Podaci uspjesno izmijenjeni.');
        return redirect()->route('vozila.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Vehicle::findOrFail($id);
        
        //Auth

        $post->delete();

        return redirect('vehicles.index');
    }
}
