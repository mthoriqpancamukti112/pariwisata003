@extends('layout.be.template')
@section('title', 'Edit Kategori')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="col-xs-12">
                    <div class="page-header text-center">
                        <h1 class="mt-4">
                            Edit Data Kategori
                        </h1>
                    </div>
                    <div class="col-xs-4">
                        <form id="simpanForm" action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                            <div class="m-5">
                                @csrf
                                @method('patch')
                                <div class="form-group mb-3">
                                    <label for="nama_kategori">Nama Kategori</label>
                                    <input type="text" name="nama_kategori" class="form-control"
                                        value="{{ $kategori->nama_kategori }}">
                                </div>
                                <button type="button" id="simpanButton" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('kategori.index') }}" class="btn btn-danger">Batal</a>
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

                var nama_kategori = $("input[name='nama_kategori']").val();

                if (nama_kategori.length == 0) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Nama Kategori tidak boleh kosong!',
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
