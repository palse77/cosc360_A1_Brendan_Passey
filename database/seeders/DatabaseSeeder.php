<?php

namespace Database\Seeders;

use App\Models\Post;
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
        //User::truncate();
        User::factory(1)
        ->has(Post::factory(10))
        ->create(['admin' => true]);

        User::factory(9)
        ->has(Post::factory(10))
        ->create(['admin' => false]);

        //User::factory()->create([
        //    'name' => 'Test User',
        //    'email' => 'test@example.com',
        //]);
        //$this->call(PostSeeder::class); 
    }
}
