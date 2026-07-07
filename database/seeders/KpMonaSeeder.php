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
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate tables
        DB::table('role')->truncate();
        DB::table('rt')->truncate();
        DB::table('users')->truncate();
        DB::table('pengaduan_kategori')->truncate();
        DB::table('pengaduan_status')->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

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
        $usedUsernames = ['admin', 'petugas', 'rw006'];

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
                'is_approved' => true,
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
                'is_approved' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_warga' => 'Ketua RW 006',
                'username' => 'rw006',
                'password' => $password,
                'role_id' => 3, // Ketua RW
                'no_tlp' => '081234567892',
                'email' => 'rw006@lingkojan.com',
                'alamat' => 'Kampung Kojan RW 006',
                'rt_id' => 1,
                'nik' => '1234567890123458',
                'is_approved' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);

        // 2. Loop per RT
        foreach ($rtNames as $index => $namaWargaKetua) {
            $rtId = $index + 1;

            // Seed 1 Ketua RT per RT
            $rtUsername = 'rt' . str_pad($rtId, 3, '0', STR_PAD_LEFT);
            $usedUsernames[] = $rtUsername;
            
            DB::table('users')->insert([
                'nama_warga' => $namaWargaKetua,
                'username' => $rtUsername,
                'password' => $password,
                'role_id' => 2, // Ketua RT
                'no_tlp' => $faker ? $faker->numerify('08##########') : '0812' . rand(10000000, 99999999),
                'email' => 'rt' . $rtId . '@lingkojan.com',
                'alamat' => 'Jl. Sltpn No. ' . ($index + 1) . ', RT. ' . str_pad($rtId, 3, '0', STR_PAD_LEFT) . '/RW. 006, Kampung Kojan, Kalideres, Jakarta Barat, Jakarta, 11840',
                'rt_id' => $rtId,
                'nik' => $faker ? $faker->unique()->numerify('################') : rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999),
                'is_approved' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            // Seed Warga
            $count = ($rtId == 15) ? 751 : 100;
            $wargaData = [];
            
            for ($i = 1; $i <= $count; $i++) {
                $name = $faker ? $faker->name : 'Warga RT' . $rtId . ' No' . $i;
                
                // Username based on name without random numbers
                $username = strtolower(str_replace([' ', '.', ','], '', preg_replace('/[^A-Za-z0-9 ]/', '', $name)));
                
                // If username is empty or too short, fallback
                if (empty($username)) { $username = 'user' . $i; }
                
                // Ensure uniqueness if collision occurs
                $baseUsername = $username;
                $counter = 1;
                while (in_array($username, $usedUsernames)) {
                    $username = $baseUsername . $counter;
                    $counter++;
                }
                $usedUsernames[] = $username;
                
                $email = $username . '@example.com';
                
                $wargaData[] = [
                    'nama_warga' => $name,
                    'username' => $username,
                    'password' => $password,
                    'role_id' => 1, // Warga
                    'no_tlp' => $faker ? $faker->numerify('08##########') : '0813' . rand(10000000, 99999999),
                    'email' => $email,
                    'alamat' => 'Jl. Sltpn No. ' . rand(1, 200) . ', RT. ' . str_pad($rtId, 3, '0', STR_PAD_LEFT) . '/RW. 006, Kampung Kojan, Kalideres, Jakarta Barat, Jakarta, 11840',
                    'rt_id' => $rtId,
                    'nik' => $faker ? $faker->unique()->numerify('################') : rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999),
                    'is_approved' => true,
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
