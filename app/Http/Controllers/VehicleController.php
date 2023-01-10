<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicle;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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
        $this->authorize('vehicles.create');
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
        $validated = $request->validated();
        $vehicle = Vehicle::make($validated);

        //Thumbnail storage

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');
            $vehicle->thumbnail = $path;
        }

        if (!app()->isProduction()) {
            $additionToPath = 'local/';
        } else {
            $additionToPath = '';
        }

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = Storage::disk('s3')->put('vehicles/' . $additionToPath . 'vehicle' . $vehicle->id, $photo);
                $image = new Image();
                $image->path = $path;
                $image->vehicle_id = $vehicle->id;
                $image->save();
            }
        }

        $vehicle->save();

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
        $thumbnail = Storage::url($vehicle->thumbnail);
        $imagePaths = $vehicle->images()->get()->pluck('path');
        return view('vehicles.show', ['vehicle' => $vehicle, 'thumbnail' => $thumbnail, 'imagePaths' => $imagePaths]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('vehicles.update');
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
        $thumbnail_path = $vehicle->thumbnail;
        $images = $vehicle->images()->get();
        $validated = $request->validated();
        $vehicle->fill($validated);

        if ($request->hasFile('thumbnail')) {
            Storage::delete($thumbnail_path);
            $path = $request->file('thumbnail')->store('thumbnails');
            $vehicle->thumbnail = $path;
        }

        //Env must be detected so that the folder in s3 can be set accordingly so that they don't clash
        if (!app()->isProduction()) {
            $additionToPath = 'local/';
        } else {
            $additionToPath = '';
        }

        if ($request->hasFile('photos')) {
            //Deleting all the currently available images
            if ($images) {
                foreach ($images as $image) {
                    $path = $image->path;
                    Storage::disk('s3')->delete($path);
                    Image::find($image->id)->delete();
                }
            }

            //Storing the new ones again
            foreach ($request->file('photos') as $photo) {
                $path = Storage::disk('s3')->put('vehicles/' . $additionToPath . 'vehicle' . $vehicle->id, $photo);
                $image = new Image();
                $image->path = $path;
                $image->vehicle_id = $vehicle->id;
                $image->save();
            }
        }

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

        Gate::authorize('vehicles.delete');

        $vehicle = Vehicle::findOrFail($id);

        Storage::delete($vehicle->thumbnail);

        $images = $vehicle->images();

        foreach ($images as $image) {
            $path = $image->path;
            Storage::disk('s3')->delete($path);
            Image::find($image->id)->delete();
        }

        $vehicle->delete();

        return redirect('vehicles.index');
    }
}
