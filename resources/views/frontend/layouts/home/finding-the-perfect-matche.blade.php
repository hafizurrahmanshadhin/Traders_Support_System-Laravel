<section class="perfect--match--area--wrapper">
    <div class="container">
        <div class="perfect--match--area--content">
            <div class="top--area">
                <h3 class="common--heading--title">
                    Your Partner in Finding The Perfect <span>Match</span>
                </h3>

                <p class="sub">
                    Need flexible workers on short notice? We are here for the
                    rescue!
                </p>
            </div>

            <div class="match--slider--wrapper">
                <div class="owl-carousel owl-theme">
                    @forelse ($findingThePerfectMatches as $match)
                        <div class="item">
                            <div class="single--slide">
                                <img src="{{ asset($match->image) }}" alt="{{ $match->title }}" />
                                <div class="overlay"></div>

                                <div class="hover--content">
                                    <div class="left">
                                        <p class="title">{{ $match->title }}</p>
                                    </div>
                                    <div class="right">
                                        <a href="{{ route('join') }}" class="btn--fill">
                                            <span> Contact Us </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="item">
                            <div class="single--slide">
                                <img src="{{ asset('frontend/images/match-slider (1).png') }}" alt="" />
                                <div class="overlay"></div>

                                <div class="hover--content">
                                    <div class="left">
                                        <p class="title">Catering</p>
                                    </div>
                                    <div class="right">
                                        <a href="{{ route('join') }}" class="btn--fill">
                                            <span> Contact Us </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="single--slide">
                                <img src="{{ asset('frontend/images/match-slider (2).png') }}" alt="" />
                                <div class="overlay"></div>

                                <div class="hover--content">
                                    <div class="left">
                                        <p class="title">Catering</p>
                                    </div>
                                    <div class="right">
                                        <a href="{{ route('join') }}" class="btn--fill">
                                            <span> Contact Us </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="single--slide">
                                <img src="{{ asset('frontend/images/match-slider (3).png') }}" alt="" />
                                <div class="overlay"></div>

                                <div class="hover--content">
                                    <div class="left">
                                        <p class="title">Catering</p>
                                    </div>
                                    <div class="right">
                                        <a href="{{ route('join') }}" class="btn--fill">
                                            <span> Contact Us </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="single--slide">
                                <img src="{{ asset('frontend/images/match-slider (4).png') }}" alt="" />
                                <div class="overlay"></div>

                                <div class="hover--content">
                                    <div class="left">
                                        <p class="title">Catering</p>
                                    </div>
                                    <div class="right">
                                        <a href="{{ route('join') }}" class="btn--fill">
                                            <span> Contact Us </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="single--slide">
                                <img src="{{ asset('frontend/images/match-slider (2).png') }}" alt="" />
                                <div class="overlay"></div>

                                <div class="hover--content">
                                    <div class="left">
                                        <p class="title">Catering</p>
                                    </div>
                                    <div class="right">
                                        <a href="{{ route('join') }}" class="btn--fill">
                                            <span> Contact Us </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="single--slide">
                                <img src="{{ asset('frontend/images/match-slider (3).png') }}" alt="" />
                                <div class="overlay"></div>

                                <div class="hover--content">
                                    <div class="left">
                                        <p class="title">Catering</p>
                                    </div>
                                    <div class="right">
                                        <a href="{{ route('join') }}" class="btn--fill">
                                            <span> Contact Us </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
