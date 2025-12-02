<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="{{ asset('assets/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/light-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/header-colors.css') }}" rel="stylesheet" />

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body class="d-flex flex-column min-vh-100">


    <!--start wrapper-->
    <!--start top header-->
    <div class="wrapper flex-fill d-flex flex-column">

        <header class="top-header">
            <nav class="navbar navbar-expand gap-3">
                <div class="mobile-toggle-icon fs-3 d-flex d-lg-none">
                    <i class="bi bi-list"></i>
                </div>
                <form class="searchbar">
                    <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><i
                            class="bi bi-search"></i></div>
                    <input class="form-control" type="text" placeholder="Type here to search">
                    <div class="position-absolute top-50 translate-middle-y search-close-icon"><i
                            class="bi bi-x-lg"></i></div>
                </form>
                <div class="top-navbar-right ms-auto">
                    <ul class="navbar-nav align-items-center gap-1">
                        <li class="nav-item search-toggle-icon d-flex d-lg-none">
                            <a class="nav-link" href="javascript:;">
                                <div class="">
                                    <i class="bi bi-search"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item dark-mode d-none d-sm-flex">
                            <a class="nav-link dark-mode-icon" href="javascript:;">
                                <div class="">
                                    <i class="bi bi-moon-fill"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="dropdown dropdown-user-setting">
                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                        <div class="user-setting d-flex align-items-center gap-3">
                            <img src="{{ asset('assets/images/avatars/avatar-1.png') }}" class="user-img"
                                alt="">
                            <div class="d-none d-sm-block">
                                @auth
                                    <p class="user-name mb-0">{{ Auth::user()->name }}</p>
                                    <small class="mb-0 dropdown-user-designation">
                                        {{ Auth::user()->getRoleNames()->first() ?? 'User' }}
                                    </small>
                                @else
                                    <p class="user-name mb-0">Guest</p>
                                    <small class="mb-0 dropdown-user-designation">Not Logged In</small>
                                @endauth
                            </div>


                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center">
                                    <div><i class="bi bi-lock-fill"></i></div>
                                    <div class="ms-3"><span>Logout</span></div>
                                </button>
                            </form>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!--end top header-->

        <!--start sidebar -->
        <aside class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
                </div>
                <div>
                    <h4 class="logo-text">Inventory</h4>
                </div>
                <div class="toggle-icon ms-auto"><i class="bi bi-list"></i>
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li class="{{ Request::is('/') || Request::is('home') ? 'mm-active' : '' }}">
                    <a href="{{ route('home') }}">
                        <div class="parent-icon"><i class="bi bi-house-fill"></i></div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>


                @can('view-barang')
                    <li class="{{ Request::is('barangs*') ? 'mm-active' : '' }}">
                        <a href="{{ route('barangs.index') }}">
                            <div class="parent-icon"><i class="bi bi-box-seam-fill"></i></div>
                            <div class="menu-title">Barang</div>
                        </a>
                    </li>
                @endcan

                @can('view-kategori')
                    <li class="{{ Request::is('kategoris*') ? 'mm-active' : '' }}">
                        <a href="{{ route('kategoris.index') }}">
                            <div class="parent-icon"><i class="bi bi-bookmarks-fill"></i></div>
                            <div class="menu-title">Kategori</div>
                        </a>
                    </li>
                @endcan

                @can('view-peminjaman')
                    <li class="{{ Request::is('peminjamans*') ? 'mm-active' : '' }}">
                        <a href="{{ route('peminjamans.index') }}">
                            <div class="parent-icon"><i class="bi bi-clipboard2-check-fill"></i></div>
                            <div class="menu-title">Peminjaman</div>
                        </a>
                    </li>
                @endcan

                @canany(['create-user', 'edit-user', 'delete-user'])
                    <li class="{{ Request::is('users*') ? 'mm-active' : '' }}">
                        <a href="{{ route('user.index') }}">
                            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
                            <div class="menu-title">User</div>
                        </a>
                    </li>
                @endcanany
            </ul>
            <!--end navigation-->
        </aside>
        <!--end sidebar -->

        <!--start content-->
        <main class="page-content">
