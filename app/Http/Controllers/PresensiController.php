<?php

namespace App\Http\Controllers;

use App\Models\Pengajuanizin;
use App\Models\Presensi;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\PDF as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Response;

class PresensiController extends Controller
{
    public function create()
    {
        $hariini = date("Y-m-d");
        $nis = Auth::guard('siswa')->user()->nis;
        $cek = DB::table('presensi')->where('tgl_presensi', $hariini)->where('nis', $nis)->count();
        $lok_sekolah = DB::table('konfigurasi_lokasi')->where('id', 1)->first();
        return view('presensi.create', compact('cek', 'lok_sekolah'));
    }

    public function store(Request $request)
    {
        $nis = Auth::guard('siswa')->user()->nis;
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");
        //Inisialisasi lokasi sekolah dinamis
        $lok_sekolah = DB::table('konfigurasi_lokasi')->where('id', 1)->first();
        $lok = explode(",", $lok_sekolah->lokasi_sekolah);
        //Lokasi kantor lat & long
        $latitudekantor = $lok[0];
        $longitudekantor = $lok[1];
        $lokasi = $request->lokasi;
        $lokasiuser = explode(",", $lokasi);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];
        $jarak = $this->distance($latitudekantor, $longitudekantor, $latitudeuser, $longitudeuser);
        $radius = round($jarak["meters"]); //round untuk menggenapkan koma

        $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nis', $nis)->count();

        if ($cek > 0) {
            $ket = "out";
        } else {
            $ket = "in";
        }


        $image = $request->image;
        $folderPath = "public/uploads/absensi/";
        $formatName = $nis . "-" . $tgl_presensi . "-" . $ket;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;


