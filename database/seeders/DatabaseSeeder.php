<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'teguh',
            'email' => 'teguh180902@gmail.com',
            'type' => 0,
            'password' => bcrypt('7ermaniS.'),
        ]);

        DB::table('books')->insert([
            'name' => 'Test Book',
            'description' => 'Test Book Description',
            'author' => 'Test Author',
            'cover' => 'Test Cover',
            'file' => 'Test File',
            'user_id' => 1,
        ]);
    }
}
