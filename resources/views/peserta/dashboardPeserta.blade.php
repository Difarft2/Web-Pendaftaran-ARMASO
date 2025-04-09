@extends('layout.dashboard')

@section('title', 'Dashboard | Peserta')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h3 mb-0 text-gray-800">Dashboard Peserta</h2>
        </div>

        <!-- Content Row  -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Setatus Peserta</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><span>
                                @if ($peserta == null)
                                    Belum Isi Data Diri
                                @elseif ($peserta->status_data == 'belum_valid')
                                    Data Sedang Diperiksa
                                @else
                                    Data Sudah Valid
                                @endif
                                </span></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-id-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Status Pembayaran</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><span>
                                @if ($tagihan == null)
                                    Belum Ada Tagihan
                                @elseif ($tagihan->status_tagihan == 'belum_upload')
                                    Belum Upload Bukti Pembayaran
                                @elseif ($tagihan->status_tagihan == 'di_periksa')
                                    Bukti Pembayaran Sedang Diperiksa
                                @else
                                    Bukti Pembayaran Sudah Valid
                                @endif
                                </span></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Pengumuman</h4>
        </div>
        <div class="card-body">
            @if($pengumuman->isEmpty())
                <div class="alert alert-warning">Belum ada data pengumuman untuk saat ini.</div>
            @else
                @foreach ($pengumuman as $index => $item)
                    <div class="card shadow mb-4">
                        <a href="#collapseCard{{ $index }}" class="d-block card-header py-3" data-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="collapseCard{{ $index }}">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $item->judul }}</h6>
                            <small class="text-muted">Tanggal: {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</small>
                        </a>
                        <div class="collapse" id="collapseCard{{ $index }}">
                            <div class="card-body">
                                <div class="mb-3 p-3 border-bottom">
                                    <p>{!! $item->isi !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

<style>
    .gradient-separator {
        height: 2px;
        background: gray;
        margin: 10px 0;
    }
</style>
