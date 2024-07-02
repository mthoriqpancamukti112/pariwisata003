@extends('layout.fe.template')
@section('title', 'Ulasan')
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
    </style>
    <section style="margin-top: 50px">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2 style="font-size: 16px; color: black">BERIKAN ULASAN ANDA UNTUK <br>
                    {{ $detailkuliner->tempat_kuliner }}</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <img class="img-fluid" style="align-items: stretch"
                                        src="/frontend/assets/images/mentahan/rating.png" height="350px" width="350px"
                                        alt="">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
                    <div class="col-lg-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="reviewForm" method="POST" action="{{ route('ulasan.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="komentar">Komentar</label>
                                <textarea id="komentar" class="form-control" name="komentar" placeholder="Masukan ulasan anda" autofocus>{{ old('komentar') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="rating">Beri Rating</label>
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

                            <input type="hidden" name="reservasi_id" value="{{ $reservasi_id }}">

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" style="text-shadow: none"
                                    id="simpanButton">
                                    Kirim Ulasan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                var komentar = $("#komentar").val();
                const ratingInput = document.getElementById('rating');
                const ratingValue = parseInt(ratingInput.value);

                // Validasi komentar terlebih dahulu
                if (komentar.length === 0) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Komentar tidak boleh kosong!',
                        icon: "warning",
                    });
                    // Hentikan pengiriman form
                    event.preventDefault();
                    return; // Keluar dari fungsi jika komentar kosong
                }

                // Setelah komentar valid, periksa rating
                if (ratingValue === 0) {
                    Swal.fire({
                        title: "Oops!",
                        text: "Berikan rating",
                        icon: "warning",
                    });
                    // Hentikan pengiriman form
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
