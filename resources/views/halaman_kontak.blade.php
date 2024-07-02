@extends('layout.fe.template')
@section('title', 'Kontak')
@section('content')
    <link rel="stylesheet" href="/frontend/assets/css/sweetalert2.min.css">
    <style>
        /* Gaya font */
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

        @media (max-width: 768px) {
            .col-lg-6 {
                padding-right: 20px;
                padding-left: 20px;
            }

            .section-title h2 {
                font-size: 12px !important;
            }
        }
    </style>
    <main id="main">
        <section style="margin-top: 30px">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="section-title">
                        <h2 style="font-size: 16px; color: black">KIRIM PESAN KE KAMI</h2>
                    </div>
                    <div class="col-lg-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="col-lg-12">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <div class="text-center">
                                            <img class="img-fluid" style="align-items: stretch"
                                                src="/frontend/assets/images/mentahan/kontak.png" width="350px"
                                                height="350px" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
                        <div class="col-lg-12">
                            <form id="simpanForm" action="{{ route('kontak.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama"
                                        placeholder="Masukan nama anda" id="nama" value="{{ old('nama') }}">
                                </div>

                                <div class="form-group">
                                    <label for="perihal">Perihal</label>
                                    <input type="text" class="form-control" name="perihal" id="perihal"
                                        placeholder="Masukan perihal anda" value="{{ old('perihal') }}">
                                </div>

                                <div class="form-group">
                                    <label for="pesan">Isi Pesan</label>
                                    <textarea name="pesan" class="form-control" id="pesan" cols="30" rows="7"
                                        placeholder="Masukan isi pesan anda">{{ old('pesan') }}</textarea>
                                </div>
                                <button type="button" id="simpanButton" class="btn btn-primary btn-block"
                                    style="text-shadow: none">Kirim</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="/frontend/assets/vendors/jquery/jquery.min.js"></script>
    <script src="/frontend/assets/js/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#simpanButton").click(function() {

                    var nama = $("#nama").val();
                    var perihal = $("#perihal").val();
                    var pesan = $("#pesan").val();

                    // Validasi form
                    if (nama.length == 0 || perihal.length == 0 || pesan.length == 0) {
                        Swal.fire({
                            type: 'warning',
                            title: 'Oops...',
                            text: 'Silakan lengkapi semua bidang!',
                            icon: "warning",
                        });
                        return;
                    }

                    // Pengecekan otentikasi
                    @auth
                    $.ajax({
                        url: $("#simpanForm").attr("action"),
                        type: $("#simpanForm").attr("method"),
                        data: $("#simpanForm").serialize(),
                        success: function(response) {
                            // Membersihkan formulir setelah berhasil disubmit
                            $("#simpanForm")[0].reset();

                            // Memberikan pesan sukses kepada pengguna
                            Swal.fire({
                                text: 'Pesan berhasil terkirim!',
                                icon: "success",
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                @else
                    // Redirect ke halaman login jika pengguna belum login
                    window.location.href = "{{ route('login') }}";
                @endauth
            });
        });
    </script>
@endsection
