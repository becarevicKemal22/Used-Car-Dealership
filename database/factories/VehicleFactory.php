<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
        ];
    }

    public function peugeot308(){
        return $this->state(function(array $attributes){
            return [
                'name' => 'PEUGEOT 308 SW 1.6 HDI , 2014 GODINA, NAVIGACIJA',
                'price' => '14999',
                'production_year' => '2014',
                'kilometers' => 205000,
                'engine_type' => 'Dizel',
                'chassis_type' => 'Karavan',
                'gearbox' => 'Manuelni',
                'color' => 'Plava',
                'door_number' => '4/5',
                'engine_volume' => '1.6',
                'engine_strength' => 120,
                'drive' => 'Prednji',
                'opis' => 'Ovo je opis ovog vozila',
                'oprema' => 'ABS/Airbag/Centralna Brava/Daljinsko Otkljucavanje/Digitalna Klima/ ESP/ El. Podizaci Stakala/ Elektricni Retrovizori/ISOFIX/Klima/Komande na volanu/Metalik/Naslon za ruku/Navigacija/Ocarinjen/Servisna Knjiga/Servo volan/ Start-stop sistem/Tempomat/Touch Screen (ekran)/Turbo',
                "thumbnail" => "",
            ];
    });}

    public function peugeot4008(){
        return $this->state(function(array $attributes){
            return [
                'name' => 'PEUGEOT 4008 2.2 HDI 4X4 ,2008 GOD, 7 SJEDIŠTA',
                'price' => '12500',
                'production_year' => '2008',
                'kilometers' => 227000,
                'engine_type' => 'Dizel',
                'chassis_type' => 'Terenac',
                'gearbox' => 'Manuelni',
                'color' => 'Crna',
                'door_number' => '5',
                'engine_volume' => '2.2',
                'engine_strength' => 156,
                'opis' => 'PEUGEOT 4007 2.2 HDI 4x4

                REGISTROVAN DO : 21.09.2022 GODINE
                
                Mogućnost zamjene po našoj procjeni
                
                Euro 5
                
                
                Mogućnost kreditiranja za vozila!
    
                2.2 DIZEL
                2008. GODINA
                115 KW - 156KS                                                                                  
                
                Prešao 227.000 km
                Servisna knjiga (vozilo redovno održavano i servisirano u ovlaštenom servisu)',
                'oprema' => 'ABS/ESP/XENONI/Tempomat/Kozni trokraki volan sa komandama/El. podizaci stakala x4/Elektricno podesavanje retrovizora sa zmigavcima/Grijaci u retrovizorima/Parking Senzori nazad/Naslon za ruku/El podesiva kozna sjedista/Navigacija/AUX/USB/ISOFIX/Manuelni mjenjac 6+R/Alu Felge R18',
                "thumbnail" => "",
            ];
    });}

    public function mercedesS320(){
        return $this->state(function(array $attributes){
            return [
                'name' => 'MERCEDES-BENZ S320 CDI, 2008 GODINA, XENONI, ŠIBER',
                'price' => '20999',
                'production_year' => '2008',
                'kilometers' => 334000,
                'engine_type' => 'Dizel',
                'chassis_type' => 'Limuzina',
                'gearbox' => 'Automatik',
                'color' => 'Siva',
                'engine_volume' => '3.0',
                'engine_strength' => 235,
                'opis' => 'MERCEDES-BENZ S320 CDI

                EURO 4
                 
                Mogućnost kreditiranja za vozila
                  
                3.0 DIZEL
                2008. GODINA
                173 KW -235 KS
                
                Prešao 334.000 km
                Servisna knjiga',
                'oprema' => 'Centralno daljinsko otkljucavanje/Xenoni/Vazdusni Ovjes/Elektricno podesavanje retrovizora/Parking senzori/Kozni trokraki volan podesiv po dubini i visini sa komandama/ABS/ESP/ISOFIX/Radio CD-MP3/Navigacija/Automatski Mjenjac 7-stepeni/Alu felge R18',
                "thumbnail" => "",
            ];
    });}

    public function renaultClio(){
        return $this->state(function(array $attributes){
            return [
                'name' => 'RENAULT CLIO 1.5 DCI SW, 2012 GODINA, NAVIGACIJA,KLIMA',
                'price' => '7999',
                'production_year' => '2012',
                'kilometers' => 199000,
                'engine_type' => 'Dizel',
                'chassis_type' => 'Karavan',
                'gearbox' => 'Manuelni',
                'drive' => 'Prednji',
                'color' => 'Bijela',
                'engine_volume' => '1.5',
                'engine_strength' => 75,
                'opis' => 'RENAULT CLIO 1.5 DCI

                MOGUĆNOST ZAMJENE PO NAŠOJ PROCJENI!
                
                EURO 5
                
                Mogućnost kreditiranja za vozila!
                
                1.5 dCI
                2012 . GODINA
                55 KW - 75 KS
        
                Prešao 199.000 km
                Servisna knjiga (vozilo redovno održavano i servisirano u ovlaštenom servisu)',
                'oprema' => 'Centralna brava/Kozni trokraki podesivi volan sa komandama/El. podizaci stakala/Klima/CD-MP3 radio/Navigacija/ABS/ESP/ISOFIX/Manuelni mjenjac 5+R/Felge R15',
                "thumbnail" => "",
            ];
    });}
}
