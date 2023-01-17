<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicle;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Vehicle::query();

        //Getting the manufacturer names joined onto the vehicles collection so that sorting is available.
        $modelsTable = DB::table('vehicle_models')->leftJoin('manufacturers', 'manufacturer_id', '=', 'manufacturers.id')->select('vehicle_models.name as vehicle_model_name', 'vehicle_models.id as id_of_vehicle_model', 'vehicle_models.vehicle_type_id as vehicle_type_id', 'manufacturers.name as manufacturer_name', 'manufacturers.id as id_of_manufacturer');
        $query->joinSub($modelsTable, 'modelsTable', function($join){
            $join->on('modelsTable.id_of_vehicle_model', '=', 'vehicle_model_id')->selectRaw('`modelsTable`.`manufacturer_name` as manufacturer_name');
        });

        //Search
        if($request->query('pretraga')){
            $query->where('name', 'LIKE', "%{$request->query('pretraga')}%");
        }

        //Filters
        if($request->query('manufacturer') != null && $request->query('manufacturer') != 0){
            $query->where('id_of_manufacturer', 'LIKE', "%{$request->query('manufacturer')}%");
        }

        if($request->query('vehicle_model_id') != null && $request->query('vehicle_model_id') != 0){
            $query->where('vehicle_model_id', 'LIKE', "%{$request->query('vehicle_model_id')}%");
        }

        if($request->query('years_from') != null){
            $query->where('production_year', '>=', $request->query('years_from'));
        }
        
        if($request->query('years_to') != null){
            $query->where('production_year', '<=', $request->query('years_to'));
        }
        
        if($request->query('price_from') != null){
            $query->where('price', '>=', $request->query('price_from'));
        }
        
        if($request->query('price_to') != null){
            $query->where('price', '<=', $request->query('price_to'));
        }

        $typeIDs = [];
        foreach (VehicleType::all() as $type) {
            if($request->query('type'.$type->id) != null){
                $typeIDs[] = $type->id;
            }
        }
        if(!empty($typeIDs)){
            $query->whereHas('model', function($q) use($typeIDs){
                $q->whereIn('vehicle_type_id', $typeIDs);
            });
        }

        if($request->query('gearbox')){
            $query->where('gearbox', 'LIKE', $request->query('gearbox'));
        }

        if($request->query('engine_type')){
            $query->where('engine_type', 'LIKE', $request->query('engine_type'));
        }

        //Ordering
        $ascOrDesc = $request->query('desc') ? 'desc' : 'asc';

        if($request->query('sort')){
            $query->orderBy($request->query('sort'), $ascOrDesc);
        }else{
            $query->orderBy('manufacturer_name', 'asc');
        }

        $vehicles = $query->get();

        // $vehicles = Cache::get('all_vehicles', function(){
        //     $temp = Vehicle::all(); // or add all the queries from the forms or search or whatever should affect cache too.
        //     Cache::put('all_vehicles', $temp, now()->addMinutes(30));
        //     return $temp;
        // });

        $models = VehicleModel::with('manufacturer')->get();

        $types = VehicleType::all();
        
        return view('vehicles.index', ['vehicles' => $vehicles, 'models' => $models, 'types' => $types]);
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

        Cache::forget('all_vehicles');
        Cache::forget('latest-vehicles');
        Cache::forget('discounted-vehicles');

        if (!app()->isProduction()) {
            $additionToPath = 'local/';
        } else {
            $additionToPath = '';
        }

        //Thumbnail storage

        if ($request->hasFile('thumbnail')) {
            $path = Storage::disk('s3')->put($additionToPath . 'thumbnails', $request->file('thumbnail'));
            $vehicle->thumbnail = $path;
        }


        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = Storage::disk('s3')->put($additionToPath . 'vehicles/' .  'vehicle' . $vehicle->id, $photo);
                $image = new Image();
                $image->path = $path;
                $image->vehicle_id = $vehicle->id;
                $image->save();
            }
        }

        $vehicle->save();

        return redirect()->route('vozila.show', ['vozila' => $vehicle->id])->with('status', 'Vozilo je uspjesno dodano.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = Cache::get($id, function() use($id){
            $temp = Vehicle::findOrFail($id);
            Cache::put($id, $temp, now()->addMinutes(30));
            return $temp;
        });
        $thumbnail = Storage::disk('s3')->url($vehicle->thumbnail);
        $imagePaths = $vehicle->images()->get()->pluck('path');
        foreach ($imagePaths as $key => $imagePath) {
            $imagePaths[$key] = Storage::disk('s3')->url($imagePath);
        }
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

        Cache::forget($id);
        Cache::forget('all_vehicles');
        Cache::forget('latest-vehicles');
        Cache::forget('discounted-vehicles');

        $thumbnail_path = $vehicle->thumbnail;
        $images = $vehicle->images()->get();
        $validated = $request->validated();
        $vehicle->fill($validated);

        //Env must be detected so that the folder in s3 can be set accordingly so that they don't clash
        if (!app()->isProduction()) {
            $additionToPath = 'local/';
        } else {
            $additionToPath = '';
        }

        if ($request->hasFile('thumbnail')) {
            Storage::disk('s3')->delete($thumbnail_path);
            $path = Storage::disk('s3')->put($additionToPath . 'thumbnails', $request->file('thumbnail'));
            $vehicle->thumbnail = $path;
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
                $path = Storage::disk('s3')->put($additionToPath . 'vehicles/' . 'vehicle' . $vehicle->id, $photo);
                $image = new Image();
                $image->path = $path;
                $image->vehicle_id = $vehicle->id;
                $image->save();
            }
        }

        $vehicle->save();

        $request->session()->flash('status', 'Podaci uspjesno izmijenjeni.');
        return redirect()->route('vozila.show', ['vozila' => $vehicle->id]);
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

        Storage::disk('s3')->delete($vehicle->thumbnail);

        Cache::forget($id);
        Cache::forget('all_vehicles');
        Cache::forget('latest-vehicles');
        Cache::forget('discounted-vehicles');

        $images = $vehicle->images();

        foreach ($images as $image) {
            $path = $image->path;
            Storage::disk('s3')->delete($path);
            Image::find($image->id)->delete();
        }

        $vehicle->delete();

        return redirect()->route('vozila.index');
    }
}