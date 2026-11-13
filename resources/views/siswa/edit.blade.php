@extends('layouts.main')

@section('title', 'Edit Siswa')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user-graduate mr-2 text-primary"></i>Edit Siswa</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Siswa</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('siswa.update', $siswa) }}" method="POST">
            @csrf
            @method('PUT')
            @include('partials.field', ['name' => 'nis', 'label' => 'NIS', 'value' => $siswa->nis])
            @include('partials.field', ['name' => 'nama', 'label' => 'Nama', 'value' => $siswa->nama])
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                    <option value="">-- Pilih --</option>
                    <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="kelas_id">Kelas <span class="text-danger">*</span></label>
                <select name="kelas_id" id="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelas as $item)
                        <option value="{{ $item->id }}" {{ (string) old('kelas_id', $siswa->kelas_id) === (string) $item->id ? 'selected' : '' }}>{{ $item->nama_kelas }}</option>
                    @endforeach
                </select>
                @error('kelas_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            @include('partials.field', ['name' => 'no_hp', 'label' => 'No HP', 'required' => false, 'value' => $siswa->no_hp])
            @include('partials.field', ['name' => 'alamat', 'label' => 'Alamat', 'type' => 'textarea', 'required' => false, 'value' => $siswa->alamat])
            <hr>
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
