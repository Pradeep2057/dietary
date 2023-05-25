@extends('layouts.app')
@section('content')
@if(session('success'))
<div class="container">
    <div class="alert alert-info alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
<div class="container">
    <div class="row login-row">
        <div class="form-heading-top">
            <img src="{{ asset('storage/image/np.png') }}" alt="">
            <p class="mt-2">Department of Food Technology and Quality Control<br>
                Babarmahal,Kathmandu
            </p>
        </div>
        <form method="POST" action="{{ route('login') }}" class="entry-form login-form">
            @csrf
            <div class="row ">
                <h3>Reset Password</h3>
                <p>Please put your credentials below.</p>
            </div>
            <div class="row">
                <label for="" class="form-label cm">Email Address</label>
                <div class="input-container">
                    <img class="login-icon-left" src="{{ asset('storage/image/user.svg') }}" alt="">
                    <input id="email" type="email" class="form-control cm @error('email') is-invalid @enderror"
                        name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <label for="" class="form-label cm">Password</label>
                <div class="input-container">
                    <img class="login-icon-left" src="{{ asset('storage/image/lock-alt.svg') }}" alt="">
                    <input id="password" type="password" class="form-control cm @error('password') is-invalid @enderror" name="password"
                        required autocomplete="new-password" placeholder="Enter your Password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <label for="" class="form-label cm">Confirm Password</label>
                <div class="input-container">
                    <img class="login-icon-left" src="{{ asset('storage/image/lock-alt.svg') }}" alt="">
                    <input id="password-confirm" type="password" class="form-control cm" name="password_confirmation" required autocomplete="new-password"
                     placeholder="Confirm Password">
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-3">Reset Password</button>
        </form>
    </div>
</div>
@endsection