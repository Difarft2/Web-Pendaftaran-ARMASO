@extends('layout.dashboard')

@section('title', 'Tagihan | Peserta')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Info Rekening</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if($rekening->count() > 0)
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>No Rekening</th>
                        <th>Bank</th>
                        <th>Cabang</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rekening as $index => $info)
                    <tr>
                        <td>{{ $info->nama }}</td>
                        <td>{{ $info->no_rekening }}</td>
                        <td>{{ $info->nama_bank }}</td>
                        <td>{{ $info->cabang }}</td>
                        <td>{{ $info->deskripsi }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-warning">Belum ada data rekening yang tersedia.</div>
            @endif
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Tagihan Peserta</h5>
    </div>
    @if (optional($tagihan)->status_tagihan == 'valid')
    <a href="{{ route('tagihan.cetakpeserta', $tagihan->id) }}" target="_blank" class="btn btn-sm btn-primary">
        <i class="fa-solid fa-print"></i> Cetak Tagihan
    </a>
    @endif
    <div class="card-body">
        <div class="row">
            @if($tagihan)
            <table class="table table-borderless">
                <tr>
                    <th>Nomor Tagihan</th>
                    <td>{{ $tagihan->nomor_tagihan }}</td>
                </tr>
                <tr>
                    <th>Total Tagihan</th>
                    <td>{{ $tagihan->total_tagihan }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $tagihan->nama }}</td>
                </tr>
                <tr>
                    <th>Mapel</th>
                    <td>{{ $tagihan->lomba}}</td>
                </tr>
                <tr>
                    <th>Status Tagihan</th>
                    <td><b>
                            @if ($tagihan == null)
                            Belum Ada Tagihan
                            @elseif ($tagihan->status_tagihan == 'belum_upload')
                            Belum Upload Bukti Pembayaran
                            @elseif ($tagihan->status_tagihan == 'di_periksa')
                            Bukti Pembayaran Sedang Diperiksa
                            @else
                            Bukti Pembayaran Sudah Valid
                            @endif
                        </b></td>
                    </td>
                    </td>
                </tr>
                <tr>
                    <th>Nomor Bukti Pembayaran</th>
                    <td>{{ optional($tagihan)->nomor_bukti_pembayaran ?? 'Belum upload' }}</td>
                </tr>
                <tr>
                    <th>Bukti Pembayaran</th>
                    <td>
                        @if (!empty($tagihan->bukti_pembayaran))
                        <a href="{{ asset('storage/bukti_pembayaran/' . $tagihan->bukti_pembayaran) }}" target="_blank">
                            Lihat Bukti Pembayaran
                        </a>
                        @else
                        <span>Belum upload</span>
                        @endif
                    </td>
                </tr>
            </table>
            @if (optional($tagihan)->status_tagihan == 'belum_upload')
            <form action="{{ route('tagihan.upload', $tagihan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="bukti_pembayaran" class="btn btn-primary">📂 Pilih File</label>
                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="d-none"
                        accept=".jpg, .jpeg, .png" required>
                    <span id="file-name" class="ms-3 text-muted" style="line-height: 38px;"> Tidak ada file
                        dipilih</span>
                </div>
                <button type="submit" class="btn btn-primary">Upload Bukti Pembayaran</button>
            </form>
            @endif
            @else
            <div class="alert alert-warning">Silahkan pilih mapel dulu.</div>
            @endif
        </div>
    </div>
</div>

<script>
document.getElementById("bukti_pembayaran").addEventListener("change", function() {
    let fileName = this.files.length ? this.files[0].name : "Tidak ada file dipilih";
    document.getElementById("file-name").textContent = fileName;
});
</script>
@endsection
