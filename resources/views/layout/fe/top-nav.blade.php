<link rel="stylesheet" href="/frontend/assets/css/icon.css">
<style>
    @font-face {
        font-family: "PlusJakartaSans";
        src: url("/frontend/assets/font/PlusJakartaSans-Medium.ttf") format("truetype");
    }

    @media (max-width: 768px) {
        #header .container {
            padding-left: 25px;
            padding-right: 15px;
        }

        .logo-container h1.logo {
            font-size: 18px !important;
        }

        .navbar ul {
            padding-right: 10px;
        }

        .navbar .mobile-nav-toggle {
            margin-right: 10px;
        }
    }


    #navbar {
        max-width: 100%;
    }

    .logo-container {
        display: flex;
        align-items: center;
    }

    .profile-image-container {
        width: 40px;
        height: 40px;
        display: inline-flex;
        overflow: hidden;
    }

    .profile-image {
        width: 100%;
        height: auto;
        border-radius: 50%;
    }

    .profile-container {
        display: flex;
        align-items: center;
    }

    .profile-text {
        margin-left: 8px;
    }
</style>
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo-container">
            <a href="index.html" class="logo"><img src="/frontend/assets/images/logo-wisata.png" alt=""></a>
            <h1 style="color: black; font-family: 'PlusJakartaSans'" class="logo">WISATA KULINER</h1>
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto" href="{{ url('/beranda') }}">Beranda</a></li>
                <li><a class="nav-link scrollto" href="{{ url('halaman_kuliner') }}">Kuliner</a></li>
                {{-- <li class="dropdown">
                    <a href="#"><span>Wisata</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="{{ url('/halaman_wisata') }}">ALAM</a></li>
                        <li><a href="">KULINER</a></li>
                    </ul>
                </li> --}}
                <li class="dropdown">
                    <a href="#"><span>Publikasi</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="{{ url('/halaman_galeri') }}">Galeri</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="{{ url('halaman_kontak') }}">Kontak</a></li>

                @auth
                    <li><a class="nav-link scrollto" href="{{ url('/halaman-reservasi') }}">Rerservasi</a></li>
                    <li class="dropdown">
                        <a href="#"><span>{{ Auth::user()->name }}</span><i class="bi bi-chevron-down"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('halaman-profil') }}">
                                    <div class="profile-container">
                                        <div class="profile-image-container">
                                            @if (Auth::user()->image)
                                                <img src="/images_profile/{{ Auth::user()->image }}" alt="Profile Image"
                                                    class="profile-image">
                                            @else
                                                <img src="{{ asset('/frontend/assets/images/icon_profil.png') }}"
                                                    alt="Profile Image" class="profile-image">
                                            @endif
                                        </div>
                                        <span class="profile-text">Dashboard</span>
                                    </div>
                                </a>
                            </li>
                            @auth
                                @if (auth()->user()->hak_akses == 'Admin' || auth()->user()->hak_akses == 'User')
                                    <li><a href="{{ route('dashboard-index') }}">Dashboard</a></li>
                                @endif
                            @endauth
                            <li><a onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                    href="{{ url('/beranda') }}">Keluar</a>
                                <form id="logout-form" action="{{ route('logoutgues') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a class="nav-link scrollto" href="{{ url('/login') }}">Login</a></li>
                @endauth
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
    </div>
</header>
