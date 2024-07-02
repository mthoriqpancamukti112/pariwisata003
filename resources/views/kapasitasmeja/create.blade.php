@extends('layout.be.template')
@section('title', 'Tambah Kapasitas Meja')
@section('content')
    <link rel="stylesheet" href="/frontend/assets/css/jquery-ui.css">
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="col-xs-12">
                    <div class="page-header text-center">
                        <h1 class="mt-4">
                            Tambah Data Kapasitas Meja
                        </h1>
                    </div>
                    <div class="col-xs-4">
                        <form id="simpanForm" action="{{ route('kapasitasmeja.store') }}" method="POST">
                            @csrf
                            <div class="m-5">
                                <div class="form-group mb-3">
                                    <label for="">Kuliner</label>
                                    <select name="kuliner_id" id="" class="form-select">
                                        <option value="" disabled {{ old('kuliner_id') == '' ? 'selected' : '' }}>--
                                            Pilih Kuliner --</option>
                                        @foreach ($data_kuliner as $row)
                                            <option value="{{ $row->id }}"
                                                {{ old('kuliner_id') == $row->id ? 'selected' : '' }}>
                                                {{ $row->tempat_kuliner }}</option>
                                        @endforeach
                                    </select>
                                    @error('kuliner_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama_meja">Nama Meja</label>
                                    <input type="text" name="nama_meja" class="form-control"
                                        value="{{ old('nama_meja') }}">
                                    @error('nama_meja')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah') }}">
                                    @error('jumlah')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="button" id="simpanButton" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('kapasitasmeja.index') }}" class="btn btn-danger">Batal</a>
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
                var nama_meja = $("input[name='nama_meja']").val();
                var jumlah = $("input[name='jumlah']").val();

                if (kuliner_id == null) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Pilih Kuliner!',
                    });
                    return;
                }

                if (nama_meja == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Nama Meja tidak boleh kosong!',
                    });
                    return;
                }

                if (jumlah == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Jumlah tidak boleh kosong!',
                    });
                    return;
                }

                // Jika berhasil, submit form
                $.ajax({
                    type: 'POST',
                    url: "{{ route('kapasitasmeja.store') }}",
                    data: $("#simpanForm").serialize(),
                    success: function(response) {
                        // Redirect ke halaman terkait dengan pesan sukses
                        window.location.href = "{{ route('kapasitasmeja.index') }}";
                    },
                    error: function(xhr) {
                        // Tangkap pesan error dari response
                        var errorMessage = JSON.parse(xhr.responseText).message;
                        // Tampilkan pesan error menggunakan SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errorMessage,
                        });
                    }
                });
            });
        });
    </script>
@endsection
