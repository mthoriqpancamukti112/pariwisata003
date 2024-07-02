<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pembayaran Berhasil</title>
    <link href="/frontend/assets/vendors/fontawesome/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="/frontend/assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
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
            .mobile-image {
                max-width: 100%;
                height: auto;
            }

            .swal2-container {
                font-size: 8px;
            }

            .swal2-title {
                font-size: 18px;
            }

            .swal2-content {
                font-size: 8px;
            }

            .swal2-actions {
                font-size: 12px;
            }

            .swal2-popup {
                max-width: 280px;
                width: 70%;
            }
        }
    </style>
</head>

<body>
    <main id="main">
        <section>
            <div class="container" data-aos="fade-up" style="padding-left: 30px; padding-right: 30px;">
                <div class="row justify-content-center align-items-center" id="reviewSection">
                    <div style="text-align: center; margin-top: 30px">
                        <img src="/frontend/assets/images/sukses.jpg" alt="Pembayaran Berhasil" class="mobile-image"
                            style="width: 500px; height: auto; margin-bottom: 15px">
                        <h4>Pembayaran anda berhasil, admin akan menghubungi nomor hp yang anda masukan,</h4>
                        <h4 class="mb-5">Mohon tunggu konfirmasi dari admin</h4>
                        <a href="{{ route('halaman-reservasi') }}" type="button" class="btn btn-primary mb-5">Kembali
                            ke
                            Reservasi anda</a>
                    </div>
                </div>
        </section>
    </main>
    <script src="/frontend/assets/js/sweetalert2.all.min.js"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "Pembayaran berhasil.",
                showConfirmButton: false,
                timer: 1500
            });
        @endif
    </script>
</body>

</html>
