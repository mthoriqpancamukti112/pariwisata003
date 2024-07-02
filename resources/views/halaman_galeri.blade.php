@extends('layout.fe.template')
@section('title', 'Galeri')
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
        li,
        div {
            font-family: "PlusJakartaSans";
        }
    </style>
    <main
        style="background-image: url('/frontend/assets/images/banner.jpg'); background-position: center; background-size: cover; position: relative; margin-top: 60px">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.5);"></div>
        <section>
            <div class="container" data-aos="fade-up" style="padding-left: 30px; padding-right: 30px;">
                <div class="row">
                    <div data-aos="zoom-in" data-aos-delay="100">
                        <div style="margin-top: 40px; margin-bottom: 40px" class="text-center">
                            <p style="font-size: 50px; color: white; font-weight: bold; font-family: 'PlusJakartaSans">
                                Galeri Wisata</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <main id="main">
        <section id="sejarah" class="sejarah">
            <div class="container" data-aos="fade-up">
                <div class="container-fluid">
                    <div class="row">
                        <div class="align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                            <section id="portfolio" class="portfolio">
                                <div class="container" data-aos="fade-up">
                                    <div class="section-title">
                                        <h2 style="font-size: 18px">Galeri</h2>
                                    </div>
                                    <div class="row" data-aos="fade-up" data-aos-delay="100">
                                        <div class="col-lg-12 d-flex justify-content-center">
                                            <ul id="portfolio-flters">
                                                <li data-filter="*" class="filter-active">Semua Kategori</li>
                                                <li data-filter=".filter-1">Restoran</li>
                                                <li data-filter=".filter-2">Rumah Makan</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                                        @forelse ($galeri as $galeri)
                                            <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $galeri->kategori }}">
                                                <img src="{{ asset('/images_galeri/' . $galeri->image) }}" class="img-fluid"
                                                    alt="">
                                                <div class="portfolio-info">
                                                    <a href="{{ asset('/images_galeri/' . $galeri->image) }}"
                                                        data-gallery="portfolioGallery"
                                                        class="portfolio-lightbox preview-link" title="{{ $galeri->judul }}"
                                                        style="font-size: 30px;"><i class="bx bx-zoom-in"></i></a>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="alert alert-primary">
                                                Data Galeri Tidak Ada.
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
