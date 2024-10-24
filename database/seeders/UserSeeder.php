<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin')->insert([
            [
                'name' => "Admin ",
                'email' => "admin@test.com",
                'role' => "admin",
                'password' => Hash::make('123'),
            ],
            [
                'name' => "Admin1 ",
                'email' => "admin1@test.com",
                'role' => "admin",
                'password' => Hash::make('123'),
            ],
            [
                'name' => "Alif",
                'email' => "alif@gmail.com",
                "role" => "guru",
                'password' => Hash::make('123'),
            ],
            [
                'name' => "ummar",
                'email' => "ummar   @gmail.com",
                "role" => "guru",
                'password' => Hash::make('123'),
            ],
        ]);
        DB::table('siswa')->insert([
            [
                'nama' => 'test',
                'kelas' => 'test',
                'email'=> 'test@gmail.com',
                'password' => Hash::make('123'),
            ],
        ]);         
    }
}
