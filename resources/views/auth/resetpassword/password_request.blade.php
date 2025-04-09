@extends('layout.auth')

@section('title', 'Request Reset Password | ' . $settingweb->nama_website)

@section('content')
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Request Reset Password</h3>
                        <form action="{{ route('password.request') }}" method="POST">
                            @csrf
                            {{-- Email Input --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>

                            {{-- Password Input --}}
                            <div class="mb-3">
                                <label for="phone" class="form-label">Nomor HP:</label>
                                <input type="text" class="form-control" name="phone" required>
                                <small class="text-muted d-block mt-2"><b>#Menggunkan +62 </b></small>
                            </div>

                            {{-- Submit Button --}}
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Request Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <script>
            Swal.fire({
                title: "Permintaan Reset Password Berhasil!",
                text: "Tunggu persetujuan admin untuk mendapatkan link reset password.",
                icon: "info",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "OK",
                denyButtonText: `Hubungi admin`
            }).then((result) => {
                if (result.isDenied) {
                    window.location.href = "{{ url('kontakadmin') }}";
                }
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK"
            });
        </script>
    @endif

@endsection
