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
                                            Edit Presensi Siswa
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
                                        <form action="/presensi/getedit" method="post">
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
                                                            value="{{ $tanggal }}" autocomplete="off">
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
                            </div>
                        </div>
                    </div>
                    {{-- CARD-TABLE --}}
                    <div id="table-default" class="table-responsive">
                        <form action="/submitpresensi" method="post" id="presensi-form">
                            @csrf
                            <table class="table card-table table-vcenter table-striped text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Tanggal Presensi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="loadedit" class="table-tbody">

                                </tbody>
                            </table>
                            <div class="col-12 d-print-none text-end">
                                <button id="konfirmasi-btn" type="button" class="btn btn-red btn-pill mx-3 my-3">Konfirmasi
                                    (Alpha)</button>
                            </div>
                        </form>
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
                    url: '/getedit',
                    data: {
                        _token: "{{ csrf_token() }}",
                        tanggal: tanggal,
                        kode_kelas: kodeKelas
                    },
                    cache: false,
                    success: function(respond) {
                        $("#loadedit").html(respond);
                    }
                });
            });
            $(".cancel-presensi").click(function(e) {
                var nis = $(this).data("nis");
                var tanggal = $(this).data("tanggal");

                $.ajax({
                    type: 'POST',
                    url: '/cancelpresensi',
                    data: {
                        _token: "{{ csrf_token() }}",
                        nis: nis,
                        tanggal: tanggal
                    },
                    success: function(response) {
                        if (response.success) {
                            // Refresh the page or update the UI as needed
                            $("#loadedit").html(respond);
                        }
                    }
                });
            });
            document.getElementById("konfirmasi-btn").addEventListener("click", function() {
                const checkboxes = document.querySelectorAll('input[name="selected_siswa[]"]:checked');
                if (checkboxes.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Anda harus memilih setidaknya satu data siswa!'
                    });
                } else {
                    document.getElementById("presensi-form")
                .submit(); // Kirim formulir jika ada yang dicentang
                }
            });
        });
    </script>
@endpush
