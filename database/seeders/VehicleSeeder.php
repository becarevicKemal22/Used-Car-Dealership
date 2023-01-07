<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $peugeot308 = Vehicle::factory()->peugeot308()->make();
        $peugeot308->model_id = VehicleModel::where('name', '=', '308')->first()->id;
        $peugeot308->save();

        $peugeot4008 = Vehicle::factory()->peugeot4008()->make();
        $peugeot4008->model_id = VehicleModel::where('name', '=', '4008')->first()->id;
        $peugeot4008->save();

        $mercedesS320 = Vehicle::factory()->mercedesS320()->make();
        $mercedesS320->model_id = VehicleModel::where('name', '=', 'S 320')->first()->id;
        $mercedesS320->save();

        $renaultClio = Vehicle::factory()->renaultClio()->make();
        $renaultClio->model_id = VehicleModel::where('name', '=', 'Clio')->first()->id;
        $renaultClio->save();
    }
}
