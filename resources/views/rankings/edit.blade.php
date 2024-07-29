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
                    <h2>Edit Ranking</h2>
                    <form action="{{ route('rankings.update', $ranking->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="alternative_id" class="form-label">Alternative ID</label>
                            <input type="text" class="form-control" id="alternative_id" name="alternative_id" value="{{ $ranking->alternative_id }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="score" class="form-label">Score</label>
                            <input type="text" class="form-control" id="score" name="score" value="{{ $ranking->score }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
