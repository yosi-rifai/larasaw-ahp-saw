@extends('admin.layout.main')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>Edit Alternative</h1>
            <form action="{{ route('alternatives.update', $alternative->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="hotel_id">Hotel</label>
                    <select name="hotel_id" id="hotel_id" class="form-control">
                        @foreach($hotels as $hotel)
                            <option value="{{ $hotel->id }}" {{ $hotel->id == $alternative->hotel_id ? 'selected' : '' }}>{{ $hotel->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="criteria_id">Criteria</label>
                    <select name="criteria_id" id="criteria_id" class="form-control">
                        @foreach($criteria as $criterion)
                            <option value="{{ $criterion->id }}" {{ $criterion->id == $alternative->criteria_id ? 'selected' : '' }}>{{ $criterion->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nilai">Nilai</label>
                    <input type="text" name="nilai" id="nilai" class="form-control" value="{{ $alternative->nilai }}">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
