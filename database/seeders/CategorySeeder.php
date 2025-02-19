<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesName = ['Dresses','Shorts','Swimwear','Jackets','Jeans'];
        $i = 1;
        foreach($categoriesName as $name){
                Category::create([
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'image' => 'category_'.$i.'.png',
                ]);
                $i++;
        }
    }
}




