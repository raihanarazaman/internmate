<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run()
    {
        DB::table('students')->insert([
            [
                'student_id' => 'CD001',
                'full_name' => 'Muhammad Amirul Hafiz',
                'course' => 'Computer Science',
                'cgpa' => 3.75,
                'interests' => 'Web Development, AI, Cybersecurity',
                'password' => Hash::make('12345678'), // ← HASHED!
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 'CD002',
                'full_name' => 'Lee Wei Jie',
                'course' => 'Computer Science',
                'cgpa' => 3.60,
                'interests' => 'Mobile Apps, Cloud Computing',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 'CA001',
                'full_name' => 'Nurul Aina Binti Azlan',
                'course' => 'Business Administration',
                'cgpa' => 3.45,
                'interests' => 'Marketing, Entrepreneurship, Finance',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 'CA002',
                'full_name' => 'Ahmad Faris bin Zainal',
                'course' => 'Business Administration',
                'cgpa' => 3.20,
                'interests' => 'HR Management, E-commerce',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 'CB001',
                'full_name' => 'Siti Nurhaliza',
                'course' => 'Graphic Design',
                'cgpa' => 3.85,
                'interests' => 'UI/UX, Branding, Illustration',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}