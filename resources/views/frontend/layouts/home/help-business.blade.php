<section class="need--help--area--wrapper">
    <div class="container">
        <div class="need--help--content">
            <div class="area--wrapper">
                <div class="top">
                    <p class="subtitle">Need Help In Your Business?</p>
                    <p class="title">Why Pro's love us</p>
                </div>
                <div class="service--list">
                    @forelse ($helpBusinessesPro as $business)
                        <div class="single--list">
                            <div class="icon">
                                <img src="{{ asset($business->image) }}" alt="{{ $business->title }}" />
                            </div>
                            <div class="text--area">
                                <p class="intro">{{ $business->title }}:</p>
                                <p class="desc">{!! $business->description !!}</p>
                            </div>
                        </div>
                    @empty
                        <div class="single--list">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/service-icon (4).png') }}" alt="" />
                            </div>

                            <div class="text--area">
                                <p class="intro">Expand Your Client Base:</p>

                                <p class="desc">
                                    By joining forces with skilled tradespersons, you tap into
                                    a new pool of potential clients. From plumbers to
                                    electricians, carpenters to HVAC technicians, these
                                    professionals often require specialized services like
                                    legal counsel, financial management, administrative
                                    support, and more.
                                </p>
                            </div>
                        </div>
                        <div class="single--list">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/service-icon (3).png') }}" alt="" />
                            </div>

                            <div class="text--area">
                                <p class="intro">Create Value-Added Services:</p>

                                <p class="desc">
                                    Your expertise complements that of skilled tradespersons,
                                    allowing you to offer comprehensive solutions to clients.
                                    Whether you assist with contract drafting, manage
                                    finances, provide legal advice, or streamline
                                    administrative processes, your services enhance the
                                    overall value proposition for clients.
                                </p>
                            </div>
                        </div>
                        <div class="single--list">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/service-icon (2).png') }}" alt="" />
                            </div>

                            <div class="text--area">
                                <p class="intro">Build Long-Term Relationships:</p>

                                <p class="desc">
                                    Trade Support Pros is an online platform where
                                    tradespersons and service professionals can register their
                                    profiles.
                                </p>
                            </div>
                        </div>
                        <div class="single--list">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/service-icon (1).png') }}" alt="" />
                            </div>

                            <div class="text--area">
                                <p class="intro">Gain Insights into Other Industries:</p>

                                <p class="desc">
                                    Partnering with skilled tradespersons exposes you to
                                    different industries and their unique challenges. This
                                    cross-pollination of ideas can spark innovation, broaden
                                    your perspective, and ultimately make you a more versatile
                                    and adaptable professional.
                                </p>
                            </div>
                        </div>
                        <div class="single--list">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/service-icon (1).png') }}" alt="" />
                            </div>

                            <div class="text--area">
                                <p class="intro">Diversify Your Revenue Streams:</p>

                                <p class="desc">
                                    By diversifying your client portfolio to include skilled
                                    tradespersons, you reduce reliance on any single market or
                                    industry. This stability can be particularly advantageous
                                    during economic downturns or fluctuations in demand within
                                    your primary client base.
                                </p>
                            </div>
                        </div>
                        <div class="single--list">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/service-icon (1).png') }}" alt="" />
                            </div>

                            <div class="text--area">
                                <p class="intro">Contribute to Community Growth:</p>

                                <p class="desc">
                                    By supporting skilled tradespersons, you're not just
                                    building your own business but also contributing to local
                                    communities' growth and vitality. Strong partnerships
                                    between service professionals and skilled tradespersons
                                    foster economic development, job creation, and prosperity.
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="btn--wrapper">
                    <a href="{{ route('join') }}" class="btn--fill">
                        <span>Register Now</span>
                    </a>
                </div>
            </div>



            <div class="area--wrapper">
                <div class="top">
                    <p class="subtitle">Need Help In Your Business?</p>

                    <p class="title">Why People In The Trades Love Us</p>
                </div>

                <div class="service--list">
                    @forelse ($helpBusinessesTrade as $business)
                        <div class="single--list">
                            <div class="icon">
                                <img src="{{ asset($business->image) }}" alt="{{ $business->title }}" />
                            </div>
                            <div class="text--area">
                                <p class="intro">{{ $business->title }}:</p>
                                <p class="desc">{!! $business->description !!}</p>
                            </div>
                        </div>
                    @empty
                        <div class="single--list">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/service-icon (4).png') }}" alt="" />
                            </div>

                            <div class="text--area">
                                <p class="intro">Focus on Your Core Strengths:</p>

                                <p class="desc">
                                    As a skilled tradesperson, your time and energy are best
                                    spent honing your craft and serving your clients. By
                                    enlisting the support of service professionals, you can
                                    offload tasks such as bookkeeping, contract management,
                                    legal compliance, and administrative duties, allowing you
                                    to focus on what you do best.
                                </p>
                            </div>
                        </div>
                        <div class="single--list">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/service-icon (3).png') }}" alt="" />
                            </div>

                            <div class="text--area">
                                <p class="intro">
                                    Enhance Professionalism and Credibility:
                                </p>

                                <p class="desc">
                                    Collaborating with service professionals adds a layer of
                                    professionalism to your business dealings. Clients value
                                    partners who demonstrate a commitment to excellence in
                                    every aspect of their operation. With the support of
                                    service professionals, you can present yourself as a
                                    well-rounded, reputable entity, enhancing your credibility
                                    in the eyes of potential clients.
                                </p>
                            </div>
                        </div>
                        <div class="single--list">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/service-icon (2).png') }}" alt="" />
                            </div>

                            <div class="text--area">
                                <p class="intro">Streamline Business Operations:</p>

                                <p class="desc">
                                    Managing the day-to-day operations of a trade business can
                                    be overwhelming. Service professionals bring efficiency
                                    and organization to your business processes, helping you
                                    streamline operations, reduce overhead costs, and optimize
                                    productivity.
                                </p>
                            </div>
                        </div>
                        <div class="single--list">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/service-icon (1).png') }}" alt="" />
                            </div>

                            <div class="text--area">
                                <p class="intro">
                                    Navigate Regulatory Challenges with Ease:
                                </p>

                                <p class="desc">
                                    The regulatory landscape for skilled tradespersons is
                                    constantly evolving, with numerous compliance requirements
                                    to adhere to. Service professionals with expertise in
                                    legal and regulatory matters can help you confidently
                                    navigate these challenges, ensuring that your business
                                    remains compliant and protected.
                                </p>
                            </div>
                        </div>
                        <div class="single--list">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/service-icon (1).png') }}" alt="" />
                            </div>

                            <div class="text--area">
                                <p class="intro">Forge Long-Term Partnerships:</p>

                                <p class="desc">
                                    Beyond transactional relationships, partnering with
                                    service professionals fosters long-term collaborations
                                    built on trust, reliability, and mutual respect. As you
                                    work together to support each other's businesses, you'll
                                    form enduring partnerships contributing to your success.
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="btn--wrapper">
                    <a href="{{ route('join') }}" class="btn--fill">
                        <span>Register Now</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
