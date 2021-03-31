<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Faker = Faker::create();
        for($i=0;$i<100;$i++){
            $data = [
                'pelanggan' => $Faker->name,
                'alamat' => $Faker->address,
                'telp' => $Faker->phoneNumber,
            ];
            Pelanggan::create($data);
            
        }
    }
}
