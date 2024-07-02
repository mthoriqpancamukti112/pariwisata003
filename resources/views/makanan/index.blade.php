@extends('layout.be.template')
@section('title', 'Makanan')
@section('content')
    <style>
        #datatablesSimple th,
        #datatablesSimple td {
            width: auto !important;
            white-space: nowrap;
        }
    </style>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Makanan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard-index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Makanan</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <a href="{{ route('makanans.create') }}" class="btn btn-success">
                    <i class="ace-icon fa fa-plus bigger-130"></i>Tambah Data
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>ID Kuliner</th>
                            <th>Nama Makanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>ID Kuliner</th>
                            <th>Nama Makanan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($data as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="/images_makanan/{{ $row->image }}" width="50px" class="rounded">
                                </td>
                                <td>{{ $row->kulinertempat?->tempat_kuliner }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>
                                    <form method="POST" action="{{ route('makanans.destroy', $row->id) }}">
                                        <div style="width: 100px">
                                            @csrf
                                            <a href="{{ route('makanans.edit', $row->id) }}"
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

    <script>
        $(document).ready(function() {
            $('#datatablesSimple').DataTable({
                "autoWidth": true, // Menyesuaikan lebar kolom dengan isi data
                // Konfigurasi lainnya...
            });
        });
    </script>
@endsection
