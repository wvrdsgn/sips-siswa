@extends('layouts.presensi')
@section('header')
    {{-- CSS Form Izin --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <style>
        .datepicker-modal {
            max-height: 463px !important;
        }

        .datepicker-date-display {
            background-color: #1e74fd !important;
        }

        .datepicker-table td.is-selected {
            background-color: #1e74fd !important;
        }

        .datepicker-table td.is-today {
            color: #1e74fd !important;
            font-weight: bolder !important;
        }

        .datepicker-cancel,
        .datepicker-clear,
        .datepicker-today,
        .datepicker-done {
            color: #1e74fd !important;
            padding: 0 1rem;
        }
    </style>
    <!-- App Header -->
    <div class="appHeader bg-dark text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Form Permohonan Izin</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@section('content')
    <div class="row" style="margin-top: 72px;">
        <div class="col">
            <form method="POST" action="/presensi/storeizin" id="formizin" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="row mx-1">
                    <div class="col form-group">
                        <input type="text" class="form-control datepicker" placeholder="Pilih Tanggal Izin"
                            id="tgl_izin" name="tgl_izin">
                    </div>
                </div>
                <div class="col form-group">
                    <p for="status">Pilih Status Izin</p>
                    <select name="status" id="status" class="form-control">
                        <option value="">Izin / Sakit</option>
                        <option value="I">Izin</option>
                        <option value="S">Sakit</option>
                    </select>
                </div>
                <div class="col">
                    <div class="custom-file-upload my-2" id="fileUpload1">
                        <input type="file" name="keterangan" id="fileuploadInput" accept=".png, .jpg, .jpeg, .pdf">
                        <label for="fileuploadInput" style="background-color: white !important;">
                            <span>
                                <strong>
                                    <small>Upload file surat izin Anda di sini</small> <br>
                                    <ion-icon name="cloud-upload-outline" role="img" class="md text-primary mt-2"
                                        aria-label="cloud upload outline"></ion-icon>
                                    <i class="text-primary">Tap to Upload</i>
                                    <br>
                                    <small>Format file surat izin harus berupa (.pdf, .jpg, .png)</small>
                                </strong>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col my-2">
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <button type="submit" class="shadow btn btn-primary btn-block">
                                <ion-icon name="share-outline"></ion-icon>
                                Submit
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('myscript')
<script>
    var currYear = (new Date()).getFullYear();
    $(document).ready(function() {
        $(".datepicker").datepicker({
            format: "yyyy-mm-dd"
        });

        // VALIDASI TANGGAL IZIN
        $("#tgl_izin").change(function(e) {
            var tgl_izin = $(this).val();
            $.ajax({
                type: 'POST',
                url: '/presensi/cekpengajuanizin',
                data: {
                    _token: "{{ csrf_token() }}",
                    tgl_izin: tgl_izin
                },
                cache: false,
                success: function(respond) {
                    if (respond == 1) {
                        Swal.fire({
                            title: 'Failed!',
                            text: 'Anda sudah mengajukan izin pada tanggal yang sama',
                            icon: 'error'
                        }).then((result) => {
                            $("#tgl_izin").val("");
                        });
                    }
                }
            });
        });

        // SWEETALERT
        $("#formizin").submit(function(e) {
            var tgl_izin = $("#tgl_izin").val();
            var status = $("#status").val();
            var fileuploadInput = $("#fileuploadInput").val();
            if (tgl_izin == "") {
                Swal.fire({
                    title: 'Failed!',
                    text: 'Tanggal tidak boleh kosong',
                    icon: 'error'
                });
                e.preventDefault();
            } else if (status == "") {
                Swal.fire({
                    title: 'Failed!',
                    text: 'Status izin tidak boleh kosong',
                    icon: 'error'
                });
                e.preventDefault();
            } else if (fileuploadInput == "") {
                Swal.fire({
                    title: 'Failed!',
                    text: 'File tidak boleh kosong',
                    icon: 'error'
                });
                e.preventDefault();
            }
        });

    });
</script>
@endpush
