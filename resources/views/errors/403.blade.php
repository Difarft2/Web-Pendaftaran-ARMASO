<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f3f4f6;
        text-align: center;
        padding: 50px;
        color: #374151;
    }

    .container {
        max-width: 600px;
        margin: auto;
    }

    h1 {
        font-size: 5rem;
        color: #ef4444;
    }

    p {
        font-size: 1.2rem;
    }

    a {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        color: white;
        background-color: #3b82f6;
        text-decoration: none;
        border-radius: 5px;
    }

    a:hover {
        background-color: #2563eb;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>403</h1>
        <p>Anda tidak memiliki izin untuk mengakses halaman ini.</p>
        <p>Silakan hubungi admin jika Anda merasa ini adalah kesalahan.</p>
        <div class="contact-admin">
            <a href="{{ url('/kontakadmin') }}">hubungi admin</a>
        </div>
        <a href="{{ url('/') }}">Kembali ke Beranda</a>
    </div>
</body>

</html>