@extends('layout.admin')

@section('title', 'Daftar Pembayaran | Admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Pembayaran Belum Valid</h5>
        <div class="d-flex justify-content-end mb-3">
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if ($belumvalid->count() > 0)
            <table class="table table-bordered" id="dataTableBelumValid" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nomor Tagihan</th>
                        <th>Nomor Bukti Pembayaran</th>
                        <th>Nama</th>
                        <th>Lomba</th>
                        <th>Total Tagihan</th>
                        <th>Tanggal Upload</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($belumvalid as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nomor_tagihan }}</td>
                        <td>{{ $item->nomor_bukti_pembayaran }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->lomba }}</td>
                        <td>{{ $item->total_tagihan }}</td>
                        <td>{{ $item->tanggal_upload }}</td>
                        <td class="text-center d-flex justify-content-center gap-5">
                            <a href="{{ asset('storage/bukti_pembayaran/' . $item->bukti_pembayaran) }}" target="_blank"
                                class="btn btn-sm btn-info text-white me-2">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <button class="btn btn-sm btn-primary switch-validasi me-2" data-id="{{ $item->id }}">
                                <i class="fa-solid fa-check"></i>
                            </button>
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
            <div class="alert alert-warning">Belum ada pembayaran yang tersedia.</div>
            @endif
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Pembayaran Sudah Valid</h5>
        <div class="d-flex justify-content-end mb-3">
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if ($valid->count() > 0)
            <table class="table table-bordered" id="dataTableValid" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nomor Tagihan</th>
                        <th>Nomor Bukti Pembayaran</th>
                        <th>Nama</th>
                        <th>Lomba</th>
                        <th>Total Tagihan</th>
                        <th>Tanggal Upload</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($valid as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nomor_tagihan }}</td>
                        <td>{{ $item->nomor_bukti_pembayaran }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->lomba }}</td>
                        <td>{{ $item->total_tagihan }}</td>
                        <td>{{ $item->tanggal_upload }}</td>
                        <td class="text-center d-flex justify-content-center gap-5">
                            <button class="btn btn-sm btn-primary switch-validasi me-2" data-id="{{ $item->id }}">
                                <i class="fa-solid fa-check"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger"
                                onclick="confirmDelete({{ $item->id }})">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('tagihan.destroy', $item->id) }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a href="{{ route('tagihan.cetak', $item->id) }}" target="_blank"
                                class="btn btn-sm btn-primary">
                                <i class="fa-solid fa-print"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-warning">Belum ada pembayaran yang tersedia.</div>
            @endif
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.switch-validasi').on('click', function() {
        let id = $(this).data('id');

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Status validasi akan diubah!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Ubah!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/pembayaran/switch-validasi/' + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}' // Kirim CSRF token
                    },
                    success: function(response) {
                        if (response.success) {
                            // Notifikasi sukses
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Status validasi telah diubah menjadi " +
                                    response.status,
                                icon: "success",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location
                                    .reload(); // Reload halaman setelah sukses
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: "Gagal!",
                            text: "Terjadi kesalahan saat mengubah status validasi.",
                            icon: "error"
                        });
                    }
                });
            }
        });
    });
});

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
    $('#dataTableBelumValid').DataTable();
    $('#dataTableValid').DataTable();

    // script switch-validasi tetap sama
});
</script>
@endsection
