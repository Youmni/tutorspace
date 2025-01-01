<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FAQCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faq_categories')->insert([
            'category_id' => 1,
            'name' => 'General Questions',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('faq_categories')->insert([
            'category_id' => 2,
            'name' => 'Courses & Programs',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('faq_categories')->insert([
            'category_id' => 3,
            'name' => 'Account & Billing',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
