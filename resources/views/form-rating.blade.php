@extends('layout.fe.template')
@section('title', 'Beri Rating')
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

        .rating {
            cursor: pointer;
            font-size: 24px;
        }

        .rating i:hover,
        .rating i.selected {
            color: gold;
        }

        @media (max-width: 768px) {
            .col-lg-7 {
                padding-left: 50px;
                padding-right: 50px;
            }

            .section-title h2 {
                font-size: 12px !important;
            }
        }
    </style>

    <main>
        <section style="margin-top: 30px" class="bg-white">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="section-title">
                        <h2 style="font-size: 16px; color: black">RATING</h2>
                    </div>
                    <div class="col-lg-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="col-lg-12">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <div class="text-center">
                                            <img class="img-fluid" style="align-items: stretch"
                                                src="/frontend/assets/images/rating-makanan-kuliner.jpg" width="350px"
                                                height="350px" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center" data-aos="zoom-in" data-aos-delay="100">
                        <div class="col-lg-7 mx-auto">
                            <div style="border-radius: 15px" class="card">
                                <img class="card-img-top" alt="{{ $makanan->nama }}"
                                    src="{{ asset('/images_makanan/' . $makanan->image) }}">
                                <div class="card-body">
                                    <h5 style="color: black; font-size: 24px" class="">
                                        {{ $makanan->nama }}</h5>
                                    <form id="reviewForm" action="{{ route('ratings.store', ['id' => $makanan->id]) }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="makanan_id" value="{{ $makanan_id }}">
                                        <div class="form-group row">
                                            <div class="star-rating">
                                                <!-- Tambahkan bintang -->
                                                <div class="rating">
                                                    <i class="fas fa-star" data-value="1"></i>
                                                    <i class="fas fa-star" data-value="2"></i>
                                                    <i class="fas fa-star" data-value="3"></i>
                                                    <i class="fas fa-star" data-value="4"></i>
                                                    <i class="fas fa-star" data-value="5"></i>
                                                    <!-- Simpan nilai rating di sini -->
                                                    <input type="hidden" name="rating" id="rating" value="0">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" id="submitButton" class="btn btn-primary"
                                            style="text-shadow: none">Kirim
                                            Penilaian</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="/frontend/assets/vendors/jquery/jquery.min.js"></script>
    <script src="/frontend/assets/js/sweetalert2.all.min.js"></script>

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
                        text: "Anda harus memberikan rating dulu.",
                        icon: "warning",
                        confirmButtonText: "OK",
                    });

                    // Hentikan pengiriman form
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
