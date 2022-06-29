@extends('layouts.admin')

@section('title', 'Detail Siswa')
    
@section('css')
    <style>
        .text-grey {
            color: #6c757d;
        }

        .text-grey:hover {
            color: #6c757d;
            text-decoration: none;
        }
    </style>
@endsection

@section('header')
    <a href="{{ route('siswa.index') }}" class="text-info">Data Siswa</a>
    <a href="#" class="text-grey">&nbsp;/&nbsp;</a>
    <a href="#" class="text-grey">Detail Siswa</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">
                        Detail Siswa
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>NISN</th>
                                <td>:</td>
                                <td>{{ $siswa->nisn }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>:</td>
                                <td>{{ $siswa->nama }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>:</td>
                                <td>{{ $siswa->email }}</td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>:</td>
                                <td>{{ $siswa->username }}</td>
                            </tr>
                            <tr>
                                <th>No Telp</th>
                                <td>:</td>
                                <td>{{ $siswa->telp }}</td>
                            </tr>
                            <tr>
                                <th>Hapus Siswa</th>
                                <td>:</td>
                                <td>
                                    <a href="#" data-nisn="{{ $siswa->nisn }}" class="btn btn-danger siswa" style="width: 100%">HAPUS</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            @if (session()->has('notif'))
                <div class="alert alert-danger">
                    {{ session()->get('notif') }}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).on('click', '.siswa', function (e) {
            e.preventDefault();
            Swal.fire({
                    title: 'Peringatan!',
                    text: "Yakin akan menghapus siswa?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28B7B5',
                    confirmButtonText: 'OK',   
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: '{{ route('siswa.destroy', $siswa->nisn) }}',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            if (response == 'success') {
                                Swal.fire({
                                    title: 'Pemberitahuan!',
                                    text: "Siswa berhasil dihapus!",
                                    icon: 'success',
                                    confirmButtonColor: '#28B7B5',
                                    confirmButtonText: 'OK',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.href = "{{ route('siswa.index') }}";
                                    }else{
                                        location.href = "{{ route('siswa.index') }}";
                                    }
                                });
                            }
                        },
                        error: function (data) {
                            Swal.fire({
                                title: 'Pemberitahuan!',
                                text: "Siswa gagal dihapus!",
                                icon: 'error',
                                confirmButtonColor: '#28B7B5',
                                confirmButtonText: 'OK',
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Pemberitahuan!',
                        text: "Siswa gagal dihapus!",
                        icon: 'error',
                        confirmButtonColor: '#28B7B5',
                        confirmButtonText: 'OK',
                    });
                }
            });
        });
    </script>    
@endsection