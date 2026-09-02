<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "Account Access",
            "Payments",
            "Feature Request",
            "Technical",
            "Billing",
            "General",
        ];

        foreach ($categories as $category) {
            Category::create([
                "title" => $category,
            ]);
        }
    }
}
