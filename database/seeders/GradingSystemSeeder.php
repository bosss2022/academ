<?php

namespace Database\Seeders;

use App\Models\Grading_system;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class GradingSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gradings = [
            ['grade' => 'A', 'min_score' => 80, 'max_score' => 100],
            ['grade' => 'B+', 'min_score' => 70, 'max_score' => 79],
            ['grade' => 'B', 'min_score' => 60, 'max_score' => 69],
            ['grade' => 'C', 'min_score' => 50, 'max_score' => 59],
            ['grade' => 'D', 'min_score' => 40, 'max_score' => 49],
            ['grade' => 'E', 'min_score' => 0, 'max_score' => 39],
        ];

        foreach ($gradings as $grading) {
            Grading_system::create($grading);
        }
    }
}
