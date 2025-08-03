@extends('frontend.dashboard')

@section('title', 'Subscription')

@section('content')
    <div class="dashboard--main--content">
        <div class="subscription--area--wrapper">
            <div class="top--area">
                <div class="logo">
                    <img src="{{ asset('frontend/images/logo.svg') }}" alt="" />
                </div>
                <div class="intro">
                    <p>
                        Discover who is interested in you and connect with them
                        instantly using Trade Support Pros
                    </p>
                </div>
            </div>

            <div class="subscription--plan--area">
                <p class="intro">Select plan</p>

                <div class="subscription--plan--wrapper">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @foreach ($subscriptions as $index => $subscription)
                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                    id="{{ $subscription->package_type }}-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-{{ $subscription->package_type }}" type="button" role="tab"
                                    aria-controls="nav-{{ $subscription->package_type }}"
                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                    <div class="top">
                                        <p class="title">{{ ucfirst($subscription->package_type) }}</p>
                                        <p class="timeline">{{ $subscription->timeline }}</p>
                                    </div>
                                    <div class="bottom">
                                        <p class="pricing">$<span>{{ $subscription->price }}</span>/</p>
                                        <p class="duration">{{ ucfirst($subscription->timeline) }}</p>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        @foreach ($subscriptions as $index => $subscription)
                            <div class="tab-pane fade show {{ $index === 0 ? 'active' : '' }}"
                                id="nav-{{ $subscription->package_type }}" role="tabpanel"
                                aria-labelledby="{{ $subscription->package_type }}-tab" tabindex="0">
                                <div class="sub--plan--content">
                                    <div class="top--list--area">
                                        <ul class="list">
                                            <li>View Limit: {{ $subscription->view_limit ?? '' }}</li>
                                            <li>Message Limit: {{ $subscription->message_limit ?? '' }}</li>
                                            {!! $subscription->feature !!}
                                        </ul>
                                    </div>

                                    <p class="agreement--text">
                                        By tapping Continue, you will be charged, your
                                        subscription will auto-renew for the same price and
                                        package length until you cancel via Play Store settings,
                                        and you agree to our Terms.
                                    </p>

                                    <div class="bottom--area">
                                        <div class="price">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="41" height="42"
                                                    viewBox="0 0 41 42" fill="none">
                                                    <g clip-path="url(#clip0_12010_344)">
                                                        <path
                                                            d="M31.7615 16.0613C31.6509 15.9228 31.5169 15.95 31.4466 15.9783C31.3878 16.0022 31.2529 16.0784 31.2716 16.2695C31.294 16.4989 31.3066 16.7328 31.309 16.9648C31.319 17.9272 30.9329 18.87 30.2499 19.5515C29.5711 20.2287 28.6784 20.5935 27.7279 20.583C26.4295 20.5664 25.3526 19.8892 24.6136 18.6245C24.0025 17.5787 24.2711 16.23 24.5554 14.802C24.7218 13.9661 24.8939 13.1017 24.8939 12.2791C24.8939 5.87372 20.5878 2.17828 18.021 0.545564C17.9679 0.511852 17.9173 0.5 17.8726 0.5C17.7998 0.5 17.7421 0.531391 17.7137 0.550609C17.6586 0.587926 17.5704 0.672969 17.5988 0.823516C18.5799 6.03356 15.6535 9.1671 12.5553 12.4846C9.3618 15.9041 5.74219 19.78 5.74219 26.7702C5.74219 34.8924 12.35 41.5002 20.4722 41.5002C27.1596 41.5002 33.0559 36.8377 34.8105 30.1619C36.0071 25.61 34.7532 19.8117 31.7615 16.0613ZM20.8396 38.3561C18.8058 38.4488 16.8716 37.7194 15.3942 36.3068C13.9327 34.9093 13.0945 32.959 13.0945 30.9559C13.0945 27.1969 14.5317 24.4374 18.3974 20.774C18.4607 20.714 18.5255 20.6951 18.5819 20.6951C18.6331 20.6951 18.6774 20.7107 18.708 20.7253C18.7723 20.7563 18.878 20.833 18.8637 20.999C18.7255 22.6073 18.7279 23.9423 18.8708 24.967C19.2359 27.5843 21.1519 29.3429 23.6388 29.3429C24.858 29.3429 26.0194 28.8841 26.909 28.0509C26.9433 28.0179 26.9852 27.9938 27.031 27.9807C27.0768 27.9676 27.1251 27.966 27.1717 27.9758C27.2303 27.9885 27.3087 28.0244 27.3497 28.1234C27.7186 29.014 27.9071 29.9593 27.91 30.933C27.9217 34.8508 24.75 38.1808 20.8396 38.3561Z"
                                                            fill="black" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_12010_344">
                                                            <rect width="41" height="41" fill="white"
                                                                transform="translate(0 0.5)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </div>
                                            <div class="instruction">
                                                <p class="duration">{{ $subscription->timeline }}</p>
                                                <p class="value">
                                                    ${{ $subscription->price }}/{{ $subscription->timeline }}</p>
                                            </div>
                                        </div>

                                        <form action={{ route('trade.stripe.payment') }} method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
                                            <input type="hidden" name="price" value="{{ $subscription->price }}">
                                            <button class="btn--fill">Continue</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
