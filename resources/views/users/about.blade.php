@extends('users.layout.main')

@section('content')
    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <div class="line-"></div>
                        <h2>Tentang Sistem</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mb-5">
                <div class="col-12 col-md-8">
                    <p>Sistem ini dikembangkan menggunakan metode SAW (Simple Additive Weighting) dan AHP (Analytic Hierarchy Process) untuk menentukan akomodasi penginapan terbaik di wilayah kabupaten Mojokerto. Dikembangkan oleh Yosi Rifa'i Putra, sistem kami menjamin tingkat akurasi hingga 99% dengan presisi 14 angka desimal.</p>
                    <p>Untuk informasi lebih lanjut, hubungi Yosi Rifa'i Putra di <strong>+6285941041371</strong>. Ikuti Yosi Rifa'i Putra di Instagram <strong>@yosi_rifai</strong>.</p>
                    <p>Jelajahi akurasi dan perhitungan sistem kami melalui file Excel detail kami:</p>
                </div>
                <div class="col-12 col-md-4">
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.7891801198267!2d112.4604986!3d-7.4941347!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e780d1039397361%3A0x35b40e32e3a9bc18!2sUniversitas%20Islam%20Majapahit!5e0!3m2!1sen!2sid!4v1625722553701!5m2!1sen!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-5">
                <div class="col-12 col-md-12">
                    <div class="iframe-container">
                        <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vS4phOcULhB3futhnQTZ8nKXEQoK6teVXHJlfmtuGyPc81f7216v4qByf2i1BRG8m4_4rXl_qZBM9on/pubhtml?gid=151324249&amp;single=true&amp;widget=true&amp;headers=false" width="100%" height="400px"></iframe>
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <form method="GET" action="{{ route('about-us') }}">
                        <div class="form-group">
                            <select id="hotel-select" name="hotel_id" class="form-control" onchange="this.form.submit()">
                                <option value="">Pilih Akomodasi</option>
                                @foreach ($hotels as $hotel)
                                    <option value="{{ $hotel->id }}" {{ $selectedHotel == $hotel->id ? 'selected' : '' }}>
                                        {{ $hotel->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form><br>
                
                    @if($selectedHotel)
                        <h3 class="mt-4">NILAI SAW</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>c1</th>
                                    <th>c2</th>
                                    <th>c3</th>
                                    <th>c4</th>
                                    <th>c5</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatives as $alternative)
                                    <tr>
                                        <td>{{ $alternative->c1 }}</td>
                                        <td>{{ $alternative->c2 }}</td>
                                        <td>{{ $alternative->c3 }}</td>
                                        <td>{{ $alternative->c4 }}</td>
                                        <td>{{ $alternative->c5 }}</td>
                                        <td>{{ $alternative->nilai }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                
                        <h3 class="mt-4">NILAI AHP</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>c1</th>
                                    <th>c2</th>
                                    <th>c3</th>
                                    <th>c4</th>
                                    <th>c5</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rankings as $ranking)
                                    <tr>
                                        <td>{{ $ranking->c1 }}</td>
                                        <td>{{ $ranking->c2 }}</td>
                                        <td>{{ $ranking->c3 }}</td>
                                        <td>{{ $ranking->c4 }}</td>
                                        <td>{{ $ranking->c5 }}</td>
                                        <td>{{ $ranking->score }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('room-area')
<div class="container">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="developer-item text-center">
                <div class="developer-img">
                    <img src="path_to_yosi_image" alt="Yosi Rifai Putra" class="rounded-circle">
                </div>
                <h4>Yosi Rifai Putra</h4>
                <p>Pengembang Sistem</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="developer-item text-center">
                <div class="developer-img">
                    <img src="path_to_soffa_image" alt="Soffa Zahara" class="rounded-circle">
                </div>
                <h4>Soffa Zahara</h4>
                <p>Pembimbing Pertama</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="developer-item text-center">
                <div class="developer-img">
                    <img src="path_to_luki_image" alt="Luki Ardiantoro" class="rounded-circle">
                </div>
                <h4>Luki Ardiantoro</h4>
                <p>Pengembang Kedua</p>
            </div>
        </div>
    </div>
</div>
@endsection