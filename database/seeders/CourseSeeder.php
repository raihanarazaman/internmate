<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::insert([
            ['name' => 'Computer Science'],
            ['name' => 'Graphic Design'],
            ['name' => 'Business Administration'],
        ]);
    }
}
