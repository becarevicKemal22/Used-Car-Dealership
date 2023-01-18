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
            'Servisna knjiga',
            'Digitalna klima',
            'Klima dvozonska automatska',
            'Grijanje sjedišta',
            'Maglenke - Maglo Farovi',
            'BI-Xenoni',
            'Centralno daljinsko otključavanje/zaključavanje',
            'Centralna brava',
            '3 ključa', 
            '2 Ključa', 
            '1 Ključ',
            'Tempomat',
            'Limitator',
            'Parking senzori nazad',
            'Parking senzori naprijed i nazad',
            'Kamera zadnja',
            'Sjedišta koža-alkantara',
            'Električno podešavanje retrovizora sa žmigavcima',
            'Električni podizači stakala X4 , Električni podizači stakala X2',
            'Kožni trokraki volan podesiv po visini i dubini sa komandama',
            'Kožna sjedišta',
            'Start-stop paljenje',
            'Anti-lock Braking System (ABS)',
            'ESP',
            'ASR',
            'ISOFIX - kopčanje za dječije sjedalice',
            'Radio CD-MP3',
            'Navigacija',
            'Naslon za ruku',
            'Park pilot',
            'AUX',
            'USB',
            'SD',
            'Touch screen',
            'Grijači u retrovizorima',
            'Zimske gume',
            'Elektronska  ručna',
            'Senzori za svjetla',
            'Senzori za kišu i svjetla',
            'AUTO HOLD',
            'Panorama',
            'Šiber',
            'Virtualni kokpit',
            'Lane assist',
            'Downhill assist',
            'BOSE surround audio sistem',
            'Vazdušni ovjes',
            'El podešavanje sjedišta sa memorijom',
        ];

        foreach ($equipmentNames as $name){
            $equipment = new Equipment();
            $equipment->equipment_name = $name;
            $equipment->save();
        }
    }
}
