@extends('template.kartupeserta')

@section('konten')
<div style="text-align: center; margin-bottom: 20px;">
    <h3>KARTU PESERTA</h3>
    <p>No. Peserta: {{ $peserta->nomor_peserta }}</p>
</div>

<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;" border="1" cellpadding="8">
    <thead>
        <tr style="background-color: #f1f1f1;">
            <th colspan="2" style="text-align: center;">DATA PRIBADI SISWA</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th style="text-align: left;">NISN</th>
            <td>{{ $peserta->nisn }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Nama Lengkap</th>
            <td>{{ $peserta->nama_lengkap }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Tempat Tgl Lahir</th>
            <td>{{ $peserta->tempat_lahir }}, {{ $peserta->tanggal_lahir }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Jenis Kelamin</th>
            <td>{{ $peserta->jenis_kelamin }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Asal Sekolah</th>
            <td>{{ $peserta->sekolah }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">No HP</th>
            <td>{{ $peserta->nomor_hp }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Mapel Lomba</th>
            <td>{{ optional($peserta->tagihan)->lomba ?? '-' }}</td>
        </tr>
    </tbody>
</table>

{{-- Footer QR dan Print Date --}}
<div style="margin-top: 30px; font-size: 12px;">
    Print Date : {{ now()->format('Y-m-d H:i:s') }}
    <br>
    <strong> by Panitia {{$settingweb->nama_website}}</strong>
</div>

<table style="width: 100%; margin-top: 10px;">
    <tr>
        <td style="width: 100%; text-align: right;">
            <img src="{{ $qrCodeBase64 }}" alt="QR Code" width="100">
        </td>
    </tr>
</table>
@endsection
