@extends('layouts.app')

@section('title', 'Ubah Password')

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
            <h1>Ubah Password</h1>
            <p>Silahkan isi form dibawah untuk mengubah password Anda dengan yang baru.</p>
            <div class="mt-2">
                <form action="{{ route('call.updatePassword') }}" method="POST">
                    @csrf
                    @if (auth('siswa')->user()->password != null)
                    <div class="form-group">
                        <label for="old_password">Password Lama</label>
                        <input type="password" value="{{ old('old_password') }}" name="old_password" id="old_password" class="form-control @error('old_password') is-invalid @enderror">
                        @error('old_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
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