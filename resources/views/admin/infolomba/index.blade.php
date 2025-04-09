@extends('layout.admin')

@section('title', 'Info Lomaba | Admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Info Lomba</h5>
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('infolomba.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Tambah
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if ($infolomba->count() > 0)
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th >#</th>
                                <th >Nama Lomba</th>
                                <th >Deskripsi</th>
                                <th >Harga</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($infolomba as $item)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $item->nama_lomba }}</td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td>
                                        <a href="{{ route('infolomba.edit', $item->idlomba) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="confirmDelete({{ $item->idlomba }})">
                                            Hapus
                                        </button>
                                        <form id="delete-form-{{ $item->idlomba }}"
                                            action="{{ route('infolomba.destroy', $item->idlomba) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning">Belum ada data lomba yang tersedia.</div>
                @endif
            </div>
        </div>
    </div>


    <script>
        function confirmDelete(idlomba) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + idlomba).submit();
                }
            });
        }
    </script>
@endsection
