@extends('layouts.main')

@section('title', 'Change Password')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Change Password</h3>
</div>

<div class="form-cm">
    <form method="POST" action="{{ route('user.updatePassword') }}" class="entry-form ">
        @csrf
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="" class="form-label cm">Current Password</label>
                <input type="password" class="form-control cm ps-2 @error('new-password') is-invalid @enderror"
                    placeholder="Enter your current password" name="current-password" required>
                @error('current-password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="" class="form-label cm">New Password</label>
                <input placeholder="Enter new password" id="password" type="password"
                    class="form-control cm @error('password') is-invalid @enderror" name="new-password"
                    autocomplete="new-password">

                @error('new-password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>
            <div class="col-md-6"> <label for="" class="form-label cm">Confirm New Password</label>
                <input name="new-password_confirmation" placeholder="Enter confirm password" type="password"
                    class="form-control cm @error('new-password_confirmation') is-invalid @enderror"
                    autocomplete="new-password">

                @error('new-password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <button type="submit" class="btn btn-primary mt-2 w-25">Change Password</button>
    </form>
</div>
@endsection