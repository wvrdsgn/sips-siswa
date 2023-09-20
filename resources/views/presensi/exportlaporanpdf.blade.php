<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Daftar Presensi Siswa</title>
    <style>
        @page {
            size: A4 landscape
        }

        body {
            font-family: Arial, sans-serif;
        }

        .header h2 {
            font-size: 18px;
        }

        .header p {
            font-size: 12px;
        }

        .logo {
            height: 80px;
            margin-right: 10px;
        }

        .school-info {
            text-align: left;
        }

        .title {
            text-align: center;
            margin-bottom: 5mm;
        }

        .title h1 {
            font-size: 20px;
        }

        .title h2 {
            font-size: 16px;
        }

        .title p {
            font-size: 12px;
        }

        .presensi-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        .presensi-table th,
        .presensi-table td {
            border: 1px solid #000;
            padding: 5px;
        }

        .presensi-table th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .footer {
            text-align: right;
            margin-top: 10mm;
        }

        .footer p {
            margin: 0;
            font-size: 12px;
        }

        /* Two-column layout */
        .column-container {
            display: flex;
        }

        .column {
            flex: 1;
            text-align: center;
        }
    </style>
</head>

<body class="A4 landscape">
    <div class="title">
        <?php
        $path = public_path('assets/img/logo-smk.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        ?>
        <img src="<?php echo $base64; ?>" width="70" height="70"/>
        {{-- <img src="{{ asset('assets/img/logo-smk.png') }}" alt="Logo Sekolah" class="logo"> --}}
        {{-- <div class="school-info">
            <h2></h2>
            <p>Jl. Surya Kencana no 2, Pamulang Barat, Kota Tangerang Selatan</p>
            <p>smksasmitajaya1@gmail.com || smk1.sasmitajaya.sch.id</p>
        </div> --}}
        <h1>DAFTAR PRESENSI SISWA SMK SASMITA JAYA 1 PAMULANG</h1>
        <h2>Tahun Pelajaran: 2023/2024</h2>
        <h2>Bulan: {{ $namaBulan }}</h2>
        <p>Nama Kelas: <b>{{ $nama_kelas }}</b> - Jumlah Siswa: <b>{{ $jumlah_siswa }} siswa</b> - Laki-laki:
            <b>{{ $jumlah_laki }} siswa</b> - Perempuan: <b>{{ $jumlah_perempuan }} siswa</b>
        </p>
        <p>Wali Kelas: <b>Budi Santoso</b></p>
    </div>
    <table class="presensi-table">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">NIS</th>
                <th rowspan="2">Nama Siswa</th>
                <th rowspan="2">L/P</th>
                <th colspan="31">{{ $namaBulan }}</th>
                <th colspan="4">Jumlah Rekap</th>
            </tr>
            <tr>
                <?php
                for ($i = 1; $i <= 31; $i++) {
                    echo "<th>$i</th>";
                }
                ?>
                <th>H</th>
                <th>S</th>
                <th>I</th>
                <th>A</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            <tr>
                @foreach ($laporan as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->nis }}</td>
                <td>{{ $data->nama_lengkap }}</td>
                <td>{{ $data->jk }}</td>
                @php
                    $presensiDays = explode(',', $data->presensi);
                    $presensiStatus = [];
                    foreach ($presensiDays as $day) {
                        [$d, $status] = explode(':', $day);
                        $presensiStatus[$d] = $status;
                    }
                @endphp
                @for ($i = 1; $i <= 31; $i++)
                    <td>{{ $presensiStatus[$i] ?? '' }}</td>
                @endfor
                <td>{{ $data->jumlah_hadir }}</td>
                <td>{{ $data->jumlah_sakit }}</td>
                <td>{{ $data->jumlah_izin }}</td>
                <td>{{ $data->jumlah_alpha }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <table width="100%" style="margin-top:100px">
        <tr>
            <td colspan="2" style="text-align: right; font-size: 14px;">Pamulang, {{ date('d-m-Y') }}</td>
        </tr>
        <tr>
            <td style="text-align:center; vertical-align:bottom; font-size: 14px;" height="100px">
                <u>Budi Santoso</u><br>
                <i><b>Wali Kelas</b></i>
            </td>
            <td style="text-align:center; vertical-align:bottom; font-size: 14px;">
                <u>Joko</u><br>
                <i><b>Kepala Sekolah</b></i>
            </td>
        </tr>
    </table>
    <div class="footer" style="font-size: 12px; position:absolute; margin-bottom:5px;">
        <i>Downloaded by {{ Auth::user()->name }} {{ date('d-m-Y H:i:s') }}</i>
    </div>
</body>

</html>
