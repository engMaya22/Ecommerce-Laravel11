<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => 'password',
            'type' =>'ADMIN',
            'mobile' => '1234567899'

        ]);
        User::factory()->create([
            'name' => 'user',
            'email' => 'user@mail.com',
            'password' => 'password',
            'type' =>'USR',
            'mobile' => '1234567890'

        ]);
        $this->call([
            MonthSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ReviewSeeder::class,
            SliderSeeder::class,

        ]);

    }
}
