<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Siswa membutuhkan kelas_id, jadi pastikan ada kelas terlebih dahulu.
        $kelas = Kelas::firstOrCreate(
            ['nama_kelas' => 'XI RPL 1'],
            ['tingkat' => 'XI', 'jurusan' => 'Rekayasa Perangkat Lunak', 'tahun_ajaran' => '2025/2026']
        );

        // Data dummy siswa (kolom sesuai migrasi tabel siswas).
        $siswa = [
            ['nis' => '1001', 'nama' => 'Budi Santoso', 'jenis_kelamin' => 'L'],
            ['nis' => '1002', 'nama' => 'Siti Aminah', 'jenis_kelamin' => 'P'],
        ];

        foreach ($siswa as $s) {
            Siswa::firstOrCreate(['nis' => $s['nis']], $s + ['kelas_id' => $kelas->id]);
        }
    }
}
