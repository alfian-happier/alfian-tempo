<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'nama' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'Administrator',
                'uuid' => Str::uuid()->toString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user12345'),
                'role' => 'User',
                'uuid' => Str::uuid()->toString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
