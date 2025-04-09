<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

{{-- iziToast --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css">

<!-- Custom fonts -->
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
<link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>

{{-- sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Inisialisasi Summernote -->
<script>
    $(document).ready(function () {
        console.log("jQuery Loaded:", typeof jQuery !== "undefined");
        console.log("Summernote Loaded:", typeof $.fn.summernote !== "undefined");

        if (typeof $.fn.summernote !== "undefined") {
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        } else {
            console.error("Summernote is not loaded!");
        }
    });
</script>

{{-- css navbar --}}
<style>
    /* Gaya dasar dropdown */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Tombol dropdown (ikon) */
    .dropdown-button {
        font-size: 24px;
        color: #ffffff;
        text-decoration: none;
        cursor: pointer;
    }

    /* Menu dropdown */
    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        /* Posisikan di bawah ikon */
        right: 0;
        background-color: white;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        list-style-type: none;
        margin: 0;
        padding: 10px 0;
        min-width: 150px;
        border-radius: 5px;
        z-index: 1000;
    }

    /* Item dalam menu dropdown */
    .dropdown-menu li {
        padding: 8px 16px;
        text-align: left;
    }

    .dropdown-menu li a {
        text-decoration: none;
        color: black;
        display: block;
    }

    .dropdown-menu li:hover {
        background-color: #f8f9fa;
    }

    /* Menampilkan menu saat dropdown aktif */
    .dropdown.active .dropdown-menu {
        display: block;
    }
</style>

{{-- all css --}}
<style>
    .nav-link {
        color: #ffffff
    }

    .nav-link:hover {
        color: black
    }


    /* pengumuman */
    .table-card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .table-header {
        background: linear-gradient(90deg, #6a11cb, #2575fc);
        color: white;
        padding: 1.5rem;
        text-align: left;
    }

    .table-header h4 {
        margin: 0;
        font-weight: bold;
    }

    .table-header p {
        margin: 0;
        font-size: 0.9rem;
        opacity: 0.8;
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
    }

    .card-header {
        padding: 1.5rem;
        text-align: left;
        border-bottom: none;
    }

    .card-header h4 {
        margin: 0;
        font-weight: bold;
    }

    .card-header p {
        margin: 0;
        font-size: 0.9rem;
        opacity: 0.85;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .summernote {
        min-height: 150px;
    }
</style>
