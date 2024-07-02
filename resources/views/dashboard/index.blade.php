@extends('layout.be.template')
@section('title', 'Dashboard')
@section('content')

    <link href="/frontend/assets/css/adminlte.css" rel="stylesheet" />

    <style>
        @media (max-width: 768px) {
            .col-md-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .card {
                width: 50%;
                margin-bottom: 15px;
            }

            .card h3 {
                font-size: 18px;
            }

            .card p {
                font-size: 14px;
            }

            .gradient-bg {
                background: linear-gradient(to right, #ff8a00, #da1b60);
                /* Atur warna gradient di sini */
                /* Gunakan prefix browser yang sesuai untuk dukungan cross-browser */
            }
        }
    </style>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <h2 style="margin-bottom: 50px">Selamat Datang <span style="color: #ff8a00">
                        {{ Auth::user()->name }}
                    </span>
                </h2>
                @auth
                    @if (auth()->user()->hak_akses == 'Admin' || auth()->user()->hak_akses == 'User')
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div
                                class="p-3 shadow-sm d-flex justify-content-around align-items-center rounded bg-gradient-yellow">
                                <div>
                                    <h3 class="fs-2 text-white">{{ $jumlah_kuliner }}</h3>
                                    <p class="fs-5 text-white">Kuliner</p>
                                </div>
                                <i class="fa-solid fa-mortar-pestle" style="font-size: 50px; color: white"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div
                                class="p-3 bg-primary shadow-sm d-flex justify-content-around align-items-center rounded bg-gradient-green">
                                <div>
                                    <h3 class="fs-2 text-white">{{ $jumlah_makanan }}</h3>
                                    <p class="fs-5 text-white">Makanan</p>
                                </div>
                                <i class="fa-solid fa-bowl-food" style="font-size: 50px; color: white"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div
                                class="p-3 bg-primary shadow-sm d-flex justify-content-around align-items-center rounded bg-gradient-blue">
                                <div>
                                    <h3 class="fs-2 text-white">{{ $jumlah_ulasan }}</h3>
                                    <p class="fs-5 text-white">Ulasan</p>
                                </div>
                                <i class="fa-solid fa-comment" style="font-size: 50px; color: white"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div
                                class="p-3 bg-primary shadow-sm d-flex justify-content-around align-items-center rounded bg-gradient-orange">
                                <div>
                                    <h3 class="fs-2 text-white">{{ $jumlah_reservasi }}</h3>
                                    <p class="fs-5 text-white">Reservasi</p>
                                </div>
                                <i class="fa-solid fa-cart-shopping" style="font-size: 50px; color: white"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div
                                class="p-3 bg-primary shadow-sm d-flex justify-content-around align-items-center rounded bg-gradient-purple">
                                <div>
                                    <h3 class="fs-2 text-white">{{ $jumlah_rating }}</h3>
                                    <p class="fs-5 text-white">Rating Makanan</p>
                                </div>
                                <i class="fa-solid fa-star" style="font-size: 50px; color: white"></i>
                            </div>
                        </div>
                    @endif
                @endauth

            </div>
        </div>
    </main>
@endsection
