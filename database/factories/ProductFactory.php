<?php

namespace Database\Factories;

use App\Models\{
    Product,
    ProductInventory,
};

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'image' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=628&q=80',
            'price' => $this->faker->randomFloat(2, 0, 100),
            'slug' => $this->faker->slug,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $product_inventory = ProductInventory::factory()->create([
                'product_id' => $product->id,
                'quantity' => $this->faker->numberBetween(1, 10),
            ]);

            $product_inventory->save();
        });
    }
   
}
