@extends('layout.admin')

@section('title', 'Kontak Admin-Buat | Admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buat Kontak Admin</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('kontakadmin.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="judul" class="form-label">Nama Admin</label>
                <input type="text" class="form-control" id="judul" name="nama" placeholder="Masukkan Nama Admin"
                    required>
            </div>

            <div class="mb-3">
                <label for="judul" class="form-label">Nomor Headphone</label>
                <input type="tel" class="form-control" id="judul" name="no_hp" placeholder="Masukkan Nomor Headphone"
                    required>
                <small class="text-muted d-block mt-2"><b>#Menggunkan +62</b></small>
            </div>

            <div class="mb-3 ">
                <label for="judul" class="form-label">Info</label>
                <input type="text" class="form-control" id="judul" name="info" placeholder="Masukkan Info" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('persyaratan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
