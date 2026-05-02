<?php

namespace Database\Seeders;

use App\Models\Pengaduan;
use App\Models\TindakLanjut;
use App\Models\User;
use Illuminate\Database\Seeder;

class PengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warga = User::where('username', 'warga')->first();
        $petugas = User::where('username', 'petugas')->first();

        if (!$warga || !$petugas) {
            return;
        }

        $pengaduans = [
            [
                'user_id' => $warga->id,
                'nomor_pengaduan' => 'P-20260501-0001',
                'kategori' => 'Keamanan',
                'subjek' => 'perbaiki jalan ini',
                'foto' => 'pengaduans/CEOmGAPd7vBCvE2tTPxz0rzuNElUlrSQj89HUj46.png',
                'alamat' => 'perbaiki jalan ini karena rusak tidak bisa di perbaiki',
                'rt' => '001',
                'rw' => '001',
                'status' => 'Cancel',
                'created_at' => '2026-05-01 07:34:47',
                'updated_at' => '2026-05-01 07:35:23',
                'tindak_lanjuts' => [
                    [
                        'user_id' => $warga->id,
                        'status' => 'Cancel',
                        'detail' => 'Laporan dibatalkan oleh pelapor.',
                        'foto' => null,
                        'created_at' => '2026-05-01 07:35:23',
                    ]
                ]
            ],
            [
                'user_id' => $warga->id,
                'nomor_pengaduan' => 'P-20260501-0002',
                'kategori' => 'Fasilitas Umum',
                'subjek' => 'jalan rusak bisa diperbaiki segera ga',
                'foto' => 'pengaduans/w4fSjWrkHV476DNfd130AAKFb1fnneo0hOMmETDq.png',
                'alamat' => 'jalan rusak bisa diperbaiki segera ga',
                'rt' => '001',
                'rw' => '001',
                'status' => 'Done',
                'created_at' => '2026-05-01 07:36:30',
                'updated_at' => '2026-05-01 08:11:52',
                'tindak_lanjuts' => [
                    [
                        'user_id' => $petugas->id,
                        'status' => 'On Progress',
                        'detail' => 'tes',
                        'foto' => 'tindak_lanjut/JkS3UANSRZvwaFT4dreu15AUje1g83oqbM7egnmq.png',
                        'created_at' => '2026-05-01 07:59:57',
                    ],
                    [
                        'user_id' => $petugas->id,
                        'status' => 'Done',
                        'detail' => 'selesai ya',
                        'foto' => 'tindak_lanjut/KK0nRHQbx7471ea7BWd6Zl2BI9ag0K1fQxNuNEoY.png',
                        'created_at' => '2026-05-01 08:11:52',
                    ]
                ]
            ],
            [
                'user_id' => $warga->id,
                'nomor_pengaduan' => 'P-20260501-0003',
                'kategori' => 'Kebersihan',
                'subjek' => 'jalan rusak rt 007',
                'foto' => 'pengaduans/xft0XYdrG7bRaRW92jw7PKX8BmOQVRqu9Y2Ge9lX.png',
                'alamat' => 'jalanannya masih rusak pak',
                'rt' => '001',
                'rw' => '006',
                'status' => 'Cancel',
                'created_at' => '2026-05-01 09:59:41',
                'updated_at' => '2026-05-01 10:01:43',
                'tindak_lanjuts' => [
                    [
                        'user_id' => $petugas->id,
                        'status' => 'On Progress',
                        'detail' => 'siapp',
                        'foto' => 'tindak_lanjut/tcOt38BrZadOZQ9mEDwyNTyFBNknKimTzlb8sl26.png',
                        'created_at' => '2026-05-01 10:01:17',
                    ],
                    [
                        'user_id' => $petugas->id,
                        'status' => 'Cancel',
                        'detail' => 'gagal',
                        'foto' => 'tindak_lanjut/mUdlFnQ8F7p0UkjelkXYarRWJ0CiYFogT33GI7yo.png',
                        'created_at' => '2026-05-01 10:01:43',
                    ]
                ]
            ],
            [
                'user_id' => $warga->id,
                'nomor_pengaduan' => 'P-20260501-0004',
                'kategori' => 'Infrastruktur',
                'subjek' => 'jalan rusak',
                'foto' => 'pengaduans/N2UekvDFVFPNL4BFZgIFaGp0MxIgwk1IDBZxGv3G.png',
                'alamat' => 'jalan rusak',
                'rt' => '001',
                'rw' => '006',
                'status' => 'On Progress',
                'created_at' => '2026-05-01 10:26:17',
                'updated_at' => '2026-05-01 10:26:35',
                'tindak_lanjuts' => [
                    [
                        'user_id' => $petugas->id,
                        'status' => 'On Progress',
                        'detail' => 'gasken',
                        'foto' => null,
                        'created_at' => '2026-05-01 10:26:35',
                    ]
                ]
            ],
        ];

        foreach ($pengaduans as $p) {
            $tindak_lanjuts = $p['tindak_lanjuts'];
            unset($p['tindak_lanjuts']);

            $pengaduan = Pengaduan::updateOrCreate(
                ['nomor_pengaduan' => $p['nomor_pengaduan']],
                $p
            );

            foreach ($tindak_lanjuts as $tl) {
                TindakLanjut::updateOrCreate(
                    [
                        'pengaduan_id' => $pengaduan->id,
                        'status' => $tl['status'],
                        'detail' => $tl['detail']
                    ],
                    $tl
                );
            }
        }
    }
}
