@extends('layout.admin')

@section('title', 'Data Peserta Kolektif | Admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Data Peserta Kolektif</h5>
        <!-- Tombol Import Data -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#importModal">
                <i class="fa-solid fa-upload"></i> Import Data
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if ($pesertaKolektif->count() > 0)
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                    @foreach ($pesertaKolektif as $item)
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
                            <a href="{{ route('kolektif.show', $item->id) }}"
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

<!-- Modal Import -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('kolektif.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="input-group align-items-center">
                        <input type="file" name="file" class="d-none" id="file" required>
                        <label for="file" class="btn btn-primary">📂 Pilih File</label>
                        <span id="file-name" class="ms-3 text-muted">Tidak ada file dipilih</span>
                    </div>

                    <a href="{{ asset('format/formatKolektif.xlsx') }}" class="btn btn-link mt-3" download>
                        <i class="fa fa-download"></i> Download Format Excel
                    </a>
                    <p class="mt-1 text-muted"><strong>Pastikan file yang diinput sesuai dengan format Excel di
                            atas!</strong></p>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
                <div class="alert alert-warning mt-3">
                    <h6 class="font-weight-bold">📌 INFORMASI PENTING:</h6>
                    <ol class="pl-3">
                        <li>Jika ada data kosong, diisi terserah saja. <strong>Jangan sampai ada data kosong</strong>
                            atau dikasih tanda <code>-</code>.</li>
                        <li>Harus mengikuti format yang ada, <strong>jangan sampai ada data yang tertukar</strong>.</li>
                        <li>Kolom <strong>Jenis Kelamin</strong> dan <strong>Lomba</strong> memiliki
                            <strong>dropdown</strong> untuk memilih nilai.
                        </li>
                        <li>Nilai dalam dropdown berasal dari sheet bernama <code>List</code>.</li>
                        <li><strong>NISN dan Nomor HP</strong> gunakan format <code>Text</code>, <strong>Tanggal
                                Lahir</strong>
                            format <code>Short Date</code>, dan <strong>Total Tagihan</strong> format
                            <code>Accounting</code> (harus ada dua nol di belakang titik).
                        </li>
                        <li>Jika ketika import di bagian nama yang gagal muncul tulisan <strong>"Tanpa Nama"</strong>,
                            <em>abaikan saja</em>.
                        </li>
                        <li><strong>Jangan lupa dicek kembali</strong> setelah data berhasil diimport.</li>
                        <li><strong> Nomor HP</strong> harus menggunkan +62.</li>
                    </ol>
                </div>

            </form>
        </div>
    </div>
</div>

@if(session('hasil_import'))
<!-- Modal -->
<div class="modal fade" id="hasilImportModal" tabindex="-1" aria-labelledby="hasilImportLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="hasilImportLabel">Hasil Import Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p><strong>Total Data Diproses:</strong> {{ session('hasil_import.total') }}</p>
                <p><strong>Berhasil Disimpan:</strong> {{ session('hasil_import.berhasil') }}</p>
                <p><strong>Gagal Disimpan:</strong> {{ session('hasil_import.gagal') }}</p>

                @if(session('hasil_import.gagal_nama'))
                <p><strong>Nama yang Gagal:</strong></p>
                <ul>
                    @foreach(session('hasil_import.gagal_nama') as $nama)
                    <li>{{ $nama }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endif


<script>
window.addEventListener('load', function() {
    var hasilImportModal = new bootstrap.Modal(document.getElementById('hasilImportModal'));
    hasilImportModal.show();
});

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".pilih-mapel-btn").forEach(button => {
        button.addEventListener("click", function() {
            let pesertaId = this.getAttribute("data-id"); // Ambil ID peserta dari tombol
            document.getElementById("peserta_id").value = pesertaId; // Masukkan ke input hidden
        });
    });
});

document.getElementById("file").addEventListener("change", function() {
    let fileName = this.files.length ? this.files[0].name : "Tidak ada file dipilih";
    document.getElementById("file-name").textContent = fileName;
});
</script>
@endsection