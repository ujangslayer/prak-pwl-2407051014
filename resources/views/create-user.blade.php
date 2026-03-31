@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endpush

@section('title', 'Tambah User')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white p-4 text-center border-0">
                    <h4 class="mb-0 fw-bold"><i class="bi bi-person-plus me-2"></i> Tambah User Baru</h4>
                    <p class="mb-0 text-white-50 small mt-1">Silakan lengkapi formulir di bawah ini</p>
                </div>
                <div class="card-body p-5 pt-4">
                    <form action="{{ route('user-management.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                                <input type="text" name="nama" class="form-control border-start-0 bg-light py-2" placeholder="Masukkan nama lengkap..." required autofocus>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted">Nomor Pokok Mahasiswa (NPM)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-credit-card text-muted"></i></span>
                                <input type="text" name="npm" class="form-control border-start-0 bg-light py-2" placeholder="Masukkan NPM..." required>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-semibold text-muted">Pilih Kelas</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-building text-muted"></i></span>
                                <select name="kelas_id" class="form-select border-start-0 bg-light py-2" required>
                                    <option value="" disabled selected>-- Pilih Kelas Mahasiswa --</option>
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('user-management') }}" class="btn btn-light rounded-pill px-4 text-secondary fw-semibold">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm fw-bold">
                                Simpan Data <i class="bi bi-check2-circle ms-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection