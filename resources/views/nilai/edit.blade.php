@extends('layouts.main')

@section('title', 'Edit Nilai Siswa')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-star mr-2 text-primary"></i>Edit Nilai Siswa</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Nilai Siswa</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('nilai.update', $nilai) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="siswa_id">Siswa <span class="text-danger">*</span></label>
                <select name="siswa_id" id="siswa_id" class="form-control @error('siswa_id') is-invalid @enderror">
                    <option value="">-- Pilih Siswa --</option>
                    @foreach ($siswas as $item)
                        <option value="{{ $item->id }}" {{ (string) old('siswa_id', $nilai->siswa_id) === (string) $item->id ? 'selected' : '' }}>{{ $item->nis }} - {{ $item->nama }} ({{ $item->kelas->nama_kelas ?? '-' }})</option>
                    @endforeach
                </select>
                @error('siswa_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="mapel_id">Mata Pelajaran <span class="text-danger">*</span></label>
                <select name="mapel_id" id="mapel_id" class="form-control @error('mapel_id') is-invalid @enderror">
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach ($mapels as $item)
                        <option value="{{ $item->id }}" {{ (string) old('mapel_id', $nilai->mapel_id) === (string) $item->id ? 'selected' : '' }}>{{ $item->nama_mapel }} (KKM {{ $item->kkm }})</option>
                    @endforeach
                </select>
                @error('mapel_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            @include('partials.field', ['name' => 'nilai_tugas', 'label' => 'Nilai Tugas (bobot 30%)', 'type' => 'number', 'step' => '0.01', 'min' => 0, 'max' => 100, 'value' => $nilai->nilai_tugas])
            @include('partials.field', ['name' => 'nilai_uts', 'label' => 'Nilai UTS (bobot 30%)', 'type' => 'number', 'step' => '0.01', 'min' => 0, 'max' => 100, 'value' => $nilai->nilai_uts])
            @include('partials.field', ['name' => 'nilai_uas', 'label' => 'Nilai UAS (bobot 40%)', 'type' => 'number', 'step' => '0.01', 'min' => 0, 'max' => 100, 'value' => $nilai->nilai_uas])
            <p class="text-muted small">Nilai akhir dan keterangan (Lulus / Tidak Lulus) dihitung otomatis berdasarkan KKM mata pelajaran.</p>
            <hr>
            <a href="{{ route('nilai.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
