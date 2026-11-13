@extends('layouts.main')

@section('title', 'Data Siswa')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user-graduate mr-2 text-primary"></i>Data Siswa</h1>
        <a href="{{ route('siswa.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Siswa
        </a>
    </div>

    <!-- DataTales -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswas as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nis }}</td>
                                <td><span class="font-weight-bold">{{ $item->nama }}</span></td>
                                <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                <td><span class="badge badge-{{ $item->jenis_kelamin === 'L' ? 'primary' : 'danger' }}">{{ $item->jenis_kelamin === 'L' ? 'Laki-Laki' : 'Perempuan' }}</span></td>
                                <td>{{ $item->no_hp ?? '-' }}</td>
                                <td>{{ $item->alamat ?? '-' }}</td>
                                <td class="text-center text-nowrap">
                                    <a href="{{ route('siswa.show', $item) }}" class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('siswa.edit', $item) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @include('partials.delete-form', ['action' => route('siswa.destroy', $item), 'message' => 'Hapus siswa ini? Seluruh nilai milik siswa juga akan terhapus.'])
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
