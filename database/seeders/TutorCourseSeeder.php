<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TutorCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tutor_courses')->insert([
            'user_id' => 1,
            'course_id' => 1,
        ]);

        DB::table('tutor_courses')->insert([
            'user_id' => 2,
            'course_id' => 2,
        ]);

        DB::table('tutor_courses')->insert([
            'user_id' => 3,
            'course_id' => 3,
        ]);

        DB::table('tutor_courses')->insert([
            'user_id' => 4,
            'course_id' => 4,
        ]);

        DB::table('tutor_courses')->insert([
            'user_id' => 5,
            'course_id' => 5,
        ]);

        DB::table('tutor_courses')->insert([
            'user_id' => 6,
            'course_id' => 6,
        ]);

        DB::table('tutor_courses')->insert([
            'user_id' => 3,
            'course_id' => 7,
        ]);

        DB::table('tutor_courses')->insert([
            'user_id' => 4,
            'course_id' => 8,
        ]);

        DB::table('tutor_courses')->insert([
            'user_id' => 5,
            'course_id' => 9,
        ]);

        DB::table('tutor_courses')->insert([
            'user_id' => 6,
            'course_id' => 10,
        ]);
    }
}
