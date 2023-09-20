@extends('layouts.presensi')
@section('content')
    <style>
        .circle {
            width: 32px;
            height: 32px;
            background-color: white;
            border-radius: 50%;
            /* Membuat lingkaran dengan border-radius setengah dari lebar/tinggi */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logout {
            position: absolute;
            color: red;
            font-size: 28px;
            text-decoration: none;
            top: 24px;
            right: 16px;
        }
    </style>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    {{-- PROFILE USER --}}
    <div class="section" id="user-section">
        <a href="/proseslogout" class="logout">
            <div class="shadow circle">
                <ion-icon name="power" class="icon"></ion-icon>
            </div>
        </a>
        <div id="user-detail">
            <div class="avatar">
                @if (!empty(Auth::guard('siswa')->user()->foto))
                    @php
                        $path = Storage::url('uploads/siswa/' . Auth::guard('siswa')->user()->foto);
                    @endphp
                    <img src="{{ url($path) }}" alt="avatar" class="imaged w64 rounded">
                @else
                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
                @endif
            </div>
            <div id="user-info" class="my-auto">
                <h2 id="user-name">{{ Auth::guard('siswa')->user()->nama_lengkap }}</h2>
                <span id="user-role">{{ Auth::guard('siswa')->user()->nis }} |
                @if (isset($kelasSiswa))
                    <span id="user-role">{{ $kelasSiswa->nama_kelas }}</span>
                @else
                    <span id="user-role">N/A</span>
                @endif
            </span>
            </div>
        </div>
    </div>

    {{-- MENU PROFILE (Revisi card menu dihilangkan)--}}
    {{-- <div class="section" id="menu-section">
        <div class="card">
            <div class="card-body text-center">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/editprofile" class="blue" style="font-size: 40px;">
                                <ion-icon name="person-sharp"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Profil</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/presensi/histori" class="green" style="font-size: 40px;">
                                <ion-icon name="calendar"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Histori</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/presensi/getizin" class="warning" style="font-size: 40px;">
                                <ion-icon name="mail"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Izin</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" style="font-size: 40px; color:#00B8D9">
                                <ion-icon name="location"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            Lokasi
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- MENU ABSEN --}}
    <div class="section" id="presence-section">
        <div class="todaypresence" style="margin-top: 20px !important;">
            <div class="row">
                <div class="col-6">
                    <div class="card gradasiblue">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if ($presensihariini != null)
                                        @php
                                            $path = Storage::url('uploads/absensi/' . $presensihariini->foto_in);
                                        @endphp
                                        <img src="{{ url($path) }}" alt="" class="imaged w48">
                                    @else
                                        <ion-icon name="camera"></ion-icon>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Masuk</h4>
                                    <span>{{ $presensihariini != null ? $presensihariini->jam_in : 'Belum Absen' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card gradasiyellow">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if ($presensihariini != null && $presensihariini->jam_out != null)
                                        @php
                                            $path = Storage::url('uploads/absensi/' . $presensihariini->foto_out);
                                        @endphp
                                        <img src="{{ url($path) }}" alt="" class="imaged w48">
                                    @else
                                        <ion-icon name="camera"></ion-icon>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Pulang</h4>
                                    <span>{{ $presensihariini != null && $presensihariini->jam_out != null ? $presensihariini->jam_out : 'Belum Absen' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- DIAGRAM CHART --}}
<div class="rekappresence">
    <h3>Rekap Presensi Bulan {{ $namabulan[$bulanini] }} Tahun {{ $tahunini }}</h3>
    <div id="chartdiv">
        <script>
            am4core.ready(function() {

                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                var chart = am4core.create("chartdiv", am4charts.PieChart3D);
                chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

                chart.legend = new am4charts.Legend();

                chart.data = [{
                        country: "Hadir",
                        litres: {{ isset($rekappresensi) && $rekappresensi->jmlhadir ? $rekappresensi->jmlhadir : 0 }}
                    },
                    {
                        country: "Sakit",
                        litres: {{ isset($rekapizin) && $rekapizin->jmlsakit ? $rekapizin->jmlsakit : 0 }}
                    },
                    {
                        country: "Izin",
                        litres: {{ isset($rekapizin) && $rekapizin->jmlizin ? $rekapizin->jmlizin : 0 }}
                    },
                    {
                        country: "Alpha",
                        litres: {{ isset($rekappresensi) && $rekappresensi->jmlalpha ? $rekappresensi->jmlalpha : 0 }}
                    },
                ];

                var series = chart.series.push(new am4charts.PieSeries3D());
                series.dataFields.value = "litres";
                series.dataFields.category = "country";
                series.alignLabels = false;
                series.labels.template.text = "{value.percent.formatNumber('#.0')}%";
                series.labels.template.radius = am4core.percent(-40);
                series.labels.template.fill = am4core.color("white");
                series.colors.list = [
                    am4core.color("#2F78F1"), //Hadir
                    am4core.color("#F5B94F"), //Izin
                    am4core.color("#59A656"), //Sakit
                    am4core.color("#E76336"), //Terlambat
                ];
            }); // end am4core.ready()
        </script>
    </div>
</div>


        {{-- LEADERBOARD & HISTORI ABSEN --}}
        <div class="presencetab mt-2">
            {{-- histori --}}
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            Bulan Ini
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            Leaderboard
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-2" style="margin-bottom:100px;">
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    <ul class="listview image-listview">
                        @foreach ($historibulanini as $d)
                            <li>
                                <div class="item">
                                    @if ($d->jam_in != null && $d->jam_out != null)
                                        <div class="icon-box bg-success">
                                            <ion-icon name="checkmark-circle-outline"></ion-icon>
                                        </div>
                                    @else
                                        <div class="icon-box bg-danger">
                                            <ion-icon name="close-circle-outline"></ion-icon>
                                        </div>
                                    @endif
                                    <div class="in">
                                        <div>{{ date('d-m-Y', strtotime($d->tgl_presensi)) }}</div>
                                        @if ($d->jam_in != null)
                                            <span class="badge badge-primary">{{ $d->jam_in }}</span>
                                        @else
                                            <span class="badge badge-secondary">Belum Absen</span>
                                        @endif

                                        @if ($d->jam_out != null)
                                            <span class="badge badge-warning">{{ $d->jam_out }}</span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                {{-- Leaderboard --}}
                <div class="tab-pane fade" id="profile" role="tabpanel">
                    <ul class="listview image-listview">
                        @foreach ($leaderboard as $d)
                            <li>
                                <div class="item">
                                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                    <div class="in">
                                        <div><b>{{ $d->nama_lengkap }}</b>
                                            <br><small class="text-muted">{{ $d->kode_kelas }}</small>
                                        </div>
                                        <span
                                            class="badge {{ $d->jam_in < '07:10' ? 'bg-primary' : 'bg-danger' }}">{{ $d->jam_in }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
