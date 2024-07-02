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

        .carousel-caption {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
            color: #fff;
            text-align: center;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }


        /* Animasi ketik */
        .typing-animation {
            overflow: hidden;
            border-right: .15em solid orange;
            /* Ganti warna garis dengan warna teks Anda */
            white-space: nowrap;
            margin: 0 auto;
            animation: typing 1.5s steps(20, end),
                blink-caret .75s step-end infinite;
        }

        @keyframes typing {
            from {
                width: 0
            }

            to {
                width: 100%
            }
        }

        @keyframes blink-caret {

            from,
            to {
                border-color: transparent
            }

            50% {
                border-color: orange;
            }
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
            height: 200px;
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
            .carousel-caption h1 {
                font-size: 28px;
            }
        }
    </style>
    <div style="margin-top: 60px" id="carouselExampleFade" class="carousel slide carousel-fade">
        <div class="carousel-inner">
            @foreach ($slider as $index => $slide)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="carousel-caption">
                        <h1><span class="typing-animation">Wisata Kuliner</span></h1>
                    </div>
                    <img style="height: 100%; width: 100%" src="{{ asset('/images_slider/' . $slide->image) }}"
                        class="d-block w-100" alt="">
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <main id="main">
        <section id="sejarah" class="sejarah">
            <div class="bg-white" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="container-fluid">
                            <div class="container">
                                <div class="row">
                                    @php $count = 0 @endphp
                                    @foreach ($data_kuliner as $kuliner)
                                        @if ($count < 3)
                                            <div class="container col-md-4 mx-auto">
                                                <div style="margin: 10px" class="card" data-aos="zoom-in"
                                                    data-aos-delay="100">
                                                    <div class="image-container">
                                                        <a href="{{ route('detail_kuliner', $kuliner->id) }}">
                                                            <div class="image"
                                                                style="background-image: url('{{ asset('/images_kuliner/' . $kuliner->image) }}');">
                                                            </div>
                                                            <div class="read-more">Read More</div>
                                                        </a>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="card-text text-truncate">
                                                            Kategori -
                                                            <i>{{ $kuliner->kategor?->nama_kategori }}</i>
                                                        </p>
                                                        <p class="card-text text-truncate">
                                                            Jam Operasional -
                                                            <i>{{ $kuliner->jam_operasional }}</i>
                                                        </p>
                                                        <p style="font-size: 24px; color: black" class="fw-bold">
                                                            {{ $kuliner->tempat_kuliner }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            @php $count++ @endphp
                                        @else
                                        @break
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    // Mengatur tingkat jeda sebelum animasi ketik dimulai
    setTimeout(function() {
        var span = document.querySelectorAll('.typing-animation');
        span.forEach(function(element) {
            var text = element.innerText;
            element.innerHTML = '';
            var i = 0;
            var direction = 1; // Menambahkan variabel untuk menentukan arah animasi
            var typing = function() {
                if (i >= text.length || i < 0) {
                    direction = -
                        direction; // Mengubah arah animasi jika mencapai akhir atau awal teks
                }
                element.innerHTML = text.substring(0, i);
                i += direction;
                setTimeout(typing,
                    100); // Mengatur kecepatan animasi ketik di sini (dalam milidetik)
            }
            typing();
        });
    }, 1000); // Mengatur waktu tunggu sebelum memulai animasi ketik (dalam milidetik)
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var carouselItems = document.querySelectorAll('.carousel-item');
        var currentSlide = 0;
        var interval = 5000; // Interval dalam milidetik (5000 ms = 5 detik)

        function nextSlide() {
            carouselItems[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % carouselItems.length;
            carouselItems[currentSlide].classList.add('active');
        }

        setInterval(nextSlide, interval);
    });
</script>
@endsection
