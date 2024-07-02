@extends('layout.be.template')
@section('title', 'Tambah Galeri')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="col-xs-12">
                <div class="page-header text-center">
                    <h1 class="mt-4">
                        Tambah Data Galeri
                    </h1>
                </div>
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

                <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="m-5">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="image">Gambar</label>
                            <input type="file" name="image" class="form-control" value="{{ old('image') }}" autofocus>
                        </div>
                        <div class="form-group mb-3">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Kategori</label>
                            <select name="kategori" id="" class="form-select">
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                @foreach ($data_kategor as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" value="Simpan" class="btn btn-success">
                        <a href="{{ route('galeri.index') }}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
