@extends('layouts.admin')

@section('title', 'Halaman Pengaduan')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@endsection

@section('header', "Data Pengaduan")

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">
            Data Pengaduan {{ $status == '0' ? 'Belum diVerifikasi' : ucwords($status) }}
        </h6>
    </div>
    <div class="card-body">
        <table id="pengaduanTable" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Isi Laporan</th>
                    <th>Status</th>
                    @if ($status == '0')
                        <th>Aksi</th>
                    @else
                        <th>Detail</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($pengaduan as $k => $v)
                <tr>
                    <td>{{ $k += 1 }}</td>
                    <td>{{ $v->tgl_pengaduan->format('d-M-Y') }}</td>
                    <td>{{ $v->isi_laporan }}</td>
                    <td>
                        @if ($v->status == '0')
                            <a href="" class="badge badge-danger">Pending</a>
                        @elseif($v->status == 'proses')
                            <a href="" class="badge badge-warning text-white">Proses</a>
                        @else
                            <a href="" class="badge badge-success">Selesai</a>
                        @endif
                    </td>
                    @if ($status == '0')
                    <td>
                        <a href="#" data-id_pengaduan="{{ $v->id_pengaduan }}" class="btn btn-info pengaduan">Verifikasi</a>
                        <a href="#" data-id_pengaduan="{{ $v->id_pengaduan }}" class="btn btn-danger pengaduanHapus">Hapus</a>
                    </td>
                    @else
                    <td><a href="{{ route('pengaduan.show', $v->id_pengaduan) }}" style="text-decoration: underline">Lihat</a></td>
                    @endif
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
            $('#pengaduanTable').DataTable();
        } );
    </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    
    
    $(document).on('click', '#del', function (e) {
        let id = $(this).data('userId');
        console.log(id);
    });



    $(document).on('click', '.pengaduan', function (e) {
        e.preventDefault();
        let id_pengaduan = $(this).data('id_pengaduan');
        Swal.fire({
                title: 'Peringatan!',
                text: "Yakin akan memverifikasi pengaduan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28B7B5',
                confirmButtonText: 'OK',   
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: '{{ route('tanggapan.createOrUpdate') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id_pengaduan": id_pengaduan,
                        "status": "proses",
                        "tanggapan": ''
                    },
                    success: function (response) {
                        if (response == 'success') {
                            Swal.fire({
                                title: 'Pemberitahuan!',
                                text: "Pengaduan berhasil diverifikasi!",
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
                            text: "Pengaduan gagal diverifikasi!",
                            icon: 'error',
                            confirmButtonColor: '#28B7B5',
                            confirmButtonText: 'OK',
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Pemberitahuan!',
                    text: "Pengaduan gagal diverifikasi!",
                    icon: 'error',
                    confirmButtonColor: '#28B7B5',
                    confirmButtonText: 'OK',
                });
            }
        });
    });

    $(document).on('click', '.pengaduanHapus', function (e) {
        e.preventDefault();
        var id_pengaduan = $(this).data('id_pengaduan');
        Swal.fire({
                title: 'Peringatan!',
                text: "Yakin akan menghapus pengaduan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28B7B5',
                confirmButtonText: 'OK',   
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: '{{ route('pengaduan.destroy', 'id_pengaduan') }}',
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