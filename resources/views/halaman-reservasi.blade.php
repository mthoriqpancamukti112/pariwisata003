@extends('layout.fe.template')
@section('title', 'Reservasi')
@section('content')
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <style>
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
            color: black;
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

        @media (max-width: 768px) {
            .col-lg-12 {
                padding-right: 30px;
                padding-left: 30px;
            }
        }

        .label {
            min-width: 180px;
            display: inline-block;
        }

        .card {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.125);
            border-radius: 10px;
        }
    </style>
    <section>
        <div class="container" style="margin-top: 30px;">
            <div class="row">
                @forelse ($data as $row)
                    <div class="col-lg-12" data-aos="zoom-in" data-aos-delay="100">
                        <div class="card p-4 mb-4">
                            <div class="row">
                                <h4 style="font-weight: bold; margin-bottom: 40px; color: black; text-align: center">
                                    Reservasi {{ $row->tempatKuliner?->tempat_kuliner }}
                                </h4>
                                <div class="col-lg-6 mb-5">
                                    <h5 style="font-weight: bold; margin-bottom: 20px; color: black">Data Customer</h5>
                                    <div class="info mb-1">
                                        <span class="label">Customer</span>
                                        <span>:</span>&ensp;
                                        <span>{{ $row->nama_pengunjung }}</span>
                                    </div>
                                    <div class="info mb-1">
                                        <span class="label">No HP/WA</span>
                                        <span>:</span>&ensp;
                                        <span>{{ $row->no_hp }}</span>
                                    </div>
                                    <div class="info mb-1">
                                        <span class="label">Tanggal Reservasi</span>
                                        <span>:</span>&ensp;
                                        <span>{{ \Carbon\Carbon::parse($row->tgl_pesan)->locale('id')->isoFormat('D MMMM YYYY [Jam] HH:mm') }}</span>
                                    </div>
                                    <div class="info mb-1">
                                        <span class="label">Jumlah Tamu</span>
                                        <span>:</span>&ensp;
                                        <span>{{ $row->jumlah_orang }}</span>
                                    </div>
                                    <div class="info mb-1">
                                        <span class="label">Nomor Meja</span>
                                        <span>:</span>&ensp;
                                        <span>{{ $row->meja?->nama_meja }}</span>
                                    </div>
                                    <div class="info mb-1">
                                        <span class="label">Jumlah Kursi</span>
                                        <span>:</span>&ensp;
                                        <span>{{ $row->meja->jumlah }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 pembayaran-info">
                                    <h5 style="font-weight: bold; margin-bottom: 20px; color: black">Detail Pembayaran</h5>
                                    <div class="info mb-1">
                                        <span class="label">Metode Pembayaran</span>
                                        <span>:</span>&ensp;
                                        <span>{{ $row->metodepembayaran?->nama_metode }}</span>
                                    </div>
                                    <div class="info mb-1">
                                        <span class="label">Nomor</span>
                                        <span>:</span>&ensp;
                                        <span>{{ $row->metodepembayaran?->nomor }}</span>
                                    </div>
                                    <div class="info mb-2">
                                        <span class="label">Total Biaya</span>
                                        <span>:</span>&ensp;
                                        <span>Rp. {{ number_format($row->metodepembayaran?->biaya, 0, ',', '.') }},00</span>
                                    </div>
                                    <div class="info">
                                        <span class="label">Status Pembayaran</span>
                                        <span>:</span>&ensp;
                                        <span>
                                            @if ($row->status == 'Dipending')
                                                <span class="status-pending">{{ $row->status }}</span>
                                                <br>
                                                <br>
                                                <p>Note: Tunggu konfirmasi dari admin</p>
                                            @elseif ($row->status == 'Belum Dibayar')
                                                <span class="status-belumbayar">{{ $row->status }}</span>
                                                <br>
                                                <br>
                                            @elseif ($row->status == 'Sudah Dibayar')
                                                <span class="status-sudahdibayar">{{ $row->status }}</span>
                                                <br>
                                                <br>
                                                <span>Note: Mohon tunggu konfirmasi dari admin.</span>
                                            @elseif ($row->status == 'Lunas')
                                                <span class="status-lunas">{{ $row->status }}</span>
                                                <br>
                                                <br>
                                                <span>Note: Pembayaran anda berhasil dikonfirmasi oleh admin, tunjukan bukti
                                                    pembayaran anda untuk mengambil nomor meja anda.</span>
                                                @php
                                                    $ulasanExists = $row
                                                        ->ulasan()
                                                        ->where('user_id', auth()->user()->id)
                                                        ->exists();
                                                @endphp
                                                @if (!$ulasanExists)
                                                @endif
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center mt-4">
                                    @if ($row->status == 'Dipending')
                                        <form id="delete-form-{{ $row->id }}"
                                            action="{{ route('reservasi.cancel', $row->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger delete-btn btn-block"
                                                data-id="{{ $row->id }}" style="text-shadow: none">Batalkan reservasi
                                                ini</button>
                                        </form>
                                    @elseif ($row->status == 'Belum Dibayar')
                                        <a href="{{ route('pembayaran.index', $row->id) }}"
                                            class="btn btn-primary btn-block" style="text-shadow: none">Bayar
                                            Sekarang</a>
                                    @elseif ($row->status == 'Lunas' && !$ulasanExists)
                                        <a href="{{ route('ulasan.create', $row->id) }}" class="btn btn-primary btn-block"
                                            style="text-shadow: none">Berikan Ulasan mengenai Tempat Reservasi ini</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 text-center">
                        <span>Tidak ada data reservasi.</span>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <script src="/frontend/assets/vendors/jquery/jquery.min.js"></script>
    <script src="/frontend/assets/js/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.delete-btn').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: "Apakah Anda yakin membatalkan reservasi ini?",
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
    <script>
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "Terimakasih telah memberikan ulasan.",
                showConfirmButton: false,
                timer: 1500
            });
        @endif
    </script>
@endsection
