@extends('layout.be.template')
@section('title', 'Kuliner')
@section('content')
    <style>
        #datatablesSimple th,
        #datatablesSimple td {
            width: auto !important;
            white-space: nowrap;
        }
    </style>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kuliner</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard-index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Kuliner</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <a href="{{ route('kuliner.create') }}" class="btn btn-success">
                    <i class="ace-icon fa fa-plus bigger-130"></i>Tambah Data
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Tempat Kuliner</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Lokasi</th>
                            <th>Jam</th>
                            <th>Fasilitas</th>
                            <th>Kontak</th>
                            <th>Galeri</th>
                            <th>Tanggal Upload</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Tempat Kuliner</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Lokasi</th>
                            <th>Jam</th>
                            <th>Fasilitas</th>
                            <th>Kontak</th>
                            <th>Galeri</th>
                            <th>Tanggal Upload</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($data as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="/images_kuliner/{{ $row->image }}" width="50px" class="rounded">
                                </td>
                                <td>{{ $row->tempat_kuliner }}</td>
                                <td>{{ $row->kategor?->nama_kategori }}</td>
                                <td>{{ $row->deskripsi }}</td>
                                <td>{{ $row->lokasi }}</td>
                                <td>{{ $row->jam_operasional }}</td>
                                <td>{{ $row->fasilitas }}</td>
                                <td>{{ $row->kontak }}</td>
                                <td>
                                    @foreach (json_decode($row->galeri) as $galleryImage)
                                        <img src="/galeri_kuliner/{{ $galleryImage }}" width="50px" class="rounded">
                                    @endforeach
                                </td>
                                <td>{{ \Carbon\Carbon::parse($row->tgl_upload)->locale('id')->isoFormat('D MMMM YYYY') }}
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('kuliner.destroy', $row->id) }}">
                                        <div style="width: 100px">
                                            @csrf
                                            <a href="{{ route('kuliner.edit', $row->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            @method('delete')
                                            <button type="submit" value="Delete" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah anda yakin ingin hapus?');">Hapus
                                            </button>
                                        </div>

                                    </form>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
