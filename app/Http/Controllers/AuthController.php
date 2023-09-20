<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    //Proses Login
    public function proseslogin(Request $request){
        if (Auth::guard('siswa')->attempt(['nis'=> $request->nis, 'password'=>$request->password])) {
            return redirect('/dashboard');
        }else{
            return redirect('/')->with(['warning'=>'NIS / Password yang anda masukkan salah!']);
        }
    }

    //Proses Logout
    public function proseslogout(){
        if(Auth::guard('siswa')->check()){
            Auth::guard('siswa')->logout();
            return redirect('/');
        }
    }

    //Proses Login Admin
    public function prosesloginadmin(Request $request){
        if (Auth::guard('user')->attempt(['email'=> $request->email, 'password'=>$request->password])) {
            return redirect('/panel/dashboardadmin');
        }else{
            return redirect('/panel')->with(['warning'=>'Email / Password yang anda masukkan salah!']);
        }
    }

    //Proses Logout Admin
    public function proseslogoutadmin(){
        if(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
            return redirect('/panel');
        }
    }
    //Proses Register Admin
    public function index(Request $request){
        $query = User::query();
        $query->select('users.*', 'nama_role');
        $query->join('roles','users.role_id','=','roles.role_id');
        $query->orderBy('id');
        if (!empty($request->nama_user)) {
            $query->where('name', 'like', '%' . $request->nama_user. '%');
        }
        $user = $query->get();

        $roles = DB::table('roles')->get();
        return view ('users.index', compact('user','roles'));
    }
    public function store(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $jabatan = $request->jabatan;
        $role_id = $request->role_id;
        $password = Hash::make('admin');
        if ($request->hasFile('foto')) {
            $foto = $name . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }

        try {
            $data = [
                'name' => $name,
                'email' => $email,
                'jabatan' => $jabatan,
                'role_id' => $role_id,
                'foto' => $foto,
                'password' => $password
            ];
            $simpan = DB::table('users')->insert($data);
            if ($simpan) {
                if ($request->hasFile('foto')) {
                    $folderPath = "public/uploads/user/";
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Berhasil! Data user telah disimpan.']);
            }
        } catch (\Exception $e) {
            // dd($e);
            return Redirect::back()->with(['error' => 'Error: Gagal menambahkan data. Silakan coba lagi.']);
        }
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $roles = DB::table('roles')->get();
        $user = DB::table('users')->where('id', $id)->first();
        return view('users.edit', compact('roles', 'user'));
    }
    public function update($id, Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $jabatan = $request->jabatan;
        $role_id = $request->role_id;
        $password = Hash::make('admin');
        $old_foto = $request->old_foto;
        if ($request->hasFile('foto')) {
            $foto = $name . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $old_foto;
        }

        try {
            $data = [
                'name' => $name,
                'email' => $email,
                'jabatan' => $jabatan,
                'role_id' => $role_id,
                'foto' => $foto,
                'password' => $password
            ];
            $update = DB::table('users')->where('id', $id)->update($data);
            if ($update) {
                if ($request->hasFile('foto')) {
                    $folderPath = "public/uploads/user/";
                    $folderPathOld = "public/uploads/user/" . $old_foto;
                    Storage::delete($folderPathOld);
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Berhasil! Data user telah diperbarui.']);
            }
        } catch (\Exception $e) {
            //dd($e);
            return Redirect::back()->with(['error' => 'Error: Gagal memperbarui data. Silakan coba lagi.']);
        }
    }
    public function delete($id)
    {
        $delete = DB::table('users')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Berhasil! Data user telah dihapus.']);
        } else {
            return Redirect::back()->with(['error' => 'Error: Data user gagal dihapus.']);
        }
    }
}
