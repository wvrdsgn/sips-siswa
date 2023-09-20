@extends('layouts.admin.tabler')
@section('content')
    <style>
        #map {
            height: 300px;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
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
                                            Konfigurasi Lokasi Sekolah
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- CARD-BODY --}}
                        <div class="card-body">
                            <form id="form-update-lokasi" action="/konfigurasi/updatelokasisekolah" method="POST">
                                @csrf
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
                                <div class="row">
                                    <div class="col-lg-6">
                                        <fieldset class="form-fieldset">
                                            <label class="form-label">Lokasi Sekolah</label>
                                            <div class="mb-3">
                                                <div class="input-icon">
                                                    <input type="text" name="lokasi_sekolah"
                                                        class="form-control form-control-rounded" autocomplete="off"
                                                        placeholder="ex. -0.0000000000000000 , 000.00000000000000"
                                                        value="{{ $lok_sekolah->lokasi_sekolah }}">
                                                    <span class="input-icon-addon"><svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-map-pin-search"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M14.916 11.707a3 3 0 1 0 -2.916 2.293"></path>
                                                            <path
                                                                d="M11.991 21.485a1.994 1.994 0 0 1 -1.404 -.585l-4.244 -4.243a8 8 0 1 1 13.651 -5.351">
                                                            </path>
                                                            <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                                            <path d="M20.2 20.2l1.8 1.8"></path>
                                                        </svg></span>
                                                </div>
                                                <small class="form-hint">Pastikan untuk tidak menambahkan spasi di antara
                                                    koma saat memasukkan lokasi sekolah.</small>
                                            </div>
                                            <label class="form-label">Radius</label>
                                            <div class="mb-3 input-group">
                                                <input type="number" name="radius"
                                                    class="form-control form-control-rounded" placeholder=""
                                                    autocomplete="off" value="{{ $lok_sekolah->radius }}">
                                                <span class="input-group-text">
                                                    meter
                                                </span>
                                            </div>
                                            <div class="my-4">
                                                <button class="btn btn-pill btn-indigo w-100" id="update-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-reload" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path
                                                            d="M19.933 13.041a8 8 0 1 1 -9.925 -8.788c3.899 -1 7.935 1.007 9.425 4.747">
                                                        </path>
                                                        <path d="M20 4v5h-5"></path>
                                                    </svg>Update
                                                </button>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6">
                                        <div id="map" style="border-radius: 10px"></div>
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
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script>
            $(function() {
                // Tambahkan kode JavaScript untuk memvalidasi input sebelum mengirimkan formulir
                document.getElementById("update-btn").addEventListener("click", function(e) {
                    e.preventDefault();
                    // Dapatkan nilai dari input Lokasi Sekolah dan Radius
                    var lokasiSekolah = document.querySelector('input[name="lokasi_sekolah"]').value.trim();
                    var radius = document.querySelector('input[name="radius"]').value.trim();

                    // Periksa apakah salah satu atau kedua input kosong
                    if (lokasiSekolah === "" || radius === "") {
                        // Tampilkan Sweet Alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Data tidak boleh kosong. Silakan isi Lokasi Sekolah dan Radius terlebih dahulu.'
                        });
                    } else {
                        // Jika semua input valid, kirim formulir
                        document.getElementById("form-update-lokasi").submit();
                    }
                });
            });
        </script>
        <script>
            var lokasi = "{{ $lok_sekolah->lokasi_sekolah }}";
            var lok = lokasi.split(",");
            var latitude = lok[0];
            var longitude = lok[1];
            var map = L.map('map').setView([latitude, longitude], 18);
            googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map);
            var circle = L.circle([latitude, longitude], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: "{{ $lok_sekolah->radius }}"
            }).addTo(map);
        </script>
    @endpush
