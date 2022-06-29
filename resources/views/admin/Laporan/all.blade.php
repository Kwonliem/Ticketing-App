@extends('layouts.admin')

@section('title', 'Semua Laporan')
    

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

<style>
    .text-link {
        color: #28B7B5;
        text-decoration: underline;
    }
</style>
@endsection

@section('header', 'Semua Pengaduan')

@section('content')
<div class="card-body">
    @if ($pengaduan ?? '')
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pengaduan</th>
                <th>Judul Laporan</th>
                <th>Isi Laporan</th>
                <th>Tanggal Tanggapan</th>
                <th>Tanggapan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduan as $k => $v)
            <tr>
                <td>{{ $k += 1 }}</td>
                <td>{{ $v->tgl_pengaduan->format('d-M-Y') }}</td>
                <td>{{ $v->judul_laporan }}</td>
                <td>{{ $v->isi_laporan }}</td>
                <td>{{ $v->tanggapan->tgl_tanggapan->format('d-M-Y') ?? '' }}</td>
                <td>{{ $v->tanggapan->tanggapan ?? '' }}</td>
                <td>
                    @if ($v->status == '0')
                    <a href="" class="badge badge-danger">Pending</a>
                    @elseif($v->status == 'proses')
                    <a href="" class="badge badge-warning text-white">Proses</a>
                    @else
                    <a href="" class="badge badge-success">Selesai</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="text-center">
        Tidak ada data
    </div>
    @endif
</div>
@endsection