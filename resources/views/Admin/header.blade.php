<!DOCTYPE html>
<html>
<head>
    <title>Rafy Backery</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-theme.css') }}">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<body>

    <nav class="navbar navbar-default" style="padding: 5px;">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-folder"></i> Data Master <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route("produk-index") }}">Master Produk</a></li>
                            <li><a href="{{ route("customer-index") }}">Master Customer</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-retweet"></i> Data Transaksi <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route("produksi-index") }}">Produksi</a></li>
                            <li><a href="">Inventory</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-chart-line"></i> Laporan <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="">Laporan Penjualan</a></li>
                            <li><a href="">Laporan Profit</a></li>
                            <!-- tambahkan rute lainnya sesuai kebutuhan -->
                        </ul>
                    </li>
                    <li><a href="{{ route("halaman-dashboard") }}">Dashboard</a></li>

                </ul>

                <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user" style="margin-right: 5px;"></i> Admin <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('logout-admin') }}">Log Out</a></li>
                    </ul>
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

