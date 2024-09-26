@extends('layouts.app')

@section('title', 'Data Satuan Kerja')
@section('description', 'Data Satuan Kerja Untuk Data Karyawan')
@section('content')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tambah Satuan Kerja
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.satuan-kerja.store') }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Satuan Kerja</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="datatable1" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($satuanKerja as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $item->id }}">
                                Edit
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.satuan-kerja.update') }}" method="POST">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Satuan
                                                    Kerja</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nama</label>
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="{{ $item->name }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $item->id }}">
                                Hapus
                            </button>
                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Hapus Satuan
                                                Kerja</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah anda yakin ingin menghapus satuan kerja ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <a href="{{ route('admin.satuan-kerja.delete', $item->id) }}"
                                                class="btn btn-danger">Hapus</a>
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
