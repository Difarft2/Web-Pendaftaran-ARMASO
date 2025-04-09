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
    </div>
@endsection
