{{-- PopperJS --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>

{{-- Font Awesome --}}
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

{{-- Chart.js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

{{-- Simple DataTables --}}
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>

{{-- DataTables --}}
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

{{-- iziToast --}}
<script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>

{{-- Custom Scripts --}}
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

{{--
<!-- Inisialisasi Summernote -->
<script>
    $(document).ready(function () {
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
    });
</script> --}}

{{-- layout --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdown = document.querySelector(".dropdown");
        const button = dropdown.querySelector(".dropdown-button");

        // Toggle menu saat ikon diklik
        button.addEventListener("click", function (event) {
            event.preventDefault(); // Mencegah aksi default link
            dropdown.classList.toggle("active");
        });

        // Tutup menu dropdown jika mengklik di luar dropdown
        document.addEventListener("click", function (event) {
            if (!dropdown.contains(event.target)) {
                dropdown.classList.remove("active");
            }
        });
    });
</script>
