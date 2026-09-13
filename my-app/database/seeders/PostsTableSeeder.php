<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = DB::table('users')->value('id');

        DB::table('posts')->insert([
            'user_id' => $userId,
            'title' => 'Sample',
            'body' => 'This is Sample Feed',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
