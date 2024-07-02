<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="/frontend/assets/images/logo-wisata.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <title>Wisata Kuliner - Register</title>
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

        ::-webkit-input-placeholder {
            font-size: 0.8em;
        }

        ::-moz-placeholder {
            font-size: 0.8em;
        }

        :-ms-input-placeholder {
            font-size: 0.8em;
        }

        :-moz-placeholder {
            font-size: 0.8em;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            height: 45px;
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

    <link href="/frontend/assets/vendors/fontawesome/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="/frontend/assets/css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5"
                    style="background-image: url('/frontend/assets/images/login_bg.jpg'); background-size: cover; background-position: center">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <div class="row align-items-center mt-5">
                                    <div class="container text-center text-gray-900 mt-5">
                                        <img src="{{ url('/frontend/assets/images/logo-wisata.png') }}" alt=""
                                            class="img-fluid" width="90%">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-4">
                                    <div class="text-center">
                                        <h1 class="h4 mb-4" style="font-weight: bold; color: black">
                                            REGISTER</h1>
                                    </div>
                                    <form id="register-form" method="POST" action="{{ route('register.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" style="border-radius: 20px"
                                                class="form-control form-control-user" placeholder="Username"
                                                name="name" id="name">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" style="border-radius: 20px"
                                                class="form-control form-control-user" placeholder="No HP"
                                                name="no_hp" id="no_hp">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" style="border-radius: 20px"
                                                class="form-control form-control-user" placeholder="Alamat"
                                                name="alamat" id="alamat">
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin:</label>
                                            <div style="float: right">
                                                <input type="radio" id="laki_laki" name="jenis_kelamin"
                                                    value="Laki-laki">
                                                <label for="laki_laki">Laki-laki</label> &ensp;
                                                <input type="radio" id="perempuan" name="jenis_kelamin"
                                                    value="Perempuan">
                                                <label for="perempuan">Perempuan</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" style="border-radius: 20px"
                                                class="form-control form-control-user" placeholder="Email"
                                                name="email" id="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" style="border-radius: 20px"
                                                class="form-control form-control-user" id="password" name="password"
                                                placeholder="Password">
                                        </div>
                                        <button type="submit" style="border-radius: 20px"
                                            class="btn btn-register btn-block btn-success">Daftar</button>
                                    </form>
                                    <div class="text-center" style="margin-top: 15px; color: black">
                                        Sudah punya akun? <a href="/login">Silahkan Login</a>
                                    </div>
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
    <script src="/frontend/assets/js/sweetalert2.all.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#register-form").submit(function(event) {
                event.preventDefault(); // Menghentikan pengiriman form secara default

                // Validasi input sebelum pengiriman
                var name = $("#name").val();
                var no_hp = $("#no_hp").val();
                var alamat = $("#alamat").val();
                var jenis_kelamin = $("input[name='jenis_kelamin']:checked").val();
                var email = $("#email").val();
                var password = $("#password").val();

                function validateEmail(email) {
                    var re = /\S+@\S+\.\S+/;
                    return re.test(email);
                }

                function validatePhoneNumber(phoneNumber) {
                    var regex = /^[0-9]{12,13}$/;
                    return regex.test(phoneNumber);
                }

                if (name.trim() == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Nama harus diisi.'
                    });
                    return;
                }
                if (no_hp.trim() == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Nomor HP harus diisi.'
                    });
                    return;
                }
                if (!validatePhoneNumber(no_hp)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Nomor HP tidak valid!'
                    });
                    return;
                }
                if (alamat.trim() == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Alamat harus diisi.'
                    });
                    return;
                }
                if (jenis_kelamin === undefined) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Jenis kelamin harus dipilih.'
                    });
                    return;
                }
                if (email.trim() == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Email harus diisi.'
                    });
                    return;
                }
                if (!validateEmail(email)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Format email tidak valid.'
                    });
                    return;
                }
                if (password.trim() == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Password harus diisi.'
                    });
                    return;
                }
                if (password.length < 8) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Password harus memiliki panjang minimal 8 karakter!'
                    });
                    return;
                }

                // Jika semua validasi berhasil, kirim data menggunakan AJAX
                var formData = $(this).serialize(); // Mengambil data form
                $.ajax({
                    url: $(this).attr('action'), // Ambil URL dari atribut action form
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            // Tampilkan alert jika penyimpanan berhasil
                            Swal.fire({
                                type: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success',
                            }).then(function() {
                                // Membersihkan nilai input setelah pesan sukses
                                $("#name").val('');
                                $("#no_hp").val('');
                                $("#alamat").val('');
                                $("input[name='jenis_kelamin']").prop('checked', false);
                                $("#email").val('');
                                $("#password").val('');
                            });
                        } else {
                            // Tampilkan aler jika penyimpanan gagal
                            Swal.fire({
                                type: 'error',
                                title: 'Gagal!',
                                text: response.message
                            });
                        }
                    },
                    error: function(response) {
                        // Tangani kesalahan jika terjadi
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Alamat email sudah digunakan!'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
