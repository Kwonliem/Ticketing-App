@extends('layouts.app')

@section('title', 'Home')

@section('css')
    <style>
        html {
            scroll-behavior: smooth;
        }

        .custom-benefit .row .col-lg-4 .text-center h2 {
            margin-top: 26px;
            margin-bottom: 10px;
            font-weight: 500;
            font-size: 24px;
        }  
        .custom-benefit .row .col-lg-4 .text-center p {
            color: #565656;
            font-weight: 400;
            font-size: 16px;
        } 

        .custom-count .bg-green {
            background: #28B7B5;
            width: 100%;
            padding: 26px;
            border-radius: 4px;
        }
    </style>
@endsection

@section('jumbotron')
<h1 class="text-center text-hero mb-3">Layanan <span>Pengaduan</span> Sekolah</h1>
<p class="text-center text-subtitle mb-5">Sampaikan pengaduan Anda langsung kepada petugas yang berwenang</p>
<a href="#benefit" class="btn btn-primary btn-custom">Mulai Sekarang</a>
@endsection

@section('content')
{{-- Manfaat --}}
<div id="benefit" class="text-center pt-4 mt-5 mb-4 custom-benefit">
    <h2>Langkah-Langkah Membuat Pengaduan</h2>
    <div class="row">
        <div class="col-lg-4 col-12 mt-5">
            <div class="text-center">
                <img src="{{ asset('images/first.svg') }}" alt="illustrasi 1">
                <h2 class="header">Tulis Pengaduan</h2>
                <p>Laporkan pengaduan Anda dengan jelas dan lengkap.</p>
            </div>
        </div>
        <div class="col-lg-4 col-12 mt-5">
            <div class="text-center">
                <img src="{{ asset('images/second.svg') }}" alt="illustrasi 2">
                <h2 class="header">Proses Tindak Lanjut</h2>
                <p>Petugas akan memverifikasi, menindak lanjuti dan memberi tanggapan pengaduan Anda.</p>
            </div>
        </div>
        <div class="col-lg-4 col-12 mt-5">
            <div class="text-center">
                <img src="{{ asset('images/third.svg') }}" alt="illustrasi 3">
                <h2 class="header">Selesai</h2>
                <p>Pengaduan Anda akan terus ditindak lanjuti hingga terselesaikan.</p>
            </div>
        </div>
    </div>
</div>
<div class="text-center pt-4 mt-5 mb-4 custom-count">
    <div class="bg-green">
        <h4 class="mb-0 text-white">Jumlah Pengaduan Sekarang</h4>
        
        <h1 class="mt-3 mb-0 text-white">{{ $pengaduan }}</h1>
    </div>
</div>
@endsection
