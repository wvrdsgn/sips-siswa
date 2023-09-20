@extends('layouts.admin.tabler')
@section('content')
    {{-- TITLE TEXT --}}
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row row-cards g-2 align-items-center">
                <div class="col-12">
                    <form action="/kelas" method="GET">
                        <div class="card">
                            <div class="row">
                                <div class="col-12">
                                    @if (Session::get('success'))
                                        <div class="alert alert-important alert-success alert-dismissible" role="alert">
                                            <div class="d-flex">
                                                <div>
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/alert-circle -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon"
                                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                        <path d="M12 8v4"></path>
                                                        <path d="M12 16h.01"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    {{ Session::get('success') }}
                                                </div>
                                            </div>
                                            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                                        </div>
                                    @endif
                                    @if (Session::get('error'))
                                        <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                                            <div class="d-flex">
                                                <div>
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/alert-circle -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon"
                                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                        <path d="M12 8v4"></path>
                                                        <path d="M12 16h.01"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    {{ Session::get('error') }}
                                                </div>
                                            </div>
                                            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-header">
                                <div class="container-xl">
                                    <div class="row row-cards g-2 align-items-center">
                                        <div class="col">
                                            <!-- CARD-HEADER -->
                                            <h2 class="card-title">
                                                Data Kelas
                                            </h2>
                                        </div>
                                        <div class="col-auto ms-auto d-print-none">
                                            <a href="#" class="btn btn-indigo btn-pill" id="btnTambahKelas"><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-apps" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z">
                                                    </path>
                                                    <path
                                                        d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z">
                                                    </path>
                                                    <path
                                                        d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z">
                                                    </path>
                                                    <path d="M14 7l6 0"></path>
                                                    <path d="M17 4l0 6"></path>
                                                </svg>Tambah Kelas</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- CARD-BODY --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="row">
                                        <div class="ms-auto col-md-4">
                                            <div class="text-muted">Cari:</div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="nama_kelas"
                                                    placeholder="Nama Kelas" value="{{ Request('nama_kelas') }}">
                                                <button class="btn btn-indigo" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-search m-auto" width="20"
                                                        height="20" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                        <path d="M21 21l-6 -6"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- CARD-BODY --}}
                                <div id="table-default" class="table-responsive">
                                    <table class="table card-table table-vcenter table-striped text-nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Kelas</th>
                                                <th>Nama Kelas</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-tbody">
                                            @foreach ($kelas as $d)
                                                <tr>
                                                    <td>{{ $loop->iteration + $kelas->firstItem() - 1 }}</td>
                                                    <td>{{ $d->kode_kelas }}</td>
                                                    <td>{{ $d->nama_kelas }}</td>
                                                    </td>
                                                    <td>
                                                        <span class="dropdown">
                                                            <button
                                                                class="shadow btn dropdown-toggle align-text-top btn-pill btn-outline-indigo"
                                                                data-bs-boundary="viewport" data-bs-toggle="dropdown"
                                                                fdprocessedid="p2mwe9">Actions</button>
                                                            <div class="dropdown-menu dropdown-menu-start">
                                                                <a class="edit dropdown-item" href="#"
                                                                    kode_kelas="{{ $d->kode_kelas }}">
                                                                    Edit
                                                                </a>
                                                                <form action="/kelas/{{ $d->kode_kelas }}/delete"
                                                                    method="POST">
                                                                    @csrf
                                                                    <a class="dropdown-item confirm-delete"
                                                                        href="#">
                                                                        Delete
                                                                    </a>
                                                                </form>
                                                            </div>
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{-- CARD-FOOTER --}}
                                <div class="card-footer">
                                    {{ $kelas->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL ADD KELAS --}}
    <div class="modal modal-blur fade" id="modal-kelas" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/kelas/store" method="POST" id="formKelas">
                        @csrf
                        <div class="row mb-3 align-items-end">
                            <div class="col">
                                <label class="form-label">Kode Kelas</label>
                                <input type="text" name="kode_kelas" id="kode_kelas"
                                    class="form-control form-control-rounded" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control form-control-rounded" id="nama_kelas" name="nama_kelas"
                                autocomplete="off">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-indigo btn-pill"><svg
                                    xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                    <path d="M7 11l5 5l5 -5"></path>
                                    <path d="M12 4l0 12"></path>
                                </svg>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL EDIT KELAS --}}
    <div class="modal modal-blur fade" id="modal-editkelas" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadeditform">

                </div>
            </div>
        </div>
    </div>
@endsection
@push('myscript')
    <script>
        $(function() {
            $("#btnTambahKelas").click(function() {
                $("#modal-kelas").modal("show");
            });

            $(".confirm-delete").click(function(e) {
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat membatalkan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire(
                            'Terhapus!',
                            'Data kelas telah dihapus.',
                            'success'
                        )
                    }
                })
            });

            $(".edit").click(function() {
                var kode_kelas = $(this).attr('kode_kelas');
                $.ajax({
                    type: 'POST', // Ubah metode menjadi POST
                    url: '/kelas/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        kode_kelas: kode_kelas
                    },
                    success: function(respond) {
                        $("#loadeditform").html(respond);
                    }
                });
                $("#modal-editkelas").modal("show");
            });


            $("#formKelas").submit(function() {
                var kode_kelas = $("#kode_kelas").val();
                var nama_kelas = $("#nama_kelas").val();
                if (kode_kelas == "") {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Kode kelas tidak boleh kosong',
                        icon: 'error'
                    });
                    return false;
                } else if (nama_kelas == "") {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Nama kelas tidak boleh kosong',
                        icon: 'error'
                    });
                    return false;
                }
            });
        });
    </script>
@endpush
