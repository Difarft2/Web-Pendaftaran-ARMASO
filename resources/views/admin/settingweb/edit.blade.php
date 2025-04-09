@extends('layout.admin')

@section('title', 'Setting-Edit | Admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Pengumuman</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('settingweb.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nama_website" class="form-label">Nama Website</label>
                    <input type="text" name="nama_website" id="nama_website" class="form-control"
                        value="{{ old('nama_website', $settingweb->nama_website ?? 'Default Nama Website') }}" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi_website" class="form-label">Deskripsi Website</label>
                    <input type="text" name="deskripsi_website" id="deskripsi_website" class="form-control"
                        value="{{ old('deskripsi_website', $settingweb->deskripsi_website ?? 'web pendafatarn') }}"
                        required />
                </div>

                <div class="mb-3">
                    <label for="nama_website" class="form-label">Format Nomor Peserta</label>
                    <input type="text" name="no_peserta_website" id="no_peserta_website" class="form-control"
                        value="{{ old('no_peserta_website', $settingweb->no_peserta_website ?? 'ARMASO25') }}" required>
                </div>

                <div class="mb-3">
                    <label for="pesankontakadmin" class="form-label">Pesan Untuk Kontak Admin</label>
                    <input type="text" name="pesankontakadmin" id="pesankontakadmin" class="form-control"
                        value="{{ old('pesankontakadmin', $settingweb->pesankontakadmin ?? 'haloooooo') }}" required>
                </div>

                <div class="mb-3">
                    <label for="logo_website" class="form-label">Logo Website</label>

                    @if($settingweb->logo_website)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $settingweb->logo_website) }}" alt="Logo" class="img-thumbnail"
                                style="width: 150px;">
                        </div>
                    @endif

                    <div class="input-group">
                        <input type="file" name="logo_website" id="logo_website" class="d-none" accept=".jpg, .jpeg, .png">
                        <label for="logo_website" class="btn btn-primary">📂 Pilih File</label>
                        <span id="file-name" class="ms-3 text-muted" style="line-height: 38px;"> Tidak ada file
                            dipilih</span>
                    </div>
                    <small class="text-muted d-block mt-2"><b>#HARUS BERUPA JPG, PNG, JPEG</b></small>
                </div>

                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="{{ route('settingweb.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("logo_website").addEventListener("change", function () {
            let fileName = this.files.length ? this.files[0].name : "Tidak ada file dipilih";
            document.getElementById("file-name").textContent = fileName;
        });
    </script>
@endsection
