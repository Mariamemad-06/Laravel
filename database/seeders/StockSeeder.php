<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Warehouse;
use App\Models\Ingredient;
use App\Models\Product;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warehouse = Warehouse::create([
            'name' => 'Main Warehouse',
            'location' => '123 Main St, Cityville',
        ]);
        $ingredient1 = Ingredient::create([
            'name' => 'Beef',
            'initial_quantity' => 20000,
        ]);
        $ingredient2 = Ingredient::create([
            'name' => 'cheese',
            'initial_quantity' => 5000,
        ]);
        $ingredient3 = Ingredient::create([
            'name' => 'onion',
            'initial_quantity' => 1000,
        ]);
        $stock1 = $warehouse->stocks()->create([
            'ingredient_id' => $ingredient1->id,
            'warehouse_id' => $warehouse->id,
            'quantity' => 20000,
        ]);
        $stock2 = $warehouse->stocks()->create([
            'ingredient_id' => $ingredient2->id,
            'warehouse_id' => $warehouse->id,
            'quantity' => 5000,
        ]);
        $stock3 = $warehouse->stocks()->create([
            'ingredient_id' => $ingredient3->id,
            'warehouse_id' => $warehouse->id,
            'quantity' => 1000,
        ]);
     $burger = Product::create([
    'name' => 'Burger',
    'sku' => 'BURGER-001',
    'price' => 150,
    'description' => 'Classic beef burger',
      ]);
      $burger->ingredients()->attach([
    $ingredient1->id => ['quantity' => 150],
    $ingredient2->id => ['quantity' => 30],
    $ingredient3->id => ['quantity' => 20],
]);
    }

}
