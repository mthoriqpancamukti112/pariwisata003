@extends('layout.fe.template')
@section('title', 'Profil')
@section('content')
    <script src="/frontend/js/jquery-3.5.1.slim.min.js"></script>
    <script src="/frontend/js/bootstrap.bundle.min.js"></script>
    <style>
        @font-face {
            font-family: "PlusJakartaSans";
            src: url("/frontend/assets/font/PlusJakartaSans-Medium.ttf") format("truetype");
        }

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        a,
        span,
        li,
        div {
            font-family: "PlusJakartaSans";
        }

        .material-icons {
            font-size: 16px;
            color: #555;
            vertical-align: middle;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .bg-gradient-green {
            background: linear-gradient(135deg, #0f9b0f, #00e400);
        }

        .bg-gradient-orange {
            background: linear-gradient(135deg, #ff6f00, #ff9a00);
        }

        .bg-gradient-yellow {
            background: linear-gradient(135deg, #ffd700, #ffea00);
        }

        .card-body i {
            transition: transform 0.3s ease;
        }

        .card-body i:hover {
            transform: scale(1.2);
        }

        .card-title {
            font-size: 1rem;
            font-weight: bold;
        }

        .card-subtitle {
            font-size: 1.2rem;
        }

        .btn-custom {
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .btn-custom:hover {
            background-color: #45a049;
        }

        @media (max-width: 768px) {
            .col-md-6 {
                padding-left: 30px;
                padding-right: 30px;
            }
        }
    </style>
    <section id="galeri" class="pb-4 mt-5">
        <div class="container">
            <div class="mb-5">
                <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-alam-tab" data-toggle="pill" href="#pills-alam" role="tab"
                            aria-controls="pills-alam" aria-selected="false" style="font-size: 16px">Dashboard</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-objek-wisata-tab" data-toggle="pill" href="#pills-objek-wisata"
                            role="tab" aria-controls="pills-objek-wisata" aria-selected="true"
                            style="font-size: 16px">Profil</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-alam" role="tabpanel" aria-labelledby="pills-alam-tab">
                    <div class="row">
                        <!-- Ulasan -->
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card bg-gradient-green h-100">
                                <div class="card-body text-center d-flex flex-column justify-content-center">
                                    <i class="bi bi-chat-left-text fs-1 mb-3 text-white"></i>
                                    <h3 class="card-title text-white">{{ $jumlah_ulasan }}</h3><br>
                                    <p class="card-subtitle text-white">Ulasan</p>
                                </div>
                            </div>
                        </div>
                        <!-- Reservasi -->
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card bg-gradient-orange h-100">
                                <div class="card-body text-center d-flex flex-column justify-content-center">
                                    <i class="bi bi-calendar-check fs-1 mb-3 text-white"></i>
                                    <h3 class="card-title text-white">{{ $jumlah_reservasi }}</h3><br>
                                    <p class="card-subtitle text-white">Reservasi</p>
                                </div>
                            </div>
                        </div>
                        <!-- Rating Makanan -->
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card bg-gradient-yellow h-100">
                                <div class="card-body text-center d-flex flex-column justify-content-center">
                                    <i class="bi bi-star-fill fs-1 mb-3 text-white"></i>
                                    <h3 class="card-title text-white">{{ $jumlah_rating }}</h3><br>
                                    <p class="card-subtitle text-white">Rating Makanan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-objek-wisata" role="tabpanel" aria-labelledby="pills-objek-wisata-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                                <div class="card-body text-center">
                                    @if ($user->image)
                                        <img src="/images_profile/{{ $user->image }}" style="border-radius: 20px"
                                            height="250px">
                                    @else
                                        <img src="{{ asset('/frontend/assets/images/icon_profil.png') }}" width="300px"
                                            alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                                <div class="card-body">
                                    <h2 class="card-title">
                                        {{ strtoupper($user->name) }}
                                    </h2>
                                    <br><br>
                                    <p class="card-subtitle">
                                        <span class="material-icons">phone</span> &ensp;
                                        {{ $user->no_hp }}
                                    </p>
                                    <p class="card-subtitle">
                                        <span class="material-icons">home</span> &ensp;
                                        {{ $user->alamat }}
                                    </p>
                                    <p class="card-subtitle">
                                        <span class="material-icons">person</span> &ensp;
                                        {{ $user->jenis_kelamin }}
                                    </p>
                                    <p class="card-subtitle">
                                        <span class="material-icons">email</span> &ensp;
                                        {{ $user->email }}
                                    </p>
                                    <div class="d-flex mt-4 justify-content-center">
                                        <a type="button" class="btn btn-custom mr-2" href="{{ url('beranda') }}">Home</a>
                                        <a type="button" class="btn btn-custom mr-2"
                                            href="{{ route('profil.edit', ['profil' => Auth::user()]) }}">Edit
                                            Profile</a>
                                        <a onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                            href="{{ url('/beranda') }}" type="button" class="btn btn-custom">Logout</a>
                                        <form id="logout-form" action="{{ route('logoutgues') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
