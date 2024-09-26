@extends('layouts.app')

@section('title', 'Data Satuan Kerja')
@section('description', 'Data Satuan Kerja Untuk Data Karyawan')
@section('content')
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="datatable1" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($satuanKerja as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
