@extends('layout.fe.template')
@section('title', 'Wisata Kuliner')
@section('content')
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

        .card-img-top {
            transition: transform 0.5s ease;
            max-width: 100%;
            max-height: 100%;
        }

        .card-img-top:hover {
            transform: scale(1.05);
        }

        .card {
            border-radius: 15px;
        }

        .image-container {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            width: 100%;
            height: 180px;
        }

        .image {
            width: 100%;
            height: 100%;
            background-size: cover;
            transition: transform 0.5s ease;
        }

        .read-more {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 20px;
            opacity: 0;
            /* Awalnya tidak terlihat */
            transition: opacity 0.3s ease;
        }

        .image-container:hover .overlay {
            opacity: 1;
            /* Tampilkan overlay saat gambar dihover */
        }

        .image-container:hover .read-more {
            opacity: 1;
            /* Tampilkan teks "Read More" saat gambar dihover */
        }

        .image:hover {
            transform: scale(1.05);
        }

        .carousel-caption h1 {
            font-size: 64px;
        }

        @media (max-width: 768px) {
            .text__judul {
                font-size: 34px !important;
            }

            .title__awal {
                height: 200px !important;
                background-size: cover;
            }

            .container__kategori {
                padding-left: 26px;
                padding-right: 26px;
            }

            .container__gambar {
                padding-left: 20px;
                padding-right: 20px;
            }
        }
    </style>


    <main id="main">
        <section style="margin-top: 50px">
            <div class="bg-white" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="container">
                            <div class="row">
                                <div class="row mb-3">
                                    <div class="container__kategori">
                                        <h4 style="color: orange;">Kategori Kuliner</h4>
                                        <select class="form-select" id="kategoriSelect">
                                            <option value="all">Semua Kategori</option>
                                            @foreach ($kategori as $kat)
                                                <option value="{{ $kat->id }}">
                                                    {{ $kat->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="container__gambar">
                                    <div class="row">
                                        @foreach ($data as $kuliner)
                                            <div class="kuliner-item container col-md-4 mx-auto"
                                                data-kategori="{{ $kuliner->kategor ? $kuliner->kategor->id : '' }}">
                                                <div class="card" data-aos="fade-up">
                                                    <div class="image-container">
                                                        <a href="{{ route('detail_kuliner', $kuliner->id) }}">
                                                            <div class="image"
                                                                style="background-image: url('{{ asset('/images_kuliner/' . $kuliner->image) }}');">
                                                            </div>
                                                            <div class="read-more">Read More</div>
                                                        </a>
                                                    </div>
                                                    <div class="card-body">
                                                        <div style="display: flex;">
                                                            <p class="card-text text-truncate"
                                                                style="margin-bottom: 0; margin-top: 0;">
                                                                Kategori -
                                                                <i>{{ $kuliner->kategor?->nama_kategori }}</i>
                                                            </p>
                                                        </div>
                                                        <p class="card-text text-truncate">Buka
                                                            <i>{{ $kuliner->jam_operasional }}</i>
                                                        </p>
                                                        <p style="font-size: 20px; color: black"
                                                            class="card-text text-truncate fw-bold">
                                                            {{ $kuliner->tempat_kuliner }}
                                                        </p>
                                                        <p class="card-text">
                                                            Rating:
                                                            @php
                                                                $rating = $kuliner->rating;
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
                                                        <a href="{{ route('halaman_detailreservasi', $kuliner->id) }}"
                                                            class="btn btn-primary">Reservasi Sekarang</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        function filterByCategory(categoryId) {
            var kulinerItems = document.getElementsByClassName('kuliner-item');
            for (var i = 0; i < kulinerItems.length; i++) {
                var kulinerItem = kulinerItems[i];
                var kategoriId = kulinerItem.getAttribute('data-kategori');
                if (categoryId === 'all' || kategoriId === categoryId) {
                    kulinerItem.style.display = 'block';
                } else {
                    kulinerItem.style.display = 'none';
                }
            }
        }

        var selectElement = document.getElementById('kategoriSelect');
        selectElement.addEventListener('change', function() {
            filterByCategory(this.value);
        });
    </script>

@endsection
