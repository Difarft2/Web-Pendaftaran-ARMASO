@extends('layout.admin')

@section('title', 'Dashboard | Admin')

@section('content')
<div class="row">
    <!-- Semua Pendaftar -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Semua Pendaftar</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ number_format($semuaPendaftar, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pendaftar Valid -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Pendaftar Valid</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ number_format($pendaftarValid, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-user-check fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Semua Tagihan -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Semua Tagihan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ number_format($semuaTagihan, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-money-bill fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pembayaran Valid -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pembayaran Valid</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ number_format($pembayaranValid, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-money-bills fa-2x "></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <!-- Statistik Asal Pendaftar -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Statistik Asal Pendaftar</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <table class="table table-bordered" id="kotaasal" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kota</th>
                                    <th>Pendaftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->tempat_lahir }}</td>
                                    <td><span class="badge"
                                            style="background-color:#6fffa2; color:#000; border-radius:20px; padding:5px 15px; font-weight:bold;">{{ $item->total }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Sekolah Pendaftar -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Statistik Sekolah Pendaftar</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <table class="table table-bordered" id="sekolah" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sekolah</th>
                                    <th>Pendaftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sekolah as $item)
                                <tr>
                                    <td>{{ $item->sekolah }}</td>
                                    <td><span class="badge"
                                            style="background-color:#6fffa2; color:#000; border-radius:20px; padding:5px 15px; font-weight:bold;">{{ $item->total }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- END row -->
</div> <!-- END container -->


<script>
$(document).ready(function() {
    $('#kotaasal').DataTable({
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

$(document).ready(function() {
    $('#sekolah').DataTable({
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
