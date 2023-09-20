@extends('layouts.presensi')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Profil</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection

@section('content')
    <div class="row" style="margin-top: 72px;">
        <div class="col">
            @php
                $messagesuccess = Session::get('success');
                $messageerror = Session::get('error');
            @endphp
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ $messagesuccess }}
                </div>
            @endif
            @if (Session::get('error'))
                <div class="alert alert-danger">
                    {{ $messageerror }}
                </div>
            @endif
        </div>
    </div>
    <form action="/presensi/{{ $siswa->nis }}/updateprofile" id="formedit" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col" style="margin-bottom: 72px;">
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="text" readonly class="form-control-plaintext" value="{{ $siswa->nis }}" name="nis"
                        placeholder="NIS" autocomplete="off" disabled>
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="text" readonly class="form-control-plaintext" value="{{ $siswa->nama_lengkap }}" name="nama_lengkap"
                        placeholder="Nama Lengkap" autocomplete="off" disabled>
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="text" class="form-control" value="{{ $siswa->no_hp }}" name="no_hp"
                    id="no_hp" placeholder="No. HP" autocomplete="off">
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <textarea type="text" class="form-control" name="alamat" id="alamat"
                        placeholder="Alamat" autocomplete="off" rows="3">{{ $siswa->alamat }}</textarea>
                </div>
            </div>
            {{-- <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                </div>
                <small>*Masukkan password untuk verifikasi identitas Anda.</small>
            </div> --}}
            <div class="custom-file-upload my-2" id="fileUpload1">
                <input type="file" name="foto" id="fileuploadInput" accept=".png, .jpg, .jpeg">
                <label for="fileuploadInput" style="background-color: white !important;">
                    <span>
                        <strong>
                            <ion-icon name="cloud-upload-outline" role="img" class="md text-primary"
                                aria-label="cloud upload outline"></ion-icon>
                            <i class="text-primary">Tap to Upload</i>
                            <br>
                            <small>Format foto harus berupa (.jpg, .png, .jpeg)</small> <br>
                        </strong>
                    </span>
                </label>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <button type="submit" class="shadow btn btn-primary btn-block">
                        <ion-icon name="refresh-outline"></ion-icon>
                        Update
                    </button>
                </div>
            </div>
        </div>
    </form>
    {{-- <div class="col" style="margin-bottom: 72px;">
        <a href="/proseslogout">
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <button type="submit" class="shadow btn btn-danger btn-block">
                        <ion-icon name="power"></ion-icon>
                        Logout
                    </button>
                </div>
            </div>
        </a>
    </div> --}}
@endsection
@push('myscript')
<script>
    $(document).ready(function() {
        // SWEETALERT
        $("#formedit").submit(function(e) {
            var alamat = $("#alamat").val();
            var no_hp = $("#no_hp").val();
            if (alamat == "") {
                Swal.fire({
                    title: 'Failed!',
                    text: 'Alamat tidak boleh kosong',
                    icon: 'error'
                });
                e.preventDefault();
            } else if (no_hp == "") {
                Swal.fire({
                    title: 'Failed!',
                    text: 'No.HP tidak boleh kosong',
                    icon: 'error'
                });
                e.preventDefault();
            }
        });

    });
</script>
@endpush
