<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>Daftar • CALL</title>

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

        .btn-social {
            font-weight: 400;
            font-size: 16px;
            background: #f6f6f6;
            border: #f6f6f6;
            padding: 10px 24px 10px 24px;
            width: 100%;
            transition: all 0.2s;
        }

        .btn-social:hover {
            font-weight: 400;
            font-size: 16px;
            background: #ececec;
            border: #f6f6f6;
            padding: 10px 24px 10px 24px;
            width: 100%;
        }

    </style>
</head>

<body>

    <nav class="navbar py-4 navbar-expand-lg navbar-light bg-white custom-nav">
        <div class="container">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('call.index') }}">CA<span>LL</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link @active('/')" href="{{ route('call.index') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @active('tentang*')" href="{{ route('call.tentang') }}">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @active('pengaduan*')" href="{{ route('call.pengaduan') }}">Buat
                                Pengaduan</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="jumbotron">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-10 col-11">
                <div class="content p-5">
                    <h1>Daftar terlebih dahulu</h1>
                    <p>Silahkan daftar akun terlebih dahulu disini atau daftar menggunakan media sosial.</p>
                    <div class="mt-2">
                        <form action="{{ route('call.register') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nisn">NISN</label>
                                <input type="number" value="{{ old('nisn') }}" name="nisn" id="nisn" class="form-control @error('nisn') is-invalid @enderror">
                                @error('nisn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" value="{{ old('nama') }}" name="nama" class="form-control @error('nama') is-invalid @enderror" id="latinTextBox">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="text" value="{{ old('email') }}" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="usernameTextBox">Username</label>
                                <input type="text" value="{{ old('username') }}" name="username" class="form-control @error('username') is-invalid @enderror" id="usernameTextBox">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="numberTextBox">No. Telp</label>
                                <input type="text" value="{{ old('telp') }}" name="telp" class="form-control @error('telp') is-invalid @enderror" id="numberTextBox">
                                @error('telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-custom text-white mt-3" style="width: 100%">Daftar</button>
                        </form>
                        <div class="text-center">
                            <p class="my-3">Sudah punya akun? <a href="{{ route('call.masuk') }}" style="text-decoration: underline">Masuk</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <script>
        function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
            });
        });
        }

        setInputFilter(document.getElementById("latinTextBox"), function(value) {
            return /^[a-zA-Z_ ]*$/.test(value); });
    </script>

    {{-- @if (Session::has('pesan'))
        <script>
            Swal.fire({
                title: 'Pemberitahuan!',
                text: "{{ Session::get('pesan') }}",
                icon: 'error',
                confirmButtonColor: '#28B7B5',
                confirmButtonText: 'OK',
            });
        </script>
    @endif --}}
</body>

</html>
