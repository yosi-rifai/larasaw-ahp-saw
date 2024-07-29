@extends('admin.layout.main')

@section('content')
<div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="{{ Auth::user()->profile_image ? asset('images/profiles/'.Auth::user()->profile_image_url) : asset('images/default_image/user.jpg') }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3">{{ $user->name }}</h5>
            <p class="text-muted mb-1">{{ $user->occupation ?? 'Occupation' }}</p>
            <p class="text-muted mb-4">{{ $user->address ?? 'Address' }}</p>
            <div class="d-flex justify-content-center mb-2">
              <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
              <form action="{{ route('profile.destroy') }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger ms-1">Delete Account</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      @include('modals.success')
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $user->name }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $user->email }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $user->phone_number ?? 'N/A' }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Birth Date</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $user->birth_date ?? 'N/A' }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $user->address ?? 'N/A' }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Occupation</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $user->occupation ?? 'N/A' }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
