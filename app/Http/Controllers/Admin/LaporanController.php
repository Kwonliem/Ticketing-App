<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('Admin.Laporan.index');
    }

    public function getLaporan(Request $request)
    {
        date_default_timezone_set('Asia/Bangkok');

        $kategori = $request->input('kategori');

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $status = $request->input('status');

        $pengaduan = Pengaduan::query();

        if ($kategori) {
            $pengaduan->where('kategori_kejadian', $kategori);
        }

        if ($date_from) {
            $pengaduan->where('tgl_pengaduan', '>=', $date_from ?? '2021-01-01 00:00:00')->where('tgl_pengaduan', '<=', $date_to . ' 23:59:59' ?? date('Y-m-d H:i:s'));
        }

        if ($status) {
            $pengaduan->where('status', $status);
        }

        return view('admin.Laporan.index', ['pengaduan' => $pengaduan->get(), 'from' => $date_from, 'to' => $date_to, 'kategori' => $kategori, 'status' => $status]);
    }

    public function cetakLaporan(Request $request)
    {
        date_default_timezone_set('Asia/Bangkok');

        $kategori = $request->input('kategori');

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $status = $request->input('status');

        $pengaduan = Pengaduan::query();

        if ($kategori) {
            $pengaduan->where('kategori_kejadian', $kategori);
        }

        if ($date_from) {
            $pengaduan->where('tgl_pengaduan', '>=', $date_from . ' ' . '00:00:00')->where('tgl_pengaduan', '<=', $date_to . ' 23:59:59' ?? date('Y-m-d H:i:s'));
        }

        if ($status) {
            $pengaduan->where('status', $status);
        }

        return view('admin.Laporan.cetak',  ['pengaduan' => $pengaduan->get()]);
    }


    public function all()
    {

        $pengaduan = Pengaduan::all();
        return view('admin.laporan.all', compact('pengaduan'));
    }
}
