<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'phuong nam',
            'email' => 'doannamq@gmail.com',
            'password' => bcrypt('nam240403')
        ]);

        Comment::factory(5)->create();
    }
}
