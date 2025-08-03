@extends('frontend.dashboard')

@section('title', 'Subscription')

@section('content')
    <div class="pro--subscription--wrapper">
        <div class="intro--area">
            <p class="title">All-Access Pass</p>

            <p class="subtitle">
                Boost your productivity with instant access to all 9,183 existing
                products and daily new releases.
            </p>
        </div>

        {{-- plan area wrapper --}}
        <div class="pro--plan--area--wrapper">
            @foreach ($subscriptions as $subscription)
                <div class="single--pro--plan">
                    <div class="top--part">
                        <p class="intro">{{ ucfirst($subscription->package_type ?? '') }}</p>

                        <div class="pricing">
                            <p class="price">$<span>{{ $subscription->price ?? '' }}</span></p>
                            <p class="timeline">/{{ $subscription->timeline ?? '' }}</p>
                        </div>

                        <div class="status">
                            <p>Pay {{ $subscription->timeline ?? '' }}ly</p>
                        </div>
                    </div>

                    <ul class="feature--list">
                        {!! $subscription->feature ?? '' !!}
                    </ul>

                    <form action={{ route('stripe.payment') }} method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
                        <input type="hidden" name="price" value="{{ $subscription->price }}">
                        <button class="btn--fill">Get Boosts</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
