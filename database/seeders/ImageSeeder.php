<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 10; $i++) {
            Image::create([
                'id' => $i,
                'name' => $faker->name,
                'file' => $faker->imageUrl(360, 360, 'animals', true, 'cats'),
                'enable' => $faker->numberBetween(0, 1),
            ]);
        }
    }
}
