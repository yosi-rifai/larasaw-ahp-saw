@extends('admin.layout.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h1 class="h4 mb-0">Edit Criteria</h1>
                    <a class="btn btn-light" href="{{ route('criterias.index') }}">Back</a>
                </div>
                <div class="card-body">
                    @include('modals.error')
                    <form action="{{ route('criterias.update', $criteria->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $criteria->nama }}">
                        </div>
                        <div class="mb-3">
                            <label for="bobot" class="form-label">Bobot</label>
                            <input type="number" class="form-control" id="bobot" name="bobot" value="{{ $criteria->bobot }}" step="0.01" min="0" max="99.99">
                        </div>
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis</label>
                            <select class="form-control" id="jenis" name="jenis">
                                <option value="benefit" {{ $criteria->jenis == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                <option value="cost" {{ $criteria->jenis == 'cost' ? 'selected' : '' }}>Cost</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
