@extends('frontend.dashboard')

@section('title', 'Message')

@push('style')
    <style>
        .subscription--area--wrapper {
            padding: 120px 100px 120px;
            max-width: 1280px;
            margin: 150px auto;
            border-radius: 20px;
            background: #fff;
            box-shadow: 0px 2px 16px 0px rgba(0, 0, 0, 0.08);
            text-align: center;
            margin-bottom: 20px;
        }

        .subscription--area--wrapper .purchase-button {
            margin-bottom: 20px;
            margin-top: 35px;
            padding: 10px 20px;
            background-color: #042544;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 20px;
            text-decoration: none;
        }

        .subscription--area--wrapper .purchase-button:hover {
            background-color: #0351a5;
        }
    </style>
@endpush

@section('content')
    <div class="subscription--area--wrapper">
        <div class="top--area">
            <div class="logo">
                <img src="{{ asset('frontend/images/logo.svg') }}" alt="">
            </div>
            <div class="intro">
                @if (Auth::user()->role == 'pro')
                    <p>
                        You Need to Purchase a Subscription Plan to Messages With Trade Users.
                    </p>
                    <br>
                    <a href="{{ route('pro.frontend.subscription') }}" class="purchase-button">Purchase New Subscription</a>
                @else
                    <p>
                        You Need to Purchase a Subscription Plan to Send Messages to the Pro Users.
                    </p>
                    <br>
                    <a href="{{ route('trade.frontend.subscription') }}" class="purchase-button">Purchase New Subscription</a>
                @endif
            </div>
        </div>
    </div>
@endsection
