@extends('layout.be.template')
@section('title', 'Reservasi')
@section('content')

    <style>
        #datatablesSimple th,
        #datatablesSimple td {
            width: auto !important;
            white-space: nowrap;
        }

        @font-face {
            font-family: "PlusJakartaSans";
            src: url("/frontend/assets/font/PlusJakartaSans-Medium.ttf") format("truetype");
        }

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        a,
        span,
        li,
        div {
            font-family: "PlusJakartaSans";
        }

        .status-belumbayar {
            background-color: yellow;
            padding: 5px;
            border-radius: 5px;
        }

        .status-pending {
            background-color: grey;
            color: white;
            padding: 5px;
            border-radius: 5px;
        }

        .status-sudahdibayar {
            background-color: blue;
            color: white;
            padding: 5px;
            border-radius: 5px;
        }

        .status-lunas {
            background-color: green;
            color: white;
            padding: 5px;
            border-radius: 5px;
        }

        .action-buttons {
            margin-right: 10px;
        }
    </style>

    <div class="container-fluid px-4">
        <h1 class="mt-4">Reservasi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard-index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Reservasi</li>
        </ol>

        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tempat Reservasi</th>
                            <th>Nama Customer</th>
                            <th>No HP/WA</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tempat Reservasi</th>
                            <th>Nama Customer</th>
                            <th>No HP/WA</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($reservasis as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->tempatKuliner?->tempat_kuliner }}</td>
                                <td>{{ $row->nama_pengunjung }}</td>
                                <td>{{ $row->no_hp }}</td>
                                <td>
                                    @if ($row->status == 'Dipending')
                                        <span class="status-pending">{{ $row->status }}</span>
                                    @elseif($row->status == 'Belum Dibayar')
                                        <span class="status-belumbayar">{{ $row->status }}</span>
                                    @elseif ($row->status == 'Sudah Dibayar')
                                        <span class="status-sudahdibayar">{{ $row->status }}</span>
                                    @else
                                        <span class="status-lunas">{{ $row->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm action-buttons" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $row->id }}">
                                        Detail
                                    </button>
                                    @if ($row->status == 'Sudah Dibayar' || $row->status == 'Lunas')
                                        <button type="button" class="btn btn-info btn-sm action-buttons"
                                            data-bs-toggle="modal" data-bs-target="#paymentModal{{ $row->id }}">
                                            Lihat Pembayaran
                                        </button>
                                    @endif
                                    @if ($row->status == 'Belum Dibayar')
                                        <form id="delete-form-{{ $row->id }}"
                                            action="{{ route('reservasi.cancel', $row->id) }}" method="POST"
                                            class="action-buttons" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger delete-btn btn-sm"
                                                data-id="{{ $row->id }}">Batalkan</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>

                            <!-- Modal for Details -->
                            <div class="modal fade" id="detailModal{{ $row->id }}" tabindex="-1"
                                aria-labelledby="detailModalLabel{{ $row->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel{{ $row->id }}">Detail
                                                Reservasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5>Data Customer</h5>
                                                        <span><strong>Nama:</strong> {{ $row->nama_pengunjung }}</span><br>
                                                        <span><strong>No HP/WA:</strong> {{ $row->no_hp }}</span><br>
                                                        <span><strong>Email:</strong> {{ $row->email }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5>Data Pembayaran</h5>
                                                        <span><strong>Total Biaya:</strong>
                                                            Rp.
                                                            {{ number_format($row->metodepembayaran?->biaya, 0, ',', '.') }}
                                                        </span><br>
                                                        <span><strong>Metode Pembayaran:</strong>
                                                            {{ $row->metodepembayaran?->nama_metode }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-12">
                                                        <h5>Data Reservasi</h5>
                                                        <span><strong>Tempat Reservasi:</strong>
                                                            {{ $row->tempatKuliner?->tempat_kuliner }}</span><br>
                                                        <span><strong>Tanggal:</strong>
                                                            {{ \Carbon\Carbon::parse($row->tgl_pesan)->locale('id')->isoFormat('D MMMM YYYY [Jam] HH:mm') }}
                                                        </span><br>
                                                        <span><strong>Jumlah Tamu:</strong>
                                                            {{ $row->jumlah_orang }}</span><br>
                                                        <span><strong>Meja:</strong>
                                                            {{ $row->meja?->nama_meja }}</span><br>
                                                        <span><strong>Status:</strong> {{ $row->status }}</span><br>
                                                        <span><strong>Waktu Order:</strong>
                                                            {{ \Carbon\Carbon::parse($row->created_at)->locale('id')->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            @if ($row->status != 'Belum Dibayar' && $row->status != 'Sudah Dibayar' && $row->status != 'Lunas')
                                                <form id="konfirmasiForm{{ $row->id }}"
                                                    action="{{ route('reservasi.konfirmasi', $row->id) }}" method="POST"
                                                    class="action-buttons" style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="btn btn-success btn-sm">Konfirmasi</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal for Payment Details -->
                            <div class="modal fade" id="paymentModal{{ $row->id }}" tabindex="-1"
                                aria-labelledby="paymentModalLabel{{ $row->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="paymentModalLabel{{ $row->id }}">
                                                Detail
                                                Pembayaran</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span><strong>Nama Pengirim:</strong>
                                                            {{ $row->pembayaran->nama_pengirim ?? 'Nama pengirim belum tersedia' }}
                                                        </span><br>
                                                        <span><strong>Total Biaya:</strong>
                                                            Rp.
                                                            {{ number_format($row->metodepembayaran?->biaya, 0, ',', '.') }}
                                                        </span><br>
                                                        <span><strong>Metode Pembayaran:</strong>
                                                            {{ $row->metodepembayaran?->nama_metode }}</span><br><br>
                                                        <p><strong>Status:</strong> {{ $row->status }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5>Bukti Pembayaran</h5>
                                                        @if ($row->pembayaran && $row->pembayaran->foto_bukti_pembayaran)
                                                            <img src="{{ asset('/images_bukti_pembayaran/' . $row->pembayaran->foto_bukti_pembayaran) }}"
                                                                class="img-fluid" alt="Bukti Pembayaran">
                                                        @else
                                                            <p>Foto bukti pembayaran belum tersedia.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            @if ($row->status == 'Sudah Dibayar' && $row->status != 'Lunas')
                                                <form id="lunas-form-{{ $row->id }}"
                                                    action="{{ route('reservasi.lunas', $row->id) }}" method="POST"
                                                    class="action-buttons" style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success btn-sm">Konfirmasi
                                                        Lunas</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center">Tidak ada data reservasi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="/frontend/assets/vendors/jquery/jquery.min.js"></script>
    <script src="/frontend/assets/js/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
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
                    confirmButtonText: "Batalkan"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-form-' + id).submit();
                    }
                });
            });
        });
    </script>
@endsection
