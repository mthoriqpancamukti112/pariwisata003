@extends('layout.be.template')
@section('title', 'Slider')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Slider</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard-index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Slider</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <a href="{{ route('slider.create') }}" class="btn btn-success">
                    <i class="ace-icon fa fa-plus bigger-130"></i>Tambah Data
                </a>
            </div>
            <div class="card-body" style="overflow-x: auto;">
                <table id="datatablesSimple" style="min-width: 1600px;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($data as $row)
                            <tr style="text-align: center">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="/images_slider/{{ $row->image }}" width="100px" class="rounded"
                                        style="width: 100px">
                                </td>
                                <td></td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
