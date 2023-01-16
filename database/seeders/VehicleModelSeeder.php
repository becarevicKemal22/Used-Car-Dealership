<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use App\Models\VehicleModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $peugeotId = Manufacturer::where('name', '=', 'Peugeot')->first()->id;
        $peugeot308 = VehicleModel::factory()->peugeot308()->make();
        $peugeot308->manufacturer_id = $peugeotId;
        $peugeot308->save();
        $peugeot4008 = VehicleModel::factory()->peugeot4008()->make();
        $peugeot4008->manufacturer_id = $peugeotId;
        $peugeot4008->save();

        $mercedesId = Manufacturer::where('name', '=', 'Mercedes')->first()->id;
        $mercedesS320 = VehicleModel::factory()->mercedesS320()->make();
        $mercedesS320->manufacturer_id = $mercedesId;
        $mercedesS320->save();

        $renaultId = Manufacturer::where('name', '=', 'Renault')->first()->id;
        $renaultClio = VehicleModel::factory()->renaultClio()->make();
        $renaultClio->manufacturer_id = $renaultId;
        $renaultClio->save();
    }
}
