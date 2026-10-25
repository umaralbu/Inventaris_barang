<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Admin Inventaris',
                'password' => Hash::make('password'),
                'role' => User::ROLE_ADMIN,
            ]
        );

        User::firstOrCreate(
            ['username' => 'pegawai'],
            [
                'name' => 'Pegawai',
                'password' => Hash::make('password'),
                'role' => User::ROLE_USER,
            ]
        );

        $this->call([
            StaffSeeder::class,
            LibraryInventorySeeder::class,
        ]);
    }
}
