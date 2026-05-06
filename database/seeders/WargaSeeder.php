<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class WargaSeeder extends Seeder
{
    /**
     * Seed warga dummy per RT di RW 006.
     * Jumlah warga per RT berkisar 400–600 jiwa.
     */
    public function run(): void
    {
        // Jumlah warga per RT (RT 001 s.d. RT 016)
        $wargaPerRt = [
            '001' => 487,
            '002' => 512,
            '003' => 463,
            '004' => 534,
            '005' => 498,
            '006' => 521,
            '007' => 475,
            '008' => 549,
            '009' => 488,
            '010' => 503,
            '011' => 467,
            '012' => 527,
            '013' => 491,
            '014' => 518,
            '015' => 571,
            '016' => 445,
        ];

        $password = Hash::make('password');
        $nikCounter = 33071000000001;
        $phoneCounter = 81200000001;

        foreach ($wargaPerRt as $rt => $jumlah) {
            $this->command->info("Seeding {$jumlah} warga untuk RT {$rt}...");

            $users = [];
            for ($i = 1; $i <= $jumlah; $i++) {
                $nik    = (string) $nikCounter++;
                $phone  = '0' . $phoneCounter++;

                $users[] = [
                    'name'              => fake('id_ID')->name(),
                    'username'          => 'warga_rt' . $rt . '_' . $i,
                    'email'             => 'warga.rt' . $rt . '.' . $i . '@lingkojan.com',
                    'password'          => $password,
                    'nik'               => $nik,
                    'phone'             => $phone,
                    'rt'                => $rt,
                    'rw'                => '006',
                    'email_verified_at' => now(),
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ];

                // Insert per batch 200 agar tidak OOM
                if (count($users) >= 200) {
                    $this->insertBatch($users);
                    $users = [];
                }
            }

            if (!empty($users)) {
                $this->insertBatch($users);
            }
        }

        $this->command->info('Selesai seed warga!');
    }

    private function insertBatch(array $users): void
    {
        // Insert tanpa event model (lebih cepat)
        \DB::table('users')->insert($users);

        // Assign role 'warga' ke semua user yang baru diinsert
        $role = \Spatie\Permission\Models\Role::where('name', 'warga')->first();
        if (!$role) {
            return;
        }

        $emails = array_column($users, 'email');
        $userIds = \DB::table('users')->whereIn('email', $emails)->pluck('id');

        $modelHasRoles = $userIds->map(fn ($id) => [
            'role_id'    => $role->id,
            'model_type' => 'App\\Models\\User',
            'model_id'   => $id,
        ])->toArray();

        \DB::table('model_has_roles')->insertOrIgnore($modelHasRoles);
    }
}
