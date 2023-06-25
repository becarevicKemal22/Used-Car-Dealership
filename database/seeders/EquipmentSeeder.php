<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $equipmentNames = [
            'Service book',
            'Digital AC',
            'Automatic AC',
            'Seat heating',
            'Central locking with remote',
            'Central locking',
            '3 keys',
            '2 keys',
            '1 key',
            'Cruise control',
            'Rear parking sensors',
            'Front and rear parking sensors',
            'Rear camera',
            'Leather seats',
            'Electrically adjustable seats',
            'Leather steering wheel',
            'Start-stop ignition',
            'Anti-lock Braking System (ABS)',
            'ESP',
            'ASR',
            'ISOFIX - seat anchors',
            'Radio CD-MP3',
            'Navigation system',
            'Auto-park',
            'AUX',
            'USB',
            'SD',
            'Touch screen',
            'Mirror defroster',
            'Winter tires',
            'Electronic handbrake',
            'Lane assist',
            'Downhill assist',
            'BOSE surround audio system',
            'Panoramic roof',
            ];

        foreach ($equipmentNames as $name){
            $equipment = new Equipment();
            $equipment->equipment_name = $name;
            $equipment->save();
        }
    }
}
