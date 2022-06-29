@extends('layouts.admin')

@section('title', 'Halaman Laporan')

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

@section('header', 'Laporan Pengaduan')

@section('content')
<div class="row">
    <div class="col-lg-4 col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">
                    Filter Data
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('laporan.getLaporan') }}" method="POST">
                    @csrf
                    <label>Kategori Kejadian</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="kategori" id="agama"
                            value="agama">
                        <label class="form-check-label" for="agama">
                            Agama
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="kategori" id="hukum"
                            value="hukum">
                        <label class="form-check-label" for="hukum">
                            Hukum
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="kategori" id="lingkungan"
                            value="lingkungan">
                        <label class="form-check-label" for="lingkungan">
                            Lingkungan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="kategori" id="sosial"
                            value="sosial">
                        <label class="form-check-label" for="sosial">
                            Sosial
                        </label>
                    </div>
                    <hr>
                    <label>Rentang Waktu</label>
                    <div class="form-group">
                        <input type="text" name="date_from" class="form-control" placeholder="Tanggal Awal"
                            onfocusin="(this.type='date')" onfocusout="(this.type='text')" value="{{ $from ?? '' }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="date_to" class="form-control" placeholder="Tanggal Akhir"
                            onfocusin="(this.type='date')" onfocusout="(this.type='text')" value="{{ $to ?? '' }}">
                    </div>
                    <hr>
                    <label>Status Pengaduan</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="0"
                            value="0">
                        <label class="form-check-label" for="0">
                            Pending
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="proses"
                            value="proses">
                        <label class="form-check-label" for="proses">
                            Proses
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="selesai"
                            value="selesai">
                        <label class="form-check-label" for="selesai">
                            Selesai
                        </label>
                    </div>
                    <button type="submit" class="btn btn-info mt-3" style="width: 100%">Cari Laporan</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">
                    Data Hasil Pencarian
                </h6>
                <div class="float-right">
                    @if ($pengaduan ?? '')
                    <form action="{{ route('laporan.cetakLaporan') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kategori" value="{{ $kategori }}">
                        <input type="hidden" name="date_from" value="{{ $from }}">
                        <input type="hidden" name="date_to" value="{{ $to }}">
                        <input type="hidden" name="status" value="{{ $status }}">
                        <button type="submit" class="btn btn-danger">EXPORT PDF</button>
                    </form>
                    @endif
                </div>
            </div>
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
        </div>
    </div>
</div>
@endsection

@section('js')
@if ($pengaduan ?? '')
    @if ($kategori != null)
    <script>
        $(document).ready(function() {
            $('#{{ $kategori }}').prop('checked', true);
        });
    </script>
    @endif
    @if ($status != null)
    <script>
        $(document).ready(function() {
            $('#{{ $status }}').prop('checked', true);
        });
    </script>
    @endif
@endif
@endsection