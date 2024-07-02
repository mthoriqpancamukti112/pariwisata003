@extends('layout.be.template')
@section('title', 'Kontak')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kontak</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard-index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Kontak</li>
        </ol>

        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Perihal</th>
                            <th>Pesan</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Perihal</th>
                            <th>Pesan</th>
                            <th>Tanggal</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($data as $row)
                            <tr style="text-align: center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->perihal }}</td>
                                <td>{{ $row->pesan }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->tgl)->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
