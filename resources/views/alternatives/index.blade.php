@extends('admin.layout.main')

@section('content')
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-xl mt-n3 ms-4">
                <i class="material-icons opacity-10" aria-hidden="true">compare</i>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="ms-3">
                        <h2>Nilai Akhir SAW</h2>
                    </div>
                    <div class="ms-auto">
                        <a href="{{ route('alternatives.create') }}" class="btn btn-primary">Create New Alternative</a>
                        {{-- <a href="{{ url('alternatives/delete-all') }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete all alternatives?')">Delete All Alternatives</a> --}}
                    </div>
                </div>

                @include('modals.success')
                @include('modals.error')

                <div class="table-responsive mt-4 text-center">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>NO</th>
                                <th>Hotel</th>
                                <th>C1</th>
                                <th>C2</th>
                                <th>C3</th>
                                <th>C4</th>
                                <th>C5</th>
                                <th>Nilai Akhir</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @php
                            $i = 0;
                        @endphp
                        <tbody>
                            @foreach($alternatives as $alternative)
                                <tr>
                                    <td scope="row">{{ ++$i }}</td>
                                    <td>{{ $alternative->hotel->nama }}</td>
                                    <td>{{ $alternative->c1 }}</td>
                                    <td>{{ $alternative->c2 }}</td>
                                    <td>{{ $alternative->c3 }}</td>
                                    <td>{{ $alternative->c4 }}</td>
                                    <td>{{ $alternative->c5 }}</td>
                                    <td>{{ $alternative->nilai }}</td>
                                    <td>
                                        <div style="display: inline-flex">
                                            <form action="{{ route('alternatives.destroy', $alternative->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" style="border: none; background: none; padding: 0; cursor: pointer;">
                                                    <i class="material-icons" style="font-size: 1.7rem; color: red; vertical-align: middle;">delete</i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-5">
        <div id="map" class="mt-0 mt-lg-n4"></div>
    </div>
</div>
@endsection
