@extends('frontend.app')

@section('title', 'Verify Email')

@section('content')
    <div class="joining--background--wrapper">
        <div class="overlay"></div>

        <div class="joining--content auth--area">
            <div class="logo">
                <img src="{{ asset('frontend/images/logo.svg') }}" alt="" />
            </div>

            <div class="middle--area">
                <h3 class="title">Verify OTP</h3>

                <p class="subtitle">
                    Please enter the OTP sent to your registered email.
                </p>
            </div>

            <form id="verify-otp-form" method="POST" action="{{ route('verify.otp') }}" class="input--area">
                @csrf
                <div class="single--input">
                    <label for="otp">OTP Code</label>
                    <input type="number" name="otp" id="otp" placeholder="Enter your OTP code"
                        class="@error('otp') is-invalid @enderror" value="{{ old('otp') }}" required autofocus />

                    @error('otp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="submit">Verify OTP</button>
            </form>

            <p class="auth--instruction--text">
                Didn't receive an OTP? <a href="{{ route('resend.otp') }}">Resend OTP</a>
            </p>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('otp').focus();
        });
    </script>
@endpush
