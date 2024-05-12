<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed dummy categories
        $categories = [
            ["name" => "Electronics"],
            ["name" => "Fashion"],
            ["name" => "Home"],
            ["name" => "Sports"],
            ["name" => "Toys"],
            ["name" => "Books"],
            ["name" => "Others"],
        ];

        foreach ($categories as $category) {
            // Check if category already exists
            $exists = Category::where("name", $category['name'])->exists();

            if (!$exists) {
                // Create a new category
                Category::factory()->create($category);
            }
        }
    }
}
