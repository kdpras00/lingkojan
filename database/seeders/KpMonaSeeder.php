<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KpMonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data for table: role
        DB::table('role')->insert([
            ['id' => 1, 'name_role' => 'Warga'],
            ['id' => 2, 'name_role' => 'Ketua RT'],
            ['id' => 3, 'name_role' => 'Ketua RW'],
            ['id' => 4, 'name_role' => 'Petugas'],
            ['id' => 5, 'name_role' => 'Admin'],
        ]);

        // Data for table: rt
        $rtNames = [
            'H. Nahrawi', 'Tri Agus Setiawan', 'Sarudin Akmal', 'Mohammad Arifin',
            'Mustika Indah Cahyani', 'Sri Wahyuningsih', 'Abdul Rohim', 'Ahmad Zainudin',
            'Lukmanul Hakim', 'Madina Idris', 'Yasin Gunawan', 'Muhasan Muhammad Nur',
            'Bilal Jibriliant Aljabbar', 'Nisun Masan', 'Hamdani M. Nawi', 'Dede Arohman'
        ];

        $rts = [];
        foreach ($rtNames as $index => $name) {
            $rts[] = [
                'id' => $index + 1,
                'nama_rt' => str_pad($index + 1, 3, '0', STR_PAD_LEFT)
            ];
        }
        DB::table('rt')->insert($rts);

        // Data for table: pengaduan_kategori
        DB::table('pengaduan_kategori')->insert([
            ['id' => 1, 'kategori' => 'Kebersihan'],
            ['id' => 2, 'kategori' => 'Keamanan'],
            ['id' => 3, 'kategori' => 'Lingkungan'],
        ]);

        // Data for table: pengaduan_status
        DB::table('pengaduan_status')->insert([
            ['id' => 10, 'status' => 'New'],
            ['id' => 20, 'status' => 'On Progress'],
            ['id' => 30, 'status' => 'Done'],
            ['id' => 40, 'status' => 'Cancel'],
        ]);

        // Data for table: users
        $fakerExists = class_exists('\Faker\Factory');
        $faker = $fakerExists ? \Faker\Factory::create('id_ID') : null;
        $password = bcrypt('password123');
        $now = now();

        // 1. Admin & Petugas
        DB::table('users')->insert([
            [
                'nama_warga' => 'Administrator',
                'username' => 'admin',
                'password' => $password,
                'role_id' => 5,
                'no_tlp' => '081234567890',
                'email' => 'admin@lingkojan.com',
                'alamat' => 'Kampung Kojan RW 006',
                'rt_id' => 1,
                'nik' => '1234567890123456',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_warga' => 'Petugas Lapangan',
                'username' => 'petugas',
                'password' => $password,
                'role_id' => 4,
                'no_tlp' => '081234567891',
                'email' => 'petugas@lingkojan.com',
                'alamat' => 'Kampung Kojan RW 006',
                'rt_id' => 1,
                'nik' => '1234567890123457',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);

        // 2. Loop per RT
        foreach ($rtNames as $index => $namaWargaKetua) {
            $rtId = $index + 1;

            // Seed 1 Ketua RT per RT
            DB::table('users')->insert([
                'nama_warga' => $namaWargaKetua,
                'username' => 'rt' . str_pad($rtId, 3, '0', STR_PAD_LEFT),
                'password' => $password,
                'role_id' => 2, // Ketua RT
                'no_tlp' => $faker ? $faker->numerify('08##########') : '0812' . rand(10000000, 99999999),
                'email' => 'rt' . $rtId . '@lingkojan.com',
                'alamat' => 'Kampung Kojan RT ' . str_pad($rtId, 3, '0', STR_PAD_LEFT),
                'rt_id' => $rtId,
                'nik' => $faker ? $faker->unique()->numerify('################') : rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999),
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            // Seed Warga
            $count = ($rtId == 15) ? 751 : 100;
            $wargaData = [];
            
            for ($i = 1; $i <= $count; $i++) {
                $wargaData[] = [
                    'nama_warga' => $faker ? $faker->name : 'Warga RT' . $rtId . ' No' . $i,
                    'username' => 'warga_' . $rtId . '_' . $i,
                    'password' => $password,
                    'role_id' => 1, // Warga
                    'no_tlp' => $faker ? $faker->numerify('08##########') : '0813' . rand(10000000, 99999999),
                    'email' => $faker ? $faker->unique()->safeEmail : 'warga' . $rtId . '_' . $i . '@example.com',
                    'alamat' => 'Alamat Warga RT ' . str_pad($rtId, 3, '0', STR_PAD_LEFT),
                    'rt_id' => $rtId,
                    'nik' => $faker ? $faker->unique()->numerify('################') : rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                // Insert in chunks of 100 to avoid memory/SQL issues
                if (count($wargaData) >= 100) {
                    DB::table('users')->insert($wargaData);
                    $wargaData = [];
                }
            }
            
            if (!empty($wargaData)) {
                DB::table('users')->insert($wargaData);
            }
        }
    }
}
