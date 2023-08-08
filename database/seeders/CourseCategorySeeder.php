<?php

namespace Database\Seeders;

use App\Models\Course\CourseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseCategory::insert([
            [
                'icon' => '<ion-icon name="albums-outline"></ion-icon>',
                'name' => 'Web Development'
            ],
            [
                'icon' => '<ion-icon name="bar-chart-outline"></ion-icon>',
                'name' => 'Data Science'
            ]
        ]);
    }
}
