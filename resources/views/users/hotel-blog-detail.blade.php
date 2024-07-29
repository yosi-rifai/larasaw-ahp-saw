@extends('users.layout.main')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="hotel-image-wrapper">
                <img src="{{ asset('images/hotels/' . $hotel->hotel_image_url) }}" alt="{{ $hotel->nama }}" class="img-fluid hotel-image">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="hotel-details">
                <h1>{{ $hotel->nama }}</h1>
                <p><strong>Lokasi:</strong> {{ $hotel->lokasi }}</p>
                <p><strong>Harga:</strong> Rp.{{ number_format($hotel->harga, 2) }}/Malam</p>
                <p><strong>Rating:</strong> {{ $hotel->rating }} / 5</p>
            </div>
        </div>
    </div>
    <div class="single-hotel-info mt-4">
        <div class="hotel-info-text">
            <div class="row">
                <div class="col-md-4">
                    <h4>Kualitas Layanan</h4>
                    @foreach(json_decode($hotel->kualitas_layanan) as $layanan)
                        <h6><span class="fa fa-check"></span> {{ $layanan }}</h6>
                    @endforeach
                </div>
                <div class="col-md-4">
                    <h4>Fasilitas</h4>
                    @foreach(json_decode($hotel->fasilitas) as $fasilitas)
                        <h6><span class="fa fa-check"></span> {{ $fasilitas }}</h6>
                    @endforeach
                </div>
                <div class="col-md-4">
                    <h4>Kemudahan Aksesibilitas</h4>
                    @foreach(json_decode($hotel->kemudahan_aksesibilitas) as $aksesibilitas)
                        <h6><span class="fa fa-check"></span> {{ $aksesibilitas }}</h6>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection