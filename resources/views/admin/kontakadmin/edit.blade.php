@extends('layout.admin')

@section('title', 'Pengumuman-Edit | Admin')

@section('content')
    <div class="container mt-5">
        <h3 class="mb-4">Edit Kontak Admin</h3>
        <form action="{{ route('kontakadmin.update', $kontakadmin->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="judul" class="form-label">Nama Admin</label>
                <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama', $kontakadmin->nama) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="judul" class="form-label">Nomor Headphone</label>
                <input type="text" name="no_hp" class="form-control" id="no_hp"
                    value="{{ old('no_hp', $kontakadmin->no_hp) }}" required>
                <small class="text-muted d-block mt-2"><b>#Menggunakan +62</b></small>
            </div>

            <div class="mb-3">
                <label for="judul" class="form-label">Info</label>
                <input type="text" name="info" class="form-control" id="info" value="{{ old('info', $kontakadmin->info) }}"
                    required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('kontakadmin.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
