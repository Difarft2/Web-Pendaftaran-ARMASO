@extends('layout.admin')

@section('title', 'Info Lomba-Buat | Admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Buat Info Lomba</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('infolomba.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="judul" class="form-label">Nama Lomba</label>
                    <input type="text" class="form-control" id="nama_lomba" name="nama_lomba" placeholder="Masukkan Nama Lomba"
                        required>
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi"
                        required>
                </div>

                <div class="mb-3">
                    <label for="jenis" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Masukkan Biaya"
                        required>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('infolomba.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
