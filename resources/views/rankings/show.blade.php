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
                    <h2>Ranking Details</h2>
                    <p><strong>ID:</strong> {{ $ranking->id }}</p>
                    <p><strong>Alternative ID:</strong> {{ $ranking->alternative_id }}</p>
                    <p><strong>Score:</strong> {{ $ranking->score }}</p>
                    <p><strong>Created At:</strong> {{ $ranking->created_at->format('Y-m-d H:i:s') }}</p>
                    <a href="{{ route('rankings.edit', $ranking->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('rankings.destroy', $ranking->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
