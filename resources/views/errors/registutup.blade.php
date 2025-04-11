<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Ditutup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: 'Outfit', sans-serif;
        background: linear-gradient(135deg, #fffaf0, #ffe4e6);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        padding: 20px;
        animation: fadeIn 1s ease;
    }

    .card {
        background-color: white;
        border-radius: 20px;
        padding: 40px;
        max-width: 500px;
        text-align: center;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        animation: slideUp 0.7s ease;
    }

    h1 {
        font-size: 2.5rem;
        color: #db2777;
        margin-bottom: 20px;
    }

    p {
        font-size: 1.1rem;
        color: #555;
        line-height: 1.6;
    }

    .icon {
        font-size: 60px;
        color: #db2777;
        margin-bottom: 20px;
        animation: bounce 1.5s infinite;
    }

    .buttons {
        margin-top: 30px;
    }

    .buttons a {
        text-decoration: none;
        margin: 0 10px;
        padding: 10px 20px;
        border-radius: 10px;
        background-color: #db2777;
        color: white;
        font-weight: 600;
        transition: background 0.3s;
    }

    .buttons a:hover {
        background-color: #be185d;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes slideUp {
        from {
            transform: translateY(30px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes bounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-8px);
        }
    }

    @media (max-width: 600px) {
        .card {
            padding: 30px 20px;
        }

        h1 {
            font-size: 2rem;
        }

        p {
            font-size: 1rem;
        }

        .buttons a {
            display: block;
            margin: 10px auto;
        }
    }
    </style>
</head>

<body>

    <div class="card">
        <div class="icon">📋</div>
        <h1>Pendaftaran Ditutup</h1>
        <p>
            Maaf, saat ini proses pendaftaran belum dibuka atau sedang ditutup sementara.<br><br>
            Untuk info lebih lanjut, silakan hubungi admin atau lihat pengumuman terbaru.
        </p>

        <div class="buttons">
            <a href="/kontakadmin">Hubungi Admin</a>
            <a href="/pengumuman">Lihat Pengumuman</a>
        </div>
    </div>

</body>

</html>