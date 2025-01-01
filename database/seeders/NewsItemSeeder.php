<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
        {
        DB::table('news_items')->insert([
            'title' => 'New Institution: Uhasselt',
            'content' => 'We are excited to announce that the University of Hasselt (Uhasselt) is now a part of our network. New opportunities for students and tutors await!',
            'image_path' => 'images/uhasselt.jpg',
            'publication_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('news_items')->insert([
            'title' => 'New Course: Advanced Data Science',
            'content' => 'A new course in Advanced Data Science has been added to the curriculum. Tutors with expertise in machine learning and data analysis are welcome to join!',
            'image_path' => 'images/data_science.jpg',
            'publication_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('news_items')->insert([
            'title' => 'New Institution: VUB',
            'content' => 'The Free University of Brussels (VUB) is now officially partnering with us. Students and tutors can now benefit from its programs.',
            'image_path' => 'images/vub.png',
            'publication_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('news_items')->insert([
            'title' => 'New Course: Web Development Basics',
            'content' => 'Learn the basics of web development! A new introductory course to help students build websites using HTML, CSS, and JavaScript is now available.',
            'image_path' => 'images/web_development.jpg',
            'publication_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('news_items')->insert([
            'title' => 'New Institution: KU Leuven',
            'content' => 'We are thrilled to announce that KU Leuven has joined our network. Expect more exciting academic collaborations with this prestigious institution.',
            'image_path' => 'images/ku_leuven.jpg',
            'publication_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('news_items')->insert([
            'title' => 'New Course: Artificial Intelligence Fundamentals',
            'content' => 'A new course on Artificial Intelligence is now available! Students will learn about AI principles, algorithms, and applications.',
            'image_path' => 'images/ai_fundamentals.jpg',
            'publication_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('news_items')->insert([
            'title' => 'New Institution: Erasmushogeschool Brussel',
            'content' => 'Erasmushogeschool Brussel has officially joined our educational network, offering new opportunities for students and tutors alike.',
            'image_path' => 'images/erasmushogeschool.jpg',
            'publication_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('news_items')->insert([
            'title' => 'New Course: Digital Marketing Strategies',
            'content' => 'We are pleased to announce the launch of our new course on Digital Marketing. Tutors and students interested in marketing can now enroll.',
            'image_path' => 'images/digital_marketing.jpg',
            'publication_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('news_items')->insert([
            'title' => 'New Institution: UAntwerpen',
            'content' => 'The University of Antwerp (UAntwerpen) is now a partner in our network. Stay tuned for more academic partnerships and learning opportunities!',
            'image_path' => 'images/uantwerpen.jpg',
            'publication_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
