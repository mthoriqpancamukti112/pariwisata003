@extends('layout.be.template')
@section('title', 'Pengguna')
@section('content')
    <style>
        #datatablesSimple th,
        #datatablesSimple td {
            width: auto !important;
            white-space: nowrap;
        }
    </style>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pengguna</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard-index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pengguna</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <a href="{{ route('user.create') }}" class="btn btn-success">
                    <i class="ace-icon fa fa-plus bigger-130"></i>Tambah Data
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar Profil</th>
                            <th>Nama Lengkap</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Hak Akses</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Gambar Profil</th>
                            <th>Nama Lengkap</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Hak Akses</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($data as $row)
                            <tr style="text-align: center">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($row->image)
                                        <img src="/images_profile/{{ $row->image }}" width="50px" class="rounded">
                                    @else
                                        <img src="{{ asset('/frontend/assets/images/icon_profil.png') }}" height="50"
                                            alt="">
                                    @endif
                                </td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->no_hp }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td>{{ $row->jenis_kelamin }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->password }}</td>
                                <td>{{ $row->hak_akses }}</td>
                                <td>
                                    <form id="delete-form-{{ $row->id }}" method="POST"
                                        action="{{ route('user.destroy', $row->id) }}">
                                        <a href="{{ route('user.edit', $row->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <a href="#" class="btn btn-danger delete-btn btn-sm"
                                            data-id="{{ $row->id }}">Hapus
                                        </a>
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
