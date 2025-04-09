@extends('layout.admin')

@section('title', 'Pengumuman - Edit | Admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Pengumuman</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('pengumuman.updatePengumuman', $pengumuman->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Pengumuman</label>
                    <input type="text" name="judul" class="form-control" id="judul"
                        value="{{ old('judul', $pengumuman->judul) }}" required>
                </div>

                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis Pengumuman</label>
                    <select name="jenis" class="form-select" id="jenis" required>
                        <option value="internal" {{ $pengumuman->jenis == 'internal' ? 'selected' : '' }}>Internal</option>
                        <option value="eksternal" {{ $pengumuman->jenis == 'eksternal' ? 'selected' : '' }}>Eksternal</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="isi" class="form-label">Isi Pengumuman</label>
                    <textarea name="isi" class="form-control summernote" id="isi" rows="5" required>
                        {{ old('isi', $pengumuman->isi) }}
                    </textarea>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('pengumuman.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
