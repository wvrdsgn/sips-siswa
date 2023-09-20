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
                                            Data Users
                                        </h2>
                                    </div>
                                    <div class="col-lg-8 col-md-8 d-print-none text-end">
                                        <a href="#" class="btn btn-indigo btn-pill" id="btnTambahUser">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-user-plus" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                                <path d="M16 19h6"></path>
                                                <path d="M19 16v6"></path>
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                                            </svg>Tambah User
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- CARD-BODY --}}
                        <form action="/users" method="GET">
                            <div class="card-body">
                                <div class="row">
                                    <div class="row">
                                        <div class="ms-auto col-md-4">
                                            <div class="text-muted">Cari:</div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="nama_user"
                                                    placeholder="Nama User" value="{{ Request('nama_user') }}">
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
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Jabatan</th>
                                        <th>Role</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-tbody">
                                    @foreach ($user as $d)
                                        @php
                                            $path = Storage::url('uploads/user/' . $d->foto);
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $d->name }}</td>
                                            <td>{{ $d->email }}</td>
                                            <td>{{ $d->jabatan }}</td>
                                            <td>{{ $d->role_id == '1' ? 'Admin' : 'User' }}</td>
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
                                                            id="{{ $d->id }}">
                                                            Edit
                                                        </a>
                                                        <form action="/users/{{ $d->id }}/delete" method="POST">
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
                            {{-- {{ $user->links('vendor.pagination.bootstrap-5') }} --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- MODAL ADD USER --}}
    <div class="modal modal-blur fade" id="modal-user" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/users/store" method="POST" id="formUser" enctype="multipart/form-data">
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
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name"
                                autocomplete="off">
                            <label for="floating-input">Nama Lengkap</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email"
                                autocomplete="off">
                            <label for="floating-input">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="jabatan" name="jabatan"
                                autocomplete="off">
                            <label for="floating-input">Jabatan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="role_id" name="role_id">
                                <option value=""></option>
                                @foreach ($roles as $d)
                                    <option {{ Request('role_id') == $d->role_id ? 'selected' : '' }}
                                        value="{{ $d->role_id }}">
                                        {{ $d->nama_role }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Role</label>
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
    {{-- MODAL EDIT USER --}}
    <div class="modal modal-blur fade" id="modal-edituser" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data User</h5>
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
            $("#btnTambahUser").click(function() {
                $("#modal-user").modal("show");
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
                            'Data user telah dihapus.',
                            'success'
                        )
                    }
                })
            });

            $(".edit").click(function() {
                var id = $(this).attr('id');
                $.ajax({
                    type: 'POST', // Ubah metode menjadi POST
                    url: '/users/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(respond) {
                        $("#loadeditform").html(respond);
                    }
                });
                $("#modal-edituser").modal("show");
            });


            $("#formUser").submit(function() {
                var name = $("#name").val();
                var email = $("#email").val();
                var jabatan = $("#jabatan").val();
                var role_id = $("#role_id").val();
                if (name == "") {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Nama tidak boleh kosong',
                        icon: 'error'
                    });
                    return false;
                } else if (email == "") {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Email user tidak boleh kosong',
                        icon: 'error'
                    });
                    return false;
                } else if (jabatan == "") {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Jabatan tidak boleh kosong',
                        icon: 'error'
                    });
                    return false;
                } else if (role_id == "") {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Role tidak boleh kosong',
                        icon: 'error'
                    });
                    return false;
                }
            });
        });
    </script>
    {{-- UPLOAD-FILE/PHOTO-DATA-SISWA --}}
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
