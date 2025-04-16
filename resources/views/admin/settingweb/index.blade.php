@extends('layout.admin')

@section('title', 'Setting | Admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary">Setting Website</h4>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('settingweb.edit') }}" class="btn btn-primary mb-4">
                <i class="fa-solid fa-pen-to-square"></i> Edit Pengaturan
            </a>
        </div>
    </div>
    @if($settingweb)
    <div class="card-body">
        <p><strong>Nama Website: </strong>{{ $settingweb->nama_website }}</p>
        <p><strong>Deskripsi Website: </strong>{{ $settingweb->deskripsi_website}}</p>
        <p><strong>Format Nomor Peserta: </strong>{{ $settingweb->no_peserta_website  }}</p>
        <p><strong>Pesan Untuk Kontak Admin: </strong>{{ $settingweb->pesankontakadmin  }}</p>
        <strong>Logo Website</strong>
        <img src="{{ asset('storage/' . $settingweb->logo_website) }}" alt="Logo" style="width: 100px;">
    </div>
    @else
    <div class="alert alert-warning">Belum ada data pengumuman yang tersedia.</div>
    @endif
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary">Control Website</h4>
        <div class="d-flex justify-content-end mb-3">
        </div>
    </div>
    <div class="card-body space-y-8">
        <!-- Maintenance Toggle -->
        <form method="POST" action="{{ route('admin.toggle.maintenance') }}" class="bg-white p-6 rounded-xl shadow-md">
            @csrf
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Mode Maintenance</h2>
                <span
                    class="px-3 py-1 text-sm rounded-full
                {{ \App\Models\Mode::getValue('maintenance_mode') == 'on' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                    <strong>{{ ucfirst(\App\Models\Mode::getValue('maintenance_mode')) }}</strong>
                </span>
            </div>
            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-black font-semibold py-2 px-4 rounded-lg transition">
                Toggle Maintenance
            </button>
        </form>
        <br>

        <!-- Registration Toggle -->
        <form method="POST" action="{{ route('admin.toggle.registration') }}" class="bg-white p-6 rounded-xl shadow-md">
            @csrf
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Pendaftaran</h2>
                <span
                    class="px-3 py-1 text-sm rounded-full
                {{ \App\Models\Mode::getValue('registration_closed') == 'on' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                    <strong>{{ \App\Models\Mode::getValue('registration_closed') == 'on' ? 'Ditutup' : 'Dibuka' }}</strong>
                </span>
            </div>
            <button type="submit"
                class="w-full bg-pink-600 hover:bg-pink-700 text-black font-semibold py-2 px-4 rounded-lg transition">
                Toggle Pendaftaran
            </button>
        </form>
        <br>

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Reset Data</h2>
        </div>
        <button class="btn btn-danger" data-toggle="modal" data-target="#Modalreset">
            RESET
        </button>
    </div>
</div>


<div class="modal fade" id="Modalreset" role=" dialog" aria-labelledby="Modalreset" aria-hidden=" true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('hapus.semuadata') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p>Masukkan password admin untuk menghapus semua data:</p>
                    <input type="password" name="password" class="form-control" placeholder="Password admin" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus Sekarang</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
