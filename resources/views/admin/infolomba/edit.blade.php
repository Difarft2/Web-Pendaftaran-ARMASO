@extends('layout.admin')

@section('title', 'Info Lomba-Edit | Admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Info Lomba</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('infolomba.update', $infolomba->idlomba) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label">Nama Lomba</label>
                    <input type="text" name="nama_lomba" class="form-control" id="nama_lomba"
                        value="{{ old('nama_lomba', $infolomba->nama_lomba) }}" required>
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control" id="deskripsi"
                        value="{{ old('deskripsi', $infolomba->deskripsi) }}" required>
                </div>

                <div class="mb-3">
                    <label for="jenis" class="form-label">Harga</label>
                    <input type="text" name="harga" class="form-control" id="harga"
                        value="{{ old('harga', $infolomba->harga) }}" required>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('infolomba.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
