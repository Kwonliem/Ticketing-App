<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Petugas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::all()->count();

        return view('user.landing', ['pengaduan' => $pengaduan]);
    }

    public function tentang()
    {
        return view('user.tentang');
    }

    public function pengaduan()
    {
        return view('user.pengaduan');
    }

    public function masuk()
    {
        return view('user.masuk');
    }

    public function login(Request $request)
    {

        $data = $request->all();

        $validate = Validator::make($data, [
            'username' => ['required'],
            'password' => ['required']
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {

            $email = Siswa::where('email', $request->username)->first();

            if (!$email) {
                return redirect()->back()->with(['pesan' => 'Email tidak terdaftar']);
            }

            $password = Hash::check($request->password, $email->password);


            if (!$password) {
                return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
            }

            if (Auth::guard('siswa')->attempt(['email' => $request->username, 'password' => $request->password])) {

                return redirect()->route('call.pengaduan');
            } else {

                return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
            }
        } else {

            $siswa = Siswa::where('username', $request->username)->first();

            $petugas = Petugas::where('username', $request->username)->first();

            if ($siswa) {
                $username = Siswa::where('username', $request->username)->first();

                if (!$username) {
                    return redirect()->back()->with(['pesan' => 'Username tidak terdaftar']);
                }

                $password = Hash::check($request->password, $username->password);

                if (!$password) {
                    return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
                }

                if (Auth::guard('siswa')->attempt(['username' => $request->username, 'password' => $request->password])) {

                    return redirect()->route('call.pengaduan');
                } else {

                    return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
                }
            } elseif ($petugas) {
                $username = Petugas::where('username', $request->username)->first();

                if (!$username) {
                    return redirect()->back()->with(['pesan' => 'Username tidak terdaftar']);
                }

                $password = Hash::check($request->password, $username->password);

                if (!$password) {
                    return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
                }

                if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {

                    return redirect()->route('dashboard.index');
                } else {

                    return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
                }
            } else {
                return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
            }
        }
    }

    public function daftar()
    {
        return view('user.daftar');
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nisn' => ['required', 'min:10', 'max:10', 'unique:siswa'],
            'nama' => ['required', 'string'],
            'email' => ['required', 'email', 'string', 'unique:siswa'],
            'username' => ['required', 'string', 'regex:/^\S*$/u', 'unique:siswa', 'unique:petugas,username'],
            'password' => ['required', 'min:6'],
            'telp' => ['required', 'regex:/(08)[0-9]/'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        Siswa::create([
            'nisn' => $data['nisn'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'username' => strtolower($data['username']),
            'password' => Hash::make($data['password']),
            'telp' => $data['telp'],
        ]);

        $siswa = Siswa::where('email', $data['email'])->first();

        Auth::guard('siswa')->login($siswa);

        return redirect()->route('call.index');
    }

    public function logout()
    {
        Auth::guard('siswa')->logout();

        return redirect()->route('call.index');
    }

    public function storePengaduan(Request $request)
    {

        $data = $request->all();

        $validate = Validator::make($data, [
            'judul_laporan' => ['required'],
            'isi_laporan' => ['required'],
            'tgl_kejadian' => ['required'],
            'lokasi_kejadian' => ['required'],
            'kategori_kejadian' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('assets/pengaduan', 'public');
        }

        date_default_timezone_set('Asia/Bangkok');

        $pengaduan = Pengaduan::create([
            'tgl_pengaduan' => date('Y-m-d h:i:s'),
            'nisn' => Auth::guard('siswa')->user()->nisn,
            'judul_laporan' => $data['judul_laporan'],
            'isi_laporan' => $data['isi_laporan'],
            'tgl_kejadian' => $data['tgl_kejadian'],
            'lokasi_kejadian' => $data['lokasi_kejadian'],
            'kategori_kejadian' => $data['kategori_kejadian'],
            'foto' => $data['foto'],
            'status' => '0',
        ]);

        if ($pengaduan) {

            return redirect()->back()->with(['pengaduan' => 'Berhasil terkirim!', 'type' => 'success']);
        } else {

            return redirect()->back()->with(['pengaduan' => 'Gagal terkirim!', 'type' => 'error']);
        }
    }

    public function laporan($siapa = '')
    {
        $terverifikasi = Pengaduan::where([['nisn', Auth::guard('siswa')->user()->nisn], ['status', '!=', '0']])->get()->count();
        $proses = Pengaduan::where([['nisn', Auth::guard('siswa')->user()->nisn], ['status', 'proses']])->get()->count();
        $selesai = Pengaduan::where([['nisn', Auth::guard('siswa')->user()->nisn], ['status', 'selesai']])->get()->count();

        $hitung = [$terverifikasi, $proses, $selesai];

        if ($siapa == 'me') {

            $pengaduan = Pengaduan::where('nisn', Auth::guard('siswa')->user()->nisn)->orderBy('tgl_pengaduan', 'desc')->get();

            return view('user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa]);
        } else {

            $pengaduan = Pengaduan::where('status', '!=', '0')->orderBy('tgl_pengaduan', 'desc')->get();

            return view('user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa]);
        }
    }

    public function laporanDetail($id_pengaduan)
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan)->first();

        return view('user.detail', ['pengaduan' => $pengaduan]);
    }

    public function laporanEdit($id_pengaduan)
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan)->first();

        return view('user.edit', ['pengaduan' => $pengaduan]);
    }

    public function laporanUpdate(Request $request, $id_pengaduan)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'judul_laporan' => ['required'],
            'isi_laporan' => ['required'],
            'tgl_kejadian' => ['required'],
            'lokasi_kejadian' => ['required'],
            'kategori_kejadian' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('assets/pengaduan', 'public');
        }

        $pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan)->first();

        $pengaduan->update([
            'judul_laporan' => $data['judul_laporan'],
            'isi_laporan' => $data['isi_laporan'],
            'tgl_kejadian' => $data['tgl_kejadian'],
            'lokasi_kejadian' => $data['lokasi_kejadian'],
            'kategori_kejadian' => $data['kategori_kejadian'],
            'foto' => $data['foto'] = $pengaduan->foto
        ]);

        return redirect()->route('call.detail', $id_pengaduan);
    }

    public function laporanDestroy(Request $request)
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $request->id_pengaduan)->first();

        $pengaduan->delete();

        return 'success';
    }


    public function password()
    {
        return view('user.password');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->all();

        if (Auth::guard('siswa')->user()->password == null) {
            $validate = Validator::make($data, [
                'password' => ['required', 'min:6', 'confirmed'],
            ]);
        } else {
            $validate = Validator::make($data, [
                'old_password' => ['required', 'min:6'],
                'password' => ['required', 'min:6', 'confirmed'],
            ]);
        }

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $nisn = Auth::guard('siswa')->user()->nisn;

        $siswa = Siswa::where('nisn', $nisn)->first();

        if (Auth::guard('siswa')->user()->password == null) {
            $siswa->password = Hash::make($data['password']);
            $siswa->save();

            return redirect()->back()->with(['pesan' => 'Password berhasil diubah!', 'type' => 'success']);
        } elseif (Hash::check($data['old_password'], $siswa->password)) {

            $siswa->password = Hash::make($data['password']);
            $siswa->save();

            return redirect()->back()->with(['pesan' => 'Password berhasil diubah!', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['pesan' => 'Password lama salah!', 'type' => 'error']);
        }
    }

    public function ubah(Request $request, $what)
    {
        if ($what == 'email') {
            $siswa = Siswa::where('nisn', $request->nisn)->first();

            $siswa->email = $request->email;
            $siswa->save();

            return 'success';
        } elseif ($what == 'telp') {

            $validate = Validator::make($request->all(), [
                'telp' => ['required', 'regex:/(08)[0-9]/'],
            ]);

            if ($validate->fails()) {
                return 'error';
            }

            $siswa = Siswa::where('nisn', $request->nisn)->first();

            $siswa->telp = $request->telp;
            $siswa->save();

            return 'success';
        }
    }

    public function profil()
    {
        $nisn = Auth::guard('siswa')->user()->nisn;

        $siswa = Siswa::where('nisn', $nisn)->first();

        return view('user.profil', ['siswa' => $siswa]);
    }

    public function updateProfil(Request $request)
    {
        $nisn = Auth::guard('siswa')->user()->nisn;

        $data = $request->all();

        $validate = Validator::make($data, [
            'nisn' => ['sometimes', 'required', 'min:10', 'max:10', Rule::unique('siswa')->ignore($nisn, 'nisn')],
            'nama' => ['required', 'string'],
            'email' => ['sometimes', 'required', 'email', 'string', Rule::unique('siswa')->ignore($nisn, 'nisn')],
            'username' => ['sometimes', 'required', 'string', 'regex:/^\S*$/u', Rule::unique('siswa')->ignore($nisn, 'nisn'), 'unique:petugas,username'],
            'telp' => ['required', 'regex:/(08)[0-9]/'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $siswa = Siswa::where('nisn', $nisn);

        $siswa->update([
            'nisn' => $data['nisn'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'username' => strtolower($data['username']),
            'telp' => $data['telp'],
        ]);

        return redirect()->back()->with(['pesan' => 'Profil berhasil diubah!', 'type' => 'success']);
    }
}
