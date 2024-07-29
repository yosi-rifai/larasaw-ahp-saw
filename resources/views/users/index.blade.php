@extends('users.layout.main')

@section('content')
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-6">
                <div class="about-text text-center mb-100">
                    <div class="section-heading text-center">
                        <div class="line-"></div>
                        <h2>Wisata Penuh Kenangan</h2>
                    </div>
                    <p>Pengalaman menginap yang berkualitas merupakan elemen krusial untuk menikmati liburan di Mojokerto. Kami dengan bangga menghadirkan rekomendasi unggulan yang telah dipilah melalui metode perhitungan yang cermat, memastikan Anda mendapatkan pengalaman terbaik dibandingkan dengan situs rekomendasi lainnya.</p>
                    <div class="about-key-text">
                        <h6><span class="fa fa-check"></span> Hotel Terbaik dengan Harga Terjangkau</h6>
                        <h6><span class="fa fa-check"></span> Kualitas Layanan Terbaik</h6>
                        <h6><span class="fa fa-check"></span> Fasilitas yang Lengkap</h6>
                        <h6><span class="fa fa-check"></span> Respon Positif terhadap Hotel</h6>
                        <h6><span class="fa fa-check"></span> Mudahnya Aksesibilitas untuk Seluruh Masyarakat</h6>
                    </div>
                    <a href="#room-area-choice" class="btn palatin-btn mt-50">Read More</a>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="about-thumbnail homepage mb-100">
                    <!-- First Img -->
                    <div class="first-img wow fadeInUp" data-wow-delay="100ms">
                        <img src="{{ asset('user/img/bg-img/13.jpg') }}" alt="">
                    </div>
                    <!-- Second Img -->
                    <div class="second-img wow fadeInUp" data-wow-delay="300ms">
                        <img src="{{ asset('user/img/bg-img/14.jpg') }}" alt="">
                    </div>
                    <!-- Third Img-->
                    <div class="third-img wow fadeInUp" data-wow-delay="500ms">
                        <img src="{{ asset('user/img/bg-img/15.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pool-area')
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-12 col-lg-7">
                <div class="pool-content text-center wow fadeInUp" data-wow-delay="300ms">
                    <div class="section-heading text-center white">
                        <div class="line-"></div>
                        <h2>Best Choice for</h2>
                        <p>Sistem ini menyediakan pilihan terbaik di antara hotel, vila, dan guest house di area Mojokerto, memastikan kenyamanan dan kualitas tertinggi bagi setiap pengunjung.</p>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="pool-feature">
                                <i class="icon-resort"></i>
                                <p>Hotel</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="pool-feature">
                                <i class="icon-mountain"></i>
                                <p>Villa</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="pool-feature">
                                <i class="icon-trekking"></i>
                                <p>Guest House</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('room-area')
    <div class="row justify-content-center" id="room-area-choice">
        <div class="col-12 col-lg-6">
            <div class="section-heading text-center">
                <div class="line-"></div>
                <h2>Best recommendation for staycation</h2>
                <p>Bagian ini menghadirkan Top 3 pilihan tempat menginap terbaik di wilayah Mojokerto</p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        @php
        $i = 0;
        @endphp
        @foreach ($topHotels as $hotel)
            @php
                $i++;
            @endphp
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-rooms-area wow fadeInUp" data-wow-delay="100ms">
                @if ($i == 1)
                    <div class="badge badge-top-left"><span id="ribbon-1">TOP 1</span></div>
                @elseif ($i == 2)
                    <div class="badge badge-top-left"><span id="ribbon-2">TOP 2</span></div>
                @elseif($i == 3)
                    <div class="badge badge-top-left"><span id="ribbon-3">TOP 3</span></div>
                @else
                    <div class="badge ranking">{{ $i + 1 }}</div>
                @endif
                <div class="bg-thumbnail bg-img" style="background-image: url({{ asset('images/hotels/'.$hotel->hotel_image_url) }});"></div>
                <p class="price-from">Rp.{{ number_format($hotel->harga, 2) }}/Malam</p>
                <div class="rooms-text">
                    <div class="line"></div>
                    <h4>{{ $hotel->nama }}</h4>
                    <span class="text-xs text-light">{{ $hotel->lokasi }}</span>
                </div>
                </div>
            </div>
        @endforeach
            <a href="{{ route('hotelspage.index')}}" class="book-room-btn btn palatin-btn">Read More</a>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 mt-4">
                <div class="section-heading text-center">
                    <div class="line-"></div>
                    <h2>Persentase</h2>
                    <p>Sistem ini memiliki tingkat akurasi yang setara dengan perhitungan manual menggunakan Excel seperti yang tertera di bawah ini</p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="our-skills-area">
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-skils-area mb-100">
                            <div id="circle" class="circle" data-value="0.99">
                                <div class="skills-text">
                                    <span>99%</span>
                                    <p>SAW Method Accuracy</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-skils-area mb-100">
                            <div id="circle2" class="circle" data-value="0.98">
                                <div class="skills-text">
                                    <span>98%</span>
                                    <p>AHP Calculation Match</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-skils-area mb-100">
                            <div id="circle3" class="circle" data-value="0.95">
                                <div class="skills-text">
                                    <span>5%</span>
                                    <p>Error Margin</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
        e.preventDefault();

        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth' });
        }
        });
    });
@endsection
