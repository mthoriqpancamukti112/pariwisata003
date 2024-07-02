@extends('layout.be.template')
@section('title', 'Tambah Makanan')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="col-xs-12">
                    <div class="page-header text-center">
                        <h1 class="mt-4">
                            Tambah Data Menu Makanan
                        </h1>
                    </div>
                    <div class="col-xs-4">
                        <form id="simpanForm" action="{{ route('makanans.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="m-5">
                                <div class="form-group mb-3">
                                    <label for="image">Gambar</label>
                                    <input type="file" name="image" class="form-control" value="{{ old('image') }}"
                                        autofocus>
                                </div>
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
                                    <label for="nama">Nama Makanan</label>
                                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                                </div>
                                <button type="button" id="simpanButton" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('makanans.index') }}" class="btn btn-danger">Batal</a>
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
                var kuliner_id = $("select[name='kuliner_id']").val();
                var nama = $("input[name='nama']").val();

                // Validasi apakah gambar telah dipilih
                if (image == "") {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Gambar harus dipilih!',
                        icon: "warning",
                    });
                    return;
                }

                // Validasi pemilihan kuliner
                if (kuliner_id == null) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Kuliner harus dipilih!',
                        icon: "warning",
                    });
                    return;
                }

                // Validasi nama makanan
                if (nama == "") {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Nama makanan tidak boleh kosong!',
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
