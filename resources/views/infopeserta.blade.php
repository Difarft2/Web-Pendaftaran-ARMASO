<html>

<head>
    <title>Data Peserta</title>
</head>

<body>
    <h2>Informasi Peserta</h2>
    <ul>
        <li><strong>Nama:</strong> {{ $peserta->nama_lengkap }}</li>
        <li><strong>Nomor Peserta:</strong> {{ $peserta->nomor_peserta }}</li>
        <li><strong>Sekolah:</strong> {{ $peserta->sekolah }}</li>
        <li><strong>Tempat Lahir:</strong> {{ $peserta->tempat_lahir }}</li>
        <li><strong>Tanggal Lahir:</strong> {{ $peserta->tanggal_lahir }}</li>
        <li><strong>Jenis Kelamin:</strong> {{ $peserta->jenis_kelamin }}</li>
        <li><strong>Alamat:</strong> {{ $peserta->alamat }}</li>
        <li><strong>No HP:</strong> {{ $peserta->nomor_hp }}</li>
        <li><strong>Status Data:</strong> {{ $peserta->status_data }}</li>
        <li><strong>Jenis Daftar:</strong> {{ $peserta->jenis_daftar }}</li>
        <li><strong>Mapel Lomba:</strong> {{ optional($peserta->tagihan)->lomba ?? '-' }}</li>
    </ul>
</body>

</html>
