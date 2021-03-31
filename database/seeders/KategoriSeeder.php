<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class KategoriSeeder extends Seeder
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
                'kategori' => $Faker->name,
                'keterangan' => $Faker->text,
            ];
            Kategori::create($data);
            
                    }
    }
}
