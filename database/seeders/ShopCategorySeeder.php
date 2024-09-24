<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShopCategory;

class ShopCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Restaurant'],
            ['name' => 'Cafe'],
            ['name' => 'Bar'],
            ['name' => 'Shop'],
            ['name' => 'Other'],
        ];

        ShopCategory::insert($categories);
    }
}
