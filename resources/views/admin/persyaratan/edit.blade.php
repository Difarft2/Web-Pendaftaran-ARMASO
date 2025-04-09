@extends('layout.admin')

@section('title', 'Persyaratan-Edit | Admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Persyaratan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('persyaratan.update', $persyaratan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Persyaratan</label>
                    <input type="text" name="nama_persya" class="form-control" id="judul"
                        value="{{ old('nama_persya', $persyaratan->nama_persya) }}" required>
                </div>

                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis Persyaratan</label>
                    <select name="jenis" class="form-select" id="jenis" required>
                        <option value="internal" {{ $persyaratan->jenis == 'internal' ? 'selected' : '' }}>Internal</option>
                        <option value="eksternal" {{ $persyaratan->jenis == 'eksternal' ? 'selected' : '' }}>Eksternal
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="isi" class="form-label">Isi Persyaratan</label>
                    <textarea name="persyaratan" class="form-control summernote" id="isi" rows="5"
                        required>{{ old('persyaratan', $persyaratan->persyaratan) }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('persyaratan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
