<?php

namespace Database\Seeders;

use App\Models\BusinessType;
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
        // Get Business Types
        $tuition = BusinessType::where('name', 'Tuition Center')->first();
        $fitness = BusinessType::where('name', 'Fitness Trainer')->first();

        // Tuition Categories
        $subjects = Category::create(['name' => 'Subjects', 'business_type_id' => $tuition->id]);
        $classes = Category::create(['name' => 'Classes', 'business_type_id' => $tuition->id]);

        // Tuition Subcategories
        Category::create(['name' => 'Physics', 'business_type_id' => $tuition->id, 'parent_id' => $subjects->id]);
        Category::create(['name' => 'Chemistry', 'business_type_id' => $tuition->id, 'parent_id' => $subjects->id]);

        // Fitness Categories
        $workouts = Category::create(['name' => 'Workouts', 'business_type_id' => $fitness->id]);
        $dietPlans = Category::create(['name' => 'Diet Plans', 'business_type_id' => $fitness->id]);

        // Fitness Subcategories
        Category::create(['name' => 'Chest Workouts', 'business_type_id' => $fitness->id, 'parent_id' => $workouts->id]);
        Category::create(['name' => 'Leg Workouts', 'business_type_id' => $fitness->id, 'parent_id' => $workouts->id]);
    }
}
