@extends('frontend.app')

@section('title', 'Request OTP')

@section('content')
    <div class="joining--background--wrapper">
        <div class="overlay"></div>

        <div class="joining--content auth--area">
            <div class="logo">
                <img src="{{ asset('frontend/images/logo.svg') }}" alt="" />
            </div>

            <div class="middle--area">
                <h3 class="title">Request OTP</h3>

                <p class="subtitle">
                    Please enter your registered email to receive the OTP.
                </p>
            </div>

            <form id="request-otp-form" method="POST" action="{{ route('send.otp') }}" class="input--area">
                @csrf
                <div class="single--input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your registered email"
                        class="@error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus />

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="submit">Send OTP</button>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('email').focus();
        });
    </script>
@endpush
