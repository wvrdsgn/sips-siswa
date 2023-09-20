<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::query();
        $query->select('siswa.*', 'nama_kelas');
        $query->join('kelas', 'siswa.kode_kelas', '=', 'kelas.kode_kelas');
        $query->orderBy('nis');
        if (!empty($request->nama_siswa)) {
            $query->where('nama_lengkap', 'like', '%' . $request->nama_siswa . '%');
        }
        if (!empty($request->kode_kelas)) {
            $query->where('siswa.kode_kelas', $request->kode_kelas);
        }
        $siswa = $query->paginate(10);


        $kelas = DB::table('kelas')->get();
        return view('siswa.index', compact('siswa', 'kelas'));
    }

    public function store(Request $request)
    {
        $nis = $request->nis;
        $nama_lengkap = $request->nama_lengkap;
        $jk = $request->jk;
        $alamat = $request->alamat;
        $kode_kelas = $request->kode_kelas;
        $no_hp = $request->no_hp;
        $password = Hash::make($nis);
        if ($request->hasFile('foto')) {
            $foto = $nis . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }
        if (!empty($request->no_hp)) {
            $no_hp = null;
        }

        try {
            $data = [
                'nis' => $nis,
                'nama_lengkap' => $nama_lengkap,
                'jk' => $jk,
                'alamat' => $alamat,
                'kode_kelas' => $kode_kelas,
                'no_hp' => $no_hp,
                'foto' => $foto,
                'password' => $password
            ];
            $simpan = DB::table('siswa')->insert($data);
            if ($simpan) {
                if ($request->hasFile('foto')) {
                    $folderPath = "public/uploads/siswa/";
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Berhasil! Data Siswa telah disimpan.']);
            }
        } catch (\Exception $e) {
            //dd($e);
            return Redirect::back()->with(['error' => 'Error: Gagal menambahkan data. Silakan coba lagi.']);
        }
    }

    public function edit(Request $request)
    {
        $nis = $request->nis;
        $kelas = DB::table('kelas')->get();
        $siswa = DB::table('siswa')->where('nis', $nis)->first();
        return view('siswa.edit', compact('kelas', 'siswa'));
    }

    public function update($nis, Request $request)
    {
        $nis = $request->nis;
        $nama_lengkap = $request->nama_lengkap;
        $jk = $request->jk;
        $alamat = $request->alamat;
        $kode_kelas = $request->kode_kelas;
        $no_hp = $request->no_hp;
        $password = Hash::make($nis);
        $old_foto = $request->old_foto;
        if ($request->hasFile('foto')) {
            $foto = $nis . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $old_foto;
        }

        try {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'jk' => $jk,
                'kode_kelas' => $kode_kelas,
                'no_hp' => $no_hp,
                'alamat' => $alamat,
                'foto' => $foto,
                'password' => $password
            ];
            $update = DB::table('siswa')->where('nis', $nis)->update($data);
            if ($update) {
                if ($request->hasFile('foto')) {
                    $folderPath = "public/uploads/siswa/";
                    $folderPathOld = "public/uploads/siswa/" . $old_foto;
                    Storage::delete($folderPathOld);
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Berhasil! Data Siswa telah diperbarui.']);
            }
        } catch (\Exception $e) {
            //dd($e);
            return Redirect::back()->with(['error' => 'Error: Gagal memperbarui data. Silakan coba lagi.']);
        }
    }

    public function delete($nis)
    {
        $delete = DB::table('siswa')->where('nis', $nis)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Berhasil! Data Siswa telah dihapus.']);
        } else {
            return Redirect::back()->with(['error' => 'Error: Data Siswa gagal dihapus.']);
        }
    }

    public function import(Request $request)
{
    // dd($request->file('file'));
    $import = Excel::import(new SiswaImport, $request->file('file'));
    if ($import) {
        return Redirect::back()->with(['success' => 'Berhasil! Data Siswa telah diimport.']);
    } else {
        return Redirect::back()->with(['error' => 'Gagal mengimport data siswa.']);
    }
}


}
