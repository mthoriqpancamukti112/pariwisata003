@extends('layout.be.template')
@section('title', 'Bukti Pembayaran')
@section('content')
    <div class="container mt-5 mb-5">
        <h3 class="text-center">Bukti Pembayaran</h3>
        <div class="d-flex justify-content-center align-items-center">
            <img src="{{ asset('/images_bukti_pembayaran/' . $pembayaran->foto_bukti_pembayaran) }}" alt="Bukti Pembayaran">
        </div>
    </div>
@endsection
