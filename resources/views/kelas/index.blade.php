@extends('layouts.main')

@section('title', 'Data Kelas')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-door-open mr-2 text-primary"></i>Data Kelas</h1>
        <a href="{{ route('kelas.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Kelas
        </a>
    </div>

    <!-- DataTales -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Tingkat</th>
                            <th>Jurusan</th>
                            <th>Tahun Ajaran</th>
                            <th>Jumlah Siswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelas as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="font-weight-bold">{{ $item->nama_kelas }}</span></td>
                                <td>{{ $item->tingkat }}</td>
                                <td>{{ $item->jurusan }}</td>
                                <td>{{ $item->tahun_ajaran }}</td>
                                <td><span class="badge badge-info">{{ $item->siswas_count }}</span></td>
                                <td class="text-center text-nowrap">
                                    <a href="{{ route('kelas.edit', $item) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @include('partials.delete-form', ['action' => route('kelas.destroy', $item), 'message' => 'Hapus kelas ini?'])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('partials.datatable')
@endsection
