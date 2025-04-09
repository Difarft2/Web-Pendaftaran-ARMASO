@extends('layout.admin')

@section('title', 'Daftar Tagihan | Admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Daftar Tagihan</h5>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('tagihan.export') }}" class="btn btn-primary">
                <i class="fa-solid fa-print"></i> Print Data Tagihan dan Pembayaran
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if ($tagihan->count() > 0)
            <table class="table table-bordered" id="dataTableTagihan" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nomor Tagihan</th>
                        <th>Nama</th>
                        <th>Lomba</th>
                        <th>Total Tagihan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tagihan as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->nomor_tagihan }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->lomba }}</td>
                        <td>{{ $item->total_tagihan }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger"
                                onclick="confirmDelete({{ $item->id }})">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('tagihan.destroy', $item->id) }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-warning">Belum ada tagihan yang tersedia.</div>
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

$(document).ready(function() {
    $('#dataTableTagihan').DataTable({
        pageLength: 10,
        lengthMenu: [10, 25, 50],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
                previous: "Sebelumnya",
                next: "Berikutnya"
            },
            zeroRecords: "Tidak ditemukan data yang cocok",
        }
    });
});
</script>
@endsection
