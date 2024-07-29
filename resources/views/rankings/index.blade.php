@extends('admin.layout.main')

@section('content')
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-xl mt-n3 ms-4">
                <i class="material-icons opacity-10" aria-hidden="true">assessment</i>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <h2>Rankings List</h2>
                        </div>
                        <div class="ms-auto">
                            <a href="{{ route('rankings.create') }}" class="btn btn-primary">Create Ranking</a>
                        </div>
                    </div>

                    @include('modals.success')
                        @include('modals.error')

                        <div class="table-responsive mt-4 text-center">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Hotel</th>
                                        <th>c1</th>
                                        <th>c2</th>
                                        <th>c3</th>
                                        <th>c4</th>
                                        <th>c5</th>
                                        <th>AHP Final</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rankings as $ranking)
                                    <tr>
                                        <td>{{ $ranking->id }}</td>
                                        <td>{{ $ranking->alternative->hotel->nama }}</td>
                                        <td>{{ $ranking->c1 }}</td>
                                        <td>{{ $ranking->c2 }}</td>
                                        <td>{{ $ranking->c3 }}</td>
                                        <td>{{ $ranking->c4 }}</td>
                                        <td>{{ $ranking->c5 }}</td>
                                        <td>{{ $ranking->score }}</td>
                                        <td>
                                            <div style="display: inline-flex;">
                                                <form action="{{ route('rankings.destroy', $ranking->id) }}" method="POST">
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
    </div>
</div>
@endsection
