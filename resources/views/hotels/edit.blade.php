@extends('admin.layout.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h2 class="h4 mb-0">Edit Hotel</h2>
                    <a class="btn btn-light" href="{{ route('hotels.index') }}">Back</a>
                </div>
                <div class="card-body">
                    @include('modals.error')

                    <form action="{{ route('hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="hotel_image_url" class="col-md-2 col-form-label">Gambar:</label>
                            <div class="col-md-10">
                                <input type="file" id="hotel_image_url" name="hotel_image_url" class="form-control-file">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-md-2 col-form-label">Nama:</label>
                            <div class="col-md-10">
                                <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" value="{{ $hotel->nama }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lokasi" class="col-md-2 col-form-label">Lokasi:</label>
                            <div class="col-md-10">
                                <input type="text" id="lokasi" name="lokasi" class="form-control" placeholder="Lokasi" value="{{ $hotel->lokasi }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="harga" class="col-md-2 col-form-label">Harga:</label>
                            <div class="col-md-4">
                                <input type="number" id="harga" name="harga" class="form-control" placeholder="Harga" value="{{ $hotel->harga }}">
                            </div>

                            <label for="rating" class="col-md-2 col-form-label">Rating:</label>
                            <div class="col-md-4">
                                <input type="number" id="rating" name="rating" class="form-control" placeholder="Rating" step="0.1" value="{{ $hotel->rating }}">
                            </div>
                        </div>

                        <hr class="my-4">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <strong>Fasilitas:</strong><br>
                                @foreach(['Kamar', 'Kamar Mandi', 'Akses Internet', 'Sarapan', 'Parkir', 'AC/Pemanas', 'Playground', 'Lobby Hotel', 'Ruangan Fungsional', 'Televisi'] as $index => $fasilitas)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="fasilitas_{{ $index }}" name="fasilitas[]" value="{{ $fasilitas }}"
                                        {{ in_array($fasilitas, json_decode($hotel->fasilitas, true) ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fasilitas_{{ $index }}">{{ $fasilitas }}</label>
                                </div>
                                @endforeach
                            </div>

                            <div class="col-md-4">
                                <strong>Kualitas Layanan:</strong><br>
                                @foreach(['Keramahan Staf', 'Pelayanan Cepat dan Efisien', 'Kebersihan dan Perawatan Kamar', 'Tanggapan Staf atas Keluhan', 'Personalisasi Layanan', 'Keamanan Pelanggan'] as $index => $kualitas)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="kualitas_{{ $index }}" name="kualitas_layanan[]" value="{{ $kualitas }}"
                                        {{ in_array($kualitas, json_decode($hotel->kualitas_layanan, true) ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kualitas_{{ $index }}">{{ $kualitas }}</label>
                                </div>
                                @endforeach
                            </div>

                            <div class="col-md-4">
                                <strong>Kemudahan Aksesibilitas:</strong><br>
                                @foreach(['Akses Fisik', 'Akses Informasi', 'Pelatihan Staf', 'Akses ke Layanan Tambahan', 'Fleksibilitas Reservasi', 'Keamanan Aksesibilitas', 'Kerjasama Organisasi dan Asosiasi', 'Komunikasi yang Efektif'] as $index => $aksesibilitas)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="aksesibilitas_{{ $index }}" name="kemudahan_aksesibilitas[]" value="{{ $aksesibilitas }}"
                                        {{ in_array($aksesibilitas, json_decode($hotel->kemudahan_aksesibilitas, true) ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="aksesibilitas_{{ $index }}">{{ $aksesibilitas }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-6">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
