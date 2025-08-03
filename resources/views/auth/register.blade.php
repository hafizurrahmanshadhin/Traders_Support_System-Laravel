@extends('frontend.app')

@section('title', 'Register')

@section('content')
    <div class="joining--background--wrapper">
        <div class="overlay"></div>

        {{-- content --}}
        <div class="joining--content auth--area">
            <div class="logo">
                <img src="{{ asset('frontend/images/logo.svg') }}" alt="" />
            </div>

            <div class="middle--area">
                <h3 class="title">Register</h3>

                <p class="subtitle">
                    To Create Account, Please Fill in the From Below.
                </p>
            </div>

            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

            <form method="POST" action="{{ route('register') }}" class="input--area">
                @csrf
                <input type="hidden" name="role" value="{{ request()->input('role') }}">
                <input type="hidden" name="question_id" value="{{ request()->input('question_id') }}">
                <input type="hidden" name="option_id" value="{{ request()->input('option_id') }}">
                <input type="hidden" name="answer_text" value="{{ request()->input('answer_text') }}">

                <div class="single--input">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your full name" required />
                    @error('name')
                        <div class="invalid-feedback d-block" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="single--input">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email address" required />
                    @error('email')
                        <div class="invalid-feedback d-block" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="single--input pass">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="******************" required />
                    @error('password')
                        <div class="invalid-feedback d-block" style="color: red;">{{ $message }}</div>
                    @enderror

                    <div class="show--pass">
                        {{-- show icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M14.5299 9.46998L9.46992 14.53C8.81992 13.88 8.41992 12.99 8.41992 12C8.41992 10.02 10.0199 8.41998 11.9999 8.41998C12.9899 8.41998 13.8799 8.81998 14.5299 9.46998Z"
                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M17.8201 5.76998C16.0701 4.44998 14.0701 3.72998 12.0001 3.72998C8.47009 3.72998 5.18009 5.80998 2.89009 9.40998C1.99009 10.82 1.99009 13.19 2.89009 14.6C3.68009 15.84 4.60009 16.91 5.60009 17.77"
                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M8.41992 19.53C9.55992 20.01 10.7699 20.27 11.9999 20.27C15.5299 20.27 18.8199 18.19 21.1099 14.59C22.0099 13.18 22.0099 10.81 21.1099 9.39999C20.7799 8.87999 20.4199 8.38999 20.0499 7.92999"
                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15.5099 12.7C15.2499 14.11 14.0999 15.26 12.6899 15.52" stroke="#292D32"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9.47 14.53L2 22" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M22 2L14.53 9.47" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>

                        {{-- hide icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M15.5799 12C15.5799 13.98 13.9799 15.58 11.9999 15.58C10.0199 15.58 8.41992 13.98 8.41992 12C8.41992 10.02 10.0199 8.41998 11.9999 8.41998C13.9799 8.41998 15.5799 10.02 15.5799 12Z"
                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M12.0001 20.27C15.5301 20.27 18.8201 18.19 21.1101 14.59C22.0101 13.18 22.0101 10.81 21.1101 9.39997C18.8201 5.79997 15.5301 3.71997 12.0001 3.71997C8.47009 3.71997 5.18009 5.79997 2.89009 9.39997C1.99009 10.81 1.99009 13.18 2.89009 14.59C5.18009 18.19 8.47009 20.27 12.0001 20.27Z"
                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>

                <div class="single--input pass">
                    <label for="confirm">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="confirm" placeholder="Retype password"
                        required />
                    @error('password_confirmation')
                        <div class="invalid-feedback d-block" style="color: red;">{{ $message }}</div>
                    @enderror

                    <div class="show--pass">
                        {{-- show icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M14.5299 9.46998L9.46992 14.53C8.81992 13.88 8.41992 12.99 8.41992 12C8.41992 10.02 10.0199 8.41998 11.9999 8.41998C12.9899 8.41998 13.8799 8.81998 14.5299 9.46998Z"
                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M17.8201 5.76998C16.0701 4.44998 14.0701 3.72998 12.0001 3.72998C8.47009 3.72998 5.18009 5.80998 2.89009 9.40998C1.99009 10.82 1.99009 13.19 2.89009 14.6C3.68009 15.84 4.60009 16.91 5.60009 17.77"
                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M8.41992 19.53C9.55992 20.01 10.7699 20.27 11.9999 20.27C15.5299 20.27 18.8199 18.19 21.1099 14.59C22.0099 13.18 22.0099 10.81 21.1099 9.39999C20.7799 8.87999 20.4199 8.38999 20.0499 7.92999"
                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15.5099 12.7C15.2499 14.11 14.0999 15.26 12.6899 15.52" stroke="#292D32"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9.47 14.53L2 22" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M22 2L14.53 9.47" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>

                        {{-- hide icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M15.5799 12C15.5799 13.98 13.9799 15.58 11.9999 15.58C10.0199 15.58 8.41992 13.98 8.41992 12C8.41992 10.02 10.0199 8.41998 11.9999 8.41998C13.9799 8.41998 15.5799 10.02 15.5799 12Z"
                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M12.0001 20.27C15.5301 20.27 18.8201 18.19 21.1101 14.59C22.0101 13.18 22.0101 10.81 21.1101 9.39997C18.8201 5.79997 15.5301 3.71997 12.0001 3.71997C8.47009 3.71997 5.18009 5.79997 2.89009 9.39997C1.99009 10.81 1.99009 13.18 2.89009 14.59C5.18009 18.19 8.47009 20.27 12.0001 20.27Z"
                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>

                {{-- additional input --}}
                <div class="additional--input terms">
                    <div class="checkbox--wrapper">
                        <input type="hidden" name="terms_accepted" value="0">
                        <input type="checkbox" name="terms_accepted" id="terms">
                        <label for="terms">I hereby confirm and accept the Terms of Service and the
                            Privacy Policy. I certify that I am over 18 years of age.
                        </label>
                        @error('terms_accepted')
                            <div class="invalid-feedback d-block" style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="submit">Register Now</button>
            </form>

            {{-- other login area --}}
            <div class="other--login--area">
                <div class="or">
                    <span>Or</span>
                </div>

                <a href="{{ route('login.google') }}" class="btn google--btn">
                    <img src="{{ asset('frontend/images/google-icon.svg') }}" alt="" />
                    <p>Sign Up With Google</p>
                </a>
            </div>

            <p class="auth--instruction--text">
                Already have an account ? <a href="{{ route('login') }}"> Log In</a>
            </p>
        </div>
    </div>
@endsection
