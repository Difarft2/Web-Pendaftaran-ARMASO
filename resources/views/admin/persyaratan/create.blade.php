@extends('layout.admin')

@section('title', 'Persyaratan-Buat | Admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Buat Persyaratan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('persyaratan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Persyaratan</label>
                    <input type="text" class="form-control" id="judul" name="nama_persya"
                        placeholder="Masukkan Judul Persyaratan" required>
                </div>

                <div class="mb-3">
                    <label>Jenis Persyaratan</label><br>
                    <input type="radio" id="internal" name="jenis" value="internal" required>
                    <label for="internal">Internal</label><br>
                    <input type="radio" id="eksternal" name="jenis" value="eksternal" required>
                    <label for="eksternal">Eksternal</label>
                </div>

                <div class="mb-3 h-auto">
                    <label for="isi" class="form-label">Isi Persyaratan</label>
                    <textarea id="isi" name="persyaratan" class="form-control summernote" required></textarea>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('persyaratan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
