@extends('template.tagihan')

@section('konten')
<div style="text-align: center; margin-bottom: 20px;">
    <h3>TAGIHAN PESERTA</h3>
    <p>No. Tagihan: {{ $tagihan->nomor_tagihan }}</p>
</div>

<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;" border="1" cellpadding="8">
    <thead>
        <tr style="background-color: #f1f1f1;">
            <th colspan="2" style="text-align: center;">DATA TAGIHAN SISWA</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th style="text-align: left;">Nama</th>
            <td>{{ $tagihan->nama }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Mapel</th>
            <td>{{ $tagihan->lomba }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Total Tagihan</th>
            <td>{{ $tagihan->total_tagihan }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Nomor Bukti Pembayaran</th>
            @if ($tagihan->dataDiri->jenis_daftar == 'ofline')
            <td>Pembayaran Via OFFLINE</td>
            @elseif ($tagihan->dataDiri->jenis_daftar == 'kolektif')
            <td>Pembayaran Via KOLEKTIF Dari Pihak Sekolah {{ $tagihan->dataDiri->sekolah }}</td>
            @else
            <td>{{ $tagihan->nomor_bukti_pembayaran }}</td>
            @endif
        </tr>
        <tr>
            <th style="text-align: left;">Status Pembayaran</th>
            <td><strong>PEMBAYARAN VALID</strong></td>
        </tr>
    </tbody>
</table>

{{-- Footer QR dan Print Date --}}
<div style="margin-top: 30px; font-size: 12px;">
    Print Date : {{ now()->format('Y-m-d H:i:s') }}
    <br>
    <strong> by Panitia {{$settingweb->nama_website}}</strong>
</div>
@endsection
