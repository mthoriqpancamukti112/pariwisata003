@extends('layout.be.template')
@section('title', 'Galeri')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Galeri</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard-index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Galeri</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <a href="{{ route('galeri.create') }}" class="btn btn-success">
                    <i class="ace-icon fa fa-plus bigger-130"></i>Tambah Data
                </a>
            </div>
            <div class="card-body" style="overflow-x: auto;">
                <table id="datatablesSimple" style="min-width: 1600px;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($data as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="/images_galeri/{{ $row->image }}" width="100px" class="rounded"
                                        style="width: 100px">
                                </td>
                                <td>{{ $row->judul }}</td>
                                <td>{{ $row->kategor?->nama_kategori }}</td>
                                <td>
                                    <form method="POST" action="{{ route('galeri.destroy', $row->id) }}">
                                        @csrf
                                        <a href="{{ route('galeri.edit', $row->id) }}" class="btn btn-xs btn-info"><i
                                                class="ace-icon fa fa-pencil bigger-120"></i></a>
                                        @method('delete')
                                        <button type="submit" value="Delete" class="btn btn-xs btn-danger"
                                            onclick="return confirm('Apakah anda yakin ingin hapus?');">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
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
