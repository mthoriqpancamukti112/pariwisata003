@extends('layout.be.template')
@section('title', 'Tambah Wisata')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-header text-center">
                            <h1 class="mt-4">
                                Tambah Data Wisata
                            </h1>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <strong>Error!</strong> <br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('tour.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="m-5">
                                        <div class="form-group mb-3">
                                            <label for="image">Gambar</label>
                                            <input type="file" name="image" class="form-control" autofocus>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="nama_wisata">Nama Wisata</label>
                                            <input type="text" name="nama_wisata" class="form-control">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" name="kategori" class="form-control">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="fasilitas">Fasilitas</label>
                                            <input type="text" name="fasilitas" class="form-control">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="lokasi">Lokasi</label>
                                            <textarea id="lokasi" name="lokasi" class="autosize-transition form-control"></textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="latitude">Latitude</label>
                                            <input type="text" name="latitude" class="form-control">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="longitude">Longitude</label>
                                            <input type="text" name="longitude" class="form-control">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="jam_operasional">Jam Operasional</label>
                                            <input type="text" name="jam_operasional" class="form-control">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea id="deskripsi" name="deskripsi" class="autosize-transition form-control"></textarea>
                                        </div>
                                        <input type="submit" value="Simpan" class="btn btn-success">
                                        <a href="{{ route('tour.index') }}" class="btn btn-danger">Batal</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
    </div>
    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/jquery.dataTables.bootstrap.min.js"></script>
    <script src="/assets/js/dataTables.buttons.min.js"></script>
    <script src="/assets/js/buttons.flash.min.js"></script>
    <script src="/assets/js/buttons.html5.min.js"></script>
    <script src="/assets/js/buttons.print.min.js"></script>
    <script src="/assets/js/buttons.colVis.min.js"></script>
    <script src="/assets/js/dataTables.select.min.js"></script>
@endsection
