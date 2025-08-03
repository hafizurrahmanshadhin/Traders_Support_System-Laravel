<header>
    <div class="container">
        <div class="header--content--wrapper">

            <div class="icon--logo--wrapper">
                {{-- hamburger icon --}}
                <div class="hamburger"><span></span><span></span><span></span></div>

                <div class="logo">
                    <img src="{{ $settings->logo ?? 'frontend/images/logo.svg' }}" alt="" />
                </div>
            </div>



            <div class="menu--links">
                <a href="{{ route('home') }}" class="active">Home</a>
                <a href="{{ route('home') }}#about">About us</a>
                <a href="{{ route('home') }}#services">Services</a>
                <a href="{{ route('home') }}#testimonial">Testimonials</a>
            </div>

            @if (auth()->check())
                <div class="btn--wrapper">
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin-dashboard') }}" class="btn--blank">
                            <span>Dashboard</span>
                        </a>
                    @elseif (auth()->user()->role === 'trade')
                        <a href="{{ route('trade.dashboard') }}" class="btn--blank">
                            <span>Dashboard</span>
                        </a>
                    @elseif (auth()->user()->role === 'pro')
                        <a href="{{ route('pro.dashboard') }}" class="btn--blank">
                            <span>Dashboard</span>
                        </a>
                    @endif
                    <a class="btn--fill" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="lni lni-exit"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            @else
                <div class="btn--wrapper">
                    <a href="{{ route('login') }}" class="btn--blank">
                        <span>Login</span>
                    </a>
                    <a href="{{ route('join') }}" class="btn--fill">
                        <span>Register Now</span>
                    </a>
                </div>
            @endif

        </div>
    </div>
</header>
