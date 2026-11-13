<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SiswaController extends Controller
{
    public function index(): View
    {
        $siswas = Siswa::with('kelas')->orderBy('nama')->get();

        return view('siswa.index', compact('siswas'));
    }

    public function create(): View
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();

        return view('siswa.create', compact('kelas'));
    }

    public function store(Request $request): RedirectResponse
    {
        Siswa::create($this->validated($request));

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show(Siswa $siswa): View
    {
        $siswa->load(['kelas', 'nilais.mapel']);

        return view('siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa): View
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();

        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, Siswa $siswa): RedirectResponse
    {
        $siswa->update($this->validated($request, $siswa));

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa): RedirectResponse
    {
        // Nilai milik siswa ikut terhapus (cascadeOnDelete pada migrasi).
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }

    private function validated(Request $request, ?Siswa $siswa = null): array
    {
        return $request->validate([
            'nis' => ['required', 'string', 'max:255', Rule::unique('siswas', 'nis')->ignore($siswa?->id)],
            'nama' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'alamat' => ['nullable', 'string'],
            'no_hp' => ['nullable', 'string', 'max:255'],
            'kelas_id' => ['required', 'exists:kelas,id'],
        ], [
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah digunakan.',
            'in' => ':attribute tidak valid.',
            'exists' => ':attribute tidak valid.',
            'max' => ':attribute maksimal :max karakter.',
        ], [
            'nis' => 'NIS',
            'nama' => 'Nama',
            'jenis_kelamin' => 'Jenis kelamin',
            'alamat' => 'Alamat',
            'no_hp' => 'No HP',
            'kelas_id' => 'Kelas',
        ]);
    }
}
