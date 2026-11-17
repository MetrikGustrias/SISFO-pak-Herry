<?php

namespace Database\Seeders;

use App\Models\Mapel;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    /**
     * Isi data mata pelajaran. Aman dijalankan berulang (berdasarkan kode_mapel).
     */
    public function run(): void
    {
        $mapels = [
            // Muatan umum
            ['kode_mapel' => 'MP-PAI', 'nama_mapel' => 'Pendidikan Agama dan Budi Pekerti', 'kkm' => 75],
            ['kode_mapel' => 'MP-PKN', 'nama_mapel' => 'Pendidikan Pancasila dan Kewarganegaraan', 'kkm' => 75],
            ['kode_mapel' => 'MP-BIND', 'nama_mapel' => 'Bahasa Indonesia', 'kkm' => 75],
            ['kode_mapel' => 'MP-MTK', 'nama_mapel' => 'Matematika', 'kkm' => 70],
            ['kode_mapel' => 'MP-BING', 'nama_mapel' => 'Bahasa Inggris', 'kkm' => 75],
            ['kode_mapel' => 'MP-PJOK', 'nama_mapel' => 'Pendidikan Jasmani, Olahraga dan Kesehatan', 'kkm' => 75],
            ['kode_mapel' => 'MP-SEJ', 'nama_mapel' => 'Sejarah Indonesia', 'kkm' => 75],

            // Kejuruan
            ['kode_mapel' => 'MP-PWPB', 'nama_mapel' => 'Pemrograman Web & Perangkat Bergerak', 'kkm' => 75],
            ['kode_mapel' => 'MP-PBO', 'nama_mapel' => 'Pemrograman Berorientasi Objek', 'kkm' => 75],
            ['kode_mapel' => 'MP-BASDAT', 'nama_mapel' => 'Basis Data', 'kkm' => 78],
            ['kode_mapel' => 'MP-DDG', 'nama_mapel' => 'Dasar Desain Grafis', 'kkm' => 75],
            ['kode_mapel' => 'MP-JARKOM', 'nama_mapel' => 'Administrasi Infrastruktur Jaringan', 'kkm' => 78],
        ];

        foreach ($mapels as $mapel) {
            Mapel::updateOrCreate(['kode_mapel' => $mapel['kode_mapel']], $mapel);
        }
    }
}
