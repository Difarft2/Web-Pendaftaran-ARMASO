@extends('layout.admin')

@section('title', 'Data Peserta Online | Admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Data Peserta Online</h5>
        <div class="d-flex justify-content-end mb-3">
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if ($pesertaOnline->count() > 0)
            <table class="table table-bordered" id="dataTableOnline" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nomor Peserta</th>
                        <th>Nama</th>
                        <th>Nomor HP</th>
                        <th>Sekolah</th>
                        <th>Mapel</th>
                        <th>Status Data</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesertaOnline as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->nomor_peserta }}</td>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td>
                            <a href="https://wa.me/{{ $item->nomor_hp }}" target="_blank">
                                {{ $item->nomor_hp }}
                            </a>
                        </td>
                        <td>{{ $item->sekolah }}</td>
                        <td>{{ optional($item->tagihan)->lomba ?? 'Tidak ada mapel' }}</td>
                        <td>@if ($item->status_data == 'belum_valid')
                            <span class="badge badge-warning">Belum Valid</span>
                            @else
                            <span class="badge badge-success">Data Valid</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('online.show', $item->id) }}"
                                class="btn btn-sm btn-info text-white d-inline-block"><i class="fa-solid fa-eye"></i>
                            </a>
                            <button class="btn btn-sm btn-primary switch-validasi" data-id="{{ $item->id }}">
                                <i class="fa-solid fa-check"></i>
                            </button>
                            @if ($item->status_data == 'valid')
                            <a href="{{ route('cetak.kartu', $item->id) }}" target="_blank"
                                class="btn btn-sm btn-primary">
                                <i class="fa-solid fa-print"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-warning">Belum ada data diri peserta yang tersedia.</div>
            @endif
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.switch-validasi').on('click', function() {
        let pesertaId = $(this).data('id');

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
                    url: '/admin/peserta/online/switch-validasi/' + pesertaId,
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
    $('#dataTableOnline').DataTable({
        pageLength: 10,
        lengthMenu: [10, 20, 50, 100],
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
