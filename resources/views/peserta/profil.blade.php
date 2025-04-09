@extends('layout.dashboard')

@section('title', 'Profil | Peserta')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Profil</h4>
        </div>
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Tanggal Dibuat:</strong> {{ $user->created_at->format('d M Y, H:i') }}</p>
        </div>
    </div>
@endsection
