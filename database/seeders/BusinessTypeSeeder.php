<?php

namespace Database\Seeders;

use App\Models\BusinessType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Tuition Center',
            'Fitness Trainer',
            'Coaching Institute',
            'Music School',
            'Dance Academy',
            'Art Classes',
            'Yoga Studio',
        ];

        foreach ($types as $type) {
            BusinessType::firstOrCreate(['name' => $type]);
        }
    }
}
