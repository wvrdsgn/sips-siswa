@extends('layouts.admin.tabler')
@section('content')
    {{-- TITLE TEXT --}}
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Beranda
                    </h2>
                    <div class="page-pretitle">
                        Administrator
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- BODY --}}
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
{{-- Revisi Untuk card-title dihapus <a> agar tidak link ke menu lain --}}
                <div class="col-md-6 col-xl-3">
                    <div class="card card-sm">
                        <div class="card-status-start bg-primary"></div>
                        <div class="card-header" style="padding: 8px 16px !important;">
                            <h3 class="card-title">Total Siswa</h3>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-blue-lt avatar" style="border-radius: 100% !important;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                         </svg>
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <div class="font-weight-medium">
                                        <h2 style="margin: 0!important;">{{ $rekapsiswa->jmlsiswa != null ? $rekapsiswa->jmlsiswa : 0 }}</h2>
                                        <strong class="float-right font-weight-medium text-blue">/ {{ $rekapkelas->jmlkelas != null ? $rekapkelas->jmlkelas : 0 }} Kelas</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card card-sm">
                        <div class="card-status-start bg-warning"></div>
                        <div class="card-header" style="padding: 8px 16px !important;">
                            <h3 class="card-title mx-1">Sakit</h3><span class="text-muted">| Hari ini</span>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-yellow-lt avatar" style="border-radius: 100% !important;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-medical" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                            <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                            <path d="M10 14l4 0"></path>
                                            <path d="M12 12l0 4"></path>
                                         </svg>
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <div class="font-weight-medium">
                                        <h2 style="margin: 0!important;">{{ $rekapizin->jmlsakit != null ? $rekapizin->jmlsakit : 0 }}</h2>
                                        <strong class="float-right font-weight-medium text-warning">Total</strong> <span>{{ $rekapizin_bulanini->jmlsakit }} Bulan ini</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card card-sm">
                        <div class="card-status-start bg-success"></div>
                        <div class="card-header" style="padding: 8px 16px !important;">
                            <h3 class="card-title mx-1">Izin</h3><span class="text-muted">| Hari ini</span>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-green-lt avatar" style="border-radius: 100% !important;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
                                            <path d="M3 7l9 6l9 -6"></path>
                                         </svg>
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <div class="font-weight-medium">
                                        <h2 style="margin: 0!important;">{{ $rekapizin->jmlizin != null ? $rekapizin->jmlizin : 0 }}</h2>
                                        <strong class="float-right font-weight-medium text-success">Total</strong> <span>{{ $rekapizin_bulanini->jmlizin }} Bulan ini</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card card-sm">
                        <div class="card-status-start bg-danger"></div>
                        <div class="card-header" style="padding: 8px 16px !important;">
                            <h3 class="card-title mx-1">Alpha<span class="text-muted">| Hari ini</span>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-red-lt avatar" style="border-radius: 100% !important;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mood-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M20.983 12.556a9 9 0 1 0 -8.433 8.427"></path>
                                            <path d="M9 10h.01"></path>
                                            <path d="M15 10h.01"></path>
                                            <path d="M9.5 15c.658 .64 1.56 1 2.5 1c.194 0 .386 -.015 .574 -.045"></path>
                                            <path d="M21.5 21.5l-5 -5"></path>
                                            <path d="M16.5 21.5l5 -5"></path>
                                         </svg>
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <div class="font-weight-medium">
                                        <h2 style="margin: 0!important;">{{ $rekappresensi->jmlalpha != null ? $rekappresensi->jmlalpha : 0 }}</h2>
                                        <strong class="float-right font-weight-medium text-danger">Total</strong> <span>{{ $rekappresensi_bulanini->jmlalpha }} Bulan ini</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
