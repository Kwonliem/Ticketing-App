@extends('layouts.app')

@section('title', 'Ubah Profil')

@section('css')
<style>
    .content {
        background-color: #fff;
        border-radius: 11px;
        text-align: left;
    }

    .content h1 {
        font-weight: 500;
        font-size: 22px;
    }

    .content p {
        font-weight: 300;
        font-size: 16px;
        color: #707070;
    }

</style>
@endsection

@section('jumbotron')
<div class="row justify-content-center">
    <div class="col-lg-5 col-md-10 col-11">
        <div class="content p-5">
            <h1>Ubah Profil</h1>
            <p>Silahkan isi form dibawah untuk mengubah profil Anda dengan yang baru.</p>
            <div class="mt-2">
                <form action="{{ route('call.updateProfil') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" value="{{ $siswa->nama }}" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" value="{{ $siswa->username }}" name="username" id="username" class="form-control @error('username') is-invalid @enderror">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" value="{{ $siswa->email }}" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="telp">No. Telp</label>
                        <input type="number" value="{{ $siswa->telp }}" name="telp" id="telp" class="form-control @error('telp') is-invalid @enderror">
                        @error('telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nisn">Nomor Induk Siswa Nasional</label>
                        <input type="number" value="{{ $siswa->nisn }}" name="nisn" id="nisn" class="form-control @error('nisn') is-invalid @enderror">
                        @error('nisn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-custom text-white mt-3" style="width: 100%">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@if (session()->has('pesan'))
    <script>
        Swal.fire({
            title: 'Pemberitahuan!',
            text: "{{ session()->get('pesan') }}",
            icon: '{{ session()->get('type') }}',
            confirmButtonColor: '#28B7B5',
            confirmButtonText: 'OK',
        });
    </script>
@endif
@endsection