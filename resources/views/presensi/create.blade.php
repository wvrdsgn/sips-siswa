@extends('layouts.presensi')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Presensi</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
    <style>
        .webcam-capture,
        .webcam-capture video {
            display: inline-block;
            width: 100% !important;
            height: auto !important;
            margin: auto;
            border-radius: 20px;
        }

        #map {
            height: 180px;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endsection
@section('content')
    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="row" style="margin-top: 72px">
            <div class="col-11 col-lg-8 mx-auto">
                <input type="hidden" name="" id="lokasi">
                <div class="webcam-capture my-2"></div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-11 col-lg-8 mx-auto">
            <div id="map" class="shadow " style="border-radius: 20px;"></div>
        </div>
    </div>
    <div class="row" style="margin-bottom: 90px">
        <div class="col-11 col-lg-6 mx-auto my-2">
            @if ($cek > 0)
                <button id="takeabsen" class="btn btn-lg btn-block gradasiyellow" style="border-radius: 20px">
                    <ion-icon name="camera"></ion-icon>
                    Absen Pulang
                </button>
            @else
                <button id="takeabsen" class="btn btn-lg btn-block gradasiblue" style="border-radius: 20px">
                    <ion-icon name="camera"></ion-icon>
                    Absen Masuk
                </button>
            @endif
        </div>
    </div>
    <!-- * App Capsule -->
@endsection

@push('myscript')
    <script>
        Webcam.set({
            height: 480,
            width: 640,
            image_format: 'jpeg',
            jpeg_quality: 80,
            flip_horiz:true
        });

        Webcam.attach('.webcam-capture');

        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }

        //Ganti Mode GMAPS search: https://gis.stackexchange.com/questions/225098/using-google-maps-static-tiles-with-leaflet
        function successCallback(position) {
            lokasi.value = position.coords.latitude + "," + position.coords.longitude;
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 17);
            //Inisialisasi variable lokasi sekolah dinamis
            var lokasi_sekolah = "{{ $lok_sekolah->lokasi_sekolah }}";
            var lok = lokasi_sekolah.split(",");
            var lat_sekolah = lok[0];
            var long_sekolah = lok[1];
            var radius = "{{ $lok_sekolah->radius }}";
            googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                attribution: 'ThanksToGoogleMap'
            }).addTo(map);
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
            var circle = L.circle([lat_sekolah, long_sekolah], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: radius
            }).addTo(map);
        }

        function errorCallback() {

        }

        $("#takeabsen").click(function(e) {
            Webcam.snap(function(uri) {
                image = uri;
            });

            var lokasi = $("#lokasi").val();
            //Proses penyimpanan menggunakan ajax
            $.ajax({
                type: 'POST',
                url: '/presensi/store',
                data: {
                    _token: "{{ csrf_token() }}",
                    image: image,
                    lokasi: lokasi
                },
                cache: false,
                success: function(respond) {
                    var status =respond.split("|");
                    if (status[0] == "success") {
                        Swal.fire({
                            title: 'Success!',
                            text: status[1],
                            icon: 'success'
                        })
                        setTimeout("location.href='/dashboard'", 2000);
                    } else {
                        Swal.fire({
                            title: 'Failed!',
                            text: status[1], //agar pesan error dinamis
                            icon: 'error'
                        })
                    }

                }
            });
        });
    </script>
@endpush
