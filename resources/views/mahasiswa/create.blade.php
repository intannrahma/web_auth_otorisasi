@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
    <div class="card shadow-lg border-0 rounded-3" style="max-width: 700px; width: 100%;">
        <div class="card-header bg-primary text-center">
            <h4 class="mb-0">Tambah Mahasiswa</h4>
        </div>
        <div class="card-body p-4 justify-content-center">
            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf


                <div class="mb-3">
                    <label class="form-label fw-bold">Nama</label><br>
                    @error('nama')
                        <span class="error" style="color: red; font-size: 12px;">{{ $message }}</span><br>
                    @enderror
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">NIM</label><br>
                    @error('nim')
                        <span class="error" style="color: red; font-size: 12px;">{{ $message }}</span><br>
                    @enderror
                    <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Jurusan</label><br>
                    <input type="text" name="jurusan" class="form-control" placeholder="Masukkan jurusan" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label><br>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email aktif" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Alamat</label><br>
                    <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">
                        ⬅ Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        💾 Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
