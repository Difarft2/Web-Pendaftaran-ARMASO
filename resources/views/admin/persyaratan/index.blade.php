@extends('layout.admin')

@section('title', 'Persyaratan | Admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Persyaratan</h5>
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('persyaratan.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Tambah
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if ($persyaratan->count() > 0)
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th >#</th>
                                <th >Judul Persyaratan</th>
                                <th >Persyaratan</th>
                                <th >Jenis</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($persyaratan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_persya }}</td>
                                    <td>{!! $item->persyaratan !!}</td>
                                    <td>
                                        @if ($item->jenis == 'internal')
                                            <span>internal</span>
                                        @else
                                            <span>eksternal</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('persyaratan.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="confirmDelete({{ $item->id }})">
                                            Hapus
                                        </button>
                                        <form id="delete-form-{{ $item->id }}"
                                            action="{{ route('persyaratan.destroy', $item->id) }}" method="POST"
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
                    <div class="alert alert-warning">Belum ada data persyaratan yang tersedia.</div>
                @endif
            </div>
        </div>
    </div>


    <script>
        function confirmDelete(id) {
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
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
