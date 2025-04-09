@extends('layout.dashboard')

@section('title', 'Data Diri | Peserta')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary">Data Diri Peserta</h4>
    </div>
    @if ($peserta == null)
    <div class="card-body">
        <div class="alert alert-warning">Belum ada data diri peserta Silahakan isi data diri.</div>
        <a href="{{ Route('datadiri.create')}}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Isi Data Diri
        </a>
    </div>
    @else
    @if ($peserta->status_data == 'valid')
    <a href="{{ route('cetak.kartupeserta', $peserta->id) }}" target="_blank" class="btn btn-sm btn-primary">
        <i class="fa-solid fa-print"></i> Cetak Kartu Peserta
    </a>
    @endif
    <div class="card-body">
        <div class="row">
            <div class="col-md-9">
                <table class="table table-borderless">
                    <tr>
                        <th>Nomor Peserta</th>
                        <td>{{ $peserta->nomor_peserta }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $peserta->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td>{{ $peserta->nisn }}</td>
                    </tr>
                    <tr>
                        <th>Tempat, Tanggal Lahir</th>
                        <td>{{ $peserta->tempat_lahir }}, {{ $peserta->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $peserta->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $peserta->alamat }}</td>
                    </tr>
                    <tr>
                        <th>No. HP</th>
                        <td>{{ $peserta->nomor_hp }}</td>
                    </tr>
                </table>
                <a href="{{ Route('datadiri.edit')}}" class="btn btn-primary">
                    <i class="fa-solid fa-pencil"></i> Edit
                </a>
            </div>
        </div>
    </div>

    @if ($tagihan == null)
    <form action="{{ route('datadiri.pilihMapel') }}" method="POST" id="formPilihMapel">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Menu Mapel</h4>
                <span>Silahkan Pilih Mapel</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        @foreach ($infolomba as $mapel)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="mapel[]"
                                value="{{ $mapel->nama_lomba }}" id="mapel-{{ $mapel->nama_lomba }}">
                            <label class="form-check-label" for="mapel-{{ $mapel->nama_lomba }}">
                                {{ $mapel->nama_lomba }}
                            </label>
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary" id="btnSimpan">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endif
    @endif
</div>

<script>
document.getElementById("btnSimpan").addEventListener("click", function(event) {
    event.preventDefault(); // Mencegah submit form langsung

    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Pastikan Mapel yang dipilih sesuai!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Simpan!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formPilihMapel").submit();
        }
    });
});
</script>
@endsection
