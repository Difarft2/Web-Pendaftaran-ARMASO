@extends('layout.auth')

@section('title', 'Registrasi Peserta | ' . $settingweb->nama_website)

@section('content')
    {{-- Alert Notifications --}}
    <div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
        <!-- Toasts will be inserted dynamically here -->
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Registrasi Peserta</h2>
                        <form id="register-form">
                            @csrf
                            {{-- Name Input --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nama Lengkap"
                                    required>
                            </div>

                            {{-- Email Input --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="name@example.com" required>
                            </div>

                            {{-- Password Input --}}
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Minimal 8 karakter" required>
                            </div>

                            {{-- Submit Button --}}
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" id="register-btn">
                                    <span id="btn-text">REGISTER</span>
                                    <span id="btn-spinner" class="spinner-border spinner-border-sm d-none" role="status"
                                        aria-hidden="true"></span>
                                </button>
                            </div>

                            {{-- Login Link --}}
                            <p class="text-center mt-3">
                                Sudah punya akun? <a href="{{ route('auth.login') }}">Login</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Include JavaScript --}}
    <script>
        document.getElementById('register-form').addEventListener('submit', function (e) {
            e.preventDefault(); // Mencegah form submit langsung
            const form = e.target;
            const formData = new FormData(form);
            const registerButton = document.getElementById('register-btn');
            const btnText = document.getElementById('btn-text');
            const btnSpinner = document.getElementById('btn-spinner');

            registerButton.disabled = true; // Nonaktifkan tombol sementara
            btnText.classList.add('d-none');
            btnSpinner.classList.remove('d-none');

            // AJAX request ke server
            fetch('{{ route('auth.register') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData,
            })
                .then(async (response) => {
                    const data = await response.json();

                    if (response.ok) {
                        // Tampilkan iziToast sukses
                        iziToast.success({
                            title: 'Sukses',
                            message: data.message,
                            position: 'topRight',
                            timeout: 3000
                        });

                        // Redirect setelah 3 detik
                        setTimeout(() => {
                            window.location.href = '{{ route('auth.login') }}';
                        }, 3000);
                    } else {
                        // Tampilkan iziToast error
                        iziToast.error({
                            title: 'Gagal',
                            message: 'Akun sudah terdaftar!',
                            position: 'topRight',
                            timeout: 2000
                        });
                    }
                })
                .catch(() => {
                    // Tampilkan iziToast jika terjadi kesalahan koneksi
                    iziToast.error({
                        title: 'Error',
                        message: 'Terjadi kesalahan, silakan coba lagi.',
                        position: 'topRight',
                        timeout: 2000
                    });
                })
                .finally(() => {
                    registerButton.disabled = false;
                    btnText.classList.remove('d-none');
                    btnSpinner.classList.add('d-none');
                });
        });
    </script>


@endsection
