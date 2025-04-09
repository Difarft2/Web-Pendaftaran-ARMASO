@extends('layout.admin')

@section('title', 'Rekening-Edit | Admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Info Rekening</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('rekening.update') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $rekening->nama }}" required>
                </div>
                <div class="mb-3">
                    <label for="no_rekening" class="form-label">No Rekening</label>
                    <input type="text" class="form-control" id="no_rekening" name="no_rekening"
                        value="{{ $rekening->no_rekening }}" required>
                </div>
                <div class="mb-3">
                    <label for="nama_bank" class="form-label">Bank</label>
                    <input type="text" class="form-control" id="nama_bank" name="nama_bank"
                        value="{{ $rekening->nama_bank }}" required>
                </div>
                <div class="mb-3">
                    <label for="cabang" class="form-label">Cabang</label>
                    <input type="text" class="form-control" id="cabang" name="cabang" value="{{ $rekening->cabang }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi"
                        rows="4">{{ $rekening->deskripsi }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Info</button>
                <a href="{{ route('rekening.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
