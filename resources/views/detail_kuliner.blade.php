@extends('layout.fe.template')
@section('title', 'Detail Kuliner')
@section('content')
    <link rel="stylesheet" href="/frontend/assets/css/lightbox.min.css">
    <link rel="stylesheet" href="/frontend/assets/css/swiper-bundle.min.css">

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
        div {
            font-family: "PlusJakartaSans";
        }

        @media (max-width: 768px) {
            .text__judul {
                font-size: 24px !important;
            }

            .btn__pertama {
                padding: 2px 16px !important;
                font-size: 12px !important;
            }

            .title__awal {
                height: 250px !important;
                background-size: cover;
            }

            .col-lg-6.align-items-stretch img {
                padding-right: 20px;
                padding-left: 20px;
                border-radius: 20px;
            }
        }

        .place__card {
            position: relative;
            overflow: hidden;
        }

        .place__container {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            grid-gap: 20px;
            justify-content: center;
        }

        .discover__container .swiper-wrapper {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .card {
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .image-container {
            overflow: hidden;
        }

        .image-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.2);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .image-container:hover::before {
            opacity: 1;
        }

        .image-container:hover img {
            transform: scale(1.1);
            transition: transform 0.3s ease;
        }

        .zoomable {
            transition: transform 0.3s ease;
        }

        .zoomable:hover {
            transform: scale(1.1);
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        @media (max-width: 768px) {

            .place__container .card p {
                font-size: 12px !important;
            }

            span a {
                padding: 3px 8px !important;
                font-size: 8px !important;
            }

            /* Mengurangi tinggi gambar menu makanan */
            .place__container .card {
                max-height: 200px;
            }

            .place__container .card .image-container img {
                width: 100% !important;
                height: 100% !important;
                object-fit: cover;
                object-position: center;
            }

            .place__container {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                grid-gap: 10px;
                margin: 0 auto;
                max-width: calc(100% - 45px);
            }

            .place__card img {
                width: 100%;
                max-height: 150px;
                object-fit: cover;
                border-radius: 10px;
            }

            .discover__container .swiper-wrapper {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px;
                padding: 0 15px;
                margin: 0 auto;
                max-width: calc(100% - 45px);
            }

            .section-title h2 {
                font-size: 12px !important;
            }
        }

        .nav-btn {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            transform: translateY(30px);
            background-color: rgb(0, 0, 0, 0.1);
            transition: 0.2s;
        }

        .nav-btn:hover {
            background-color: rgb(0, 0, 0, 0.2);
        }

        .nav-btn::after,
        .nav-btn::before {
            font-size: 20px;
            color: blue;
        }

        .swiper-pagination-bullet {
            background-color: rgb(0, 0, 0, 0.8);
        }

        .swiper-pagination-bullet-active {
            background-color: blue;
        }
    </style>


    <section class="title__awal"
        style="background-image: url('/frontend/assets/images/banner.jpg'); height: auto; background-position: center; background-size: cover; position: relative; display: flex; justify-content: center; align-items: center;">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.5);"></div>
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div data-aos="fade-up">
                    <div style="margin-top: 100px; margin-bottom: 40px" class="text-center">
                        <p class="text__judul"
                            style="font-size: 50px; color: white; font-weight: bold; font-family: 'PlusJakartaSans'">
                            Detail Kuliner {{ $detailkuliner->tempat_kuliner }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-5 mb-5" data-aos="zoom-in">
        <div class="text-center">
            <h2 style="color: black; font-weight: bold">
                {{ strtoupper($detailkuliner->tempat_kuliner) }}</h2>
            <p>Upload:
                {{ \Carbon\Carbon::parse($detailkuliner->tgl_upload)->locale('id')->isoFormat('D MMMM YYYY') }}
            </p>
        </div>
        <div class="row text-center">
            <div class="col-lg-6 align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                <img class="img-fluid" src="{{ asset('/images_kuliner/' . $detailkuliner->image) }}" class="card-img-top"
                    alt="{{ $detailkuliner->tempat_kuliner }}" style="border-radius: 10px">
                <h2 class="mt-2" style="font-weight: bold; color: black">{{ $detailkuliner->rating }}</h2>
                <h5 class="mt-2">
                    @php
                        $rating = $detailkuliner->rating;
                        $maxRating = 5;
                        $fullStar = floor($rating);
                        $halfStar = ceil($rating - $fullStar);
                        $emptyStar = $maxRating - $fullStar - $halfStar;

                        // Menampilkan bintang penuh
                        for ($i = 0; $i < $fullStar; $i++) {
                            echo '<i class="fas fa-star" style="color: gold;"></i>';
                        }

                        // Menampilkan bintang setengah
                        for ($i = 0; $i < $halfStar; $i++) {
                            echo '<i class="fas fa-star-half-alt" style="color: gold;"></i>';
                        }

                        // Menampilkan bintang kosong
                        for ($i = 0; $i < $emptyStar; $i++) {
                            echo '<i class="far fa-star" style="color: gold;"></i>';
                        }
                    @endphp
                </h5>
                <p><i class="fas fa-user"></i>&ensp;{{ $jumlahRating }}</p>
            </div>

            <div class="col-lg-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                <div class="container-fluid">
                    <div class="container">
                        <div class="row">
                            <div style="color: black; text-align: justify">
                                <h6 class="text-bold">Jam Operasional</h6>
                                <p style="font-size: 14px"><i
                                        class="fa-solid fa-clock"></i>&ensp;{{ $detailkuliner->jam_operasional }}
                                </p>
                                <h6 class="text-bold">Fasilitas</h6>
                                <p style="font-size: 14px"><i
                                        class="fa-solid fa-list"></i>&ensp;{{ $detailkuliner->fasilitas }}
                                </p>
                                <h6 class="text-bold">Alamat</h6>
                                <p style="font-size: 14px">
                                    <i class="fa-solid fa-location-dot"></i>&ensp;{{ $detailkuliner->lokasi }}<br>
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $detailkuliner->tempat_kuliner }}"
                                        target="_blank">Lihat di Google Maps</a>
                                </p>
                                <h6 class="text-bold">Kontak</h6>
                                <p style="font-size: 14px"><i
                                        class="fa-brands fa-whatsapp"></i>&ensp;{{ $detailkuliner->kontak }}
                                </p>
                                <h6 class="text-bold">Mengenai {{ $detailkuliner->tempat_kuliner }}
                                </h6>
                                <p style="font-family: PlusJakartaSans; font-size: 14px">
                                    {{ $detailkuliner->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main id="main"
        style="background-image: url('/frontend/assets/images/banner.jpg'); background-position: center; background-size: cover; position: relative;">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.5);">
        </div>
        <section class="title__awal">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div data-aos="zoom-in" data-aos-delay="100">
                        <div class="text-center" style="font-weight: bold; color: white">
                            <p class="text__judul"
                                style="font-size: 50px; color: white; font-weight: bold; font-family: 'PlusJakartaSans'">
                                Tertarik Dengan {{ $detailkuliner->tempat_kuliner }} ?
                                Kami Tunggu Kedatangan Anda Bersama Keluarga dan Pasangan Tercinta</p>
                            <a href="{{ route('halaman_detailreservasi', $detailkuliner->id) }}" class="btn__pertama btn"
                                style="background-color: #1f920b; color: white; padding: 7px 22px; font-size: 16px; border-radius: 50px;">Reservasi
                                {{ $detailkuliner->tempat_kuliner }} disini!</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section>
        <div class="section-title">
            <h2 style="font-size: 16px; color: black;">Menu {{ $detailkuliner->tempat_kuliner }}</h2>
        </div>
        <div class="place__container container grid">
            @forelse ($menu_makanan as $makanan)
                <div class="card" style="border-radius: 10px" data-aos="fade-up" data-aos-delay="100">
                    <div class="image-container">
                        <img src="{{ asset('/images_makanan/' . $makanan->image) }}"
                            style="border-top-left-radius: 10px; max-height: 300px; width: auto; background-position: center; background-size: cover;"
                            alt="{{ $makanan->nama }}">
                    </div>
                    <div style="margin-left: 10px; margin-bottom: 10px; margin-top: 1">
                        <div class="mt-3">


                            <p style="color: black; font-size: 24px; font-weight: bold">{{ $makanan->nama }}</p>
                            @if ($makanan->ratings->count() > 0)
                                @php
                                    $totalRating = $makanan->ratings->sum('rating');
                                    $averageRating = $makanan->ratings->avg('rating');
                                    $ratingStars = str_repeat(
                                        '<i class="fas fa-star" style="color: gold;"></i>',
                                        round($averageRating),
                                    );
                                    $emptyStars = str_repeat(
                                        '<i class="far fa-star" style="color: gold;"></i>',
                                        5 - round($averageRating),
                                    );
                                    echo $ratingStars . $emptyStars;
                                @endphp
                            @endif
                            @php
                                // Memeriksa apakah pengguna saat ini sudah memberikan rating untuk makanan ini
                                $userRating = $makanan->ratings->where('user_id', Auth::id())->first();
                            @endphp
                            @if (!$userRating)
                                <div>
                                    <a href="{{ route('form-rating', ['id' => $makanan->id]) }}">Beri
                                        Rating</a>
                                </div>
                            @else
                                {{-- <p>Anda telah memberikan rating</p> --}}
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                Belum ada menu untuk saat ini.
            @endforelse
        </div>
    </section>

    <section class="container">
        <div class="section-title">
            <h2 style="font-size: 16px; color: black;">APA KATA PENGUNJUNG UNTUK <br>
                {{ $detailkuliner->tempat_kuliner }}</h2>
        </div>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($ulasan as $index => $review)
                    <div class="swiper-slide">
                        <div class="text-center mt-3">
                            @if ($review->user->image)
                                <img src="/images_profile/{{ $review->user->image }}" class="image-card-top rounded-circle"
                                    style="width: 130px; height: 130px; object-fit: cover;">
                            @else
                                <img src="{{ asset('/frontend/assets/images/icon_profil.png') }}"
                                    style="width: 130px; height: 130px;" alt="">
                            @endif
                        </div>
                        <div class="card-body">
                            <h4 class="text-center" style="font-weight: bold">
                                {{ $review->reservasi->nama_pengunjung }}</h4>
                            <div class="text-center mb-3">
                                <!-- Rating -->
                                <p style="font-size: 14px">
                                    @php
                                        $rating = $review->rating;
                                        $maxRating = 5;
                                        $fullStar = floor($rating);
                                        $halfStar = ceil($rating - $fullStar);
                                        $emptyStar = $maxRating - $fullStar - $halfStar;

                                        // Menampilkan bintang penuh
                                        for ($i = 0; $i < $fullStar; $i++) {
                                            echo '<i class="fas fa-star" style="color: gold;"></i>';
                                        }

                                        // Menampilkan bintang setengah
                                        for ($i = 0; $i < $halfStar; $i++) {
                                            echo '<i class="fas fa-star-half-alt" style="color: gold;"></i>';
                                        }

                                        // Menampilkan bintang kosong
                                        for ($i = 0; $i < $emptyStar; $i++) {
                                            echo '<i class="far fa-star" style="color: gold;"></i>';
                                        }
                                    @endphp
                                </p>
                                <!-- Komentar -->
                                <p class="text-center" style="font-size: 14px">{{ $review->komentar }}
                                </p>
                                <!-- Tanggal ulasan -->
                                <p class="card-text" style="font-size: 14px"><i
                                        class="fa-solid fa-calendar-days"></i>&ensp;Diulas
                                    pada
                                    {{ \Carbon\Carbon::parse($review->tgl_ulasan)->locale('id')->isoFormat('D MMMM YYYY') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next nav-btn"></div>
            <div class="swiper-button-prev nav-btn"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="discover section" id="discover" data-aos="fade-up" data-aos-delay="100">
        <div class="section-title">
            <h2 style="font-size: 16px; color: black;">Galeri {{ $detailkuliner->tempat_kuliner }}</h2>
        </div>

        <div class="discover__container container swiper-container">
            <div class="swiper-wrapper">
                @foreach ($slicedGaleri as $galleryImage)
                    <div class="discover__card swiper-slide">
                        <a href="/galeri_kuliner/{{ $galleryImage }}" data-lightbox="galeri"
                            data-title="Galeri {{ $detailkuliner->tempat_kuliner }}">
                            <img style="height: 180px; width: 100%; border-radius: 10px; margin-bottom: 10px; object-fit: cover; object-position: center;"
                                src="/galeri_kuliner/{{ $galleryImage }}" class="discover__img zoomable">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-3 mb-3">
                <a style="font-size: 16px;" href="{{ route('semua-galeri', ['id' => $detailkuliner->id]) }}">Lihat
                    semua
                    galeri</a>
            </div>
        </div>
    </section>
    <script src="/frontend/assets/js/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: "auto",
            spaceBetween: 20,
            centeredSlides: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
    <script src="/frontend/assets/js/sweetalert2.all.min.js"></script>
    <script src="/frontend/assets/js/lightbox-plus-jquery.min.js"></script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            const stars = document.querySelectorAll('.rating i');
            console.log("JavaScript dijalankan!");

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const value = parseInt(star.getAttribute('data-value'));
                    const ratingInput = document.getElementById('rating');

                    // Set nilai input tersembunyi
                    ratingInput.value = value;

                    // Ubah warna bintang sesuai dengan nilai yang dipilih
                    stars.forEach(s => {
                        const starValue = parseInt(s.getAttribute('data-value'));
                        if (starValue <= value) {
                            s.classList.add('selected');
                        } else {
                            s.classList.remove('selected');
                        }
                    });
                });
            });

            // Tambahkan event listener untuk form submit
            const form = document.getElementById('reviewForm');
            form.addEventListener('submit', function(event) {
                // console.log("Javadcript dijalankan!"); // untuk mencoba tes javascriptnya pada console browser
                const ratingInput = document.getElementById('rating');
                const ratingValue = parseInt(ratingInput.value);

                // Periksa apakah nilai rating tidak sama dengan 0
                if (ratingValue === 0) {
                    Swal.fire({
                        title: "Oops!",
                        text: "Anda harus memberikan rating sebelum mengirim ulasan.",
                        icon: "warning",
                        confirmButtonText: "OK",
                    });

                    // Hentikan pengiriman form
                    event.preventDefault();
                }
            });
        });
    </script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "Terimakasih telah memberikan rating.",
                showConfirmButton: false,
                timer: 1500
            });
        @endif
    </script>
@endsection
