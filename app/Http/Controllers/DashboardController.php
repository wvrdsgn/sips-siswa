<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $hariini = date("Y-m-d");
        $bulanini = date("m") * 1;
        $tahunini = date("Y");
        $nis = Auth::guard('siswa')->user()->nis;
        $presensihariini = DB::table('presensi')
            ->where('nis', $nis)
            ->where('tgl_presensi', $hariini)
            ->first();
        // Fetch the student's class data
        $kelasSiswa = DB::table('siswa')
            ->join('kelas', 'siswa.kode_kelas', '=', 'kelas.kode_kelas')
            ->where('siswa.nis', $nis)
            ->select('kelas.nama_kelas')
            ->first();

        //History Bulan ini
        $historibulanini = DB::table('presensi')
            ->where('nis', $nis)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
            ->orderBy('tgl_presensi')
            ->get();

        $leaderboard = DB::table('presensi')
            ->join('siswa', 'presensi.nis', '=', 'siswa.nis')
            ->where('tgl_presensi', $hariini)
            ->orderBy('jam_in')
            ->get();

        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $rekappresensi = DB::table('presensi')
            ->selectRaw('COUNT(jam_in) as jmlhadir, SUM(IF(jam_in IS NULL,1,0))as jmlalpha')
            ->where('nis', $nis)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
            ->first();

        $rekapizin = DB::table('pengajuan_izin')
            ->selectRaw('SUM( IF(status="I",1,0))as jmlizin, SUM( IF(status="S",1,0))as jmlsakit')
            ->where('nis', $nis)
            ->whereRaw('MONTH(tgl_izin)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_izin)="' . $tahunini . '"')
            ->where('status_approved', 1)
            ->first();

        return view('dashboard.dashboard', compact('presensihariini', 'historibulanini', 'namabulan', 'bulanini', 'tahunini', 'rekappresensi', 'leaderboard', 'rekapizin','kelasSiswa'));
    }

    public function dashboardadmin()
    {
        $hariini = date("Y-m-d");
        $bulanini = date("Y-m");
        // Mengambil jumlah yang alpha dan hadir
        $rekappresensi = DB::table('presensi')
            ->selectRaw('COUNT(jam_in) as jmlhadir, SUM(IF(jam_in IS NULL,1,0))as jmlalpha')
            ->where('tgl_presensi', $hariini)
            ->first();
        // Mengambil jumlah yang hadir dan alpha pada bulan ini
        $rekappresensi_bulanini = DB::table('presensi')
            ->selectRaw('COUNT(jam_in) as jmlhadir, SUM(IF(jam_in IS NULL,1,0))as jmlalpha')
            ->whereYear('tgl_presensi', date('Y')) // Mengambil data pada tahun ini
            ->whereMonth('tgl_presensi', date('m')) // Mengambil data pada bulan ini
            ->first();
        // Mengambil jumlah yang izin dan sakit
        $rekapizin = DB::table('pengajuan_izin')
            ->selectRaw('SUM( IF(status="I",1,0))as jmlizin, SUM( IF(status="S",1,0))as jmlsakit')
            ->where('tgl_izin', $hariini)
            ->where('status_approved', 1)
            ->first();
        // Mengambil jumlah yang izin dan sakit pada bulan ini
        $rekapizin_bulanini = DB::table('pengajuan_izin')
            ->selectRaw('SUM( IF(status="I", 1, 0)) as jmlizin, SUM( IF(status="S", 1, 0)) as jmlsakit')
            ->whereYear('tgl_izin', date('Y')) // Mengambil data pada tahun ini
            ->whereMonth('tgl_izin', date('m')) // Mengambil data pada bulan ini
            ->where('status_approved', 1) // Hanya mengambil data yang sudah disetujui (status_approved = 1)
            ->first();
        // Mengambil jumlah yang alpha dan hadir
        $rekapsiswa = DB::table('siswa')
            ->selectRaw('COUNT(DISTINCT nis) as jmlsiswa')
            ->first();
        // Mengambil jumlah siswa dan kelas
        $rekapkelas = DB::table('kelas')
            ->selectRaw('COUNT(DISTINCT kode_kelas) as jmlkelas')
            ->first();
        return view('dashboard.dashboardadmin', compact('rekappresensi', 'rekapizin', 'rekappresensi_bulanini', 'rekapizin_bulanini', 'rekapsiswa', 'rekapkelas'));
    }
}
