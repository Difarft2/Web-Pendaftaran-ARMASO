<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <style>
    body {
        background-color: #f0f2f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-align: center;
        padding: 40px 20px;
        color: #333;
    }

    .error-image {
        margin-bottom: 40px;
        height: auto;
        width: 250px;
    }

    h1 {
        font-size: 64px;
        margin-bottom: 20px;
    }

    p {
        font-size: 20px;
        margin-bottom: 30px;
    }

    a.button {
        display: inline-block;
        padding: 12px 24px;
        background-color: #007bff;
        color: #fff;
        border-radius: 6px;
        text-decoration: none;
        font-size: 16px;
    }

    a.button:hover {
        background-color: #0056b3;
    }

    .contact-admin {
        margin-top: 20px;
        font-size: 16px;
        color: #666;
    }

    .contact-admin a {
        color: #007bff;
        text-decoration: none;
    }

    .contact-admin a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <img src="{{ asset('img/404.png') }}" alt="Ilustrasi 404" class="error-image">
    <p>Oops! Halaman yang kamu cari tidak ditemukan.</p>

    <a href="{{ url('/') }}" class="button">Kembali ke Beranda</a>

    <div class="contact-admin">
        atau <a href="{{ url('/kontakadmin') }}">hubungi admin</a>
    </div>

</body>

</html>