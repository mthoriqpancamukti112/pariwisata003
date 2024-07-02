@extends('layout.be.template')
@section('title', 'Edit Galeri')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-header text-center">
                            <h1 class="mt-4">
                                Edit Data Galeri
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

                                <form action="{{ route('galeri.update', $galeri->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="m-5">
                                        @csrf
                                        @method('patch')
                                        <div class="form-group mb-3">
                                            <label>Gambar</label>
                                            <input type="file" name="image" class="form-control">
                                            <img src="/images_galeri/{{ $galeri->image }}" width="300px">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="judul">Judul</label>
                                            <input type="text" name="judul" class="form-control"
                                                value="{{ $galeri->judul }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Kategori</label>
                                            <select name="kategori" id="" class="form-select">
                                                <option disabled value="">-- Pilih Kategori --</option>
                                                @foreach ($data_kategor as $row)
                                                    <option value="{{ $row->id }}"
                                                        {{ $galeri->kategor->id == $row->id ? 'selected' : '' }}>
                                                        {{ $row->nama_kategori }}
                                                    </option>
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
                </div>
            </div>
        </div>
    </div>
@endsection