        if ($radius > $lok_sekolah->radius) {
            echo "error|Gagal menyimpan data absensi karena lokasi Anda berada di luar radius yang ditentukan. Silakan coba lagi dari lokasi yang benar.|";
        } else {
            if ($cek > 0) {
                $data_pulang = [
                    'jam_out' => $jam,
                    'foto_out' => $fileName,
                    'lokasi_out' => $lokasi,
                    'status' => 'H', // status hadir ketika sudah absen
                ];
                $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nis', $nis)->update($data_pulang);
                //Alert setelah absen masuk
                if ($update) {
                    echo "success|Data kehadiran berhasil disimpan. Hati-hati di jalan! :)|out";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Ups! Ada yang salah saat menyimpan kehadiran Anda. Silakan hubungi IT atau administrator untuk bantuan|out";
                }
            } else {
                $data = [
                    'nis' => $nis,
                    'tgl_presensi' => $tgl_presensi,
                    'jam_in' => $jam,
                    'foto_in' => $fileName,
                    'lokasi_in' => $lokasi,
                    'status' => 'H', // status hadir ketika sudah absen
                ];
                $simpan = DB::table('presensi')->insert($data);
                if ($simpan) {
                    //Alert setelah absen pulang
                    Storage::put($file, $image_base64);
                    echo "success|Data kehadiran berhasil disimpan. Selamat belajar! :)|in";
                } else {
                    echo "error|Ups! Ada yang salah saat menyimpan kehadiran Anda. Silakan hubungi IT atau administrator untuk bantuan|in";
                }
            }
        }

    }
    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function editprofile()
    {
        $nis = Auth::guard('siswa')->user()->nis;
        $siswa = DB::table('siswa')->where('nis', $nis)->first();
        return view('presensi.editprofile', compact('siswa'));
    }

    public function updateprofile(Request $request)
    {
        $nis = Auth::guard('siswa')->user()->nis;
        $nama_lengkap = $request->nama_lengkap;
        $alamat = $request->alamat;
        $no_hp = $request->no_hp;
        // $password = Hash::make($request->password);
        $siswa = DB::table('siswa')->where('nis', $nis)->first();
        if ($request->hasFile('foto')) {
            $foto = $nis . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $siswa->foto;
        }
            $data = [
                'alamat' => $alamat,
                'no_hp' => $no_hp,
                'foto' => $foto
            ];
        $update = DB::table('siswa')->where('nis', $nis)->update($data);
        if ($update) {
            if ($request->hasFile('foto')) {
                $folderPath = "public/uploads/siswa/";
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Berhasil! Profil Anda telah diperbarui.']);
        } else {
            return Redirect::back()->with(['error' => 'Error: Gagal memperbarui profil. Silakan coba lagi.']);
        }
    }

    public function histori()
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('presensi.histori', compact('namabulan'));
    }

    public function gethistori(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nis = Auth::guard('siswa')->user()->nis;

        $histori = DB::table('presensi')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->where('nis', $nis)
            ->orderBy('tgl_presensi')
            ->get();

        return view('presensi.gethistori', compact('histori'));
    }

    public function izin()
    {
        $nis = Auth::guard('siswa')->user()->nis;
        $dataizin = DB::table('pengajuan_izin')->where('nis', $nis)->get();
        return view('presensi.izin', compact('dataizin'));
    }

    public function getizin()
    {
        return view('presensi.getizin');
    }

    public function storeizin(Request $request)
    {
        $nis = Auth::guard('siswa')->user()->nis;
        $tgl_izin = $request->tgl_izin;
        $status = $request->status;
        $keterangan = null; // Inisialisasi variabel $keterangan dengan nilai default null

        // Pastikan ada file yang diunggah sebelum menggunakan getOriginalClientExtension()
        if ($request->hasFile('keterangan')) {
            $keterangan = $nis . "-" . $status . "-" . $tgl_izin . "." . $request->file('keterangan')->getClientOriginalExtension();

            // Simpan file langsung ke folder public/uploads/izin
            $request->file('keterangan')->storeAs('public/uploads/izin', $keterangan);
        }

        $data = [
            'nis' => $nis,
            'tgl_izin' => $tgl_izin,
            'status' => $status,
            'keterangan' => $keterangan // Jika file tidak diunggah, $keterangan akan bernilai null
        ];

        $simpan = DB::table('pengajuan_izin')->insert($data);

        if ($simpan) {
            return redirect('/presensi/izin')->with(['success' => 'Sukses! Pengajuan Anda telah dikirim.']);
        } else {
            return redirect('/presensi/izin')->with(['error' => 'Error: Gagal mengirim pengajuan. Silakan coba lagi.']);
        }
    }

    public function monitoring()
    {
        $kelas = DB::table('kelas')->get();
        return view('presensi.monitoring', compact('kelas'));
    }


    public function getpresensi(Request $request)
    {
        $tanggal = $request->tanggal;
        $kodeKelas = $request->kode_kelas;

        $siswa = DB::table('siswa')
            ->select('siswa.nis', 'nama_lengkap', 'nama_kelas', 'siswa.kode_kelas')
            ->leftJoin('kelas', 'siswa.kode_kelas', '=', 'kelas.kode_kelas')
            ->when($kodeKelas, function ($query, $kodeKelas) {
                return $query->where('siswa.kode_kelas', $kodeKelas);
            })
            ->get();

        $presensi = DB::table('presensi')
            ->select('presensi.*')
            ->where('tgl_presensi', $tanggal)
            ->get()
            ->keyBy('nis');
        $izin = DB::table('pengajuan_izin')
            ->select('pengajuan_izin.*')
            ->where('tgl_izin', $tanggal)
            ->get()
            ->keyBy('nis');

        return view('presensi.getpresensi', compact('siswa', 'presensi', 'tanggal', 'kodeKelas', 'izin'));
    }

    public function tampilkanpeta(Request $request)
    {
        $id = $request->id;
        $presensi = DB::table('presensi')
            ->join('siswa', 'siswa.nis', '=', 'presensi.nis')
            ->where('id', $id)->first();
        $lokasi_in = $presensi->lokasi_in;
        $lok_sekolah = DB::table('konfigurasi_lokasi')
            ->where('id', 1)
            ->value('lokasi_sekolah');
        $rad_sekolah = DB::table('konfigurasi_lokasi')
            ->where('id', 1)
            ->value('radius');

        return view('presensi.showmaps', compact('presensi', 'lokasi_in', 'lok_sekolah', 'rad_sekolah'));
    }
    public function editpresensi(Request $request)
    {
        $kelas = DB::table('kelas')->get();
        $tanggal = $request->input('tanggal');
        return view('presensi.editpresensi', compact('kelas', 'tanggal'));
    }
    public function getedit(Request $request)
    {
        $tanggal = $request->tanggal;
        $kodeKelas = $request->kode_kelas;

        $siswa = DB::table('siswa')
            ->select('siswa.nis', 'nama_lengkap', 'nama_kelas', 'siswa.kode_kelas')
            ->leftJoin('kelas', 'siswa.kode_kelas', '=', 'kelas.kode_kelas')
            ->when($kodeKelas, function ($query, $kodeKelas) {
                return $query->where('siswa.kode_kelas', $kodeKelas);
            })
            ->get();

        $presensi = DB::table('presensi')
            ->select('presensi.*')
            ->where('tgl_presensi', $tanggal)
            ->get()
            ->keyBy('nis');
        $izin = DB::table('pengajuan_izin')
            ->select('pengajuan_izin.*')
            ->where('tgl_izin', $tanggal)
            ->get()
            ->keyBy('nis');

        return view('presensi.getedit', compact('siswa', 'presensi', 'tanggal', 'kodeKelas', 'izin'));
    }
    public function submitpresensi(Request $request)
    {
        $selectedSiswa = $request->input('selected_siswa', []);
        $tanggal = $request->input('tanggal');

        foreach ($selectedSiswa as $nis) {
            $existingRecord = Presensi::where('nis', $nis)
                ->where('tgl_presensi', $tanggal)
                ->first();

            if ($existingRecord) {
                // Update existing record's status
                $existingRecord->update(['status' => 'A']);
            } else {
                // Insert new record
                Presensi::create([
                    'nis' => $nis,
                    'tgl_presensi' => $tanggal,
                    'status' => 'A', // Absent
                ]);
            }
        }
        return Redirect::back()->with(['success' => 'Data berhasil diperbarui']);
    }
    public function cancelPresensi($nis)
    {
        // Update the status of the student's attendance to null
        DB::table('presensi')
            ->where('nis', $nis)
            ->update(['status' => 'H']);
        return Redirect::back()->with(['success' => 'Data berhasil diperbarui']);
    }

    public function laporan()
    {
        // Ambil data kelas dari tabel 'kelas'
        $kelas = DB::table('kelas')->get();
        return view('presensi.laporan', compact('kelas'));
    }

    public function izinsakit(Request $request)
    {
        $query = Pengajuanizin::query();
        $query->select('id', 'tgl_izin', 'pengajuan_izin.nis', 'nama_lengkap', 'siswa.kode_kelas', 'status', 'status_approved', 'keterangan');
        $query->join('siswa', 'pengajuan_izin.nis', '=', 'siswa.nis');
        $query->join('kelas', 'siswa.kode_kelas', '=', 'kelas.kode_kelas');
        if (!empty($request->dari) && !empty($request->sampai)) {
            $query->whereBetween('tgl_izin', [$request->dari, $request->sampai]);
        }
        if ($request->status_approved === '0' || $request->status_approved === '1' || $request->status_approved === '2') {
            $query->where('pengajuan_izin.status_approved', $request->status_approved);
        }
        $query->orderBy('tgl_izin', 'desc');
        $izinsakit = $query->paginate(10);
        $izinsakit->appends($request->all());
        return view('presensi.izinsakit', compact('izinsakit'));
    }
    public function downloadlampiran($id)
    {
        $izin_uploads = DB::table('pengajuan_izin')->where('id', $id)->first();

        // Make sure the file name exists before attempting to download
        if ($izin_uploads && $izin_uploads->keterangan) {
            $fileName = $izin_uploads->keterangan;
            $filePath = Storage::disk('public')->path("uploads/izin/{$fileName}");

            if (file_exists($filePath)) {
                return response()->download($filePath);
            } else {
                return back()->withError("The file does not exist.");
            }
        } else {
            return back()->withError("No attachment available for this izin.");
        }
    }
    public function approval(Request $request)
    {
        $status_approved = $request->status_approved;
        $id_izinsakit_form = $request->id_izinsakit_form;
        $update = DB::table('pengajuan_izin')->where('id', $id_izinsakit_form)->update(['status_approved' => $status_approved]);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data berhasil diperbarui']);
        } else {
            return Redirect::back()->with(['success' => 'Data gagal diperbarui']);
        }
    }
    public function cancelizinsakit($id)
    {
        $update = DB::table('pengajuan_izin')->where('id', $id)->update(['status_approved' => 0]);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data berhasil diperbarui']);
        } else {
            return Redirect::back()->with(['success' => 'Data gagal diperbarui']);
        }
    }
    public function cekpengajuanizin(Request $request)
    {
        $tgl_izin = $request->tgl_izin;
        $nis = Auth::guard('siswa')->user()->nis;
        $cek = DB::table('pengajuan_izin')->where('nis', $nis)->where('tgl_izin', $tgl_izin)->count();
        return $cek;
    }
    public function getlaporan(Request $request)
    {
        // query untuk menghitung jumlah izin dan sakit dari table pengajuan_izin
        $izin = Pengajuanizin::groupBy('nis', 'status')
            ->selectRaw('nis, status, count(*) as total')
            ->whereDate('tgl_izin', '>=', $request->tanggalawal)
            ->whereDate('tgl_izin', '<=', $request->tanggalakhir)
            ->where(function ($query) {
                $query->where(function ($subquery) {
                    $subquery->where('status', '=', 'I') // status izin
                        ->where('status_approved', '=', '1'); // status_approved = 1
                })->orWhere(function ($subquery) {
                    $subquery->where('status', '=', 'S') // status sakit
                        ->where('status_approved', '=', '1'); // status_approved = 1
                });
            });

        // query untuk menghitung jumlah hadir dari table presensi
        $hadir = Presensi::groupBy('nis')
            ->selectRaw('nis, count(*) as total')
            ->whereDate('tgl_presensi', '>=', $request->tanggalawal)
            ->whereDate('tgl_presensi', '<=', $request->tanggalakhir);

        // query untuk menghitung jumlah alpha dari table pengajuan_izin berdasarkan status_approved = 2
        $alpha = Presensi::groupBy('nis')
            ->selectRaw('nis, SUM(CASE WHEN status = "A" THEN 1 ELSE 0 END) as total_alpha') // Counting alpha with status 'A'
            ->whereDate('tgl_presensi', '>=', $request->tanggalawal)
            ->whereDate('tgl_presensi', '<=', $request->tanggalakhir)
            ->whereNotIn('nis', function ($query) use ($request) {
                $query->select('nis')
                    ->from('pengajuan_izin')
                    ->whereDate('tgl_izin', '>=', $request->tanggalawal)
                    ->whereDate('tgl_izin', '<=', $request->tanggalakhir);
            });

        $laporan = Siswa::leftJoinSub($izin, 'izin', function ($join) {
            $join->on('siswa.nis', '=', 'izin.nis');
        })
            ->leftJoinSub($hadir, 'hadir', function ($join) {
                $join->on('siswa.nis', '=', 'hadir.nis');
            })
            ->leftJoinSub($alpha, 'alpha', function ($join) {
                $join->on('siswa.nis', '=', 'alpha.nis');
            })
            ->select(
                'siswa.nis',
                'nama_lengkap',
                'kode_kelas',
                DB::raw("SUM(CASE WHEN status = 'I' THEN izin.total ELSE 0 END) as jumlah_izin"),
                DB::raw("SUM(CASE WHEN status = 'S' THEN izin.total ELSE 0 END) as jumlah_sakit"),
                DB::raw("COALESCE(hadir.total, 0) as jumlah_hadir"),
                DB::raw("COALESCE(alpha.total_alpha, 0) as jumlah_alpha")
            ) // Using the total_alpha column
            ->where('kode_kelas', '=', $request->kode_kelas)
            ->groupBy('siswa.nis')
            ->get();

        return view('presensi.getlaporan', compact('laporan'));
    }
    public function printlaporan(Request $request)
    {
        $tanggalawal = $request->tanggalawal;
        $tanggalakhir = $request->tanggalakhir;
        $kode_kelas = $request->kode_kelas;

        // Assuming the date format is 'Y-m-d', we extract the month and year from the input dates
        $startMonth = date('m', strtotime($tanggalawal));
        $startYear = date('Y', strtotime($tanggalawal));
        $endMonth = date('m', strtotime($tanggalakhir));
        $endYear = date('Y', strtotime($tanggalakhir));

        // Combine the month and year to create a range of months, separated by '-'
        $bulan = $startMonth === $endMonth ? $startMonth : "$startMonth-$endMonth";
        // Define the month names
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        // Get the month name
        $namaBulan = $namabulan[(int) $startMonth];
        if ($startMonth !== $endMonth) {
            $namaBulan .= ' - ' . $namabulan[(int) $endMonth];
        }

        // Query to get the data
        $laporan = DB::table('siswa')
            ->select('siswa.nis', 'nama_lengkap', 'jk', 'nama_kelas')
            ->selectRaw("GROUP_CONCAT(DISTINCT CASE
        WHEN presensi.status = 'H' THEN CONCAT(DAY(tgl_presensi), ':H')
        WHEN pengajuan_izin.status = 'S' AND pengajuan_izin.status_approved = 1 THEN CONCAT(DAY(tgl_izin), ':S')
        WHEN pengajuan_izin.status = 'I' AND pengajuan_izin.status_approved = 1 THEN CONCAT(DAY(tgl_izin), ':I')
        WHEN presensi.status = 'A' THEN CONCAT(DAY(tgl_presensi), ':A')
        ELSE NULL
        END ORDER BY tgl_presensi, tgl_izin) as presensi")
            ->selectRaw("COUNT(DISTINCT CASE WHEN presensi.status = 'H' THEN tgl_presensi END) as jumlah_hadir")
            ->selectRaw("COUNT(DISTINCT CASE WHEN pengajuan_izin.status = 'S' AND pengajuan_izin.status_approved = 1 THEN tgl_izin END) as jumlah_sakit")
            ->selectRaw("COUNT(DISTINCT CASE WHEN pengajuan_izin.status = 'I' AND pengajuan_izin.status_approved = 1 THEN tgl_izin END) as jumlah_izin")
            ->selectRaw("COUNT(DISTINCT CASE WHEN presensi.status = 'A' THEN tgl_presensi END) as jumlah_alpha")
            ->where('siswa.kode_kelas', $kode_kelas)
            ->leftJoin('kelas', 'siswa.kode_kelas', '=', 'kelas.kode_kelas')
            ->leftJoin('presensi', function ($join) use ($tanggalawal, $tanggalakhir) {
                $join->on('siswa.nis', '=', 'presensi.nis')
                    ->whereDate('tgl_presensi', '>=', $tanggalawal)
                    ->whereDate('tgl_presensi', '<=', $tanggalakhir);
            })
            ->leftJoin('pengajuan_izin', function ($join) use ($tanggalawal, $tanggalakhir) {
                $join->on('siswa.nis', '=', 'pengajuan_izin.nis')
                    ->where(function ($query) {
                        $query->where('pengajuan_izin.status', '=', 'S') // status sakit
                            ->orWhere('pengajuan_izin.status', '=', 'I'); // status izin
                    })
                    ->where('pengajuan_izin.status_approved', '=', '1')
                    ->whereDate('tgl_izin', '>=', $tanggalawal)
                    ->whereDate('tgl_izin', '<=', $tanggalakhir);
            })
            ->groupBy('siswa.nis', 'nama_lengkap', 'jk')
            ->get();

        // Query to get the class summary
        $classSummary = DB::table('siswa')
            ->selectRaw("COUNT(*) as jumlah_siswa")
            ->selectRaw("SUM(CASE WHEN jk = 'L' THEN 1 ELSE 0 END) as jumlah_laki")
            ->selectRaw("SUM(CASE WHEN jk = 'P' THEN 1 ELSE 0 END) as jumlah_perempuan")
            ->where('kode_kelas', $kode_kelas)
            ->first();

        // Get the class name and summary values
        $nama_kelas = $laporan->first()->nama_kelas ?? '';
        $jumlah_siswa = $classSummary->jumlah_siswa ?? 0;
        $jumlah_laki = $classSummary->jumlah_laki ?? 0;
        $jumlah_perempuan = $classSummary->jumlah_perempuan ?? 0;

        if (isset($_POST['exportpdf'])) {
            //mengambil data dan tampilan dari halaman laporan_pdf
            //data di bawah ini bisa kalian ganti nantinya dengan data dari database
            $data = PDF::loadview('presensi.exportlaporanpdf', compact('laporan', 'bulan', 'classSummary', 'nama_kelas', 'jumlah_siswa', 'jumlah_laki', 'jumlah_perempuan', 'namaBulan'));
            //mendownload laporan.pdf
            return $data->stream('laporan.pdf');
        }
        if (isset($_POST['exportexcel'])) {
            $time = date("d-M-Y H:i:s");
            //Fungsi header dengan mengirimkan raw data excel
            header("Content-type: application/vnd-ms-excel");
            //Mendefinisikan nama file ekspor "export_laporan.xlsx"
            header("Content-Disposition: attachment; filename=Laporan Presensi Siswa $time.xls");
            return view('presensi.printlaporan', compact('laporan', 'bulan', 'classSummary', 'nama_kelas', 'jumlah_siswa', 'jumlah_laki', 'jumlah_perempuan', 'namaBulan'));
        }
    }
    public function export()
    {
        //mengambil data dan tampilan dari halaman laporan_pdf
        //data di bawah ini bisa kalian ganti nantinya dengan data dari database
        $data = PDF::loadview('presensi.exportlaporanpdf');
        //mendownload laporan.pdf
        return $data->stream('laporan.pdf');
    }

}
