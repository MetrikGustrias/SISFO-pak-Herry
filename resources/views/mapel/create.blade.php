@extends('layouts.main')

@section('title', 'Tambah Mata Pelajaran')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-book mr-2 text-primary"></i>Tambah Mata Pelajaran</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Mata Pelajaran</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('mapel.store') }}" method="POST">
            @csrf
            @include('partials.field', ['name' => 'kode_mapel', 'label' => 'Kode Mapel'])
            @include('partials.field', ['name' => 'nama_mapel', 'label' => 'Nama Mata Pelajaran'])
            @include('partials.field', ['name' => 'kkm', 'label' => 'KKM', 'type' => 'number', 'min' => 0, 'max' => 100, 'value' => 75])
            <hr>
            <a href="{{ route('mapel.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
            </form>
        </div>
    </div>
@endsection
