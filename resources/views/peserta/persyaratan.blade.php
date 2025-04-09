@extends('layout.dashboard')

@section('title', 'Persyaratan | Peserta')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Persyaratan</h4>
        </div>
        <div class="card-body">
            @if($syarat->isEmpty())
                <div class="alert alert-warning">Belum ada data persyaratan yang tersedia.</div>
            @else
                @foreach ($syarat as $index => $item)
                    <div class="card shadow mb-4">
                        <a href="#collapseCard{{ $index }}" class="d-block card-header py-3" data-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="collapseCard{{ $index }}">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $item->nama_persya }}</h6>
                            <small class="text-muted">Tanggal: {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</small>
                        </a>
                        <div class="collapse" id="collapseCard{{ $index }}">
                            <div class="card-body">
                                <div class="mb-3 p-3 border-bottom">
                                    <p>{!! $item->persyaratan !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
