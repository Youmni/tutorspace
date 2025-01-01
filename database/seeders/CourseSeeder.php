<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            'course_id' => 1,
            'title' => 'Artificial Intelligence 101',
            'description' => 'Introduction to the basics of artificial intelligence.',
            'institution_id' => 1, // UHasselt
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'course_id' => 2,
            'title' => 'Data Science and Analytics',
            'description' => 'A comprehensive course on data science, data analysis, and visualization.',
            'institution_id' => 2, // VUB
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'course_id' => 3,
            'title' => 'Machine Learning for Beginners',
            'description' => 'An introductory course to machine learning algorithms and techniques.',
            'institution_id' => 3, // KU Leuven
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'course_id' => 4,
            'title' => 'Web Development with Laravel',
            'description' => 'Learn web development by building projects using Laravel.',
            'institution_id' => 4, // Erasmushogeschool Brussel
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'course_id' => 5,
            'title' => 'Cybersecurity Fundamentals',
            'description' => 'Understanding the basics of cybersecurity and online threats.',
            'institution_id' => 5, // UAntwerpen
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'course_id' => 6,
            'title' => 'Cloud Computing with AWS',
            'description' => 'Learn how to use Amazon Web Services to build scalable cloud applications.',
            'institution_id' => 1, // UHasselt
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'course_id' => 7,
            'title' => 'Big Data and Hadoop',
            'description' => 'Learn about Big Data concepts and Hadoop framework.',
            'institution_id' => 2, // VUB
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'course_id' => 8,
            'title' => 'Blockchain Development',
            'description' => 'Introduction to blockchain technology and development.',
            'institution_id' => 3, // KU Leuven
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'course_id' => 9,
            'title' => 'Artificial Neural Networks',
            'description' => 'A deep dive into neural networks and their applications.',
            'institution_id' => 4, // Erasmushogeschool Brussel
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'course_id' => 10,
            'title' => 'DevOps and Continuous Integration',
            'description' => 'Learn DevOps principles and how to implement continuous integration in software projects.',
            'institution_id' => 5, // UAntwerpen
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
