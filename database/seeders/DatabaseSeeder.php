<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(50)->create();
        \App\Models\Product::factory(50)->create();
        \App\Models\Doctor::factory(50)->create();
        \App\Models\Outlet::factory(50)->create();
        \App\Models\Role::create([
            'id' => 1,
            'name' => 'Admin'
        ]);
        \App\Models\Role::create([
            'id' => 2,
            'name' => 'DM'
        ]);
        \App\Models\Role::create([
            'id' => 3,
            'name' => 'RSM'
        ]);
        \App\Models\Role::create([
            'id' => 4,
            'name' => 'MM'
        ]);
    }
}
