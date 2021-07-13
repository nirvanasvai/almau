<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 250; $i++) {
            $images =
                [
                    'url' => \Faker\Provider\Image::image('images', 578, 340),
                    'adt_id' => rand(1, 50),
                    'slug_main_image'=>$i
                ];
            Image::query()->create($images);
        }
    }
}
