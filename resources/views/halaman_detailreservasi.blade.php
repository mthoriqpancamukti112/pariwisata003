@extends('layout.fe.template')
@section('title', 'Tambah Reservasi')
@section('content')

    <link rel="stylesheet" href="/frontend/assets/css/flatpickr.min.css">

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
        label,
        div {
            font-family: "PlusJakartaSans";
        }

        @media (max-width: 768px) {
            .ml-6 {
                padding-left: 30px;
                padding-right: 30px;
            }
        }
    </style>

    <section>
        <div style="margin-top: 30px" class="container">
            <div class="section-title" data-aos="fade-up" data-aos-delay="100">
                <h2 style="font-size: 16px; color: black;">Reservasi {{ $kuliner->tempat_kuliner }}</h2>
            </div>
            <div class="container" style="margin-bottom: 50px; margin-top: 20px" data-aos="fade-up" data-aos-delay="200">
                <ul>
                    <li>
                        <h6>Harap Isi form dibawah dengan benar untuk membuat reservasi</h6>
                    </li>
                    <li>
                        <h6>Pastikan nomor HP terhubung dengan WhatsApp untuk memudahkan komunikasi dengan Admin</h6>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="ml-6 mr-6">
                        <form id="simpanForm" method="post" action="{{ route('simpan_reservasi') }}">
                            @csrf
                            <input type="hidden" name="id_tempat" value="{{ $kuliner->id }}">
                            <div class="form-group">
                                <label for="nama_pengunjung">Nama Pengunjung</label>
                                <input type="text" class="form-control" id="nama_pengunjung"
                                    placeholder="Masukan nama lengkap" name="nama_pengunjung"
                                    value="{{ old('nama_pengunjung') }}">
                            </div>
                            <div class="form-group">
                                <label for="no_hp">Nomor HP/WA Aktif</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp"
                                    placeholder="Masukan no hp/wa yang masih aktif" value="{{ old('no_hp') }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Masukan email yang aktif" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label for="tgl_pesan">Tanggal Reservasi</label>
                                <input type="text" class="form-control flatpickr" id="tgl_pesan" name="tgl_pesan">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_orang">Jumlah Tamu</label>
                                <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang"
                                    placeholder="Masukan jumlah tamu" value="{{ old('jumlah_orang') }}">
                            </div>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="ml-6 mr-6">
                        <div class="form-group">
                            <label for="id_meja">Nomor Meja</label>
                            <select name="id_meja" class="form-select" id="id_meja">
                                <option value="" disabled selected>Pilih Meja</option>
                                <!-- Meja akan dimuat melalui JavaScript -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_metode_pembayaran">Metode Pembayaran</label>
                            <select name="id_metode_pembayaran" id="id_metode_pembayaran" class="form-select">
                                <option value="" disabled selected>Pilih Metode Pembayaran</option>
                                @foreach ($metodePembayaran as $metode)
                                    <option value="{{ $metode->id }}">{{ $metode->nama_metode }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div id="detailMetodePembayaran">
                                <div class="card col-lg-12 p-3">
                                    <div class="info mb-1">
                                        <span class="label">Nomor</span>
                                        <span>:</span>&ensp;
                                        <span id="nomorDetail"></span>
                                    </div>
                                    <div class="info mb-1">
                                        <span class="label">Nama Penerima</span>
                                        <span>:</span>&ensp;
                                        <span id="namaDetail"></span>
                                    </div>
                                    <div class="info mb-1">
                                        <span class="label">Total Biaya</span>
                                        <span>:</span>&ensp;Rp.
                                        <span id="biayaDetail"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="button" id="simpanButton" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>

    <script src="/frontend/assets/vendors/jquery/jquery.min.js"></script>
    <script src="/frontend/assets/js/sweetalert2.all.min.js"></script>
    <script src="/frontend/assets/js/flatpickr.js"></script>
    <script>
        $(document).ready(function() {
            // Mengatur nilai default input tanggal reservasi dengan waktu saat ini
            var now = new Date();
            var currentDate = now.getDate();
            var currentMonth = now.getMonth() + 1;
            var currentYear = now.getFullYear();
            var currentHour = now.getHours();
            var currentMinute = now.getMinutes();

            var formattedDate = (currentDate < 10 ? '0' : '') + currentDate + '-' + (currentMonth < 10 ? '0' : '') +
                currentMonth + '-' + currentYear + ' ' + (currentHour < 10 ? '0' : '') + currentHour + ':' + (
                    currentMinute < 10 ? '0' : '') + currentMinute;

            $('#tgl_pesan').val(formattedDate);

            flatpickr('.flatpickr', {
                enableTime: true,
                dateFormat: "d-m-Y H:i",
                minDate: "today",
            });

            $("#simpanButton").click(function() {
                var nama_pengunjung = $("#nama_pengunjung").val();
                var no_hp = $("#no_hp").val();
                var email = $("#email").val();
                var tgl_pesan = $("#tgl_pesan").val();
                var jumlah_orang = $("#jumlah_orang").val();
                var kapasitasMeja = parseInt($("select[name='id_meja'] option:selected").text().split('-')
                    .pop().trim());
                var id_metode_pembayaran = $("select[name='id_metode_pembayaran']").val();
                var id_meja = $("select[name='id_meja']").val();

                var isNumeric = /^[0-9]+$/.test(no_hp);
                var isMaxLength = no_hp.length <= 13;
                var isLengthValid = no_hp.length >= 12 && no_hp.length <= 13;
                var urlKapasitasMeja = "/get-kapasitas-meja";
                var isEmailValid = /\b[A-Za-z0-9._%+-]+@gmail\.com\b/.test(email);

                if (parseInt(jumlah_orang) > kapasitasMeja) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Jumlah tamu melebihi kapasitas meja yang dipilih!',
                        icon: "error",
                    });
                    return;
                }

                if (nama_pengunjung.length == 0) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Nama pengunjung tidak boleh kosong!',
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

                if (tgl_pesan.length == 0) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Tanggal pesan tidak boleh kosong!',
                        icon: "warning",
                    });
                    return;
                }
                if (jumlah_orang.length == 0) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Jumlah tidak boleh kosong!',
                        icon: "warning",
                    });
                    return;
                }

                if (jumlah_orang.length == 0 || parseInt(jumlah_orang) <= 0) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Jumlah harus lebih dari 1!',
                        icon: "warning",
                    });
                    return;
                }

                if (id_meja == null) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Pilih nomor meja!',
                        icon: "warning",
                    });
                    return;
                }

                if (id_metode_pembayaran == null) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Pilih metode pembayaran!',
                        icon: "warning",
                    });
                    return;
                }

                // Submit form
                $.ajax({
                    url: $("#simpanForm").attr("action"),
                    type: $("#simpanForm").attr("method"),
                    data: $("#simpanForm").serialize(),
                    success: function(response) {
                        $("#simpanForm")[0].reset();
                        $("#nomorDetail").text('');
                        $("#namaDetail").text('');
                        $("#biayaDetail").text('');

                        Swal.fire({
                            text: 'Reservasi berhasil disimpan!',
                            icon: "success",
                        }).then(function() {
                            window.location.href = '/halaman-reservasi';
                        });
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON.error;
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: errorMessage,
                            icon: "error",
                        });
                    }
                });
            });

            // AJAX untuk mendapatkan meja yang tersedia berdasarkan id_tempatkuliner
            function loadAvailableTables() {
                var id_tempatkuliner = $("input[name='id_tempat']").val();
                $.ajax({
                    url: '/get-meja-tersedia/' +
                        id_tempatkuliner, // Endpoint untuk mendapatkan meja yang tersedia
                    type: 'GET',
                    success: function(data) {
                        var mejaDropdown = $("#id_meja");
                        mejaDropdown.empty();
                        mejaDropdown.append('<option value="" disabled selected>Pilih Meja</option>');
                        data.forEach(function(meja) {
                            var disabled = meja.status === 'Full' ? 'disabled' : '';
                            mejaDropdown.append('<option value="' + meja.id + '" ' + disabled +
                                '>' + meja.nama_meja + ' - ' + meja.jumlah +
                                ' kursi</option>');
                        });
                    }
                });
            }

            loadAvailableTables(); // Memanggil fungsi untuk memuat meja yang tersedia

            $("#id_metode_pembayaran").change(function() {
                var selectedMetodeId = $(this).val();
                $.ajax({
                    url: "/get-metode-pembayaran/" + selectedMetodeId,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        $("#nomorDetail").text(response.nomor);
                        $("#namaDetail").text(response.nama);
                        $("#biayaDetail").text(response.biaya_formatted);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
