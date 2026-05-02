<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@lingkojan.com',
                'password' => 'password',
                'role' => 'admin',
                'rt' => null,
                'rw' => null,
            ],
            [
                'name' => 'Warga User',
                'username' => 'warga',
                'email' => 'warga@lingkojan.com',
                'password' => 'password',
                'role' => 'warga',
                'rt' => '001',
                'rw' => '006',
            ],
            [
                'name' => 'Petugas Lapangan',
                'username' => 'petugas',
                'email' => 'petugas@lingkojan.com',
                'password' => 'password',
                'role' => 'petugas',
                'rt' => null,
                'rw' => null,
            ],
        ];

        foreach ($users as $userData) {
            // Create RukunTetangga record if it's an RT role
            if ($userData['role'] == 'rt' && $userData['rt']) {
                \App\Models\RukunTetangga::updateOrCreate(
                    ['nomor' => $userData['rt']],
                    ['nama_ketua' => $userData['name']]
                );
            }

            $user = User::updateOrCreate(
                ['username' => $userData['username']],
                [
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']),
                    'rt' => $userData['rt'],
                    'rw' => $userData['rw'],
                    'nik' => '3307' . str_pad(rand(1, 999999), 12, '0', STR_PAD_LEFT),
                    'phone' => '0812' . str_pad(rand(1, 999999), 9, '0', STR_PAD_LEFT),
                ]
            );

            if (!$user->hasRole($userData['role'])) {
                $user->assignRole($userData['role']);
            }
        }
    }
}
