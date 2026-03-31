@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endpush

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-0"><i class="bi bi-people-fill me-2"></i>User Management</h2>
            <p class="text-muted">Ini adalah halaman user management</p>
        </div>
        <a class="btn btn-primary shadow-sm rounded-pill px-4" href="{{ route('user-management.create') }}">
            <i class="bi bi-person-plus-fill me-2"></i> Tambah User Baru
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('user-management') }}" method="GET" class="row g-3">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 bg-light" placeholder="Cari Nama atau NPM..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="kelas_id" class="form-select bg-light">
                        <option value=""> Filter Semua Kelas </option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-grid d-md-block">
                    <button type="submit" class="btn btn-dark px-4"><i class="bi bi-funnel-fill me-1"></i> Terapkan</button>
                    <a href="{{ route('user-management') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-clockwise"></i> Reset</a>
                </div>
            </form>
        </div>
    </div>
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover table-borderless align-middle mb-0">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="ps-4 py-3">Nama Lengkap</th>
                        <th class="py-3">NPM</th>
                        <th class="py-3">Kelas</th>
                        <th class="text-center pe-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 40px; height: 40px; font-weight: bold;">
                                        {{ strtoupper(substr($user->nama, 0, 1)) }}
                                    </div>
                                    <span class="fw-semibold text-dark">{{ $user->nama }}</span>
                                </div>
                            </td>
                            <td><span class="badge bg-secondary bg-opacity-10 text-secondary border px-2 py-1">{{ $user->npm }}</span></td>
                            <td><i class="bi bi-journal-bookmark-fill text-warning me-2"></i>{{ $user->kelas->nama_kelas ?? 'Tanpa Kelas' }}</td>
                            <td class="text-center pe-4">
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                
                                <form action="{{ route('user-management.destroy', $user->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3" type="button" onclick="confirmDelete(this)">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                Yah, data user tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>

</div>

@foreach ($users as $user)
<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold">Edit Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user-management.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body pt-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted small">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control bg-light" value="{{ $user->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted small">NPM</label>
                        <input type="text" name="npm" class="form-control bg-light" value="{{ $user->npm }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted small">Pilih Kelas</label>
                        <select name="kelas_id" class="form-select bg-light" required>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}" {{ $user->kelas_id == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="bi bi-save2-fill me-2"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000,
            toast: true,
            position: 'top-end'
        });
    @endif

    function confirmDelete(button) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        })
    }
</script>
@endpush