<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class NilaiController extends Controller
{
    public function index(): View
    {
        $nilais = Nilai::with(['siswa.kelas', 'mapel'])->latest()->get();

        return view('nilai.index', compact('nilais'));
    }

    public function create(): View
    {
        $siswas = Siswa::with('kelas')->orderBy('nama')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('nilai.create', compact('siswas', 'mapels'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        Nilai::create($data + $this->hitung($data));

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil ditambahkan.');
    }

    public function edit(Nilai $nilai): View
    {
        $nilai->load(['siswa.kelas', 'mapel']);
        $siswas = Siswa::with('kelas')->orderBy('nama')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('nilai.edit', compact('nilai', 'siswas', 'mapels'));
    }

    public function update(Request $request, Nilai $nilai): RedirectResponse
    {
        $data = $this->validated($request, $nilai);

        $nilai->update($data + $this->hitung($data));

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil diperbarui.');
    }

    public function destroy(Nilai $nilai): RedirectResponse
    {
        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil dihapus.');
    }

    /**
     * Nilai akhir = (tugas * 0.3) + (uts * 0.3) + (uas * 0.4)
     * Keterangan  = nilai akhir >= KKM mapel ? 'Lulus' : 'Tidak Lulus'
     */
    private function hitung(array $data): array
    {
        $akhir = round(
            ($data['nilai_tugas'] * 0.3) + ($data['nilai_uts'] * 0.3) + ($data['nilai_uas'] * 0.4),
            2
        );
        $kkm = Mapel::findOrFail($data['mapel_id'])->kkm;

        return [
            'nilai_akhir' => $akhir,
            'keterangan' => $akhir >= $kkm ? 'Lulus' : 'Tidak Lulus',
        ];
    }

    private function validated(Request $request, ?Nilai $nilai = null): array
    {
        return $request->validate([
            'siswa_id' => ['required', 'exists:siswas,id'],
            'mapel_id' => [
                'required',
                'exists:mapels,id',
                // Satu siswa hanya boleh punya satu nilai per mapel (unique di migrasi).
                Rule::unique('nilais', 'mapel_id')
                    ->where('siswa_id', $request->input('siswa_id'))
                    ->ignore($nilai?->id),
            ],
            'nilai_tugas' => ['required', 'numeric', 'between:0,100'],
            'nilai_uts' => ['required', 'numeric', 'between:0,100'],
            'nilai_uas' => ['required', 'numeric', 'between:0,100'],
        ], [
            'required' => ':attribute wajib diisi.',
            'exists' => ':attribute tidak valid.',
            'numeric' => ':attribute harus berupa angka.',
            'between' => ':attribute harus antara :min sampai :max.',
            'mapel_id.unique' => 'Siswa ini sudah memiliki nilai untuk mata pelajaran tersebut.',
        ], [
            'siswa_id' => 'Siswa',
            'mapel_id' => 'Mata pelajaran',
            'nilai_tugas' => 'Nilai tugas',
            'nilai_uts' => 'Nilai UTS',
            'nilai_uas' => 'Nilai UAS',
        ]);
    }
}
