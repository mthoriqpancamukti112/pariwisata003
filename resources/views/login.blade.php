<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="/frontend/assets/images/logo-wisata.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Wisata Kuliner - Log in</title>

    <link href="/frontend/assets/vendors/fontawesome/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="/frontend/assets/css/sb-admin-2.min.css" rel="stylesheet" />
    <script src="/frontend/assets/js/sweetalert2.all.min.js"></script>
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

        body {
            background-image: url('/frontend/assets/images/banner.jpg');
            background-position: center;
            background-size: cover;
        }

        @media (max-width: 768px) {
            .form-control {
                width: 100%;
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
    <div class="container login-form">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12">
                <div class="card o-hidden border-0 shadow-lg my-5"
                    style="background-image: url('/frontend/assets/images/login_bg.jpg'); background-size: cover; background-position: center">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <div class="row align-items-center mt-4">
                                    <div class="container text-center text-gray-900">
                                        <img src="/frontend/assets/images/logo-wisata.png" alt=""
                                            class="img-fluid" width="90%">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-4">
                                    <div class="text-center">
                                        <h1 class="h4 mb-4" style="font-weight: bold; color: black">LOGIN</h1>
                                    </div>

                                    @if ($errors->any())
                                        <script>
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Oops...',
                                                text: '{{ $errors->first('email') }}'
                                            });
                                        </script>
                                    @endif

                                    <form id="loginForm" action="/login-post" method="post" class="user form-login">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                placeholder="Email" name="email" id="user">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password"
                                                name="password" placeholder="Password">
                                        </div>
                                        <button type="button" id="loginButton"
                                            class="btn btn-primary btn-user btn-block">Masuk</button>
                                        <a href="{{ url('/beranda') }}" type="button"
                                            class="btn btn-danger btn btn-user btn-block">Batal</a>
                                        <div class="text-center" style="margin-top: 15px; color: black">
                                            Belum punya akun? <a href="{{ url('/register') }}">Daftar</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <script src="/frontend/assets/vendors/jquery/jquery.min.js"></script>
    <script src="/frontend/assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/frontend/assets/vendors/jquery-easing/jquery.easing.min.js"></script>
    <script src="/frontend/assets/js/sb-admin-2.min.js"></script>
    <script>
        $(document).ready(function() {

            $("#loginButton").click(function() {

                var email = $("#user").val();
                var password = $("#password").val();
                var isEmailValid = /\b[A-Za-z0-9._%+-]+@gmail\.com\b/.test(email);

                // Validasi Email dan Password
                if (email.length == 0 && password.length == 0) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Email dan password tidak boleh kosong!',
                        icon: 'warning',
                    });
                    return;
                }

                // Validasi Email
                if (email.length == 0) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Email tidak boleh kosong!',
                        icon: 'warning',
                    });
                    return;
                }

                if (!isEmailValid) {

                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Email tidak valid!',
                        icon: "warning",
                    });
                    return;
                }

                // Validasi Password
                if (password.length == 0) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Password tidak boleh kosong!',
                        icon: 'warning',
                    });
                    return;
                }

                // Jika berhasil, submit form
                $("#loginForm").submit();

            });

        });
    </script>
</body>

</html>
