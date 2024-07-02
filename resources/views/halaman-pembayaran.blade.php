@extends('layout.fe.template')
@section('title', 'Pembayaran')
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

        @media (max-width: 768px) {
            .col-lg-6 {
                padding-right: 30px;
                padding-left: 30px;
            }

            .section-title h2 {
                font-size: 12px !important;
            }
        }
    </style>
    <main id="main">
        <section style="margin-top: 30px">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2 style="font-size: 16px; color: black">Pembayaran</h2>
                </div>
                <div class="row">
                    <div class="col-lg-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="col-lg-12">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <div class="text-center">
                                            <img class="img-fluid" style="align-items: stretch"
                                                src="/frontend/assets/images/bayar.jpg" width="350px" height="350px"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
                        <div class="col-lg-12">
                            <form id="simpanForm" action="{{ route('pembayaran.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="nama_pengirim">Nama Pengirim / Customer</label>
                                    <input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control"
                                        autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="foto_bukti_pembayaran">Foto Bukti Pembayaran</label>
                                    <input type="file" name="foto_bukti_pembayaran" id="foto_bukti_pembayaran"
                                        class="form-control-file">
                                </div>
                                <div class="form-group" style="display: none;">
                                    <select name="reservasi_id" id="reservasi_id" class="form-control">
                                        @foreach ($reservasiBelumBayar as $reservasi)
                                            <option value="{{ $reservasi->id }}">{{ $reservasi->id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button id="simpanButton" type="button" class="btn btn-primary btn-block"
                                    style="text-shadow: none">Bayar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <script src="/frontend/assets/vendors/jquery/jquery.min.js"></script>
    <script src="/frontend/assets/js/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#simpanButton").click(function() {

                var nama_pengirim = $("#nama_pengirim").val();
                var foto_bukti_pembayaran = $("#foto_bukti_pembayaran").val();
                var maxNamaPengirimLength = 50;

                if (nama_pengirim.length == 0) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Nama pengirim tidak boleh kosong!',
                        icon: "warning",

                    });
                    return;
                } else if (!isNaN(nama_pengirim)) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Nama pengirim tidak valid!',
                        icon: "warning",
                    });
                    return;
                } else if (nama_pengirim.length > maxNamaPengirimLength) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Nama pengirim tidak boleh melebihi ' + maxNamaPengirimLength +
                            ' karakter!',
                        icon: "warning",
                    });
                    return;
                }

                if (foto_bukti_pembayaran.length == 0) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Upload foto bukti pembayaran anda!',
                        icon: "warning",
                    });
                    return;
                }
                // Jika berhasil, submit form
                $("#simpanForm").submit();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#jumlah_pembayaran").on("input", function() {
                // Dapatkan nilai input
                let nilaiInput = $(this).val();

                // Hapus tanda titik dari nilai input (jika ada)
                nilaiInput = nilaiInput.replace(/\./g, '');

                // Format angka dengan menambahkan tanda titik sebagai pemisah ribuan
                let formattedValue = parseFloat(nilaiInput).toLocaleString('id-ID');

                // Atur kembali nilai input dengan format yang telah diformat
                $(this).val(formattedValue);
            });
        });
    </script>
@endsection
