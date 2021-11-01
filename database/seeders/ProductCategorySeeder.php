<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \App\Models\ProductCategory::factory(5)->has(
            \App\Models\Product::factory()->count(2)
        )->create();
    }
}
