@extends('layout.admin')

@section('title', 'Lihat Data Peserta | Admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Data Diri Peserta Online</h5>
            <div class="d-flex justify-content-end mb-3">
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <table class="table table-borderless">
                        <tr>
                            <th>Nomor Peserta</th>
                            <td>{{ $peserta->nomor_peserta }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $peserta->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>{{ $peserta->nisn }}</td>
                        </tr>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td>{{ $peserta->tempat_lahir }}, {{ $peserta->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $peserta->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $peserta->alamat }}</td>
                        </tr>
                        <tr>
                            <th>No. HP</th>
                            <td>{{ $peserta->nomor_hp }}</td>
                        </tr>
                    </table>
                    <a href="{{ Route('Admin.datadiripeserta.online.edit', $peserta->id)}}" class="btn btn-primary">
                        <i class="fa-solid fa-pencil"></i> Edit
                    </a>
                    <a href="{{ Route('online.index')}}" class="btn btn-primary">
                        Back
                    </a>
                    <button type="button" class="btn btn-sm btn-danger"
                        onclick="confirmDelete({{ $peserta->id }})">
                        <i class="fa-solid fa-trash"></i> Hapus
                    </button>
                    <form id="delete-form-{{ $peserta->id }}"
                        action="{{ route('online.destroy', $peserta->id) }}" method="POST"
                        style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
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
