@extends('users.layout.main')

@section('style')
<style>
    .dropdown-menu {
        z-index: 1000;
    }

    .dropdown-item.option-palatin {
        background-color: #cb8670;
        color: #fff;
    }

    .dropdown-item.option-palatin:hover,
    .dropdown-item.option-palatin:focus {
        background-color: #363636;
        color: #fff;
    }

    .palatin-btn {
        background-color: #cb8670;
        transition-duration: 500ms;
        position: relative;
        display: inline-block;
        min-width: 123px;
        height: 53px;
        color: #ffffff;
        border: none;
        padding: 0 30px;
        font-size: 16px;
        line-height: 53px;
        text-transform: capitalize;
    }

    .palatin-btn:hover, .palatin-btn:focus {
        background-color: #363636;
        color: #ffffff;
    }

    .custom-select {
        background-color: #cb8670;
        color: #ffffff;
        border: none;
        height: 53px;
        padding: 0 30px;
        font-size: 16px;
        line-height: 53px;
        transition: background-color 500ms, color 500ms;
        appearance: none;
        -webkit-appearance: none;
        z-index: 1050;
        position: relative;
    }

    .custom-select:hover, .custom-select:focus {
        background-color: #363636;
        color: #ffffff;
    }

    .form-inline {
        display: flex;
        align-items: center;
    }

    .form-inline .dropdown {
        flex-grow: 1;
    }

    .form-inline .btn {
        margin-left: 10px;
    }
</style>
@endsection
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center" id="room-area-choice">
        <div class="col-12 col-lg-6">
            <div class="section-heading text-center">
                <div class="line-"></div>
                <h2>Staycation at Mojokerto</h2>
                <p>Berikut adalah data keseluruhan seluruh penginapan di area Mojokerto berurutan dari yang paling rekomendasi</p>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <form class="form-inline">
                    <div class="dropdown">
                        <button class="btn palatin-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sort By
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item option-palatin" href="?sort_by=harga_asc">Harga Terendah</a>
                            <a class="dropdown-item option-palatin" href="?sort_by=harga_desc">Harga Tertinggi</a>
                            <a class="dropdown-item option-palatin" href="?sort_by=fasilitas_desc">Fasilitas Terbanyak</a>
                            <a class="dropdown-item option-palatin" href="?sort_by=layanan_desc">Kualitas Layanan Terbanyak</a>
                            <a class="dropdown-item option-palatin" href="?sort_by=rating_desc">Rating Tertinggi</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @php
                $i = 0;
            @endphp
            @foreach($hotels as $hotel)
                <div class="col-12 col-md-6 col-lg-4">
                    @php
                        $i++;
                    @endphp
                    <div class="single-rooms-area wow fadeInUp" data-wow-delay="100ms">
                    @if ($i == 1)
                        <div class="badge badge-top-left"><span id="ribbon-1">TOP 1</span></div>
                    @elseif ($i == 2)
                        <div class="badge badge-top-left"><span id="ribbon-2">TOP 2</span></div>
                    @elseif($i == 3)
                        <div class="badge badge-top-left"><span id="ribbon-3">TOP 3</span></div>
                    @else
                        <div class="badge badge-top-left"><span class="badge-modern">{{ $i + 1 }}</span></div>
                    @endif
                        <div class="bg-thumbnail bg-img" style="background-image: url({{ asset('images/hotels/' . $hotel->hotel_image_url) }});"></div>
                        <p class="price-from">Rp.{{ number_format($hotel->harga, 2) }}/Malam</p>
                        <div class="rooms-text">
                            <a href="{{ url('hotel-blog-detail', $hotel->id) }}">
                                <div class="line"></div>
                                <h4>{{ $hotel->nama }}</h4>
                                <span class="text-xs text-light">{{ $hotel->lokasi }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@section('script')
    document.addEventListener('DOMContentLoaded', (event) => {
        const dropdown = document.getElementById('sort_by');
        dropdown.addEventListener('change', function() {
            const selectedOption = dropdown.value;
            window.location.href = `{{ route('hotelspage.index') }}?sort_by=${selectedOption}`;
        });
    });
@endsection
@endsection
