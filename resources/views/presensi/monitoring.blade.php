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
                                            Monitoring Presensi
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- CARD-BODY --}}
                        <div class="card-body">
                            <div class="container-xl">
                                <div class="row row-cards g-2 align-items-center">
                                    <div class="col">
                                        <form action="/presensi/getpresensi" method="post">
                                            <div class="row ">
                                                <div class="col-12 col-md-4">
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
                                                <div class="col-8 col-md-4">
                                                    <div class="text-muted">Tanggal Presensi:</div>
                                                    <div class="input-icon mb-3">
                                                        <input type="text" class="form-control"
                                                            placeholder="Pilih Tanggal" id="tanggal" name="tanggal"
                                                            value="" autocomplete="off">
                                                        <span class="input-icon-addon">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-calendar-search m-auto"
                                                                width="20" height="24" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
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
                                                <div class="col-4 col-md-4" style="margin-top: 1.25rem!important;">
                                                    <button id="filter-btn" class="btn btn-indigo btn-pill">
                                                        <span>Filter</span>
                                                    </button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-3 col-md-3 d-print-none text-end"
                                    style="margin-top: 1rem!important;">
                                    <button id="status-btn" class="btn btn-yellow btn-pill w-100">
                                        <span><svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-edit" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                </path>
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                </path>
                                                <path d="M16 5l3 3"></path>
                                            </svg>Edit Presensi</span>
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    {{-- CARD-TABLE --}}
                    <div id="table-default" class="table-responsive">
                        <table class="table card-table table-vcenter table-striped text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Jam Masuk</th>
                                    <th>Foto</th>
                                    <th>Jam Keluar</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="loadpresensi" class="table-tbody">

                            </tbody>
                        </table>
                    </div>
                    {{-- CARD-FOOTER --}}
                    <div class="card-footer">
                        {{-- {{ $kelas->links('vendor.pagination.bootstrap-5') }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- MODAL DETAIL ABSENSI MAP & FOTO --}}
    <div class="modal modal-blur fade" id="modal-tampilkanpeta" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lokasi Presensi Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadmap">

                </div>
            </div>
        </div>
    </div>
    {{-- MODAL STATUS PRESENSI SISWA
    <div class="modal modal-blur fade" id="modal-editpresensi" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Status Presensi Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/updatePresensi" method="POST">
                        @csrf
                        <input type="hidden" id="id_editstatus_form" name="id_editstatus_form">
                        <input type="hidden" id="tanggal_presensi" name="tanggal_presensi">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-3">
                                        <label class="form-label text-info">Tanggal</label>
                                        <label class="form-label text-info">Nama Siswa</label>
                                        <label class="form-label text-info">Kelas</label>
                                    </div>
                                    <div class="col-auto">
                                        <label class="form-label" id="modal-tanggal-izin"></label>
                                        <label class="form-label" id="modal-nama-siswa"></label>
                                        <label class="form-label" id="modal-nama-kelas"></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-12">
                                            <label class="form-label text-info">Status Presensi</label>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center">
                                            <div class="col-2 form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="statuspresensi"
                                                    value="H">
                                                <label class="form-check-label">Hadir</label>
                                            </div>
                                            <div class="col-2 form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="statuspresensi"
                                                    value="I">
                                                <label class="form-check-label">Izin</label>
                                            </div>
                                            <div class="col-2 form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="statuspresensi"
                                                    value="S">
                                                <label class="form-check-label">Sakit</label>
                                            </div>
                                            <div class="col-2 form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="statuspresensi"
                                                    value="A">
                                                <label class="form-check-label">Alpha</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12" style="margin-top: 1.25rem!important;">
                                    <button type="submit" class="btn btn-indigo btn-pill w-100">
                                        <span>Submit</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@push('myscript')
    <script>
        $(function() {
            $("#tanggal").datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            }).datepicker('update', new Date());

            $("#filter-btn").click(function(e) {
                e.preventDefault();
                var tanggal = $("#tanggal").val();
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
                    url: '/getpresensi',
                    data: {
                        _token: "{{ csrf_token() }}",
                        tanggal: tanggal,
                        kode_kelas: kodeKelas
                    },
                    cache: false,
                    success: function(respond) {
                        $("#loadpresensi").html(respond);
                    }
                });
            });

            $('')
        });
    </script>
@endpush
