@extends('layouts.admin.tabler')
@section('content')
    {{-- TITLE TEXT --}}
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row row-cards g-2 align-items-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="container-xl">
                                <div class="row row-cards g-2 align-items-center">
                                    <div class="col">
                                        <!-- CARD-HEADER -->
                                        <h2 class="card-title">
                                            Laporan Presensi
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- CARD-BODY --}}
                        <div class="card-body">
                            <form action="/presensi/printlaporan" target="_blank" method="POST">
                                @csrf
                                <div class="row ">
                                    <div class="row mx-auto">
                                        <div class="col-md-5">
                                            <div class="text-muted">Pilih Kelas</div>
                                            <div class="input-group mb-3">
                                                <select name="kode_kelas" id="kode_kelas" class="form-select">
                                                    <option value="">Kelas</option>
                                                    @foreach ($kelas as $d)
                                                        <option
                                                            {{ Request('kode_kelas') == $d->kode_kelas ? 'selected' : '' }}
                                                            value="{{ $d->kode_kelas }}">
                                                            {{ $d->nama_kelas }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="text-muted">Tanggal Awal:</div>
                                            <div class="input-icon mb-3">
                                                <input type="text" class="form-control" placeholder="Pilih Tanggal"
                                                    id="tanggalawal" name="tanggalawal" value="" autocomplete="off">
                                                <span class="input-icon-addon">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-calendar-search m-auto"
                                                        width="20" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path
                                                            d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4.5">
                                                        </path>
                                                        <path d="M16 3v4"></path>
                                                        <path d="M8 3v4"></path>
                                                        <path d="M4 11h16"></path>
                                                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                                        <path d="M20.2 20.2l1.8 1.8"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-9 col-md-3">
                                            <div class="text-muted">Tanggal Akhir:</div>
                                            <div class="input-icon mb-3">
                                                <input type="text" class="form-control" placeholder="Pilih Tanggal"
                                                    id="tanggalakhir" name="tanggalakhir" value="" autocomplete="off">
                                                <span class="input-icon-addon">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-calendar-search m-auto"
                                                        width="20" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path
                                                            d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4.5">
                                                        </path>
                                                        <path d="M16 3v4"></path>
                                                        <path d="M8 3v4"></path>
                                                        <path d="M4 11h16"></path>
                                                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                                        <path d="M20.2 20.2l1.8 1.8"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-3 col-md-1" style="margin-top: 1.25rem!important;">
                                            <button class="btn btn-indigo btn-pill" style="width: 100%" id="filter-btn">
                                                <span><svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-search mx-auto" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                        <path d="M21 21l-6 -6"></path>
                                                    </svg></span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-6 col-md-6">
                                            <button type="submit" class="btn btn-outline-indigo btn-pill mx-auto"
                                                name="exportpdf"
                                                style="width: 100%; --tblr-btn-border-width: 1.35px !important;">
                                                <span><svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-printer" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path
                                                            d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2">
                                                        </path>
                                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                                        <path
                                                            d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z">
                                                        </path>
                                                    </svg>
                                                    Print Laporan</span>
                                            </button>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <button type="submit" class="btn btn-outline-green btn-pill" name="exportexcel"
                                                style="width: 100%; --tblr-btn-border-width: 1.35px !important;">
                                                <span><svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-brand-office" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M4 18h9v-12l-5 2v5l-4 2v-8l9 -4l7 2v13l-7 3z"></path>
                                                    </svg>
                                                    Export to Excel</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div id="table-default" class="table-responsive" style="margin-top: 1.25rem!important;">
                                    <table class="table card-table table-vcenter table-striped text-nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIS</th>
                                                <th>Nama Siswa</th>
                                                <th>Kelas</th>
                                                <th>Hadir</th>
                                                <th>Sakit</th>
                                                <th>Izin</th>
                                                <th>Alpha</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody id="loadlaporan" class="table-tbody">

                                        </tbody>
                                    </table>
                                </div>
                                {{-- CARD-FOOTER --}}
                                <div class="card-footer">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection
    @push('myscript')
        <script>
            $(function() {
                $("#tanggalawal, #tanggalakhir").datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format: 'yyyy-mm-dd'
                }).datepicker('update', new Date());

                $("#filter-btn").click(function(e) {
                    e.preventDefault();
                    var tanggalawal = $("#tanggalawal").val();
                    var tanggalakhir = $("#tanggalakhir").val();
                    var kodeKelas = $("#kode_kelas").val();

                    // Cek apakah kodeKelas kosong
                    if (!kodeKelas) {
                        // Tampilkan Sweet Alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Anda harus memilih kelas!'
                        });
                        return;
                    }

                    $.ajax({
                        type: 'POST',
                        url: '/getlaporan',
                        data: {
                            _token: "{{ csrf_token() }}",
                            tanggalawal: tanggalawal,
                            tanggalakhir: tanggalakhir,
                            kode_kelas: kodeKelas
                        },
                        cache: false,
                        success: function(respond) {
                            $("#loadlaporan").html(respond);
                        }
                    });
                });
                // tambahkan event listener pada tombol print laporan
                document.querySelector('[name="exportpdf"]').addEventListener('click', function(e) {
                    // ambil nilai dari input
                    var tanggalawal = document.querySelector("#tanggalawal").value;
                    var tanggalakhir = document.querySelector("#tanggalakhir").value;
                    var kodeKelas = document.querySelector("#kode_kelas").value;

                    // cek apakah semua input terisi
                    if (!kodeKelas || !tanggalawal || !tanggalakhir) {
                        // tampilkan Sweet Alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Anda harus memilih kelas dan tanggal awal dan akhir!'
                        });

                        // batalkan aksi default tombol
                        e.preventDefault();
                    }
                });
                // tambahkan event listener pada tombol print laporan
                document.querySelector('[name="exportexcel"]').addEventListener('click', function(e) {
                    // ambil nilai dari input
                    var tanggalawal = document.querySelector("#tanggalawal").value;
                    var tanggalakhir = document.querySelector("#tanggalakhir").value;
                    var kodeKelas = document.querySelector("#kode_kelas").value;

                    // cek apakah semua input terisi
                    if (!kodeKelas || !tanggalawal || !tanggalakhir) {
                        // tampilkan Sweet Alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Anda harus memilih kelas dan tanggal awal dan akhir!'
                        });

                        // batalkan aksi default tombol
                        e.preventDefault();
                    }
                });

            });
        </script>
    @endpush
