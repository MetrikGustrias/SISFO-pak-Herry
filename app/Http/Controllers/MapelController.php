<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MapelController extends Controller
{
    public function index(): View
    {
        $mapels = Mapel::orderBy('kode_mapel')->get();

        return view('mapel.index', compact('mapels'));
    }

    public function create(): View
    {
        return view('mapel.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Mapel::create($this->validated($request));

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil ditambahkan.');
    }

    public function edit(Mapel $mapel): View
    {
        return view('mapel.edit', compact('mapel'));
    }

    public function update(Request $request, Mapel $mapel): RedirectResponse
    {
        $mapel->update($this->validated($request, $mapel));

        // Nilai akhir/keterangan yang sudah tersimpan bergantung pada KKM, hitung ulang agar tetap konsisten.
        $mapel->nilais()->get()->each(function ($nilai) use ($mapel) {
            $nilai->update(['keterangan' => $nilai->nilai_akhir >= $mapel->kkm ? 'Lulus' : 'Tidak Lulus']);
        });

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil diperbarui.');
    }

    public function destroy(Mapel $mapel): RedirectResponse
    {
        if ($mapel->nilais()->exists()) {
            return redirect()->route('mapel.index')
                ->with('error', 'Mata pelajaran tidak dapat dihapus karena sudah memiliki data nilai.');
        }

        $mapel->delete();

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil dihapus.');
    }

    private function validated(Request $request, ?Mapel $mapel = null): array
    {
        return $request->validate([
            'kode_mapel' => ['required', 'string', 'max:255', Rule::unique('mapels', 'kode_mapel')->ignore($mapel?->id)],
            'nama_mapel' => ['required', 'string', 'max:255'],
            'kkm' => ['required', 'integer', 'min:0', 'max:100'],
        ], [
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah digunakan.',
            'integer' => ':attribute harus berupa angka bulat.',
            'min' => ':attribute minimal :min.',
            'max' => ':attribute maksimal :max.',
        ], [
            'kode_mapel' => 'Kode mapel',
            'nama_mapel' => 'Nama mapel',
            'kkm' => 'KKM',
        ]);
    }
}
