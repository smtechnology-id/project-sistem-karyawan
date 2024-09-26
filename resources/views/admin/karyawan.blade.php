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
                    <th>Aksi</th>
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
                        <td>
                            <a href="{{ route('admin.karyawan.edit', $item->id) }}" class="btn btn-warning">Edit</a>

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                Hapus
                            </button>
                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                       
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Hapus Data Karyawan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                               <p>Apakah anda yakin ingin menghapus Data karyawan ini?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <a href="{{ route('admin.karyawan.delete', $item->id) }}" class="btn btn-danger">Hapus</a>
                                            </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
