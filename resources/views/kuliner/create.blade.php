@extends('layout.be.template')
@section('title', 'Tambah Kuliner')
@section('content')
    <link rel="stylesheet" href="/frontend/assets/css/jquery-ui.css">
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="col-xs-12">
                    <div class="page-header text-center">
                        <h1 class="mt-4">
                            Tambah Data Kuliner
                        </h1>
                    </div>
                    <div class="row">
                        <form id="simpanForm" action="{{ route('kuliner.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="m-5">
                                <div class="form-group mb-3">
                                    <label for="image">Gambar</label>
                                    <input type="file" name="image" class="form-control" value="{{ old('image') }}"
                                        autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tempat_kuliner">Tempat Kuliner</label>
                                    <input type="text" name="tempat_kuliner" class="form-control"
                                        value="{{ old('tempat_kuliner') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Kategori</label>
                                    <select name="id_kategori" id="" class="form-select">
                                        <option value="" disabled selected>-- Pilih Kategori --</option>
                                        @foreach ($data_kategor as $row)
                                            <option value="{{ $row->id }}">{{ $row->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea id="deskripsi" name="deskripsi" class="autosize-transition form-control">{{ old('deskripsi') }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="lokasi">Lokasi</label>
                                    <textarea id="lokasi" name="lokasi" class="autosize-transition form-control">{{ old('lokasi') }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jam_operasional">Jam Operasional</label>
                                    <input type="text" name="jam_operasional" class="form-control"
                                        value="{{ old('jam_operasional') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="fasilitas">Fasilitas</label>
                                    <input type="text" name="fasilitas" class="form-control"
                                        value="{{ old('fasilitas') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kontak">No HP Admin Kuliner</label>
                                    <input type="text" name="kontak" class="form-control" value="{{ old('kontak') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="galeri">Galeri</label>
                                    <input type="file" name="galeri[]" class="form-control" multiple>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tgl_upload">Tanggal Upload</label>
                                    <input type="text" name="tgl_upload" id="tgl_upload" class="form-control datepicker"
                                        value="{{ old('tgl_upload') }}">
                                </div>
                                <button type="button" id="simpanButton" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('kuliner.index') }}" class="btn btn-danger">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/frontend/assets/vendors/jquery/jquery.min.js"></script>
    <script src="/frontend/assets/js/jquery-ui.min.js"></script>
    <script src="/frontend/assets/js/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#simpanButton").click(function() {

                var image = $("input[name='image']").val();
                var tempat_kuliner = $("input[name='tempat_kuliner']").val();
                var id_kategori = $("select[name='id_kategori']").val();
                var deskripsi = $("textarea[name='deskripsi']").val();
                var lokasi = $("textarea[name='lokasi']").val();
                var jam_operasional = $("input[name='jam_operasional']").val();
                var fasilitas = $("input[name='fasilitas']").val();
                var kontak = $("input[name='kontak']").val();
                var galeri = $("input[name='galeri[]']").val();
                var tgl_upload = $("input[name='tgl_upload']").val();

                // Validasi nomor telepon harus berisi angka dan max 13 karakter
                var isNumeric = /^[0-9]+$/.test(kontak);
                var isMaxLength = kontak.length <= 13;
                var isLengthValid = kontak.length >= 11 && kontak.length <= 13;

                if (image == '') {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Gambar tidak boleh kosong!',
                        icon: "warning",
                    });
                    return;
                }

                if (tempat_kuliner == '') {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Tempat Kuliner tidak boleh kosong!',
                        icon: "warning",
                    });
                    return;
                }

                if (!isNaN(tempat_kuliner)) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Tempat Kuliner tidak valid!',
                        icon: "warning",
                    });
                    return;
                }

                if (id_kategori == undefined) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Pilih kategori!',
                        icon: "warning",
                    });
                    return;
                }

                if (deskripsi == '') {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Deskripsi tidak boleh kosong!',
                        icon: "warning",
                    });
                    return;
                }

                if (lokasi == '') {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Lokasi tidak boleh kosong!',
                        icon: "warning",
                    });
                    return;
                }

                if (jam_operasional == '') {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Jam Operasional tidak boleh kosong!',
                        icon: "warning",
                    });
                    return;
                }

                if (fasilitas == '') {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Fasilitas tidak boleh kosong!',
                        icon: "warning",
                    });
                    return;
                }

                if (kontak == '') {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Kontak tidak boleh kosong!',
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

                if (galeri == '') {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Galeri tidak boleh kosong!',
                        icon: "warning",
                    });
                    return;
                }

                if (tgl_upload == '') {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Tanggal Upload tidak boleh kosong!',
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
            $('#tgl_upload').datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true
            });
        });
    </script>
@endsection
