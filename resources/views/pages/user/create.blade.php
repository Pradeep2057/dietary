@extends('layouts.main')
@section('title', 'Create User')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Create User</h3>
</div>
<div class="form-cm">
    <form method="POST" action="{{ route('user.store') }}" class="entry-form ">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="" class="form-label cm">Full Name</label>
                <input type="text" class="form-control cm ps-2" placeholder="Enter your Full Name" name="name"
                    value="{{ old('name') }}" required>
            </div>
            <div class="col-md-4"> <label for="" class="form-label cm">Email Address</label>
                <input type="email" class="form-control cm" placeholder="Enter your Email Address" name="email"
                    value="{{ old('email') }}" required>
            </div>
            <div class="col-md-4">
                <label for="" class="form-label cm">User Role</label>
                <select name="role" class="form-select kit-form-control" required>
                    <option value="0">Verifier</option>
                    <option value="1">Reviewer</option>
                    <option value="2">Data Entry Operator</option>
                    <option value="3">Report Viewer</option>
                </select>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6"> <label for="" class="form-label cm">Password</label>
                <input placeholder="Enter password" id="password" type="password"
                    class="form-control cm @error('password') is-invalid @enderror" name="password" required
                    autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <small>{{ $message }}</small>
                </span>
                @enderror

            </div>
            <div class="col-md-6"> <label for="" class="form-label cm">Confirm Password</label>
                <input id="password-confirm" placeholder="Enter confirm password" type="password"
                    class="form-control cm" name="password_confirmation" required autocomplete="new-password">
            </div>

        </div>

        <button type="submit" class="btn btn-primary mt-2 w-25">Create User</button>
    </form>
</div>
@endsection