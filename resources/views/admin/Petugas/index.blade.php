@extends('layouts.admin')

@section('title', 'Halaman Petugas')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@endsection

@section('header', 'Data Petugas')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">
            Data Petugas
        </h6>
    </div>
    <div class="card-body">
        <a href="{{ route('petugas.create') }}" class="btn btn-info mb-2">Tambah Petugas</a>
        <table id="petugasTable" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Petugas</th>
                    <th>Username</th>
                    <th>Telp</th>
                    <th>Level</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($petugas as $k => $v)
                <tr>
                    <td>{{ $k += 1 }}</td>
                    <td>{{ $v->nama_petugas }}</td>
                    <td>{{ $v->username }}</td>
                    <td>{{ $v->telp }}</td>
                    <td>{{ $v->level }}</td>
                    <td><a href="{{ route('petugas.edit', $v->id_petugas) }}" style="text-decoration: underline">Lihat</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#petugasTable').DataTable();
        } );
    </script>
@endsection