<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();

        return view('Admin.Siswa.index', ['siswa' => $siswa]);
    }

    public function show($nisn)
    {
        $siswa = Siswa::where('nisn', $nisn)->first();

        return view('Admin.Siswa.show', ['siswa' => $siswa]);
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return 'success';
    }
}
