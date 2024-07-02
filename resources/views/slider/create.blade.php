@extends('layout.be.template')
@section('title', 'Tambah Slider')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="col-xs-12">
                    <div class="page-header text-center">
                        <h1 class="mt-4">
                            Tambah Data Slider
                        </h1>
                    </div>
                    <div class="col-xs-4">
                        <form id="simpanForm" action="{{ route('slider.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="m-5">
                                <div class="form-group mb-3">
                                    <label for="image">Gambar</label>
                                    <input type="file" name="image" class="form-control" value="{{ old('image') }}"
                                        autofocus>
                                </div>
                                <button type="button" id="simpanButton" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('slider.index') }}" class="btn btn-danger">Batal</a>
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

                // Jika berhasil, submit form
                $("#simpanForm").submit();
            });
        });
    </script>
@endsection
