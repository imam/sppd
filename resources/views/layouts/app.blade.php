@inject('request','Illuminate\Http\Request')
@php
    $sidebar_open = $request->session()->get('sidebar_open');
    $sidebar_class = $sidebar_open?'site-menubar-unfold':'site-menubar-fold-alt site-menubar-keep site-menubar-fold';
@endphp
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">
    <title>SIMPD</title>
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
    <link rel="stylesheet" href="/global/vendor/summernote/summernote.css">
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
    <style>
        .site-menubar-body.scrollable.scrollable-inverse.is-enabled.scrollable-vertical.hoverscorll-disabled{
            min-height: 100%;
        }
    </style>
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
<body class="animsition {{$sidebar_class}}">
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
                    <a class="nav-link" data-toggle="menubar" onclick="toggleFooter()" href="#" role="button">
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
                        <span><strong>Profile</strong></span>
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="/profile" role="menuitem">
                            Profile</a>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout').submit();" role="menuitem">
                             Logout</a>
                        <form action="/logout" id="logout" method="post" style="display:none">{{csrf_field()}}</form>
                    </div>
                </li>
            </ul>
            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li class="nav-item dropdown ">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" data-animation="scale-up" aria-expanded="true" role="button">
                        <span><strong>Tahun Anggaran: </strong>{{Auth::user()->tahun_anggaran}}</span>
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <div class="dropdown-menu-header">
                            <h5 class="p-l-20">TAHUN ANGGARAN</h5>
                        </div>
                        @php
                            $tahunanggaran = App\TahunAnggaran::all();
                        @endphp
                        @foreach($tahunanggaran as $t)
                            <a class="dropdown-item @if($t->tahun == Auth::user()->tahun_anggaran) active @endif"
                               href="/ganti_tahun_anggaran?tahun={{$t->tahun}}" role="menuitem">
                                {{$t->tahun}}</a>
                        @endforeach
                        @if(\Entrust::can('create-data'))
                            <a class="dropdown-item" data-toggle="modal" data-target="#tahun_anggaran" href="#" role="menuitem">
                                <i class="fa fa-plus"></i> Buat Tahun Anggaran Baru</a>
                        @endif
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
                    <li class="site-menu-item {{active(['/'],'active open')}}">
                        <a href="/">
                            <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                            <span class="site-menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{active(['profile'],'active open')}}">
                        <a href="/profile">
                            <i class="site-menu-icon wb-user" aria-hidden="true"></i>
                            <span class="site-menu-title">Profile</span>
                        </a>
                    </li>
                    <li class="site-menu-category">Master</li>
                    <li class="site-menu-item has-sub {{active(['pegawai','pegawai/*'],'active open')}}">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-users" aria-hidden="true"></i>
                            <span class="site-menu-title">Pegawai</span>
                            <span class="site-menu-arrow"></span>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item {{active(['pegawai'],'active open')}}">
                                    <a class="animsition-link" href="{{route('pegawai.index')}}">
                                        <span class="site-menu-title">Pegawai</span>
                                    </a>
                                </li>
                                @if(\Entrust::hasRole(['admin','supervisor']))
                                    <li class="site-menu-item {{active(['pegawai/create'],'active open')}}">
                                        <a class="animsition-link" href="/pegawai/create">
                                            <span class="site-menu-title">Tambah Pegawai</span>
                                        </a>
                                    </li>
                                    @if(\Entrust::hasRole('admin'))
                                        <li class="site-menu-item {{active(['pegawai/import'],'active open')}}">
                                            <a class="animsition-link" href="/pegawai/import">
                                                <span class="site-menu-title">Impor Pegawai</span>
                                            </a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </a>
                    </li>
                    <li class="site-menu-item has-sub {{active(['dppa','dppa/*'],'active open')}}">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-briefcase" aria-hidden="true"></i>
                            <span class="site-menu-title">DPPA</span>
                            <span class="site-menu-arrow"></span>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item {{active(['dppa'])}}">
                                    <a class="animsition-link" href="/dppa/">
                                        <span class="site-menu-title">DPPA</span>
                                    </a>
                                </li>
                                @if(\Entrust::hasRole('admin'))
                                    <li class="site-menu-item {{active(['dppa/import'])}}">
                                        <a class="animsition-link" href="/dppa/import">
                                            <span class="site-menu-title">Impor DPPA</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </a>
                    </li>
                    <li class="site-menu-category">Transaksi</li>
                    <li class="site-menu-item has-sub {{active(['umk','umk/*'],'active open')}}">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-book" aria-hidden="true"></i>
                            <span class="site-menu-title">UMK</span>
                            <span class="site-menu-arrow"></span>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item {{active(['umk'])}}">
                                    <a class="animsition-link" href="{{route('umk.index')}}">
                                        <span class="site-menu-title">UMK</span>
                                    </a>
                                </li>
                                <li class="site-menu-item {{active(['umk/create'])}}">
                                    <a class="animsition-link" href="{{route('umk.create')}}">
                                        <span class="site-menu-title">Tambah UMK</span>
                                    </a>
                                </li>
                            </ul>
                        </a>
                    </li>
                    <li class="site-menu-item has-sub {{active(['perjalanandinas','perjalanandinas/*','transaksiperjalanandinas','transaksiperjalanandinas/*'],'active open')}}">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-map" aria-hidden="true"></i>
                            <span class="site-menu-title">Perjalanan Dinas</span>
                            <span class="site-menu-arrow"></span>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item {{active(['perjalanandinas'])}}">
                                    <a class="animsition-link" href="{{route('perjalanandinas.index')}}">
                                        <span class="site-menu-title">Perjalanan Dinas</span>
                                    </a>
                                </li>
                                <li class="site-menu-item {{active(['perjalanandinas/create'])}}">
                                    <a class="animsition-link" href="{{route('perjalanandinas.create')}}">
                                        <span class="site-menu-title">Tambah Perjalanan Dinas</span>
                                    </a>
                                </li>
                                <li class="site-menu-item has-sub {{active(['transaksiperjalanandinas','transaksiperjalanandinas/*'],'active open')}}">
                                    <a href="javascript:void(0)" class="">
                                        <span class="site-menu-title">Transaksi Perjalanan Dinas</span>
                                        <span class="site-menu-arrow"></span>
                                    </a>
                                    <ul class="site-menu-sub">
                                        <li class="site-menu-item is-shown {{active(['transaksiperjalanandinas'],'active open')}}">
                                            <a class="animsition-link " href="{{route('transaksiperjalanandinas.index' )}}">
                                                <span class="site-menu-title">Transaksi Perjalanan Dinas</span>
                                            </a>
                                        </li>
                                        <li class="site-menu-item is-shown {{active(['transaksiperjalanandinas/create'],'active open')}}">
                                            <a class="animsition-link " href="{{route('transaksiperjalanandinas.create')}}">
                                                <span class="site-menu-title">Tambah Transaksi Perjalanan Dinas</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </a>
                    </li>
                    <li class="site-menu-item has-sub {{active(['hasilperjalanandinas','hasilperjalanandinas/*'],'active open')}}">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-check" aria-hidden="true"></i>
                            <span class="site-menu-title">Hasil Perjalanan Dinas</span>
                            <span class="site-menu-arrow"></span>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item {{active(['hasilperjalanandinas'],'active open')}}">
                                    <a class="animsition-link" href="{{route('hasilperjalanandinas.index')}}">
                                        <span class="site-menu-title">Hasil Perjalanan Dinas</span>
                                    </a>
                                </li>
                                <li class="site-menu-item {{active(['hasilperjalanandinas/create'],'active open')}}">
                                    <a class="animsition-link" href="{{route('hasilperjalanandinas.create')}}">
                                        <span class="site-menu-title">Tambah Hasil Perjalanan Dinas</span>
                                    </a>
                                </li>
                            </ul>
                        </a>
                    </li>
                    <li class="site-menu-item has-sub {{active(['pembayaran','pembayaran/*'],'active open')}}">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-payment" aria-hidden="true"></i>
                            <span class="site-menu-title">Pembayaran</span>
                            <span class="site-menu-arrow"></span>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item {{active(['pembayaran'],'active open')}}">
                                    <a class="animsition-link" href="{{route('pembayaran.index')}}">
                                        <span class="site-menu-title">Pembayaran</span>
                                    </a>
                                </li>
                                <li class="site-menu-item {{active(['pembayaran/create'],'active open')}}">
                                    <a class="animsition-link" href="{{route('pembayaran.create')}}">
                                        <span class="site-menu-title">Tambah Pembayaran</span>
                                    </a>
                                </li>
                            </ul>
                        </a>
                    </li>
                    <li class="site-menu-category">Bug</li>
                    <li class="site-menu-item {{active(['bug'])}}">
                        <a href="/bug">
                            <i class="site-menu-icon wb-warning" aria-hidden="true"></i>
                            <span class="site-menu-title">Bug Reporting</span>
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
    <div class="site-footer-legal">© {{\Carbon\Carbon::now()->year}} SIMPD</div>
    <div class="site-footer-right">
        Crafted with <i class="red-600 wb wb-heart"></i> by <a href="http://Imam.tech">Imam Assidiqqi</a>
    </div>
</footer>
<!-- Modal -->
            <div class="modal fade" id="tahun_anggaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalTitle">Buat Tahun Anggaran</h4>
                        </div>
                        <div class="modal-body">
                            <form action="buattahunanggaran" id="tahun_anggaran_form" method="post">
                                {{csrf_field()}}
                                <input type="text" placeholder="Tahun" name="tahun" class="form-control">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" form="tahun_anggaran_form" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
@include('footer')
<script>
    $('#tahun_anggaran input[type=text]').datepicker({
        minViewMode: 2,
        maxViewMode: 2,
        format: 'yyyy',
        startDate: "1997",
        endDate: "2200",
    });
</script>
</body>
</html>
