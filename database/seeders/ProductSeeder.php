<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;

class ProductSeeder extends Seeder
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
            $product = Product::create([
                'id' => $i,
                'name' => $faker->name,
                'description' => $faker->text(200),
                'enable' => $faker->numberBetween(0, 1),
            ]);
            $product->categories()->attach($i);
            $product->images()->attach($i);
        }
    }
}
