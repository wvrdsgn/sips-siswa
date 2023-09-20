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
                                            Persetujuan Izin/Sakit
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- CARD-BODY --}}
                        <div class="card-body">
                            <form action="/presensi/izinsakit" method="GET">
                                <div class="col">
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="text-muted">Status Approved</div>
                                            <div class="input-group mb-3">
                                                <select name="status_approved" id="status_approved" class="form-select">
                                                    <option value="">Pilih Status</option>
                                                    <option value="0"
                                                        {{ Request('status_approved') === '0' ? 'selected' : '' }}>
                                                        Menunggu...</option>
                                                    <option value="1"
                                                        {{ Request('status_approved') == 1 ? 'selected' : '' }}>Disetujui
                                                    </option>
                                                    <option value="2"
                                                        {{ Request('status_approved') == 2 ? 'selected' : '' }}>Ditolak
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="text-muted">Tanggal Awal:</div>
                                            <div class="input-icon mb-3">
                                                <input type="text" class="form-control" placeholder="Pilih Tanggal"
                                                    id="dari" name="dari" value="{{ Request('dari') }}"
                                                    autocomplete="off">
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
                                                    id="sampai" name="sampai" value="{{ Request('sampai') }}"
                                                    autocomplete="off">
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
                                        <div class="col-3 col-md-2" style="margin-top: 1.25rem!important;">
                                            <button class="btn btn-indigo btn-pill" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler"
                                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                    <path d="M21 21l-6 -6"></path>
                                                </svg>
                                                <span class="ms-auto">Filter</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- CARD-TABLE --}}
                        <div id="table-default" class="table-responsive">
                            <table class="table card-table table-vcenter table-striped text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Izin</th>
                                        <th>NIS</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Status</th>
                                        <th>Lampiran</th>
                                        <th>Status Approved</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="loadizin" class="table-tbody">
                                    @foreach ($izinsakit as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d-m-Y', strtotime($d->tgl_izin)) }}</td>
                                            <td>{{ $d->nis }}</td>
                                            <td>{{ $d->nama_lengkap }}</td>
                                            <td>{{ $d->kode_kelas }}</td>
                                            <td>{{ $d->status == 'I' ? 'Izin' : ($d->status == 'S' ? 'Sakit' : 'Alpha') }}
                                            </td>
                                            <td>
                                                @if ($d->keterangan)
                                                    <a class="btn btn-sm btn-outline-indigo btn-pill"
                                                        href="{{ url('presensi/downloadlampiran/' . $d->id) }}"><svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-file-download"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                            </path>
                                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                            <path
                                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                                            </path>
                                                            <path d="M12 17v-6"></path>
                                                            <path d="M9.5 14.5l2.5 2.5l2.5 -2.5"></path>
                                                        </svg>Download</a>
                                                @else
                                                    N/A
                                                @endif

                                            </td>
                                            <td>
                                                @if ($d->status_approved == 1)
                                                    <span class="badge bg-indigo">Disetujui</span>
                                                @elseif ($d->status_approved == 2)
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @else
                                                    <span class="badge bg-secondary">Menunggu...</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($d->status_approved == 0)
                                                    <a href="#"
                                                        class="btn btn-sm btn-indigo btn-pill w-100 btn-approve"
                                                        data-id_izinsakit="{{ $d->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-edit" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                            </path>
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                            </path>
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                            </path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>Edit
                                                    </a>
                                                @else
                                                    <a href="/presensi/{{ $d->id }}/cancelizinsakit"
                                                        class="btn btn-sm btn-outline-danger btn-pill w-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-x" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                            </path>
                                                            <path d="M18 6l-12 12"></path>
                                                            <path d="M6 6l12 12"></path>
                                                        </svg>Batalkan
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- CARD-FOOTER --}}
                        <div class="card-footer">
                            {{ $izinsakit->links('vendor.pagination.bootstrap-5') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL EDIT IZIN/SAKIT --}}
    <div class="modal modal-blur fade" id="modal-izinsakit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Persetujuan Izin/Sakit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/presensi/approval" method="POST">
                        @csrf
                        <input type="hidden" id="id_izinsakit_form" name="id_izinsakit_form">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-3">
                                        <label class="form-label text-info">Tanggal Izin</label>
                                        <label class="form-label text-info">Jenis Izin</label>
                                        <label class="form-label text-info">Nama Siswa</label>
                                        <label class="form-label text-info">Kelas</label>
                                    </div>
                                    <div class="col-auto">
                                        <label class="form-label" id="modal-tanggal-izin"></label>
                                        <label class="form-label badge bg-azure-lt" id="modal-jenis-izin"></label>
                                        <label class="form-label" id="modal-nama-siswa"></label>
                                        <label class="form-label" id="modal-nama-kelas"></label>
                                    </div>
                                </div>
                                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="radio" name="status_approved" id="status_approved" value="1"
                                            class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>
                                                <span><svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-circle-check" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                        <path d="M9 12l2 2l4 -4"></path>
                                                    </svg></span>
                                                <strong>Setujui</strong>
                                                <br><small>Pilih opsi ini jika Anda ingin menyetujui pengajuan izin/sakit
                                                    siswa.</small>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="radio" name="status_approved" id="status_approved" value="2"
                                            class="form-selectgroup-input" checked="">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>
                                                <span><svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-circle-x" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                        <path d="M10 10l4 4m0 -4l-4 4"></path>
                                                    </svg></span>
                                                <strong>Tolak</strong>
                                                <br><small>Pilih opsi ini jika Anda ingin menolak pengajuan izin/sakit
                                                    siswa.</small>
                                            </div>
                                        </div>
                                    </label>
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
    </div>
@endsection
@push('myscript')
    <script>
        $(function() {
            $("#dari, #sampai").datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            }).datepicker('update', new Date());

            $("#filter-btn").click(function(e) {
                e.preventDefault();
                var tanggalawal = $("#dari").val();
                var tanggalakhir = $("#sampai").val();
                var statusApproved = $("#status_approved").val();

                // Cek apakah statusApproved kosong
                if (!statusApproved) {
                    // Tampilkan Sweet Alert
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Anda harus memilih status approved!'
                    });
                    return;
                }

                $.ajax({
                    type: 'get',
                    url: '/izinsakit',
                    data: {
                        _token: "{{ csrf_token() }}",
                        dari: dari,
                        sampai: sampai,
                        status_approved: statusApproved
                    },
                    cache: false,
                    success: function(respond) {
                        $("#loadizin").html(respond);
                    }
                });
            });

            $(".btn-approve").click(function(e) {
                e.preventDefault();
                var id_izinsakit = $(this).data("id_izinsakit");
                var tanggal_izin = $(this).closest("tr").find("td:nth-child(2)").text();
                var nama_siswa = $(this).closest("tr").find("td:nth-child(4)").text();
                var jenis_izin = $(this).closest("tr").find("td:nth-child(6)").text();
                var nama_kelas = $(this).closest("tr").find("td:nth-child(5)").text();

                $("#id_izinsakit_form").val(id_izinsakit);
                $("#modal-tanggal-izin").text(tanggal_izin);
                $("#modal-nama-siswa").text(nama_siswa);
                $("#modal-jenis-izin").text(jenis_izin);
                $("#modal-nama-kelas").text(nama_kelas);

                $("#modal-izinsakit").modal("show");
            });
        });
    </script>
@endpush
