@extends('layout.dashboard')

@section('title', 'Tambah Data Diri | Peserta')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary">Buat Data Diri Peserta</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('datadiri.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap"
                    value="{{ old('nama_lengkap') }}" required>
            </div>

            <div class="mb-3">
                <label for="nisn" class="form-label">NISN</label>
                <input type="text" name="nisn" class="form-control" id="nisn" value="{{ old('nisn') }}" required>
            </div>

            <div class="mb-3">
                <label for="sekolah" class="form-label">Asal Sekolah</label>
                <input type="text" name="sekolah" class="form-control" id="sekolah" value="{{ old('sekolah') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir"
                    value="{{ old('tempat_lahir') }}" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                    value="{{ old('tanggal_lahir') }}" required>
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" id="alamat" required>{{ old('alamat') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="nomor_hp" class="form-label">Nomor HP</label>
                <input type="text" name="nomor_hp" class="form-control" id="nomor_hp" value="{{ old('nomor_hp') }}"
                    required>
                <small class="text-muted d-block mt-2"><b># Menggunkan +62</b></small>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </form>
    </div>
</div>
@endsection