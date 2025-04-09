<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
    body {
        font-family: DejaVu Sans, sans-serif;
        margin: 0;
        padding: 0;
    }

    .kop {
        text-align: center;
        margin-bottom: 10px;
    }

    .content {
        padding: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-size: 14px;
    }

    th,
    td {
        padding: 6px 10px;
        text-align: left;
        vertical-align: top;
    }

    thead th {
        text-align: center;
        font-size: 16px;
    }

    tbody th {
        width: 150px;
        font-weight: bold;
    }

    .footer {
        margin-top: 20px;
    }

    .qr {
        margin-top: 10px;
    }
    </style>

    <title>Tagihan Peserta</title>
</head>

<body>
    <div class="kop">
        <img src="{{ public_path('format/koppsb.png') }}" style="width: 100%;" alt="Kop Surat">
    </div>

    <div class="content">
        @yield('konten')
    </div>
</body>

</html>
