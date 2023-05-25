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
                <span>Babarmahal, Kathmandu</span> 
            </p>
        </div>
        <form method="POST" action="{{ route('login') }}" class="entry-form login-form">
            @csrf
            <div class="row fst-row">
                <h3>Login to your Account</h3>
                <p>Please put your login credentials below.</p>
            </div>
            <div class="row">
                <label for="" class="form-label cm">Email Address</label>
                <div class="input-container">
                    <img class="login-icon-left" src="{{ asset('storage/image/user.svg') }}" alt="">
                    <input id="email" type="email" class="form-control cm @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required autocomplete="email" autofocus aria-describedby="emailHelp"
                        placeholder="Enter your Email Address" name="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <label for="" class="form-label cm">Password</label>
                <div class="input-container">
                    <img class="login-icon-left" src="{{ asset('storage/image/lock-alt.svg') }}" alt="">
                    <input id="password" type="password" class="form-control cm @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" aria-describedby="passwordHelp"
                        placeholder="Enter your Password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mx-1 mt-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>

        </form>
        <div class="row btm-text">
            @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                Forget your password?
            </a>
            @endif
        </div>
    </div>
</div>
@endsection