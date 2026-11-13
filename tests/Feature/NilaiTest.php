<?php

namespace Tests\Feature;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NilaiTest extends TestCase
{
    use RefreshDatabase;

    private function siswaDanMapel(int $kkm = 75): array
    {
        $kelas = Kelas::create([
            'nama_kelas' => 'XI RPL 1', 'tingkat' => 'XI',
            'jurusan' => 'RPL', 'tahun_ajaran' => '2025/2026',
        ]);
        $siswa = Siswa::create([
            'nis' => '1', 'nama' => 'Budi', 'jenis_kelamin' => 'L', 'kelas_id' => $kelas->id,
        ]);
        $mapel = Mapel::create(['kode_mapel' => 'MP-1', 'nama_mapel' => 'Basis Data', 'kkm' => $kkm]);

        return [$siswa, $mapel];
    }

    public function test_nilai_akhir_dan_keterangan_dihitung_otomatis(): void
    {
        [$siswa, $mapel] = $this->siswaDanMapel(75);

        $this->actingAs(User::factory()->create())
            ->post(route('nilai.store'), [
                'siswa_id' => $siswa->id, 'mapel_id' => $mapel->id,
                'nilai_tugas' => 85, 'nilai_uts' => 80, 'nilai_uas' => 90,
            ])
            ->assertRedirect(route('nilai.index'));

        $nilai = Nilai::first();
        $this->assertEquals(85.5, (float) $nilai->nilai_akhir);
        $this->assertSame('Lulus', $nilai->keterangan);
    }

    public function test_nilai_di_bawah_kkm_tidak_lulus(): void
    {
        [$siswa, $mapel] = $this->siswaDanMapel(75);

        $this->actingAs(User::factory()->create())
            ->post(route('nilai.store'), [
                'siswa_id' => $siswa->id, 'mapel_id' => $mapel->id,
                'nilai_tugas' => 70, 'nilai_uts' => 65, 'nilai_uas' => 70,
            ]);

        $this->assertSame('Tidak Lulus', Nilai::first()->keterangan);
    }

    public function test_siswa_tidak_boleh_punya_dua_nilai_untuk_mapel_yang_sama(): void
    {
        [$siswa, $mapel] = $this->siswaDanMapel();
        $payload = [
            'siswa_id' => $siswa->id, 'mapel_id' => $mapel->id,
            'nilai_tugas' => 80, 'nilai_uts' => 80, 'nilai_uas' => 80,
        ];
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('nilai.store'), $payload);
        $this->actingAs($user)->post(route('nilai.store'), $payload)->assertSessionHasErrors('mapel_id');

        $this->assertSame(1, Nilai::count());
    }

    public function test_kelas_yang_masih_punya_siswa_tidak_bisa_dihapus(): void
    {
        [$siswa] = $this->siswaDanMapel();

        $this->actingAs(User::factory()->create())
            ->delete(route('kelas.destroy', $siswa->kelas_id))
            ->assertSessionHas('error');

        $this->assertSame(1, Kelas::count());
    }
}
