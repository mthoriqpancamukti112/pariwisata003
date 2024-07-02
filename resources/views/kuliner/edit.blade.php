@extends('layout.be.template')
@section('title', 'Edit Kuliner')
@section('content')
    <link rel="stylesheet" href="/frontend/assets/css/jquery-ui.css">
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="col-xs-12">
                    <div class="page-header text-center">
                        <h1 class="mt-4">
                            Edit Data Kuliner
                        </h1>
                    </div>
                    <div class="col-xs-4">
                        <form id="simpanForm" action="{{ route('kuliner.update', $kuliner->id) }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="m-5">
                                @csrf
                                @method('patch')
                                <div class="form-group mb-3">
                                    <label>Gambar</label>
                                    <input type="file" name="image" class="form-control">
                                    <img src="/images_kuliner/{{ $kuliner->image }}" width="300px">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tempat_kuliner">Tempat Kuliner</label>
                                    <input type="text" name="tempat_kuliner" class="form-control"
                                        value="{{ $kuliner->tempat_kuliner }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Kategori</label>
                                    <select name="id_kategori" id="" class="form-select">
                                        <option disabled value="">-- Pilih Kategori --</option>
                                        @foreach ($data_kategor as $row)
                                            <option value="{{ $row->id }}"
                                                {{ $kuliner->kategor->id == $row->id ? 'selected' : '' }}>
                                                {{ $row->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="deskripsi">Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control"
                                        value="{{ $kuliner->deskripsi }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="lokasi">Lokasi</label>
                                    <textarea id="lokasi" name="lokasi" class="autosize-transition form-control">{{ $kuliner->lokasi }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jam_operasional">Jam Operasional</label>
                                    <input type="text" name="jam_operasional" class="form-control"
                                        value="{{ $kuliner->jam_operasional }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="fasilitas">Fasilitas</label>
                                    <input type="text" name="fasilitas" class="form-control"
                                        value="{{ $kuliner->fasilitas }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kontak">Kontak</label>
                                    <input type="text" name="kontak" class="form-control"
                                        value="{{ $kuliner->kontak }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Galeri</label>
                                    <input type="file" name="galeri[]" class="form-control" multiple>
                                    @if ($kuliner->galeri)
                                        @foreach (json_decode($kuliner->galeri) as $galleryImage)
                                            <img src="/galeri_kuliner/{{ $galleryImage }}" width="300px">
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tgl_upload">Tanggal Upload</label>
                                    <input type="text" name="tgl_upload" id="tgl_upload" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($kuliner->tgl_upload)->locale('id')->isoFormat('D MMMM YYYY') }}">
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

                var tempat_kuliner = $("input[name='tempat_kuliner']").val();
                var id_kategori = $("select[name='id_kategori']").val();
                var deskripsi = $("textarea[name='deskripsi']").val();
                var lokasi = $("textarea[name='lokasi']").val();
                var jam_operasional = $("input[name='jam_operasional']").val();
                var fasilitas = $("input[name='fasilitas']").val();
                var kontak = $("input[name='kontak']").val();
                var tgl_upload = $("input[name='tgl_upload']").val();

                // Validasi nomor telepon harus berisi angka dan max 13 karakter
                var isNumeric = /^[0-9]+$/.test(kontak);
                var isMaxLength = kontak.length <= 13;
                var isLengthValid = kontak.length >= 11 && kontak.length <= 13;

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
                dateFormat: 'dd MM yy',
                changeMonth: true,
                changeYear: true,
                monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                    'September', 'Oktober', 'November', 'Desember'
                ],
                monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt',
                    'Nov', 'Des'
                ]
            });
        });
    </script>
@endsection
