@extends('layout.be.template')
@section('title', 'Tambah Metode Pembayaran')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="col-xs-12">
                    <div class="page-header text-center">
                        <h1 class="mt-4">
                            Tambah Data Metode Pembayaran
                        </h1>
                    </div>
                    <div class="col-xs-4">
                        <form id="simpanForm" action="{{ route('metodepembayaran.store') }}" method="POST">
                            @csrf
                            <div class="m-5">
                                <div class="form-group mb-3">
                                    <label for="">ID Kuliner</label>
                                    <select name="kuliner_id" id="" class="form-select">
                                        <option value="" disabled selected>-- Pilih Kuliner --</option>
                                        @foreach ($data_kuliner as $row)
                                            <option value="{{ $row->id }}">{{ $row->tempat_kuliner }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama_metode">Metode Pembayaran</label>
                                    <input type="text" name="nama_metode" class="form-control"
                                        value="{{ old('nama_metode') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nomor">Nomor</label>
                                    <input type="text" name="nomor" class="form-control" value="{{ old('nomor') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="biaya">Biaya Uang Muka / DP</label>
                                    <input type="number" name="biaya" class="form-control" value="{{ old('biaya') }}">
                                </div>
                                <button type="button" id="simpanButton" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('metodepembayaran.index') }}" class="btn btn-danger">Batal</a>
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
                var kuliner_id = $("select[name='kuliner_id']").val();
                var nama_metode = $("input[name='nama_metode']").val();
                var nomor = $("input[name='nomor']").val();
                var nama = $("input[name='nama']").val();
                var biaya = $("input[name='biaya']").val();

                if (kuliner_id == null) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Kuliner harus dipilih!',
                        icon: "warning",
                    });
                    return;
                }

                if (nama_metode == "") {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Metode pembayaran tidak boleh kosong!',
                        icon: "warning",
                    });
                    return;
                }

                if (nomor == "") {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Nomr tidak boleh kosong!',
                        icon: "warning",
                    });
                    return;
                }

                if (nama == "") {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Nama tidak boleh kosong!',
                        icon: "warning",
                    });
                    return;
                }

                if (biaya == "") {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Biaya tidak boleh kosong!',
                        icon: "warning",
                    });
                    return;
                }

                $("#simpanForm").submit();
            });
        });
    </script>
@endsection
