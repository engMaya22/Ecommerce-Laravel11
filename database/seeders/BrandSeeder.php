<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = ['Adidas','Zara','Kenzo','Balenciaga'];
        foreach($brands as $brand){
                Brand::create([
                    'name' => $brand,
                    'slug' => Str::slug($brand),
                ]);
        }
    }
}
