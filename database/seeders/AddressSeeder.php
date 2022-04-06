<?php

namespace Database\Seeders;

use App\Models\Barangay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brgy_name = array(
            "Bagsangan","Bacolod","Batang",
            "Bolos","Buenavista","Bulawan","Carriedo",
            "Casini","Cawayan","Cogon","Gabao",
            "Gulang-Gulang","Gumapia","Santo Domingo",
            "Liang","Macawayan","Mapaso","Monbon",
            "Patag","Salvacion","San Agustin","San Isidro",
            "San Juan","San Julian","San Pedro","Tabon-Tabon",
            "Tinampo","Tongdol"
        );
        foreach ($brgy_name as $data) {
            Barangay::create([
                "barangay_name" => $data,
            ]);
        }
    }
}
