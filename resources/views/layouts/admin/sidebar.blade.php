<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand">
            <a href=".">
                <img src="{{ asset('assets/img/logo-smk-landscape.png') }}" width="110" height="32" alt="Tabler"
                    class="navbar-brand-image">
            </a>
        </h1>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item {{ request()->is(['panel/dashboardadmin']) ? 'active' : '' }}">
                    <a class="nav-link" href="/panel/dashboardadmin">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title ">
                            Beranda
                        </span>
                    </a>
                </li>
                {{-- DROPDOWN-MENU(REVISI) --}}
                {{-- @if (auth()->user()->role_id == '1')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is(['siswa', 'kelas']) ? 'show' : '' }}"
                            href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                            aria-expanded="{{ request()->is(['siswa', 'kelas']) ? 'true' : 'false' }}">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                    <path d="M12 12l8 -4.5" />
                                    <path d="M12 12l0 9" />
                                    <path d="M12 12l-8 -4.5" />
                                    <path d="M16 5.25l-8 4.5" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Data Master
                            </span>
                        </a>
                        <div class="dropdown-menu {{ request()->is(['siswa', 'kelas']) ? 'show' : '' }}">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item {{ request()->is(['kelas']) ? 'active' : '' }}"
                                        href="/kelas">
                                        Kelas
                                    </a>
                                    <a class="dropdown-item {{ request()->is(['siswa']) ? 'active' : '' }}"
                                        href="/siswa">
                                        Siswa
                                    </a>
                                    <a class="dropdown-item" href="/users">
                                        Users
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                @endif --}}
                @if (auth()->user()->role_id == '1')
                    <li class="nav-item {{ request()->is(['kelas']) ? 'active' : '' }}">
                        <a class="nav-link" href="/kelas">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-door" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 12v.01"></path>
                                    <path d="M3 21h18"></path>
                                    <path d="M6 21v-16a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v16"></path>
                                 </svg>
                            </span>
                            <span class="nav-link-title">
                                Data Kelas
                            </span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is(['siswa']) ? 'active' : '' }}">
                        <a class="nav-link" href="/siswa">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-school" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6"></path>
                                    <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4"></path>
                                 </svg>
                            </span>
                            <span class="nav-link-title">
                                Data Siswa
                            </span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is(['users']) ? 'active' : '' }}">
                        <a class="nav-link" href="/users">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                 </svg>
                            </span>
                            <span class="nav-link-title">
                                Data Users
                            </span>
                        </a>
                    </li>
                @endif
                <li class="nav-item {{ request()->is(['presensi/editpresensi']) ? 'active' : '' }}">
                    <a class="nav-link" href="/presensi/editpresensi">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                </path>
                                <path d="M16 5l3 3"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Edit Presensi
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is(['presensi/monitoring']) ? 'active' : '' }}">
                    <a class="nav-link" href="/presensi/monitoring">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z">
                                </path>
                                <path d="M7 20h10"></path>
                                <path d="M9 16v4"></path>
                                <path d="M15 16v4"></path>
                                <path d="M9 12v-4"></path>
                                <path d="M12 12v-1"></path>
                                <path d="M15 12v-2"></path>
                                <path d="M12 12v-1"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Monitoring Presensi
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is(['presensi/izinsakit']) ? 'active' : '' }}">
                    <a class="nav-link" href="/presensi/izinsakit">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-clipboard-check" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2">
                                </path>
                                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                </path>
                                <path d="M9 14l2 2l4 -4"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Persetujuan Izin/Sakit
                        </span>
                    </a>
                </li>
                @if (auth()->user()->role_id == '1')
                <li class="nav-item {{ request()->is(['konfigurasi/lokasisekolah']) ? 'active' : '' }}">
                    <a class="nav-link" href="/konfigurasi/lokasisekolah">
                        <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                                    </path>
                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                </svg>
                            </span>
                        <span class="nav-link-title">
                            Lokasi Sekolah
                        </span>
                    </a>
                </li>
                @endif
                <li class="nav-item {{ request()->is(['presensi/laporan']) ? 'active' : '' }}">
                    <a class="nav-link" href="/presensi/laporan">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-file-description" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                </path>
                                <path d="M9 17h6"></path>
                                <path d="M9 13h6"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Laporan Presensi
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is(['proseslogoutadmin']) ? 'active' : '' }}">
                    <a class="nav-link" href="/proseslogoutadmin">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-power"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 6a7.75 7.75 0 1 0 10 0"></path>
                                <path d="M12 4l0 8"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Logout
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
