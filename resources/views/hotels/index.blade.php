@extends('admin.layout.main')

@section('style')
    <style>
        .pagination {
            margin: 20px 0;
        }

        .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #dee2e6;
        }

        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .page-link {
            color: #007bff;
        }

        .page-link:hover {
            color: #0056b3;
        }
    </style>
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-xl mt-n3 ms-4">
                <i class="material-icons opacity-10" aria-hidden="true">business</i>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="ms-3">
                        <h2>Hotels List</h2>
                    </div>
                    <div class="ms-auto">
                        <a class="btn btn-success" href="{{ route('hotels.create') }}">Create New Hotel</a>
                        <a class="btn btn-primary" href="{{ route('hotels.detail') }}">Grid Show Hotel</a>
                    </div>
                </div>

                @include('modals.success')

                <div class="table-responsive mt-4 text-center">
                    <table class="table table-hover">
                        <thead class="text-uppercase font-weight-bold">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Gmaps Rating</th>
                                <th>Fasilitas</th>
                                <th>Kemudahan Aksesibilitas</th>
                                <th>Kualitas Layanan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @php
                           $i = ($hotels->currentPage() - 1) * $hotels->perPage();
                        @endphp
                        <tbody>
                            @foreach ($hotels as $hotel)
                            <tr>
                                <td scope="row">{{ ++$i }}</td>
                                <td>{{ $hotel->nama }}</td>
                                <td>Rp.{{ number_format($hotel->harga, 2) }}</td>
                                <td>{{ $hotel->rating }}</td>
                                <td>{{ count(json_decode($hotel->fasilitas)) }}</td>
                                <td>{{ count(json_decode($hotel->kemudahan_aksesibilitas)) }}</td>
                                <td>{{ count(json_decode($hotel->kualitas_layanan)) }}</td>
                                <td>
                                    <div style="display: inline-flex">
                                        <a class="btn btn-primary mr-2" href="{{ route('hotels.edit', $hotel->id) }}" style="text-decoration: none; border: none; background: none; padding: 0; cursor: pointer;">
                                            <i class="material-icons" style="font-size: 1.7rem; color: rgb(255, 153, 0); vertical-align: middle;">edit</i>
                                        </a>
                                        <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger m-" style="border: none; background: none; padding: 0; cursor: pointer;">
                                                <i class="material-icons" style="font-size: 1.7rem; color: red; vertical-align: middle;">delete</i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @if($i < count($hotels))
                            <tr>
                                <td colspan="9">Error: Loop tidak mencakup semua data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $hotels->links('vendor.pagination.simple-bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-5">
        <div id="map" class="mt-0 mt-lg-n4"></div>
    </div>
</div>

@endsection
