<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Lalu Admin Ye',
                'no_hp' => '089876665434',
                'alamat' => 'Mataram',
                'jenis_kelamin' => 'Laki-laki',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'hak_akses' => 'Admin',
            ],
            [
                'name' => 'M Thoriq Panca Mukti',
                'no_hp' => '081233799312',
                'alamat' => 'Mataram',
                'jenis_kelamin' => 'Laki-laki',
                'email' => 'thoriq@gmail.com',
                'password' => bcrypt('thoriq'),
                'hak_akses' => 'User',
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
