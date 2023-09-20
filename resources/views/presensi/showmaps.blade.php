<style>
    #map {
        height: 180px;
    }
</style>

<div id="map"></div>
<script>
    var lokasi_in = "{{ $lokasi_in }}";
    var lokasi_sekolah = "{{ $lok_sekolah }}";
    if (lokasi_in) {
        var lok = lokasi_in.split(",");
        var latitude = parseFloat(lok[0]);
        var longitude = parseFloat(lok[1]);
        var loksekolah = lokasi_sekolah.split(",");
        var latitudes = parseFloat(loksekolah[0]);
        var longitudes = parseFloat(loksekolah[1]);
        var map = L.map('map').setView([latitude, longitude], 17);
        googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
}).addTo(map);
        var marker = L.marker([latitude, longitude]).addTo(map);
        var circle = L.circle([latitudes,longitudes], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: {{$rad_sekolah}}
        }).addTo(map);
        var popup = L.popup()
            .setLatLng([latitude,longitude])
            .setContent("{{ $presensi->nama_lengkap }} telah melakukan absen di lokasi ini.")
            .openOn(map);
    } else {
        document.getElementById('map').innerHTML = "<div class='alert alert-warning'>Lokasi presensi tidak tersedia.</div>";
    }
</script>
