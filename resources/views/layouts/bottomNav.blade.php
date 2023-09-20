<div class="appBottomMenu">
    <a href="/dashboard" class="item {{ request()->is('dashboard') ? 'active' : '' }}">
        <div class="col">
            @if (request()->is('dashboard'))
                <ion-icon name="home"></ion-icon>
            @else
                <ion-icon name="home-outline"></ion-icon>
            @endif
            <strong>Beranda</strong>
        </div>
    </a>

    <a href="/presensi/histori" class="item {{ request()->is('presensi/histori') ? 'active' : '' }}">
        <div class="col">
            @if(request()->is('presensi/histori'))
                <ion-icon name="calendar" role="img" class="md hydrated" aria-label="calendar"></ion-icon>
            @else
                <ion-icon name="calendar-outline" role="img" class="md hydrated" aria-label="calendar outline"></ion-icon>
            @endif
            <strong>Riwayat</strong>
        </div>
    </a>

    <a href="/presensi/create" class="item">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="camera" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </div>
        </div>
    </a>

    <a href="/presensi/izin" class="item {{ request()->is('presensi/izin') ? 'active' : '' }}">
        <div class="col">
            @if(request()->is('presensi/izin'))
                <ion-icon name="document" role="img" class="md hydrated" aria-label="document"></ion-icon>
            @else
                <ion-icon name="document-outline" role="img" class="md hydrated" aria-label="document outline"></ion-icon>
            @endif
            <strong>Data Izin</strong>
        </div>
    </a>

    <a href="/editprofile" class="item {{ request()->is('editprofile') ? 'active' : '' }}">
        <div class="col">
            @if(request()->is('editprofile'))
                <ion-icon name="people" role="img" class="md hydrated" aria-label="people"></ion-icon>
            @else
                <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            @endif
            <strong>Profil</strong>
        </div>
    </a>

</div>
