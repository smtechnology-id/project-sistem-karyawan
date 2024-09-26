@extends('layouts.app')

@section('title', 'Edit Karyawan')
@section('description', 'Edit Karyawan')
@section('content')
    <!-- Button trigger modal -->
    <form action="{{ route('admin.karyawan.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="photo" class="form-label">Foto</label>
            <input type="file" class="form-control" id="photo" name="photo">
            <img src="{{ asset('storage/' . $karyawan->photo) }}" alt="Foto Karyawan" class="img-fluid mt-2" style="max-height: 200px; max-width: 200px;">
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="hidden" name="id" value="{{ $karyawan->id }}">
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $karyawan->nama }}" required>
        </div>
       
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat">{{ $karyawan->alamat }}</textarea>
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $karyawan->no_hp }}">
        </div>
        <div class="mb-3">
            <label for="satuan_kerja" class="form-label">Satuan Kerja</label>
            <select class="form-select" id="satuan_kerja" name="satuan_kerja" required>
                <option value="">Pilih Satuan Kerja</option>
                @foreach ($satuanKerja as $item)
                    <option value="{{ $item->id }}" {{ $karyawan->work_unit_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        {{-- Account --}}
        <hr>
        <h5 class="mt-3">Account</h5>
        <hr>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $karyawan->user->email }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
        </div>
       
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
