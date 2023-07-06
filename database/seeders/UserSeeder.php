<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super-admin@article-apps.com',
            'password' => '$2y$10$ZK/ZyrV/O98wrjkZh2yCxOnaUYAZJ4nUJJYAo6SJ10LjcJ7vDdKRi',
            'is_admin' => true,
        ]);
    }
}
