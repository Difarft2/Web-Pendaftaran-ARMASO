@extends('layout.admin')

@section('title', 'Profil | Admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Profil Admin</h4>
        </div>
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $admin->name }}</p>
            <p><strong>Email:</strong> {{ $admin->email }}</p>
            <p><strong>Role:</strong> {{ ucfirst($admin->role) }}</p>
            <p><strong>Tanggal Dibuat:</strong> {{ $admin->created_at->format('d M Y, H:i') }}</p>
        </div>
    </div>
@endsection
