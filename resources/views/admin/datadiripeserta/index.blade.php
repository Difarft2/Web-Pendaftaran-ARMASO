@extends('layout.admin')

@section('title', 'Data Peserta | Admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Data Peserta Valid</h5>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('export.download') }}" class="btn btn-success">
                <i class="fa-solid fa-print"></i> Print Data Peserta
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if ($dataValid->count() > 0)
            <table class="table table-bordered" id="dataTableValid">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nomor Peserta</th>
                        <th>Nama</th>
                        <th>Nomor HP</th>
                        <th>Sekolah</th>
                        <th>Mapel</th>
                        <th>Jenis Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataValid as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->nomor_peserta }}</td>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td>
                            <a href="https://wa.me/{{ $item->nomor_hp }}" target="_blank">
                                {{ $item->nomor_hp }}
                            </a>
                        </td>
                        <td>{{ $item->sekolah }}</td>
                        <td>{{ optional($item->tagihan)->lomba ?? 'Tidak ada mapel' }}</td>
                        <td>
                            @if ($item->jenis_daftar == 'online')
                            <span class="badge badge-info"><i class="fas fa-globe"></i> Daftar Online</span>
                            @elseif ($item->jenis_daftar == 'offline')
                            <span class="badge badge-success"><i class="fas fa-building"></i> Daftar Offline</span>
                            @else
                            <span class="badge badge-secondary"><i class="fas fa-users"></i> Daftar Kolektif</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-warning">Belum ada data diri peserta yang tersedia.</div>
            @endif
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Data Peserta Belum Valid</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if ($dataTidakvalid->count() > 0)
            <table class="table table-bordered" id="dataTableTidakValid">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nomor Peserta</th>
                        <th>Nama</th>
                        <th>Nomor HP</th>
                        <th>Sekolah</th>
                        <th>Mapel</th>
                        <th>Jenis Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataTidakvalid as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->nomor_peserta }}</td>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td>
                            <a href="https://wa.me/{{ $item->nomor_hp }}" target="_blank">
                                {{ $item->nomor_hp }}
                            </a>
                        </td>
                        <td>{{ $item->sekolah }}</td>
                        <td>{{ optional($item->tagihan)->lomba ?? 'Tidak ada mapel' }}</td>
                        <td>
                            @if ($item->jenis_daftar == 'online')
                            <span class="badge badge-info"><i class="fas fa-globe"></i> Daftar Online</span>
                            @elseif ($item->jenis_daftar == 'offline')
                            <span class="badge badge-success"><i class="fas fa-building"></i> Daftar Offline</span>
                            @else
                            <span class="badge badge-secondary"><i class="fas fa-users"></i> Daftar Kolektif</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-warning">Belum ada data diri peserta yang tersedia.</div>
            @endif
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#dataTableValid').DataTable({
        pageLength: 10,
        lengthMenu: [10, 20, 50, 100],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
                previous: "Sebelumnya",
                next: "Berikutnya"
            },
            zeroRecords: "Tidak ditemukan data yang cocok",
        }
    });

    $('#dataTableTidakValid').DataTable({
        pageLength: 10,
        lengthMenu: [10, 20, 50, 100],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
                previous: "Sebelumnya",
                next: "Berikutnya"
            },
            zeroRecords: "Tidak ditemukan data yang cocok",
        }
    });
});
</script>
@endsection
