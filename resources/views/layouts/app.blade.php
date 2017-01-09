<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">
    <title>Dashboard | SIMPD Site</title>
    <link rel="apple-touch-icon" href="/assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="/assets/images/favicon.ico">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="/global/css/bootstrap.min.css">
    <link rel="stylesheet" href="/global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="/assets/css/site.min.css">
    <!-- Plugins -->
    <link rel="stylesheet" href="/global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="/global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="/global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="/global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="/global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="/global/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="/global/vendor/select2/select2.min.css">
    <link rel='stylesheet' href="/global/vendor/jquery-wizard/jquery-wizard.min.css">
    <link rel="stylesheet" href="/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
    <!-- Fonts -->
    <link rel="stylesheet" href="/global/fonts/web-icons/web-icons.min.css">
    <link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    <link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css" integrity="sha384-dNpIIXE8U05kAbPhy3G1cz+yZmTzA6CY8Vg/u2L9xRnHjJiAK76m2BIEaSEV+/aU" crossorigin="anonymous">
    <link rel="stylesheet" href="/global/vendor/datatables-bootstrap/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="/global/vendor/datatables-responsive/dataTables.responsive.css">
    <link rel="stylesheet" href="/global/vendor/datatables-tabletools/datatables-tabletools.min.css">
    <link rel="stylesheet" href="/global/vendor/notie/notie.min.css">
    <link rel="stylesheet" href="/global/vendor/slidepanel/slidePanel.css">
    <link rel="/global/vendor/asscrollbar/jquery-asScrollbar.min.js">
    <link rel="stylesheet" href="/global/vendor/asscrollable/asScrollable.min.css">
    @yield('head')
    <!--[if lt IE 9]>
    <script src="/global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
    <!--[if lt IE 10]>
    <script src="/global/vendor/media-match/media.match.min.js"></script>
    <script src="/global/vendor/respond/respond.min.js"></script>
    <![endif]-->
    <!-- Scripts -->
    <script src="/global/vendor/breakpoints/breakpoints.js"></script>
    <script>
        Breakpoints();
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="animsition">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
                data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
                data-toggle="collapse">
            <i class="icon wb-more-horizontal" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle">
            <img class="navbar-brand-logo" src="/assets/images/logo.png" title="Remark">
            <span class="navbar-brand-text hidden-xs-down"> SIMPD</span>
        </div>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
                data-toggle="collapse">
            <span class="sr-only">Toggle Search</span>
            <i class="icon wb-search" aria-hidden="true"></i>
        </button>
    </div>
    <div class="navbar-container container-fluid">
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">
                <li class="nav-item hidden-float" id="toggleMenubar">
                    <a class="nav-link" data-toggle="menubar" href="#" role="button">
                        <i class="icon hamburger hamburger-arrow-left">
                            <span class="sr-only">Toggle menubar</span>
                            <span class="hamburger-bar"></span>
                        </i>
                    </a>
                </li>
            </ul>
            <!-- End Navbar Toolbar -->
            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li class="nav-item dropdown ">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" data-animation="scale-up" aria-expanded="true" role="button">
                        <span><strong>Tahun Anggaran: </strong>2016</span>
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <div class="dropdown-menu-header">
                            <h5 class="p-l-20">TAHUN ANGGARAN</h5>
                        </div>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                            2017</a>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                            <i class="fa fa-plus"></i> Buat Tahun Anggaran Baru</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu" data-plugin="menu">
                    <li class="site-menu-category">General</li>
                    <li class="site-menu-item">
                        <a href="/">
                            <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                            <span class="site-menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="site-menu-category">Master</li>
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-briefcase" aria-hidden="true"></i>
                            <span class="site-menu-title">DPPA</span>
                            <span class="site-menu-arrow"></span>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="/dppa/">
                                        <span class="site-menu-title">DPPA</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="/dppa/import">
                                        <span class="site-menu-title">Impor DPPA</span>
                                    </a>
                                </li>
                            </ul>
                        </a>
                    </li>
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-users" aria-hidden="true"></i>
                            <span class="site-menu-title">Pegawai</span>
                            <span class="site-menu-arrow"></span>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{route('pegawai.index')}}">
                                        <span class="site-menu-title">Pegawai</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="/pegawai/create">
                                        <span class="site-menu-title">Tambah Pegawai</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="/pegawai/import">
                                        <span class="site-menu-title">Impor Pegawai</span>
                                    </a>
                                </li>
                            </ul>
                        </a>
                    </li>
                    <li class="site-menu-category">Transaksi</li>
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-book" aria-hidden="true"></i>
                            <span class="site-menu-title">UMK</span>
                            <span class="site-menu-arrow"></span>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{route('umk.index')}}">
                                        <span class="site-menu-title">UMK</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{route('umk.create')}}">
                                        <span class="site-menu-title">Tambah UMK</span>
                                    </a>
                                </li>
                            </ul>
                        </a>

                    </li>
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-map" aria-hidden="true"></i>
                            <span class="site-menu-title">Perjalanan Dinas</span>
                            <span class="site-menu-arrow"></span>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{route('perjalanandinas.index')}}">
                                        <span class="site-menu-title">Perjalanan Dinas</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{route('perjalanandinas.create')}}">
                                        <span class="site-menu-title">Tambah Perjalanan Dinas</span>
                                    </a>
                                </li>
                                <li class="site-menu-item has-sub">
                                    <a href="javascript:void(0)">
                                        <span class="site-menu-title">Hasil Perjalanan Dinas</span>
                                        <span class="site-menu-arrow"></span>
                                    </a>
                                    <ul class="site-menu-sub">
                                        <li class="site-menu-item is-shown">
                                            <a class="animsition-link" href="{{route('hasilperjalanandinas.index' )}}">
                                                <span class="site-menu-title">Hasil Perjalanan Dinas</span>
                                            </a>
                                        </li>
                                        <li class="site-menu-item is-shown">
                                            <a class="animsition-link" href="{{route('hasilperjalanandinas.create')}}">
                                                <span class="site-menu-title">Tambah Hasil Perjalanan Dinas</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </a>
                    </li>
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-envelope-open" aria-hidden="true"></i>
                            <span class="site-menu-title">Pembayaran</span>
                            <span class="site-menu-arrow"></span>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{route('pembayaran.index')}}">
                                        <span class="site-menu-title">Pembayaran</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{route('pembayaran.create')}}">
                                        <span class="site-menu-title">Tambah Pembayaran</span>
                                    </a>
                                </li>
                            </ul>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page -->
<div class="page">
    <div class="page-content">
        @yield('content')
    </div>
</div>
<!-- End Page -->
<!-- Footer -->
<footer class="site-footer">
    <div class="site-footer-legal">© 2016 <a href="http://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202">SIMPD</a></div>
    <div class="site-footer-right">
        Crafted with <i class="red-600 wb wb-heart"></i> by <a href="http://Imam.tech">Imam Assidiqqi</a>
    </div>
</footer>
@include('footer')
</body>
</html>