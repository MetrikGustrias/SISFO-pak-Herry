@extends('layouts.main')

@section('title', 'Tambah Guru')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-chalkboard-teacher mr-2 text-primary"></i>Tambah Guru</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Guru</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('guru.store') }}" method="POST">
            @csrf
            @include('partials.field', ['name' => 'nip', 'label' => 'NIP'])
            @include('partials.field', ['name' => 'nama', 'label' => 'Nama'])
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                    <option value="">-- Pilih --</option>
                    <option value="L" {{ old('jenis_kelamin', '') === 'L' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="P" {{ old('jenis_kelamin', '') === 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            @include('partials.field', ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => false])
            @include('partials.field', ['name' => 'no_hp', 'label' => 'No HP', 'required' => false])
            @include('partials.field', ['name' => 'alamat', 'label' => 'Alamat', 'type' => 'textarea', 'required' => false])
            <hr>
            <a href="{{ route('guru.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
            </form>
        </div>
    </div>
@endsection
