<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            InstitutionSeeder::class,
            CourseSeeder::class,
            UserSeeder::class,
            TutorCourseSeeder::class,
            FAQCategorySeeder::class,
            FAQQuestionSeeder::class,
            NewsItemSeeder::class,
        ]);
    }
}
