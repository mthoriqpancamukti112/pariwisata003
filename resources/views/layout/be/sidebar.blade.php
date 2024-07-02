<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>

                @auth
                    @if (auth()->user()->hak_akses == 'Admin')
                        <a class="nav-link" href="{{ route('dashboard-index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house-user"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="{{ route('user.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                            Pengguna
                        </a>
                        <a class="nav-link" href="{{ url('/indexreservasi') }}">
                            <div class="sb-nav-link-icon"> <i class="fa-solid fa-cart-shopping"></i></div>
                            Reservasi &ensp;
                            @php
                                // Ambil jumlah reservasi yang masih menunggu konfirmasi dari database
                                $jumlah_reservasi = App\Models\Reservasi::whereIn('status', [
                                    'Dipending',
                                    'Belum Dibayar',
                                ])->count();
                            @endphp
                            {{-- Tampilkan badge dengan jumlah reservasi --}}
                            <span class="badge bg-danger">{{ $jumlah_reservasi }}</span>
                        </a>
                        <a class="nav-link" href="{{ route('kategori.index') }}">
                            <div class="sb-nav-link-icon"> <i class="fa-solid fa-list"></i></div>
                            Kategori
                        </a>
                        <a class="nav-link" href="{{ route('kuliner.index') }}">
                            <div class="sb-nav-link-icon"> <i class="fa-solid fa-mortar-pestle"></i></div>
                            Kuliner
                        </a>
                        <a class="nav-link" href="{{ route('makanans.index') }}">
                            <div class="sb-nav-link-icon"> <i class="fa-solid fa-bowl-food"></i></div>
                            Makanan
                        </a>
                        <a class="nav-link" href="{{ route('kapasitasmeja.index') }}">
                            <div class="sb-nav-link-icon"> <i class="fa-solid fa-table"></i></div>
                            Kapasitas Meja
                        </a>
                        <a class="nav-link" href="{{ route('metodepembayaran.index') }}">
                            <div class="sb-nav-link-icon"> <i class="fa-solid fa-bowl-food"></i></div>
                            Metode Pembayaran
                        </a>
                        <a class="nav-link" href="{{ route('galeri.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-image"></i></div>
                            Galeri
                        </a>
                        <a class="nav-link" href="{{ route('ulasan.index') }}">
                            <div class="sb-nav-link-icon"> <i class="fa-solid fa-comment"></i></div>
                            Ulasan
                        </a>
                        <a class="nav-link" href="{{ route('slider.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-sliders"></i></div>
                            Slider
                        </a>
                        <a class="nav-link" href="{{ route('rating.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-star-half-stroke"></i></div>
                            Rating
                        </a>
                        <a class="nav-link" href="{{ route('kontak.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-comment"></i></div>
                            Feedback
                        </a>
                    @endif
                @endauth

                @auth
                    @if (auth()->user()->hak_akses == 'User')
                        <a class="nav-link" href="{{ route('dashboard-index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house-user"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link" href="{{ url('/indexreservasi') }}">
                            <div class="sb-nav-link-icon"> <i class="fa-solid fa-cart-shopping"></i></div>
                            Reservasi &ensp;
                            @php
                                // Ambil jumlah reservasi yang masih menunggu konfirmasi dari database
                                $jumlah_reservasi = App\Models\Reservasi::whereIn('status', [
                                    'Dipending',
                                    'Belum Dibayar',
                                ])->count();
                            @endphp
                            {{-- Tampilkan badge dengan jumlah reservasi --}}
                            <span class="badge bg-danger">{{ $jumlah_reservasi }}</span>
                        </a>
                        <a class="nav-link" href="{{ route('kategori.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                            Kategori
                        </a>
                        <a class="nav-link" href="{{ route('kuliner.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-mortar-pestle"></i></div>
                            Kuliner
                        </a>
                        <a class="nav-link" href="{{ route('makanans.index') }}">
                            <div class="sb-nav-link-icon"> <i class="fa-solid fa-bowl-food"></i></div>
                            Makanan
                        </a>
                        <a class="nav-link" href="{{ route('kapasitasmeja.index') }}">
                            <div class="sb-nav-link-icon"> <i class="fa-solid fa-table"></i></div>
                            Kapasitas Meja
                        </a>
                        <a class="nav-link" href="{{ route('galeri.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-image"></i></div>
                            Galeri
                        </a>
                        <a class="nav-link" href="{{ route('ulasan.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-comment"></i></div>
                            Ulasan
                        </a>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-star-half-stroke"></i></div>
                            Rating
                        </a>
                    @endif
                @endauth
                {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Layouts
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('tour.index') }}">Wisata</a>
                    </nav>
                </div> --}}
            </div>
        </div>
    </nav>
</div>
