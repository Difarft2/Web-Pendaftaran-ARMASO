@extends('layout.admin')

@section('title', 'Edit Data Peserta | Admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Edit Data Diri Peserta Online</h5>
            <div class="d-flex justify-content-end mb-3">
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('online.update', $peserta->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="{{ $peserta->nama_lengkap }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">NISN</label>
                    <input type="text" name="nisn" class="form-control" value="{{ $peserta->nisn }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sekolah</label>
                    <input type="text" name="sekolah" class="form-control" value="{{ $peserta->sekolah }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="{{ $peserta->tempat_lahir }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ $peserta->tanggal_lahir }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="laki-laki" {{ $peserta->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ $peserta->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" required>{{ $peserta->alamat }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor HP</label>
                    <input type="text" name="nomor_hp" class="form-control" value="{{ $peserta->nomor_hp }}" required>
                </div>

                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="{{ route('online.show', $peserta->id) }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
