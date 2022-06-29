<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::all();

        return view('Admin.Petugas.index', ['petugas' => $petugas]);
    }

    public function create()
    {
        return view('Admin.Petugas.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nama_petugas' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'regex:/^\S*$/u', 'unique:petugas', 'unique:siswa,username'],
            'password' => ['required', 'string', 'min:6'],
            'telp' => ['required'],
            'level' => ['required', 'in:admin,petugas'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $username = Petugas::where('username', $data['username'])->first();

        if ($username) {
            return redirect()->back()->with(['notif' => 'Username sudah digunakan!']);
        }

        Petugas::create([
            'nama_petugas' => $data['nama_petugas'],
            'username' => strtolower($data['username']),
            'password' => Hash::make($data['password']),
            'telp' => $data['telp'],
            'level' => $data['level'],
        ]);

        return redirect()->route('petugas.index');
    }

    public function edit($id_petugas)
    {
        $petugas = Petugas::where('id_petugas', $id_petugas)->first();

        return view('Admin.Petugas.edit', ['petugas' => $petugas]);
    }

    public function update(Request $request, $id_petugas)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nama_petugas' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'regex:/^\S*$/u', Rule::unique('petugas')->ignore($id_petugas, 'id_petugas'), 'unique:siswa,username'],
            'telp' => ['required'],
            'level' => ['required', 'in:admin,petugas'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $petugas = Petugas::find($id_petugas);

        if ($data['password'] != null) {
            $password = Hash::make($data['password']);
        }

        $petugas->update([
            'nama_petugas' => $data['nama_petugas'],
            'username' => strtolower($data['username']),
            'password' => $password ?? $petugas->password,
            'telp' => $data['telp'],
            'level' => $data['level'],
        ]);

        return redirect()->back()->with(['pesan' => 'Petugas berhasil diupdate!']);
    }

    public function destroy($id_petugas)
    {
        $petugas = Petugas::findOrFail($id_petugas);

        $petugas->delete();

        return 'success';
    }
}
