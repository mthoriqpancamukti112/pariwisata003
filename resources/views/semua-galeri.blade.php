@extends('layout.fe.template')
@section('title', 'Galeri Kuliner')
@section('content')

    <link rel="stylesheet" href="/frontend/assets/css/lightbox.min.css">

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

        .container__galeri {
            display: grid;
            justify-items: center;
        }

        .container__galeri {
            display: grid;
            justify-items: center;
        }

        /* Efek zoom pada gambar */
        .zoomable {
            transition: transform 0.3s ease;
        }

        .zoomable:hover {
            transform: scale(1.1);
            /* Memperbesar gambar saat dihover */
        }

        /* Mengatur tata letak grid untuk versi desktop */
        @media (min-width: 1200px) {
            .container__galeri {
                grid-template-columns: repeat(4, minmax(0, 1fr));
                grid-gap: 20px;
            }

            .discover__container__galeri .swiper-wrapper {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .container__galeri {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                grid-gap: 20px;
                padding: 0 15px;
                margin: 0 auto;
                max-width: calc(100% - 30px);
            }

            .container__galeri a img {
                width: 50%;
                height: 50%;
            }

            .section-title h2 {
                font-size: 12px !important;
            }
        }
    </style>

    <section style="margin-top: 30px" id="galeri" id="discover">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2 style="font-size: 16px; color: black;">Galeri {{ $kuliner->tempat_kuliner }}</h2>
            </div>
            <div class="container__galeri">
                @forelse ($galeri as $galleryImage)
                    <a href="/galeri_kuliner/{{ $galleryImage }}" data-title="Galeri {{ $kuliner->tempat_kuliner }}"
                        data-lightbox="galeri" class="zoomable">
                        <img style="height: 180px; width: 100%; border-radius: 10px; object-fit: cover; object-position: center;"
                            src="/galeri_kuliner/{{ $galleryImage }}">
                    </a>
                @empty
                    <p>Belum ada galeri untuk saat ini</p>
                @endforelse
            </div>
        </div>
    </section>

    <script src="/frontend/assets/js/lightbox-plus-jquery.min.js"></script>

@endsection
