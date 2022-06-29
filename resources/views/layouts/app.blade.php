<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')

    <title>@yield('title') • CALL</title>
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
                    <ul class="navbar-nav mr-auto">
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
                        @auth('siswa')
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link pb-0 text-dark dropdown-toggle @active('laporan*')" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pengaduan</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('call.laporan', 'me') }}">Pengaduan Saya</a>
                                </div>
                            </div>
                        </li>
                        @endauth
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            @auth('siswa')
                            <div class="dropdown">
                                <a class="nav-link pb-0 text-dark dropdown-toggle" style="text-decoration: underline" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ 'Hai, '. auth('siswa')->user()->nama}}</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('call.profil') }}">Ubah Profil</a>
                                    <a class="dropdown-item" href="{{ route('call.password') }}">Ubah Password</a>
                                    <a class="dropdown-item" href="{{ route('call.logout') }}">Keluar</a>
                                </div>
                            </div>
                            @else
                            <a href="{{ route('call.masuk') }}" class="btn btn-login" style="width: 100%">Masuk &
                                Daftar</a>
                            @endauth
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="jumbotron">
        @yield('jumbotron')
    </div>

    <div class="container mb-5">
        @yield('content')
    </div>

    <hr>
    <div class="container footer">
        <div class="row mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="group">
                    <div class="brand">
                        CA<span>LL</span>
                    </div>
                    <ul>
                        <li>
                            <a href="{{ route('call.index') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('call.tentang') }}">Tentang</a>
                        </li>
                        <li>
                            <a href="{{ route('call.pengaduan') }}">Buat Pengaduan</a>
                        </li>
                        @if (auth('siswa')->check())
                        <li>
                            <a href="{{ route('call.laporan') }}">Pengaduan</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="group">
                    <div class="parent">
                        Me
                    </div>
                    <ul>
                        <li>
                            <a>liemyoesuf@gmail.com</a>
                        </li>
                        <li>
                            <a>Bogor, Indonesia</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="group">
                    <div class="parent">
                        Find Me
                    </div>
                    <ul>
                        <li>
                            <a href="https://www.instagram.com/idnboardingschool/">Instagram</a>
                        </li>
                        <li>
                            <a href="https://t.me/kwonliem">Telegram</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center">
            <p>© 2021 CALL • All rights reserved</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    @if (session()->has('notif'))
    <script>
        Swal.fire({
            title: '{{ session()->get('notif') }}',
            text: "Silahkan cek kontak masuk email Anda.",
            icon: 'success',
            confirmButtonColor: '#28B7B5',
            confirmButtonText: 'Ok',
        })
    </script>
    @endif

    @yield('js')
</body>

</html>
