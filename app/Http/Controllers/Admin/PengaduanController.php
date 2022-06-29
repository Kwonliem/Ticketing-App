<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::orderBy('tgl_pengaduan', 'desc')->get();

        return view('admin.Pengaduan.index', ['pengaduan' => $pengaduan]);
    }

    public function filterPengaduan($status)
    {
        $pengaduan = Pengaduan::where('status', $status)->orderBy('tgl_pengaduan', 'desc')->get();

        return view('admin.Pengaduan.filter', ['pengaduan' => $pengaduan, 'status' => $status]);
    }

    public function show($id_pengaduan)
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan)->first();

        $tanggapan = Tanggapan::where('id_pengaduan', $id_pengaduan)->first();

        return view('admin.Pengaduan.show', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan]);
    }

    public function destroy(Request $request, $id_pengaduan)
    {
        if ($id_pengaduan = 'id_pengaduan') {
            $id_pengaduan = $request->id_pengaduan;
        }

        $pengaduan = Pengaduan::find($id_pengaduan);

        $pengaduan->delete();

        if ($request->ajax()) {
            return 'success';
        }

        return redirect()->route('pengaduan.index');
    }
}
