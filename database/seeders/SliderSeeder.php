<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            'slideshow-character1.png',
            'slideshow-character2.png'

        ];
        foreach($images as $img){
            Slide::create(
                [
                    'tagline' => 'New Arrivals',
                    'title' => 'Night Spring',
                    'subtitle' => 'Dresses',
                    'link' => '#',
                    'status' => 1,
                    'image' => 'uploads\slides\\'.$img ,

                ]
                );

        }

    }
}
