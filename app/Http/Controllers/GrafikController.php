<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Petugas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class GrafikController extends Controller
{
    public function grafik()
    {


        $title = 'Data Grafik';
        $pengaduan = Pengaduan::count();
        $pending = Pengaduan::where('status', '=', '0')->count();
        $proses = Pengaduan::where('status', '=', 'proses')->count();
        $selesai = Pengaduan::where('status', '=', 'selesai')->count();
        $petugas = Petugas::count();


        return view('grafik', compact('pengaduan', 'pending', 'proses', 'selesai', 'petugas', 'title'));
    }
}
