<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategories;
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

        $admin = User::factory()->admin()->create([
            'no_anggota' => '01234567891234',
            'username' => 'admin',
            'password' => 'admin',
            'nama' => 'Admin'
        ]);

        $user = User::factory()->create([
            'no_anggota' => '98765432104321',
            'username' => 'user',
            'password' => 'user',
            'nama' => 'User 1'
        ]);

        User::factory(99)->create();

    }
}
