@extends('layouts.main')

@section('title', 'Nilai Siswa')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-star mr-2 text-primary"></i>Rekapitulasi Nilai Siswa</h1>
        <a href="{{ route('nilai.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Input Nilai Siswa
        </a>
    </div>

    <!-- DataTales -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Nilai Siswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Siswa</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Tugas (30%)</th>
                            <th>UTS (30%)</th>
                            <th>UAS (40%)</th>
                            <th>Nilai Akhir</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilais as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="font-weight-bold">{{ $item->siswa->nama ?? '-' }}</span></td>
                                <td>{{ $item->siswa->kelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $item->mapel->nama_mapel ?? '-' }}</td>
                                <td>{{ (float) $item->nilai_tugas }}</td>
                                <td>{{ (float) $item->nilai_uts }}</td>
                                <td>{{ (float) $item->nilai_uas }}</td>
                                <td><span class="badge badge-info">{{ (float) $item->nilai_akhir }}</span></td>
                                <td><span class="badge badge-{{ $item->keterangan === 'Lulus' ? 'success' : 'danger' }}">{{ $item->keterangan }}</span></td>
                                <td class="text-center text-nowrap">
                                    <a href="{{ route('nilai.edit', $item) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @include('partials.delete-form', ['action' => route('nilai.destroy', $item), 'message' => 'Hapus nilai ini?'])
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
