@extends('layout.app')
@section('title', 'Kontak Admin | ARMASO')

@section('content')
    <div class="card-header text-center bg-primary text-white">
        <h3>
            <i class="fa-solid fa-phone"></i>
            Kontak Admin
        </h3>
    </div>
    <div class="card shadow mb-4">
        @if($kontakadmin->count() > 0)
            <div class="card-body">
                <div class="row">
                    @foreach ($kontakadmin as $admin)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $admin->nama }}</h5>
                                    <p class="card-text">{{ $admin->info }}</p>
                                    <a href="https://wa.me/{{ $admin->no_hp }}?text={{$pesan}}" target="_blank"
                                        class="btn btn-success">
                                        <i class="bi bi-whatsapp"></i> Hubungi via WhatsApp
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="alert alert-warning">Belum ada data kontak admin yang tersedia.</div>
        @endif
    </div>
@endsection
