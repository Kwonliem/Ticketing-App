@extends('layouts.app')

@section('title', 'Pengaduan')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
    <style>
        .my-shadow {
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        }

        .btn-warning {
            background: #fff !important;
            border-color: orange !important;
            color: orange !important;
        }

        .btn-warning:hover {
            background: orange !important;
            color: #fff !important;
        }

        .btn-danger {
            background: #fff !important;
            border-color: red !important;
            color: red !important;
        }

        .btn-danger:hover {
            background: red !important;
            color: #fff !important;
        }
    </style>
@endsection

@section('jumbotron')
<h1 class="text-center text-hero mb-3">{{ $siapa == 'me' ? 'Pengaduan Saya' : 'Semua Pengaduan' }}</h1>
<p class="text-center text-subtitle mb-4">{{ $siapa == 'me' ? 'Hanya berisi pengaduan yang saya buat' : 'Berisi semua pengaduan yang dikirimkan siswa lain' }}</p>
@endsection



@section('content')
<div class="row">
    @foreach ($pengaduan as $v)
    <div class="col-xl-4 col-lg-6 col-md-6 col-12">
        <div class="card my-shadow mb-4">
            <img src="{{url('storage/'.$v->foto)}}" class="img-fluid" alt="{{ $v->judul_laporan }}">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 col-7">
                        <h2>{{ $v->judul_laporan }}</h2>
                        <p class="text-truncate">{{ $v->isi_laporan }}</p>
                        @if ($v->status == '0')
                            <a href="" class="badge badge-danger">Pending</a>
                        @elseif($v->status == 'proses')
                            <a href="" class="badge badge-warning text-white">Proses</a>
                        @else
                            <a href="" class="badge badge-success">Selesai</a>
                        @endif
                    </div>
                    <div class="col-lg-4 col-5">
                        <a href="{{ route('call.detail', $v->id_pengaduan) }}" class="mt-2 mr-1">Detail</a>
                        @if ($v->user->nisn == auth('siswa')->user()->nisn)

                        @if ($v->status == 'selesai')
                        @else
                        <a href="{{ route('call.edit', $v->id_pengaduan) }}" class="btn-warning mt-2 mr-1">Edit</a>
                        @endif    
                        <a href="#" data-id_pengaduan="{{ $v->id_pengaduan }}" class="btn-danger mt-2 mr-1 pengaduan">Hapus</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).on('click', '.pengaduan', function (e) {
            e.preventDefault();
            let id_pengaduan = $(this).data('id_pengaduan');
            Swal.fire({
                    title: 'Peringatan!',
                    text: "Yakin akan menghapus pegaduan?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28B7B5',
                    confirmButtonText: 'OK',   
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('call.laporanDestroy') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id_pengaduan": id_pengaduan
                        },
                        success: function (response) {
                            if (response == 'success') {
                                Swal.fire({
                                    title: 'Pemberitahuan!',
                                    text: "Pengaduan berhasil dihapus!",
                                    icon: 'success',
                                    confirmButtonColor: '#28B7B5',
                                    confirmButtonText: 'OK',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }else{
                                        location.reload();
                                    }
                                });
                            }
                        },
                        error: function (data) {
                            Swal.fire({
                                title: 'Pemberitahuan!',
                                text: "Pengaduan gagal dihapus!",
                                icon: 'error',
                                confirmButtonColor: '#28B7B5',
                                confirmButtonText: 'OK',
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Pemberitahuan!',
                        text: "Pengaduan gagal dihapus!",
                        icon: 'error',
                        confirmButtonColor: '#28B7B5',
                        confirmButtonText: 'OK',
                    });
                }
            });
        });
    </script>
@endsection