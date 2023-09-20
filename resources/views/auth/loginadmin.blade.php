<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sign in with illustration - Tabler - Premium and Open Source dashboard template with responsive and high
        quality UI.</title>
    <script defer data-api="/stats/api/event" data-domain="preview.tabler.io" src="/stats/js/script.js"></script>
    <meta name="msapplication-TileColor" content="" />
    <meta name="theme-color" content="" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    <meta name="description"
        content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!" />
    <meta name="canonical" content="https://preview.tabler.io/sign-in-illustration.html">
    <meta name="twitter:image:src" content="https://preview.tabler.io/static/og.png">
    <meta name="twitter:site" content="@tabler_ui">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title"
        content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI.">
    <meta name="twitter:description"
        content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!">
    <meta property="og:image" content="https://preview.tabler.io/static/og.png">
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="640">
    <meta property="og:site_name" content="Tabler">
    <meta property="og:type" content="object">
    <meta property="og:title"
        content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI.">
    <meta property="og:url" content="https://preview.tabler.io/static/og.png">
    <meta property="og:description"
        content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!">
    <!-- CSS files -->
    <link href="{{ asset('tabler/dist/css/tabler.min.css?1685973381') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/dist/css/tabler-flags.min.css?1685973381') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/dist/css/tabler-payments.min.css?1685973381') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/dist/css/tabler-vendors.min.css?1685973381') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/dist/css/demo.min.css?1685973381') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" d-flex flex-column">
    <script src="{{ asset('tabler/dist/js/demo-theme.min.js?1685973381') }}"></script>
    <div class="page page-center" style="background-color: #ECF2F7">
        <div class="container container-normal py-4">
            <div class="row align-items-center">
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="text-center mb-4">
                            <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg"
                                    height="36" alt=""></a>
                        </div>
                        <div class="shadow card card-md" style="border-radius: 5% !important;">
                            <div class="card-body">
                                <h2 class="h1 text-center text-indigo">SISTEM INFORMASI PRESENSI SISWA SMK SASMITA JAYA 1 PAMULANG</h1>
                                    <h2 class="text-center mb-3">ADMINISTRATOR</h2>
                                    @if (Session::get('warning'))
                                        <div class="alert alert-important alert-danger alert-dismissible"
                                            role="alert">
                                            <div class="d-flex">
                                                <div>
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/alert-circle -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon"
                                                        width="24" height="24" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                        <path d="M12 8v4"></path>
                                                        <path d="M12 16h.01"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    {{ Session::get('warning') }}
                                                </div>
                                            </div>
                                            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                                        </div>
                                    @endif
                                    <form action="/prosesloginadmin" method="post" autocomplete="off" novalidate>
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Email address</label>
                                            <input name="email" type="email" class="form-control"
                                                placeholder="your@email.com" autocomplete="off">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label">
                                                Password
                                                {{-- <span class="form-label-description">
                                                <a href="./forgot-password.html">I forgot password</a>
                                            </span> --}}
                                            </label>
                                            <div class="input-group input-group-flat">
                                                <input name="password" type="password" class="form-control"
                                                    id="password" placeholder="Your password" autocomplete="off">
                                                <span class="input-group-text">
                                                    <a id="eyeicon" class="link-secondary" title="Show password"
                                                        data-bs-toggle="tooltip"
                                                        style="cursor: pointer"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                            <path
                                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                        </svg>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-check">
                                                <input type="checkbox" class="form-check-input" />
                                                <span class="form-check-label">Remember me on this device</span>
                                            </label>
                                        </div>
                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-indigo w-100 btn-pill">Log
                                                in</button>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="text-center mb-4">
                            <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg"
                                    height="36" alt=""></a>
                        </div>
                        <div class="shadow card card-md" style="border-radius: 5% !important;">
                            <div class="card-stamp">
                                <div class="card-stamp-icon bg-white text-primary">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                                </div>
                              </div>
                            <div class="card-body text-center">
                                <div class="section mb-2">
                                    <img src="{{ asset('assets/img/login/logo-smk.png') }}" height="72">
                                </div>
                                <div class="section">
                                    <h2 class="text-indigo" style="margin-bottom: 0!important">VISI, MISI, TUJUAN DAN
                                        STRATEGI​</h2>
                                    <h4>SMK SASMITA JAYA 1 PAMULANG TANGERANG SELATAN</h4>
                                </div>
                                <!-- Cards with tabs component -->
                                <div class="card bg-primary-lt">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs"
                                            role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a href="#tabs-visi-5" class="nav-link active" data-bs-toggle="tab"
                                                    aria-selected="true" role="tab" tabindex="-1">Visi</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="#tabs-misi-5" class="nav-link" data-bs-toggle="tab"
                                                    aria-selected="false" role="tab" tabindex="-1">Misi</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="#tabs-tujuan-5" class="nav-link" data-bs-toggle="tab"
                                                    aria-selected="false" role="tab">Tujuan</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="#tabs-strategi-5" class="nav-link" data-bs-toggle="tab"
                                                    aria-selected="false" role="tab">Strategi</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active show" id="tabs-visi-5" role="tabpanel">
                                                <h4>VISI</h4>
                                                <div>SMK Sasmita Jaya 1 mampu menghasilkan lulusan yang unggul dan
                                                    kompetitif di tingkat nasional, dilandasi nilai humanis dan religius
                                                    pada tahun 2027.</div>
                                            </div>
                                            <div class="tab-pane" id="tabs-misi-5" role="tabpanel">
                                                <h4>MISI</h4>
                                                <ol>
                                                    <li>
                                                        <p>Menyelenggarakan pembinaan kegiatan keagamaan, nasionalisme
                                                            dan pengembangan diri.</p>
                                                    </li>
                                                    <li>
                                                        <p>Menyelenggarakan pendidikan yang terjangkau dan diminati
                                                            semua lapisan masyarakat.</p>
                                                    </li>
                                                    <li>
                                                        <p>menyelenggarakan pembelajaran untuk memperoleh capaian
                                                            pembelajaran yang berkualitas.</p>
                                                    </li>
                                                    <li>
                                                        <p>Menyelenggarakan pendidikan vokasi sesuai dengan kebutuhan
                                                            dunia usaha, dunia industri dan dunia kerja.</p>
                                                    </li>
                                                </ol>
                                            </div>
                                            <div class="tab-pane" id="tabs-tujuan-5" role="tabpanel">
                                                <h4>TUJUAN</h4>
                                                <ol>
                                                    <li>
                                                        <p>Menghasilkan lulusan yang memiliki ahlak mulia, cinta tanah
                                                            air
                                                            dan memiliki keahlian.</p>
                                                    </li>
                                                    <li>
                                                        <p>Memberikan kesempatan kepada semua lapisan masyarakat untuk
                                                            mendapatkan pendidikan yang terjangkau.</p>
                                                    </li>
                                                    <li>
                                                        <p>Menghasilkan lulusan yang cerdas, memiliki wawasan nasional
                                                            dan
                                                            global.</p>
                                                    </li>
                                                    <li>
                                                        <p>Menghasilkan lulusan yang mampu bekerja, melanjutkan
                                                            pendidikan
                                                            dan wirausaha.</p>
                                                    </li>
                                                </ol>
                                            </div>
                                            <div class="tab-pane" id="tabs-strategi-5" role="tabpanel">
                                                <h4>STRATEGI</h4>
                                                <ol>
                                                    <li><p>Penegakan disiplin pada semua warga sekolah dan
                                                        <em>stakeholder</em>.</p></li>
                                                    <li><p>Memberikan kemudahan akses pendidikan.</p></li>
                                                    <li><p>Meningkatkan kualifikasi dan kompetensi pendidikan dan tenaga
                                                        pendidikan.</p></li>
                                                    <li><p>Menjalin kerjasama dengan dunia usaha, dunia industri dan dunia
                                                        kerja.</p></li>
                                                    <li><p>Menyediakan sarana dan prasarana pendidikan yang memadai.</p></li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg d-none d-lg-block">
                    <img src="{{ asset('tabler/static/illustrations/3d-student-graduation.png') }}" height="480"
                        class="d-block mx-auto" alt="">
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('tabler/dist/js/tabler.min.js?1685973381') }}" defer></script>
    <script src="{{ asset('tabler/dist/js/demo.min.js?1685973381') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#eyeicon").click(function() {
                var passwordField = $("#password");
                var passwordFieldType = passwordField.attr('type');
                if (passwordFieldType == 'password') {
                    passwordField.attr('type', 'text');
                    $(this).html(
                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"></path><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87"></path><path d="M3 3l18 18"></path></svg>'
                    );
                } else {
                    passwordField.attr('type', 'password');
                    $(this).html(
                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon"width="24" height="24" viewBox="0 0 24 24"stroke-width="2" stroke="currentColor" fill="none"stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>'
                    );
                }
            });
        });
    </script>
</body>

</html>
