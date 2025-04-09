@extends('layout.auth')

@section('title', 'Login Admin | ' . $settingweb->nama_website)

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
                        <h2 class="text-center mb-4">Login Admin</h2>
                        <form id="loginadmin-form">
                            @csrf
                            {{-- Email Input --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="name@example.com" required autofocus>
                                </div>
                            </div>

                            {{-- Password Input --}}
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-lock"></i>
                                    </span>
                                    <input type="password" name="password" id="password" class="form-control" required
                                        autocomplete="off">
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" id="login-btn">
                                    <span id="btn-text">LOGIN</span>
                                    <span id="btn-spinner" class="spinner-border spinner-border-sm d-none" role="status"
                                        aria-hidden="true"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Include JavaScript --}}
    <script>
        document.getElementById('loginadmin-form').addEventListener('submit', async function (e) {
            e.preventDefault(); // Prevent default form submission
            const form = e.target;
            const formData = new FormData(form);
            const loginButton = document.getElementById('login-btn');
            const btnText = document.getElementById('btn-text');
            const btnSpinner = document.getElementById('btn-spinner');

            loginButton.disabled = true;
            btnText.classList.add('d-none');
            btnSpinner.classList.remove('d-none');

            try {
                const response = await fetch('{{ route('auth.loginAdmin') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData,
                    mode: 'cors'
                });

                let data;
                try {
                    data = await response.json();
                } catch (error) {
                    throw new Error("Invalid server response.");
                }

                iziToast.destroy(); // Prevent duplicate toasts
                if (response.ok) {
                    iziToast.success({
                        title: 'Sukses!',
                        message: data.message,
                        position: 'topRight',
                        timeout: 3000,
                        close: true,
                        onClosing: function () {
                            window.location.href = data.redirect; // Redirect after notification closes
                        }
                    });
                } else {
                    iziToast.error({
                        title: 'Gagal!',
                        message: data.message,
                        position: 'topRight',
                        timeout: 3000,
                        close: true,
                    });
                }
            } catch (error) {
                iziToast.error({
                    title: 'Kesalahan!',
                    message: error.message || 'Terjadi kesalahan, silakan coba lagi.',
                    position: 'topRight',
                    timeout: 3000,
                    close: true,
                });
            } finally {
                loginButton.disabled = false;
                btnText.classList.remove('d-none');
                btnSpinner.classList.add('d-none');
            }
        });
    </script>

@endsection
