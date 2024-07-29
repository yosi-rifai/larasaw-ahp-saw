@extends('admin.layout.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h2 class="h4 mb-0 text-white">Add New Hotel</h2>
                    <a class="btn btn-light" href="{{ route('hotels.index') }}">Back</a>
                </div>
                <div class="card-body">
                    @include('modals.error')
                    <form action="{{ route('hotels.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>Gambar:</strong>
                                    <input type="file" name="hotel_image_url" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <strong>Nama:</strong>
                                    <input type="text" name="nama" class="form-control" placeholder="Nama">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <strong>Lokasi:</strong>
                                    <input type="text" name="lokasi" class="form-control" placeholder="Lokasi">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Harga:</strong>
                                    <input type="Integer" name="harga" class="form-control" placeholder="Harga">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Rating:</strong>
                                    <input type="number" name="rating" class="form-control" placeholder="Rating" step="0.1">
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        @include('modals.modal_info', ['modalType' => 'fasilitas'])
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>Fasilitas:
                                        {{-- <button type="button" class="btn btn-sm btn-info rounded-circle ml-2" data-toggle="modal" data-target="#infoModal" data-modal-type="fasilitas">
                                            <i class="fas fa-info-circle"></i>
                                        </button> --}}
                                    </strong><br>
                                    @foreach(['Kamar', 'Kamar Mandi', 'Akses Internet', 'Sarapan', 'Parkir', 'AC/Pemanas', 'Playground', 'Lobby Hotel', 'Ruangan Fungsional', 'Televisi'] as $index => $fasilitas)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="fasilitas_{{ $index }}" name="fasilitas[]" value="{{ $fasilitas }}">
                                        <label class="form-check-label" for="fasilitas_{{ $index }}">{{ $fasilitas }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>Kualitas Layanan:
                                        {{-- <button type="button" class="btn btn-sm btn-info rounded-circle ml-2" data-toggle="modal" data-target="#infoModal" data-modal-type="kualitas_layanan">
                                            <i class="fas fa-info-circle"></i>
                                        </button> --}}
                                    </strong><br>
                                    @foreach(['Keramahan Staf', 'Pelayanan Cepat dan Efisien', 'Kebersihan dan Perawatan Kamar', 'Tanggapan Staf atas Keluhan', 'Personalisasi Layanan', 'Keamanan Pelanggan'] as $index => $kualitas)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="kualitas_{{ $index }}" name="kualitas_layanan[]" value="{{ $kualitas }}">
                                        <label class="form-check-label" for="kualitas_{{ $index }}">{{ $kualitas }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>Kemudahan Aksesibilitas:
                                        {{-- <button type="button" class="btn btn-sm btn-info rounded-circle ml-2" data-toggle="modal" data-target="#infoModal" data-modal-type="kemudahan_aksesibilitas">
                                            <i class="fas fa-info-circle"></i>
                                        </button> --}}
                                    </strong><br>
                                    @foreach(['Akses Fisik', 'Akses Informasi', 'Pelatihan Staf', 'Akses ke Layanan Tambahan', 'Fleksibilitas Reservasi', 'Keamanan Aksesibilitas', 'Kerjasama Organisasi dan Asosiasi', 'Komunikasi yang Efektif'] as $index => $aksesibilitas)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="aksesibilitas_{{ $index }}" name="kemudahan_aksesibilitas[]" value="{{ $aksesibilitas }}">
                                        <label class="form-check-label" for="aksesibilitas_{{ $index }}">{{ $aksesibilitas }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
