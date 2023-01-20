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
        $peugeot308->vehicle_model_id = VehicleModel::where('name', '=', '308')->first()->id;
        $peugeot308->save();
        $peugeot308->equipment()->attach([1, 2, 3, 4, 5]);

        $peugeot4008 = Vehicle::factory()->peugeot4008()->make();
        $peugeot4008->vehicle_model_id = VehicleModel::where('name', '=', '4008')->first()->id;
        $peugeot4008->save();
        $peugeot4008->equipment()->attach([2, 4, 7, 9, 12]);

        $mercedesS320 = Vehicle::factory()->mercedesS320()->make();
        $mercedesS320->vehicle_model_id = VehicleModel::where('name', '=', 'S 320')->first()->id;
        $mercedesS320->save();
        $mercedesS320->equipment()->attach([6, 2, 12, 13, 14]);
        
        $renaultClio = Vehicle::factory()->renaultClio()->make();
        $renaultClio->vehicle_model_id = VehicleModel::where('name', '=', 'Clio')->first()->id;
        $renaultClio->save();
        $renaultClio->equipment()->attach([2, 4, 6, 8, 10]);
    }
}
