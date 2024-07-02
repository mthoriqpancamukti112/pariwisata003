@extends('layout.be.template')
@section('title', 'Wisata')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Wisata</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard-index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Wisata</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <a href="{{ route('tour.create') }}" class="btn btn-success">
                    <i class="ace-icon fa fa-plus bigger-130"></i>Tambah Data
                </a>
            </div>
            <div class="card-body" style="overflow-x: auto;">
                <table id="datatablesSimple" style="min-width: 1600px;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Wisata</th>
                            <th>Kategori</th>
                            <th>Fasilitas</th>
                            <th>Lokasi</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Jam</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Wisata</th>
                            <th>Kategori</th>
                            <th>Fasilitas</th>
                            <th>Lokasi</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Jam</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($data as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="/images_wisata/{{ $row->image }}" width="100px" class="rounded"
                                        style="width: 100px">
                                </td>
                                <td>{{ $row->nama_wisata }}</td>
                                <td>{{ $row->kategori }}</td>
                                <td>{{ $row->fasilitas }}</td>
                                <td>{{ $row->lokasi }}</td>
                                <td>{{ $row->latitude }}</td>
                                <td>{{ $row->longitude }}</td>
                                <td>{{ $row->jam_operasional }}</td>
                                <td>{{ $row->deskripsi }}</td>
                                <td>
                                    <form method="POST" action="{{ route('tour.destroy', $row->id) }}">
                                        <div style="width: 100px">
                                            @csrf
                                            <a href="{{ route('tour.edit', $row->id) }}" class="btn btn-xs btn-info"><i
                                                    class="ace-icon fa fa-pencil bigger-120"></i></a>
                                            @method('delete')
                                            <button type="submit" value="Delete" class="btn btn-xs btn-danger"
                                                onclick="return confirm('Apakah anda yakin ingin hapus?');">
                                                <i class="ace-icon fa fa-trash-o bigger-120"></i>
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
