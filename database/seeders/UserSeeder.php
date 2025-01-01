<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'user_id' => 1,
            'first_name' => 'Admin',
            'last_name' => 'User',
            'username' => 'admin',
            'date_of_birth' => '1980-01-01',
            'profile_photo' => null,
            'about_me' => 'I am the admin of the platform.',
            'email' => 'admin@ehb.be',
            'email_verified_at' => now(),
            'password' => bcrypt('Password!321'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'user_id' => 2,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'john_doe',
            'date_of_birth' => '1990-05-15',
            'profile_photo' => null,
            'about_me' => 'A passionate tutor and learner.',
            'email' => 'john.doe@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password123'),
            'role' => 'tutor',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'user_id' => 3,
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'username' => 'jane_smith',
            'date_of_birth' => '1985-02-20',
            'profile_photo' => null,
            'about_me' => 'An experienced teacher and mentor.',
            'email' => 'jane.smith@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password123'),
            'role' => 'client',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'user_id' => 4,
            'first_name' => 'Michael',
            'last_name' => 'Johnson',
            'username' => 'michael_johnson',
            'date_of_birth' => '1992-08-11',
            'profile_photo' => null,
            'about_me' => 'An enthusiastic tutor with a passion for mathematics.',
            'email' => 'michael.johnson@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password456'),
            'role' => 'tutor',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'user_id' => 5,
            'first_name' => 'Emily',
            'last_name' => 'Williams',
            'username' => 'emily_williams',
            'date_of_birth' => '1993-09-25',
            'profile_photo' => null,
            'about_me' => 'Passionate about coding and technology.',
            'email' => 'emily.williams@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password789'),
            'role' => 'client',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'user_id' => 6,
            'first_name' => 'David',
            'last_name' => 'Brown',
            'username' => 'david_brown',
            'date_of_birth' => '1994-04-30',
            'profile_photo' => null,
            'about_me' => 'An avid learner and a professional software developer.',
            'email' => 'david.brown@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password101'),
            'role' => 'tutor',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
