@extends('layout.fe.template')
@section('title', 'Detail Wisata')
@section('content')
    <main id="main">
        <section id="sejarah" class="sejarah">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-9 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="container-fluid">
                            <div class="card">
                                <img class="img-fluid" src="{{ asset('/images_wisata/' . $detail->image) }}"
                                    class="card-img-top" alt="{{ $detail->nama_wisata }}">
                                <div class="card-body">
                                    <h5 style="color: black; font-size: 25px; margin-bottom: 50px"
                                        class="description-header">
                                        {{ $detail->nama_wisata }}</h5>
                                    <h6>Jam Operasional</h6>
                                    <p style="font-size: 14px" class="card-text">{{ $detail->jam_operasional }}</p>
                                    <h6>Fasilitas</h6>
                                    <p style="font-size: 14px" class="card-text">{{ $detail->fasilitas }}</p>
                                    <h6>Lokasi</h6>
                                    <p style="font-size: 14px" class="card-text">{{ $detail->lokasi }}</p>

                                    <div id="map" style="width: 100%; height: 300px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        var map;

        function initMap() {
            var latitude = {{ $detail->latitude }};
            var longitude = {{ $detail->longitude }};

            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: latitude,
                    lng: longitude
                },
                zoom: 12 // Ubah nilai zoom untuk memperjauh tampilan peta
            });

            // Tambahkan marker untuk menunjukkan lokasi wisata
            var marker = new google.maps.Marker({
                position: {
                    lat: latitude,
                    lng: longitude
                },
                map: map,
                title: '{{ $detail->nama_wisata }}'
            });
        }
    </script>
    <script src="/assets/js/mapsJavaScriptAPI.js" async defer></script>
@endsection
