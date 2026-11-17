<?php

namespace Database\Seeders;

use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Database\Seeder;

class NilaiSeeder extends Seeder
{
    /**
     * Isi data nilai untuk setiap siswa yang ada pada beberapa mata pelajaran.
     * Aman dijalankan berulang (berdasarkan pasangan siswa_id + mapel_id).
     * Nilai dibuat deterministik agar hasilnya sama di setiap komputer.
     */
    public function run(): void
    {
        $siswas = Siswa::all();
        $mapels = Mapel::all();

        if ($siswas->isEmpty() || $mapels->isEmpty()) {
            $this->command?->warn('Siswa atau mapel masih kosong. Jalankan SiswaSeeder / MapelSeeder terlebih dahulu.');

            return;
        }

        foreach ($siswas as $siswa) {
            // Tiap siswa mendapat nilai pada 6 mapel (dipilih berurutan dari daftar mapel).
            foreach ($mapels->take(6) as $mapel) {
                $tugas = $this->angka($siswa->id, $mapel->id, 'tugas');
                $uts = $this->angka($siswa->id, $mapel->id, 'uts');
                $uas = $this->angka($siswa->id, $mapel->id, 'uas');

                // Rumus sama dengan NilaiController::hitung()
                $akhir = round(($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4), 2);

                Nilai::updateOrCreate(
                    ['siswa_id' => $siswa->id, 'mapel_id' => $mapel->id],
                    [
                        'nilai_tugas' => $tugas,
                        'nilai_uts' => $uts,
                        'nilai_uas' => $uas,
                        'nilai_akhir' => $akhir,
                        'keterangan' => $akhir >= $mapel->kkm ? 'Lulus' : 'Tidak Lulus',
                    ]
                );
            }
        }
    }

    /**
     * Angka 60-98 yang konsisten untuk kombinasi siswa, mapel, dan jenis nilai.
     */
    private function angka(int $siswaId, int $mapelId, string $jenis): int
    {
        return 60 + (crc32("{$siswaId}-{$mapelId}-{$jenis}") % 39);
    }
}
