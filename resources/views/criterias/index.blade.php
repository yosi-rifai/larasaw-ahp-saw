@extends('admin.layout.main')

@section('content')
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-xl mt-n3 ms-4">
                <i class="material-icons opacity-10" aria-hidden="true">checklist</i>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <h2>Criteria List</h2>
                        </div>
                        <div class="ms-auto">
                            @php
                            $totalBobot = $criterias->sum('bobot');
                            @endphp

                            <div class="text-center"> <!-- Menggunakan class text-center untuk mengatur posisi secara horizontal -->
                                @if ($totalBobot == 1.00)
                                    <div style="margin-bottom: 10px;"> <!-- Menambahkan margin-bottom untuk jarak antara tombol dan span -->
                                        <button class="btn btn-primary" disabled>Create Criteria</button>
                                    </div>
                                    <span style="font-size: 12px; color: #6c757d;">Data Bobot Telah Mencapai Batas Maksimal</span>
                                @else
                                    <a href="{{ route('criterias.create') }}" class="btn btn-primary">Create Criteria</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    @include('modals.error')
                    @include('modals.success')
                    <div class="card-title">
                    <table class="table table-hover text-center mt-2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Bobot</th>
                                <th>Jenis</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($criterias as $criteria)
                                <tr>
                                    <td>{{ $criteria->id }}</td>
                                    <td>{{ $criteria->nama }}</td>
                                    <td>{{ $criteria->bobot }}</td>
                                    <td>{{ $criteria->jenis }}</td>
                                    <td>
                                        <a href="{{ route('criterias.edit', $criteria->id) }}" class="btn btn-warning" style="text-decoration: none; border: none; background: none; padding: 0; cursor: pointer;">
                                            <i class="material-icons" style="font-size: 1.7rem; color: rgb(255, 81, 0); vertical-align: middle;">edit</i> <!-- Icon Edit -->
                                        </a>

                                        <form action="{{ route('criterias.destroy', $criteria->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="border: none; background: none; padding: 0; cursor: pointer;">
                                                <i class="material-icons" style="font-size: 1.7rem; color: red; vertical-align: middle;">delete</i> <!-- Icon Delete -->
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
