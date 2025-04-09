@extends('layout.admin')

@section('title', 'Reset Password | Admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Reset Password Requests</h5>
        <p><b>Token akan kadaluarsa setelah 24 jam</b></p>
        <div class="d-flex justify-content-end mb-3">
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if ($requests->count() > 0)
            <table class="table table-bordered" id="resetrequest" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Nomor HP</th>
                        <th>Status</th>
                        <th>Link Reset</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="userTable">
                    @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->email }}</td>
                        <td>
                            <a href="https://wa.me/{{ $request->phone }}" target="_blank">
                                {{ $request->phone }}
                            </a>
                        </td>
                        <td>
                            @if($request->approved)
                            <span class="badge badge-success">Approved</span>
                            @else
                            <span class="badge badge-warning">Pending</span>
                            @endif
                        </td>
                        <td>
                            @if($request->approved && $request->reset_link)
                            <a href="{{ $request->reset_link }}" target="_blank">Klik untuk Reset</a>
                            @else
                            <span class="text-muted">Menunggu persetujuan</span>
                            @endif
                        </td>
                        <td>
                            @if(!$request->approved)
                            <form action="{{ route('password.approve', $request->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                            @else
                            <button class="btn btn-secondary btn-sm" disabled>Approved</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-warning">Belum ada data reset password.</div>
            @endif
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#resetrequest').DataTable({
        pageLength: 10,
        lengthMenu: [10, 20, 50, 100],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
                previous: "Sebelumnya",
                next: "Berikutnya"
            },
            zeroRecords: "Tidak ditemukan data yang cocok",
        }
    });
});
</script>
@endsection
