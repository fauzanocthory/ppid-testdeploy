<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Informasi Serta Merta',
            'description' => 'Dekripsi Informasi Serta Merta',
        ]);

        Category::create([
            'name' => 'Profil KUA',
            'description' => 'Dekripsi Profil KUA',
        ]);
    }
}
