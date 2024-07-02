@extends('layout.fe.template')
@section('title', 'Edit Profile')
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
            .mt-5 {
                margin-left: 25px;
                margin-right: 25px;
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
    <main>
        <section>
            <div class="container" data-aos="fade-up">
                <form id="simpanForm" action="{{ route('profil.update', ['profil' => $user]) }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="mt-5">
                        @csrf
                        @method('patch')
                        <div class="form-group mb-3">
                            <label>Gambar Profile</label>
                            @if ($user->image)
                                <img src="/images_profile/{{ $user->image }}" width="100" alt="">
                            @else
                                <br>
                                <img src="{{ asset('/frontend/assets/images/icon_profil.png') }}" height="100"
                                    alt="">
                            @endif
                            <input type="file" name="image" class="form-control mt-2">
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="no_hp">No HP</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ $user->no_hp }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat" class="autosize-transition form-control">{{ $user->alamat }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Jenis Kelamin:</label>
                            <div style="float: right">
                                <input type="radio" id="laki_laki" name="jenis_kelamin" value="Laki-laki"
                                    {{ $user->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }}>
                                <label for="laki_laki">Laki-laki</label>&ensp;
                                <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan"
                                    {{ $user->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}>
                                <label for="perempuan">Perempuan</label>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="{{ $user->password }}">
                        </div>
                        <div class="form-group mb-3" style="display: none">
                            <label for="">Hak Akses</label>
                            <select name="hak_akses" id="" class="form-select">
                                <option value="Admin" {{ $user->hak_akses == 'Admin' ? 'selected' : '' }}>
                                    Admin</option>
                                <option value="User" {{ $user->hak_akses == 'User' ? 'selected' : '' }}>
                                    User</option>
                                <option value="Pengunjung" {{ $user->hak_akses == 'Pengunjung' ? 'selected' : '' }}>
                                    Pengunjung
                                </option>
                            </select>

                        </div>
                        <button type="button" id="simpanButton" class="btn btn-success">Simpan</button>
                        <a href="{{ route('halaman-profil') }}" type="button" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <script src="/frontend/assets/vendors/jquery/jquery.min.js"></script>
    <script src="/frontend/assets/js/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#simpanButton").click(function() {

                var name = $("input[name='name']").val();
                var no_hp = $("input[name='no_hp']").val();
                var email = $("input[name='email']").val();
                var alamat = $("textarea[name='alamat']").val();
                var jenis_kelamin = $("input[name='jenis_kelamin']:checked").val();
                var password = $("input[name='password']").val().trim();

                // Validasi nomor telepon harus berisi angka dan max 13 karakter
                var isNumeric = /^[0-9]+$/.test(no_hp);
                var isMaxLength = no_hp.length <= 13;
                var isLengthValid = no_hp.length >= 11 && no_hp.length <= 13;

                // Validasi alamat email harus berakhiran dengan '@gmail.com'
                var isEmailValid = /\b[A-Za-z0-9._%+-]+@gmail\.com\b/.test(email);

                if (name.length == 0) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Nama tidak boleh kosong!',
                        icon: "warning",

                    });
                    return;
                }
                if (no_hp.length == 0) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'No HP tidak boleh kosong!',
                        icon: "warning",
                    });
                    return;
                }
                if (!isNumeric) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'No HP harus berisi angka!',
                        icon: "warning",
                    });
                    return;
                }
                if (!isMaxLength) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'No HP tidak valid!',
                        icon: "warning",
                    });
                    return;
                }
                if (!isLengthValid) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'No HP tidak valid!',
                        icon: "warning",
                    });
                    return;
                }
                if (alamat.length == 0) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Alamat tidak boleh kosong!',
                        icon: "warning",
                    });
                    return;
                }
                if (jenis_kelamin == undefined) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Pilih jenis kelamin!',
                        icon: "warning",
                    });
                    return;
                }
                if (email.length == 0) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Email tidak boleh kosong!',
                        icon: "warning",
                    });
                    return;
                }
                if (password.length == 0) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Password tidak boleh kosong!',
                        icon: "warning",
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
                if (!isEmailValid) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Email tidak valid!',
                        icon: "warning",
                    });
                    return;
                }
                // Jika berhasil, submit form
                $("#simpanForm").submit();
            });
        });
    </script>
@endsection
