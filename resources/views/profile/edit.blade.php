@extends('admin.layout.main')

@section('content')
<div class="container py-5">
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <div class="card mb-4">
          <div class="card-body">
            @include('modals.error')
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="form-group mb-3">
                <label for="name">Full Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}">
              </div>
              <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}">
              </div>
              <div class="form-group mb-3">
                <label for="profile_image">Profile Image</label>
                <input type="file" name="profile_image" class="form-control" id="profile_image">
              </div>
              <div class="form-group mb-3">
                <label for="birth_date">Birth Date</label>
                <input type="date" name="birth_date" class="form-control" id="birth_date" value="{{ old('birth_date', $user->birth_date) }}">
              </div>
              <div class="form-group mb-3">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" id="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
              </div>
              <div class="form-group mb-3">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" id="address" value="{{ old('address', $user->address) }}">
              </div>
              <div class="form-group mb-3">
                <label for="occupation">Occupation</label>
                <input type="text" name="occupation" class="form-control" id="occupation" value="{{ old('occupation', $user->occupation) }}">
              </div>
              <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
