@extends('layouts.main')

@section('title', 'Edit Kelas')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-door-open mr-2 text-primary"></i>Edit Kelas</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Kelas</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('kelas.update', $kelas) }}" method="POST">
            @csrf
            @method('PUT')
            @include('partials.field', ['name' => 'nama_kelas', 'label' => 'Nama Kelas', 'value' => $kelas->nama_kelas])
            @include('partials.field', ['name' => 'tingkat', 'label' => 'Tingkat (X / XI / XII)', 'value' => $kelas->tingkat])
            @include('partials.field', ['name' => 'jurusan', 'label' => 'Jurusan', 'value' => $kelas->jurusan])
            @include('partials.field', ['name' => 'tahun_ajaran', 'label' => 'Tahun Ajaran (mis. 2025/2026)', 'value' => $kelas->tahun_ajaran])
            <hr>
            <a href="{{ route('kelas.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
