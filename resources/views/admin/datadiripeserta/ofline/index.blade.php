@extends('layout.admin')

@section('title', 'Data Peserta Offline | Admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Data Peserta Offline</h5>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('ofline.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Tambah
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if ($pesertaOffline->count() > 0)
            <table class="table table-bordered" id="dataTableOffline" width="100%" cellspacing="0">
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
                    @foreach ($pesertaOffline as $item)
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
                            @if ($item->tagihan == null)
                            <button class="btn btn-primary pilih-mapel-btn" data-toggle="modal"
                                data-target="#pilihMapelModal" data-id="{{ $item->id }}">
                                <i class="fa-solid fa-book-medical"></i>
                            </button>
                            @endif
                            <a href="{{ route('ofline.show', $item->id) }}"
                                class="btn btn-sm btn-info text-white d-inline-block"><i class="fa-solid fa-eye"></i>
                            </a>
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


<!-- Modal Pilih Mapel -->
<div class="modal fade" id="pilihMapelModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('ofline.pilihMapel') }}" method="POST">
                @csrf
                <input type="hidden" name="peserta_id" id="peserta_id"> <!-- Menyimpan ID peserta -->

                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Pilih Mapel</h5>
                </div>

                <div class="modal-body">
                    <p>Silakan pilih mapel yang ingin diikuti:</p>
                    @foreach ($infolomba as $mapel)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="mapel[]" value="{{ $mapel->nama_lomba }}"
                            id="mapel-{{ $mapel->nama_lomba }}">
                        <label class="form-check-label" for="mapel-{{ $mapel->nama_lomba }}">
                            {{ $mapel->nama_lomba }}
                        </label>
                    </div>
                    @endforeach
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".pilih-mapel-btn").forEach(button => {
        button.addEventListener("click", function() {
            let pesertaId = this.getAttribute("data-id"); // Ambil ID peserta dari tombol
            document.getElementById("peserta_id").value = pesertaId; // Masukkan ke input hidden
        });
    });
});

$(document).ready(function() {
    $('#dataTableOffline').DataTable({
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

    // Ambil ID peserta ke input hidden saat tombol pilih-mapel ditekan
    $(".pilih-mapel-btn").on("click", function() {
        let pesertaId = $(this).data("id");
        $("#peserta_id").val(pesertaId);
    });
});
</script>
@endsection