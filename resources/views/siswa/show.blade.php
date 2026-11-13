@extends('layouts.main')

@section('title', 'Detail Siswa')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user-graduate mr-2 text-primary"></i>Detail Siswa</h1>
        <a href="{{ route('siswa.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Biodata</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr><th width="35%">NIS</th><td>{{ $siswa->nis }}</td></tr>
                        <tr><th>Nama</th><td>{{ $siswa->nama }}</td></tr>
                        <tr><th>Jenis Kelamin</th><td>{{ $siswa->jenis_kelamin === 'L' ? 'Laki-Laki' : 'Perempuan' }}</td></tr>
                        <tr><th>Kelas</th><td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td></tr>
                        <tr><th>Jurusan</th><td>{{ $siswa->kelas->jurusan ?? '-' }}</td></tr>
                        <tr><th>No HP</th><td>{{ $siswa->no_hp ?? '-' }}</td></tr>
                        <tr><th>Alamat</th><td>{{ $siswa->alamat ?? '-' }}</td></tr>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('siswa.edit', $siswa) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-1"></i> Edit</a>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Nilai Akademik</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <th>Tugas</th>
                                    <th>UTS</th>
                                    <th>UAS</th>
                                    <th>Akhir</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($siswa->nilais as $nilai)
                                    <tr>
                                        <td>{{ $nilai->mapel->nama_mapel ?? '-' }}</td>
                                        <td>{{ (float) $nilai->nilai_tugas }}</td>
                                        <td>{{ (float) $nilai->nilai_uts }}</td>
                                        <td>{{ (float) $nilai->nilai_uas }}</td>
                                        <td><span class="badge badge-info">{{ (float) $nilai->nilai_akhir }}</span></td>
                                        <td>
                                            <span class="badge badge-{{ $nilai->keterangan === 'Lulus' ? 'success' : 'danger' }}">{{ $nilai->keterangan }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Belum ada nilai untuk siswa ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
