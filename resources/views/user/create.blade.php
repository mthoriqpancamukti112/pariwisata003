@extends('layout.be.template')
@section('title', 'Pengguna')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="col-lg-12">
                    <div class="page-header text-center">
                        <h1 class="mt-4">
                            Tambah Data Pengguna
                        </h1>
                    </div>
                    <div class="col-xs-4">
                        <form id="simpanForm" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="m-5">
                                <div class="form-group mb-3">
                                    <label for="name">Gambar Profile</label>
                                    <input type="file" name="image" class="form-control" value="{{ old('image') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="no_hp">No HP</label>
                                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="alamat">Alamat</label>
                                    <textarea id="lokasi" name="alamat" class="autosize-transition form-control">{{ old('alamat') }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Jenis Kelamin:</label>
                                    <div style="float: right">
                                        <input type="radio" id="laki_laki" name="jenis_kelamin" value="Laki-laki">
                                        <label for="laki_laki">Laki-laki</label>&ensp;
                                        <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan">
                                        <label for="perempuan">Perempuan</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Hak Akses</label>
                                    <select name="hak_akses" id="" class="form-select">
                                        <option value="" disabled selected>-- Pilih --</option>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                                <button type="button" id="simpanButton" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('user.index') }}" class="btn btn-danger">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/frontend/assets/vendors/jquery/jquery.min.js"></script>
    <script src="/frontend/assets/js/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#simpanButton").click(function() {

                var image = $("input[name='image']").val();
                var name = $("input[name='name']").val();
                var no_hp = $("input[name='no_hp']").val();
                var email = $("input[name='email']").val();
                var alamat = $("textarea[name='alamat']").val();
                var jenis_kelamin = $("input[name='jenis_kelamin']:checked").val();
                var password = $("input[name='password']").val();
                var hak_akses = $("select[name='hak_akses']").val();

                // Validasi nomor telepon harus berisi angka dan max 13 karakter
                var isNumeric = /^[0-9]+$/.test(no_hp);
                var isMaxLength = no_hp.length <= 13;
                var isLengthValid = no_hp.length >= 11 && no_hp.length <= 13;

                // Validasi alamat email harus berakhiran dengan '@gmail.com'
                var isEmailValid = /\b[A-Za-z0-9._%+-]+@gmail\.com\b/.test(email);

                if (image == '') {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Gambar tidak boleh kosong!',
                        icon: "warning",
                    });
                    return;
                }

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
                if (!isEmailValid) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Email tidak valid!',
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
                if (hak_akses == null) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Pilih hak akses!',
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
