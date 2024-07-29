@extends('admin.layout.main')

<style>
    .card-body .material-icons {
        font-size: 1rem;
        vertical-align: middle;
    }

    .col-md-12{
        margin-top: 1rem;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
        cursor: pointer;
    }

    .card-body .star {
        color: #FFD700;
    }

    .card-body .star-half {
        color: #FFD700;
    }

    .card-body .star-border {
        color: #808080;
    }
</style>

@section('content')
<div class="container">
    <div class="mb-2">
        <a href="{{ route('hotels.index') }}" class="btn btn-primary">
            <i class="material-icons me-1">arrow_back</i>
            BACK
        </a>
    </div>
    <div class="row">
        @foreach($hotels as $hotel)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('images/hotels/' . $hotel->hotel_image_url) }}" class="card-img-top w-100" style="min-height: 200px; max-height: 200px; object-fit: cover;" alt="Hotel Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $hotel->nama }}</h5>
                        <p style="margin-bottom: 0;">
                            @php
                                $rating = $hotel->rating;
                                $fullStars = floor($rating);
                                $halfStar = ceil($rating - $fullStars);
                            @endphp
                             @for ($i = 0; $i < $fullStars; $i++)
                             <i class="material-icons star">star</i>
                            @endfor

                            @if ($halfStar)
                                <i class="material-icons star-half">star_half</i>
                                @php $fullStars++ @endphp
                            @endif

                            @for ($i = $fullStars; $i < 5; $i++)
                                <i class="material-icons star-border">star_border</i>
                            @endfor
                        </p>
                        <span class="text-xs text-black">({{ $rating }}/5 GMaps Rating)</span>
                        <div class="col-md-12">
                            <p><strong>Lokasi: </strong> {{ $hotel->lokasi }}</p>
                        </div>
                        <p><strong>Harga :</strong> Rp.{{ number_format($hotel->harga, 2) }}</p>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Kualitas Layanan :</strong></p>
                                <ul class="list-group">
                                    @foreach(json_decode($hotel->kualitas_layanan) as $item)
                                        <li class="list-group-item">{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <p><strong>Fasilitas Hotel :</strong></p>
                                <ul class="list-group">
                                    @foreach(json_decode($hotel->fasilitas) as $item)
                                        <li class="list-group-item">{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <p><strong>Kemudahan Aksesibilitas / Penunjang Hotel :</strong></p>
                                <ul class="list-group">
                                    @foreach(json_decode($hotel->kemudahan_aksesibilitas) as $item)
                                        <li class="list-group-item">{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="{{ route('hotels.show', $hotel->id) }}" class="card-link">Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if($hotels->count() <= 12)
        <div class="text-center mt-4">
            <button id="loadMoreBtn" class="btn btn-primary">Load More</button>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var loadMoreBtn = document.getElementById('loadMoreBtn');
        var cards = document.querySelectorAll('.card');

        if(cards.length <= 12) {
            loadMoreBtn.style.display = 'none';
        }

        loadMoreBtn.addEventListener('click', function() {
            var hiddenCards = document.querySelectorAll('.card:not(:visible)');
            var cardsToShow = hiddenCards.length >= 12 ? 12 : hiddenCards.length;

            for (var i = 0; i < cardsToShow; i++) {
                hiddenCards[i].style.display = 'block';
            }

            if (hiddenCards.length <= 12) {
                loadMoreBtn.style.display = 'none';
            }
        });
    });
</script>
@endsection
