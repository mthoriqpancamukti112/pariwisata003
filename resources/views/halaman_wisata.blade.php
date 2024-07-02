@extends('layout.fe.template')
@section('title', 'Wisata')
@section('content')
    <style>
        .card-img-top {
            transition: transform 0.5s ease;
            max-width: 100%;
            max-height: 100%;
        }

        .card-img-top:hover {
            transform: scale(1.05);
        }

        .image-container {
            overflow: hidden;
            width: 100%;
            height: 200px;
        }

        .image {
            width: 100%;
            height: 100%;
            background-size: cover;
            transition: transform 0.5s ease;
        }

        .image:hover {
            transform: scale(1.05);
        }
    </style>
    <main id="main">
        <section id="sejarah" class="sejarah">
            <div class="container" data-aos="fade-up">
                <div class="container-fluid">
                    <div class="card-widget widget-user">
                        <div class="widget-user-header">
                            <h3 class="widget-user-username text-center">WISATA&ensp;ALAM</h3>
                            <hr class="mx-auto" style="width: 50%; border-top: 2px solid #00ff08;">
                        </div>

                        <div class="card-footer" style="display: flex; flex-wrap: wrap; justify-content: space-between;">
                            @forelse ($data as $tour)
                                <div class="card mb-4" style="flex: 0 0 calc(33.333% - 20px); margin-bottom: 20px;">
                                    <div class="image-container">
                                        <a href="{{ route('detail_wisata', $tour->id) }}">
                                            <div class="image"
                                                style="background-image: url('{{ asset('/images_wisata/' . $tour->image) }}');">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-truncate">
                                            Kategori -
                                            <i>{{ $tour->kategori == 1 ? 'Kuliner' : 'Wisata' }}</i>
                                        </p>
                                        <p class="card-text text-truncate">
                                            Jam Operasional &ensp;
                                            <i>{{ $tour->jam_operasional }}</i>
                                        </p>
                                        <p style="font-size: 20px; color: black" class="card-text text-truncate fw-bold">
                                            {{ $tour->nama_wisata }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-danger">
                                    Data Wisata Tidak Ada.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
