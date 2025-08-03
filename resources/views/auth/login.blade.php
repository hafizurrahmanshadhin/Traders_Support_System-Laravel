@extends('frontend.app')

@section('title', 'Login')

@section('content')
    <div class="joining--background--wrapper">
        <div class="overlay"></div>

        <div class="joining--content auth--area">
            <div class="logo">
                <img src="{{ asset('frontend/images/logo.svg') }}" alt=""/>
            </div>

            <div class="middle--area">
                <h3 class="title">Login</h3>

                <p class="subtitle">
                    Welcome Back, Please Enter your Details to Log In.
                </p>
            </div>


            <form id="login-form" method="POST" action="{{ route('login') }}" class="input--area">
                @csrf
                <div class="single--input">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="demo@gmail.com"
                           class="@error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus/>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="single--input pass">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="******************"
                           class="@error('password') is-invalid @enderror" required/>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="show--pass">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none">
                            <path
                                    d="M14.5299 9.46998L9.46992 14.53C8.81992 13.88 8.41992 12.99 8.41992 12C8.41992 10.02 10.0199 8.41998 11.9999 8.41998C12.9899 8.41998 13.8799 8.81998 14.5299 9.46998Z"
                                    stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path
                                    d="M17.8201 5.76998C16.0701 4.44998 14.0701 3.72998 12.0001 3.72998C8.47009 3.72998 5.18009 5.80998 2.89009 9.40998C1.99009 10.82 1.99009 13.19 2.89009 14.6C3.68009 15.84 4.60009 16.91 5.60009 17.77"
                                    stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path
                                    d="M8.41992 19.53C9.55992 20.01 10.7699 20.27 11.9999 20.27C15.5299 20.27 18.8199 18.19 21.1099 14.59C22.0099 13.18 22.0099 10.81 21.1099 9.39999C20.7799 8.87999 20.4199 8.38999 20.0499 7.92999"
                                    stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15.5099 12.7C15.2499 14.11 14.0999 15.26 12.6899 15.52" stroke="#292D32"
                                  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.47 14.53L2 22" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M22 2L14.53 9.47" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none">
                            <path
                                    d="M15.5799 12C15.5799 13.98 13.9799 15.58 11.9999 15.58C10.0199 15.58 8.41992 13.98 8.41992 12C8.41992 10.02 10.0199 8.41998 11.9999 8.41998C13.9799 8.41998 15.5799 10.02 15.5799 12Z"
                                    stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path
                                    d="M12.0001 20.27C15.5301 20.27 18.8201 18.19 21.1101 14.59C22.0101 13.18 22.0101 10.81 21.1101 9.39997C18.8201 5.79997 15.5301 3.71997 12.0001 3.71997C8.47009 3.71997 5.18009 5.79997 2.89009 9.39997C1.99009 10.81 1.99009 13.18 2.89009 14.59C5.18009 18.19 8.47009 20.27 12.0001 20.27Z"
                                    stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>

                <div class="additional--input">
                    <div class="checkbox--wrapper">
                        <input type="checkbox" name="remember" id="remember"/>
                        <label for="remember">Remember me</label>
                    </div>

                    <a href="{{ route('password.request') }}">
                        <p class="forgot--pass">Forgot Pass ?</p>
                    </a>
                </div>

                <button type="submit" class="submit">Log In</button>
            </form>

            <div class="other--login--area">
                <div class="or">
                    <span>Or</span>
                </div>

                <a href="{{ route('login.google') }}" class="btn google--btn">
                    <img src="{{ asset('frontend/images/google-icon.svg') }}" alt=""/>
                    <p>Login With Google</p>
                </a>
            </div>

            <p class="auth--instruction--text">
                Don’t have an account? <a href="{{ route('join') }}"> Sign Up</a>
            </p>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Check if an email is stored and populate the email field
            const savedEmail = localStorage.getItem('savedEmail');
            if (savedEmail) {
                document.getElementById('email').value = savedEmail;
            }

            // When logging in, save the email if "Remember Me" is checked
            document.getElementById('login-form').addEventListener('submit', function () {
                if (document.getElementById('remember').checked) {
                    const email = document.getElementById('email').value;
                    localStorage.setItem('savedEmail', email);
                }
            });
        });
    </script>
@endpush
