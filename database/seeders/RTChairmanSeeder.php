<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\RukunTetangga;
use App\Models\Pengaduan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RTChairmanSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Clean up dependent data first
        // We delete users with rt/rw pattern, but first we must handle their pengaduans
        $userIds = User::where('username', 'like', 'rt%')
            ->orWhere('username', 'like', 'rw%')
            ->pluck('id');
            
        Pengaduan::whereIn('user_id', $userIds)->delete();
        User::whereIn('id', $userIds)->delete();
        
        // Clean RukunTetangga table
        DB::table('rukun_tetangga')->delete();

        // 2. Create RT 001-016
        for ($i = 1; $i <= 16; $i++) {
            $nomorRt = str_pad($i, 3, '0', STR_PAD_LEFT);
            
            RukunTetangga::create([
                'nomor' => $nomorRt,
                'nama_ketua' => 'Ketua RT ' . $nomorRt
            ]);

            // 3. Create Chairman User for each RT
            $user = User::create([
                'name' => 'Ketua RT ' . $nomorRt,
                'username' => 'rt' . $nomorRt,
                'email' => 'rt' . $nomorRt . '@lingkojan.com',
                'password' => Hash::make('password'),
                'rt' => $nomorRt,
                'rw' => '006',
                'nik' => '3307' . str_pad($i, 12, '0', STR_PAD_LEFT),
                'phone' => '0812' . str_pad($i, 9, '0', STR_PAD_LEFT),
            ]);

            $user->assignRole('rt');
        }

        // 4. Create RW 006 Chairman
        $rwUser = User::create([
            'name' => 'Ketua RW 006',
            'username' => 'rw006',
            'email' => 'rw006@lingkojan.com',
            'password' => Hash::make('password'),
            'rt' => null,
            'rw' => '006',
            'nik' => '3307' . str_pad('999', 12, '0', STR_PAD_LEFT),
            'phone' => '0812' . str_pad('6', 9, '0', STR_PAD_LEFT),
        ]);

        $rwUser->assignRole('rw');
    }
}
