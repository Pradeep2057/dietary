@extends('layouts.main')
@section('title', 'Edit User')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Edit User</h3>
</div>
<div class="form-cm">
    <form method="POST" action="{{ route('user.update', $user->id) }}" class="entry-form ">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <label for="" class="form-label cm">Full Name</label>
                <input type="text" class="form-control cm ps-2 @error('name') is-invalid @enderror" placeholder="Enter your Full Name" name="name"
                    value="{{ old('name', $user->name) }}" >
            </div>
            <div class="col-md-4"> <label for="" class="form-label cm">Email Address</label>
                <input type="email" class="form-control cm @error('email') is-invalid @enderror" placeholder="Enter your Email Address" name="email"
                    value="{{ old('email', $user->email) }}" >
            </div>
            <div class="col-md-4">
                <label for="" class="form-label cm">User Role</label>
                <select name="role" class="form-select kit-form-control" required>
                    <option value="0" @if ($user->role == 0) selected @endif>Verifier</option>
                    <option value="1" @if ($user->role == 1) selected @endif>Reviewer</option>
                    <option value="2" @if ($user->role == 2) selected @endif>Data Entry Operator</option>
                    <option value="3" @if ($user->role == 3) selected @endif>Report Viewer</option>
                </select>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6"> 
                <label for="" class="form-label cm">New Password</label>
                <input placeholder="Enter password" id="password" type="password"
                    class="form-control cm @error('password') is-invalid @enderror" name="password"
                    autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <small>{{ $message }}</small>
                </span>
                @enderror

            </div>
            <div class="col-md-6"> <label for="" class="form-label cm">Confirm New Password</label>
                <input id="password-confirm" placeholder="Enter confirm password" type="password"
                    class="form-control cm" name="password_confirmation"  autocomplete="new-password">
            </div>

        </div>

        <button type="submit" class="btn btn-primary mt-2 w-25">Update User</button>
    </form>
</div>

@endsection