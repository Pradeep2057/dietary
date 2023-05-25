@extends('layouts.app')
@section('content')
<div class="container">
    @if(session('status'))
    <div class="container">
        <div class="alert alert-info alert-dismissible fade show">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
    <div class="row login-row">
        <div class="form-heading-top">
            <img src="{{ asset('storage/image/np.png') }}" alt="">
            <p class="mt-2">Department of Food Technology and Quality Control<br>
                Babarmahal,Kathmandu
            </p>
        </div>
        <form method="POST" action="{{ route('password.email') }}" class="entry-form login-form">
            @csrf
            <div class="row ">
                <h3>Reset Password</h3>
                <p>Please enter your email address.</p>
            </div>
            <div class="row">
                <label for="" class="form-label cm">Email Address</label>
                <div class="input-container">
                    <img class="login-icon-left" src="{{ asset('storage/image/user.svg') }}" alt="">
                    <input id="email" type="email" class="form-control cm @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        autocomplete="email" autofocus aria-describedby="emailHelp"
                        placeholder="Enter your email address" name="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-3">Send Password Reset Link</button>
        </form>
    </div>
</div>
@endsection