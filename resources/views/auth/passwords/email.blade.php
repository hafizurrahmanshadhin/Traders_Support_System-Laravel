@extends('frontend.app')

@section('title', 'Reset Password')

@section('content')
    <div class="joining--background--wrapper">
        <div class="overlay"></div>

        <div class="joining--content auth--area">
            <div class="logo">
                <img src="{{ asset('frontend/images/logo.svg') }}" alt=""/>
            </div>

            <div class="middle--area">
                <h3 class="title">Reset Password</h3>

                <p class="subtitle">
                    Please Enter your Email Address to Receive a Password Reset Link.
                </p>
            </div>

            <form method="POST" action="{{ route('password.email') }}" class="input--area">
                @csrf
                <div class="single--input">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="demo@gmail.com"
                           class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                           autofocus/>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="submit">Send Password Reset Link</button>
            </form>

            <p class="auth--instruction--text">
                Don’t have an account? <a href="{{ route('join') }}"> Sign Up</a>
            </p>
        </div>
    </div>
@endsection
