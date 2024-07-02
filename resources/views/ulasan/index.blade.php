@extends('layout.be.template')
@section('title', 'Ulasan')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Ulasan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard-index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Ulasan</li>
        </ol>

        <div class="card mb-4">
            <div class="card-body" style="overflow-x: auto;">
                <table id="datatablesSimple" style="min-width: 1600px;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pengunjung</th>
                            <th>Tempat Kuliner</th>
                            <th>Komentar</th>
                            <th>Rating</th>
                            <th>Tanggal Ulasan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Pengunjung</th>
                            <th>Tempat Kuliner</th>
                            <th>Komentar</th>
                            <th>Rating</th>
                            <th>Tanggal Ulasan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($data as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->reservasi?->nama_pengunjung }}</td>
                                <td>{{ $row->kulinertempat?->tempat_kuliner }}</td>
                                <td>{{ $row->komentar }}</td>
                                <td>{{ $row->rating }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->tgl_ulasan)->locale('id')->isoFormat('D MMMM YYYY') }}
                                </td>
                                <td>
                                    <form id="delete-form-{{ $row->id }}" method="POST"
                                        action="{{ route('ulasan.destroy', $row->id) }}">
                                        <div style="width: 100px">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="btn btn-danger delete-btn"
                                                data-id="{{ $row->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
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
    <script src="/frontend/assets/vendors/jquery/jquery.min.js"></script>
    <script src="/frontend/assets/js/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.delete-btn').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Anda tidak akan dapat mengembalikannya!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-form-' + id).submit();
                    }
                });
            });
        });
    </script>
@endsection
