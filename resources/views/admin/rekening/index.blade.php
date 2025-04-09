@extends('layout.admin')

@section('title', 'Rekening | Admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Info Rekening</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if($rekening->count() > 0)
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th >Nama</th>
                                <th >No Rekening</th>
                                <th >Bank</th>
                                <th >Cabang</th>
                                <th >Deskripsi</th>
                                <th >Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rekening as $index => $info)
                                <tr>
                                    <td>{{ $info->nama }}</td>
                                    <td>{{ $info->no_rekening }}</td>
                                    <td>{{ $info->nama_bank }}</td>
                                    <td>{{ $info->cabang }}</td>
                                    <td>{{ $info->deskripsi }}</td>
                                    <td>
                                        <a href="{{ route('rekening.edit') }}" class="btn btn-primary btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning">Belum ada data rekening yang tersedia.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
