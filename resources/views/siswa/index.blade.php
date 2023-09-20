@extends('layouts.admin.tabler')
@section('content')
    {{-- TITLE TEXT --}}
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row row-cards g-2 align-items-center">
                <div class="col-12">
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
                                    <div class="col-lg-4 col-md-4">
                                        <!-- CARD-HEADER -->
                                        <h2 class="card-title">
                                            Data Siswa
                                        </h2>
                                    </div>
                                    {{-- REVISI IMPORT DATA SISWA DIMATIKAN --}}
                                    {{-- <div class="col-lg-5 col-md-5 text-end">
                                        <form action="/siswa-import" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-8">
                                                    <input type="file" name="file" class="form-control">
                                                </div>
                                                <div class="col-4">
                                                    <button class="btn btn-pill btn-green w-100" type="submit">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-file-type-xls"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                            <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4"></path>
                                                            <path d="M4 15l4 6"></path>
                                                            <path d="M4 21l4 -6"></path>
                                                            <path
                                                                d="M17 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75">
                                                            </path>
                                                            <path d="M11 15v6h3"></path>
                                                        </svg>Import
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div> --}}
                                    <div class="col-lg-3 col-md-3 d-print-none text-end">
                                        <a href="#" class="btn btn-indigo btn-pill w-100" id="btnTambahSiswa">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-user-plus" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                                <path d="M16 19h6"></path>
                                                <path d="M19 16v6"></path>
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                                            </svg>Tambah Siswa
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- CARD-BODY --}}

                        <form action="/siswa" method="GET">
                            <div class="card-body">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-4">
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
                                        <div class="ms-auto col-md-4">
                                            <div class="text-muted">Cari:</div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="nama_siswa"
                                                    placeholder="Nama Siswa" value="{{ Request('nama_siswa') }}">
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
                        </form>
                        {{-- CARD-BODY --}}
                        <div id="table-default" class="table-responsive">
                            <table class="table card-table table-vcenter table-striped text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Kelas</th>
                                        <th>No. HP</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-tbody">
                                    @foreach ($siswa as $d)
                                        @php
                                            $path = Storage::url('uploads/siswa/' . $d->foto);
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration + $siswa->firstItem() - 1 }}</td>
                                            <td>{{ $d->nis }}</td>
                                            <td>{{ $d->nama_lengkap }}</td>
                                            <td>{{ $d->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                            <td>{{ $d->nama_kelas }}</td>
                                            <td>{{ $d->no_hp }}</td>
                                            <td>
                                                @if (empty($d->foto))
                                                    <img src="{{ asset('assets/img/avatar.svg') }}" class="avatar"
                                                        alt="">
                                                @else
                                                    <img src="{{ url($path) }}" class="avatar" alt="">
                                                @endif
                                            </td>
                                            <td>
                                                <span class="dropdown">
                                                    <button
                                                        class="shadow btn dropdown-toggle align-text-top btn-pill btn-outline-indigo"
                                                        data-bs-boundary="viewport" data-bs-toggle="dropdown"
                                                        fdprocessedid="p2mwe9">Actions</button>
                                                    <div class="dropdown-menu dropdown-menu-start">
                                                        <a class="edit dropdown-item" href="#"
                                                            nis="{{ $d->nis }}">
                                                            Edit
                                                        </a>
                                                        <form action="/siswa/{{ $d->nis }}/delete" method="POST">
                                                            @csrf
                                                            <a class="dropdown-item confirm-delete" href="#">
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
                            {{ $siswa->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- MODAL ADD SISWA --}}
    <div class="modal modal-blur fade" id="modal-siswa" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/siswa/store" method="POST" id="formSiswa" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3 align-items-end">
                            <div class="col-auto">
                                <label for="foto" class="avatar avatar-upload rounded">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    <span class="avatar-upload-text">Add</span>
                                </label>
                                <input type="file" name="foto" id="foto" style="display: none;" />
                            </div>

                            <div class="col">
                                <label class="form-label">Nomor Induk Siswa (NIS)</label>
                                <input type="text" name="nis" id="nis"
                                    class="form-control form-control-rounded" />
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                autocomplete="off">
                            <label for="floating-input">Nama Lengkap</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="jk" name="jk">
                                <option value=""></option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <label for="floatingSelect">Jenis Kelamin</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="kode_kelas" name="kode_kelas">
                                <option value=""></option>
                                @foreach ($kelas as $d)
                                    <option {{ Request('kode_kelas') == $d->kode_kelas ? 'selected' : '' }}
                                        value="{{ $d->kode_kelas }}">
                                        {{ $d->nama_kelas }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Kelas</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                autocomplete="off">
                            <label for="floating-input">Nomor HP</label>
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
    {{-- MODAL EDIT SISWA --}}
    <div class="modal modal-blur fade" id="modal-editsiswa" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Siswa</h5>
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
            $("#btnTambahSiswa").click(function() {
                $("#modal-siswa").modal("show");
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
                            'Data siswa telah dihapus.',
                            'success'
                        )
                    }
                })
            });

            $(".edit").click(function() {
                var nis = $(this).attr('nis');
                $.ajax({
                    type: 'POST', // Ubah metode menjadi POST
                    url: '/siswa/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        nis: nis
                    },
                    success: function(respond) {
                        $("#loadeditform").html(respond);
                    }
                });
                $("#modal-editsiswa").modal("show");
            });


            $("#formSiswa").submit(function() {
                var nis = $("#nis").val();
                var nama_lengkap = $("#nama_lengkap").val();
                var jk = $("#jk").val();
                var kode_kelas = $("formSiswa").find("#kode_kelas").val();
                if (nis == "") {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'NIS tidak boleh kosong',
                        icon: 'error'
                    });
                    return false;
                } else if (nama_lengkap == "") {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Nama siswa tidak boleh kosong',
                        icon: 'error'
                    });
                    return false;
                } else if (jk == "") {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Jenis kelamin tidak boleh kosong',
                        icon: 'error'
                    });
                    return false;
                } else if (kode_kelas == "") {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Kelas tidak boleh kosong',
                        icon: 'error'
                    });
                    return false;
                }
            });
        });
    </script>
    {{-- UPLOAD-FILE/PHOTO-DATA-USER --}}
    <script>
        const uploadInput = document.getElementById("foto");
        const avatarUpload = document.querySelector(".avatar-upload");

        uploadInput.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();

                reader.addEventListener("load", function() {
                    const imgData = this.result;
                    const img = document.createElement("img");
                    img.src = imgData;
                    avatarUpload.innerHTML = "";
                    avatarUpload.appendChild(img);
                });

                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
