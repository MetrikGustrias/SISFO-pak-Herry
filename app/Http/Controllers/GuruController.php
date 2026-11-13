<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class GuruController extends Controller
{
    public function index(): View
    {
        $gurus = Guru::orderBy('nama')->get();

        return view('guru.index', compact('gurus'));
    }

    public function create(): View
    {
        return view('guru.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Guru::create($this->validated($request));

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru): View
    {
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru): RedirectResponse
    {
        $guru->update($this->validated($request, $guru));

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru): RedirectResponse
    {
        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }

    private function validated(Request $request, ?Guru $guru = null): array
    {
        return $request->validate([
            'nip' => ['required', 'string', 'max:255', Rule::unique('gurus', 'nip')->ignore($guru?->id)],
            'nama' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'email' => ['nullable', 'email', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
        ], [
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah digunakan.',
            'email' => 'Format :attribute tidak valid.',
            'in' => ':attribute tidak valid.',
            'max' => ':attribute maksimal :max karakter.',
        ], [
            'nip' => 'NIP',
            'nama' => 'Nama',
            'jenis_kelamin' => 'Jenis kelamin',
            'email' => 'Email',
            'no_hp' => 'No HP',
            'alamat' => 'Alamat',
        ]);
    }
}
