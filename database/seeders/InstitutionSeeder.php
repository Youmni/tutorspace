<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('institutions')->insert([
            'institution_id' => 1,
            'name' => 'UHasselt',
            'country' => 'Belgium',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('institutions')->insert([
            'institution_id' => 2,
            'name' => 'VUB',
            'country' => 'Belgium',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('institutions')->insert([
            'institution_id' => 3,
            'name' => 'KU Leuven',
            'country' => 'Belgium',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('institutions')->insert([
            'institution_id' => 4,
            'name' => 'Erasmushogeschool Brussel',
            'country' => 'Belgium',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('institutions')->insert([
            'institution_id' => 5,
            'name' => 'UAntwerpen',
            'country' => 'Belgium',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
