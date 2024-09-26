@extends('layouts.app')

@section('title', 'Data Karyawan')
@section('description', 'Data Karyawan')
@section('content')
    <!-- Button trigger modal -->
    <a href="{{ route('admin.karyawan.create') }}" class="btn btn-primary mb-3">Tambah Karyawan</a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="datatable1" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Satuan Kerja</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($karyawan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->nama }}" style="width: 100px; height: 100px; object-fit: cover;">
                        </td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->workUnit->name }}</td>
                        <td>{{ $item->user->email }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->no_hp }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
