@extends('layout.admin')

@section('title', 'Pengumuman-Buat | Admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Buat Pengumuman</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('pengumuman.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Pengumuman</label>
                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul Pengumuman"
                        required>
                </div>

                <div class="mb-3">
                    <label>Jenis Pengumuman</label><br>
                    <input type="radio" id="internal" name="jenis" value="internal" required>
                    <label for="internal">Internal</label><br>
                    <input type="radio" id="eksternal" name="jenis" value="eksternal" required>
                    <label for="eksternal">Eksternal</label>
                </div>

                <div class="mb-3 h-auto">
                    <label for="isi" class="form-label">Isi Pengumuman</label>
                    <textarea id="isi" name="isi" class="form-control summernote" required></textarea>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('persyaratan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
