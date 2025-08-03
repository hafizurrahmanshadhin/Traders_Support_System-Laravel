@extends('frontend.dashboard')

@section('title', 'Settings')

@push('style')
    <style>
        .amount-cell {
            font-weight: normal;
        }
    </style>
@endpush

@section('content')
    <div class="setting--area--wrapper">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="security" data-bs-toggle="tab" data-bs-target="#security-pane"
                    type="button" role="tab" aria-controls="security-pane" aria-selected="true">
                    Security
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="payment" data-bs-toggle="tab" data-bs-target="#payment-pane" type="button"
                    role="tab" aria-controls="payment-pane" aria-selected="false">
                    Payment Method
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="payment-history" data-bs-toggle="tab" data-bs-target="#payment-history-pane"
                    type="button" role="tab" aria-controls="payment-history-pane" aria-selected="false">
                    Purchase History
                </button>
            </li>

            @if (Auth::user()->role === 'pro')
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="boost-payment-history" data-bs-toggle="tab"
                        data-bs-target="#boost-payment-history-pane" type="button" role="tab"
                        aria-controls="payment-history-pane" aria-selected="false">
                        Boost Purchase History
                    </button>
                </li>
            @endif
        </ul>

        <div class="tab-content" id="myTabContent">
            {{-- Security Part...... Update Password Start --}}
            <div class="tab-pane fade show active" id="security-pane" role="tabpanel" aria-labelledby="security"
                tabindex="0">
                <div class="single--settings password">
                    <div class="top--part">
                        <h3 class="common--dashboard--title">Password</h3>
                    </div>

                    <form method="POST" action="{{ route('update.Password') }}" class="settings--form--input">
                        @csrf
                        <div class="single--input">
                            <label for="old_password">Current Password</label>
                            <input type="password" @error('old_password') is-invalid @enderror" placeholder="********"
                                name="old_password" id="old_password" />

                            @error('old_password')
                                <span class="invalid-feedbac d-blockk" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="single--input">
                            <label for="password">New Password</label>
                            <input type="password" @error('password') is-invalid @enderror" placeholder="********"
                                name="password" id="password" />
                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="single--input">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" @error('password_confirmation') is-invalid @enderror"
                                placeholder="********" name="password_confirmation" id="password_confirmation" />
                            @error('password_confirmation')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="update">Updated Now</button>
                    </form>
                </div>
            </div>
            {{-- Security Part...... Update Password End --}}



            {{-- Payment Part...... Add Payment Method Start --}}
            <div class="tab-pane fade" id="payment-pane" role="tabpanel" aria-labelledby="payment" tabindex="0">
                <div class="single--settings payment">
                    <div class="top--part">
                        <h3 class="common--dashboard--title">
                            Add New Payment Method
                        </h3>
                    </div>

                    <form action="{{ route('store.payment.method') }}" method="POST" class="settings--form--input">
                        @csrf
                        <div class="single--input">
                            <input type="text" name="card-holder" id="card-holder" placeholder="Card Holder Name"
                                value="{{ session('paymentMethod.card-holder', '') }}" />
                        </div>
                        <div class="single--input">
                            <input type="text" name="card-number" id="card-number" placeholder="Card Number"
                                value="{{ session('paymentMethod.card-number', '') }}" />
                        </div>
                        <div class="single--input">
                            <input type="text" name="cvc" id="cvc" placeholder="CVC"
                                value="{{ session('paymentMethod.cvc', '') }}" />
                        </div>
                        <div class="single--input">
                            <input type="text" name="expiry" id="expiry" placeholder="Expiry Date"
                                value="{{ session('paymentMethod.expiry', '') }}" />
                        </div>

                        <button class="update">Add new payment method</button>
                    </form>
                </div>
            </div>
            {{-- Payment Part...... Add Payment Method End --}}



            {{-- Payment History Part...... Payment History Start --}}
            <div class="tab-pane fade" id="payment-history-pane" role="tabpanel" aria-labelledby="payment-history"
                tabindex="0">
                <div class="single--settings payment-history">
                    <div class="top--part">
                        <h3 class="common--dashboard--title">Payment History</h3>
                        <div class="payment--history--table">
                            <table>
                                <tr class="heading">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Transection ID</th>
                                    <th>Purchase Date</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>

                                @foreach ($transactions as $key => $transaction)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $transaction->user->name }}</td>
                                        <td>{{ $transaction->user->email }}</td>
                                        <td>{{ $transaction->transaction_id }}</td>
                                        <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
                                        <td class="amount-cell">${{ $transaction->amount }}</td>
                                        <td><a href="{{ route('transactions.download', $transaction->id) }}">Download</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Payment History Part...... Payment History End --}}



            {{-- Boost Payment History Part...... Payment History Start --}}
            <div class="tab-pane fade" id="boost-payment-history-pane" role="tabpanel"
                aria-labelledby="boost-payment-history-pane" tabindex="0">
                <div class="single--settings payment-history">
                    <div class="top--part">
                        <h3 class="common--dashboard--title">Boost Payment History</h3>

                        <table class="payment--history--table">
                            <tr class="heading">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Transection ID</th>
                                <th>Purchase Date</th>
                                <th>Total</th>
                                {{-- <th>Action</th> --}}
                            </tr>

                            @foreach ($boostTransactions as $key => $boostTransaction)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $boostTransaction->user->name }}</td>
                                    <td>{{ $boostTransaction->user->email }}</td>
                                    <td>{{ $boostTransaction->transaction_id }}</td>
                                    <td>{{ $boostTransaction->created_at->format('d/m/Y') }}</td>
                                    <td class="amount-cell">${{ $boostTransaction->amount }}</td>
                                    {{-- <td><a href="{{ route('transactions.download', $transaction->id) }}">Download</a></td> --}}
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            {{-- Boost Payment History Part...... Payment History End --}}
        </div>
    </div>
@endsection
