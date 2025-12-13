<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Owner
        User::create([
            'name' => 'Owner Coffee Shop',
            'email' => 'owner@coffee.com',
            'password' => bcrypt('password'),
            'role' => 'owner'
        ]);

        // Create Kasir
        User::create([
            'name' => 'Kasir 1',
            'email' => 'kasir@coffee.com',
            'password' => bcrypt('password'),
            'role' => 'kasir'
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Coffee', 'description' => 'Various coffee drinks'],
            ['name' => 'Non Coffee', 'description' => 'Non coffee beverages'],
            ['name' => 'Food', 'description' => 'Snacks and meals'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Create Sample Menus
        $menus = [
            ['category_id' => 1, 'name' => 'Americano', 'price' => 25000, 'description' => 'Classic black coffee'],
            ['category_id' => 1, 'name' => 'Cappuccino', 'price' => 30000, 'description' => 'Espresso with steamed milk'],
            ['category_id' => 1, 'name' => 'Latte', 'price' => 32000, 'description' => 'Smooth espresso with milk'],
            ['category_id' => 2, 'name' => 'Chocolate', 'price' => 28000, 'description' => 'Hot chocolate'],
            ['category_id' => 3, 'name' => 'Croissant', 'price' => 20000, 'description' => 'Buttery pastry'],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}