@extends('backend.app')

@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/plugins/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/plugins/aos.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/plugins/owl.carousel.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/plugins/magnific-popup.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/plugins/nice-select.min.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/helper.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/responsive.css') }}" />

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/logo.svg') }}">

    <style>
        .help--support--area--wrapper {
            margin: 52px;
            padding: 40px;
            border-radius: 4px;
            background: #fff;
            box-shadow: 0px 6px 16px 0px rgba(0, 0, 0, 0.12);
            display: contents;
            align-items: start;
            gap: 70px;
        }

        .footer {
            background: none;
        }

        .help--request--area {
            margin: 50px;
            padding: 50px 30px 30px;
            border-radius: 20px;
            background: #eaeff7;
            padding-right: 15px;
        }
    </style>
@endpush

@section('content')
    <!-- help support area -->
    <div class="help--support--area--wrapper">
        <div class="help--list--area">

        </div>
        <div class="help--request--area">
            <div class="top--part">
                <h3 class="common--dashboard--title">Help Request</h3>
            </div>

            <div class="request--wrapper">

                <div class="single--request">
                    <h3 class="common--dashboard--title">{{ $ticket->status }}</h3>

                    <div class="content--wrapper">
                        <div class="top--area">
                            <p class="name">{{ $ticket->user->name }}</p>
                            <p class="date">{{ $ticket->created_at->format('D, M d, Y, h:i A') }}</p>
                        </div>

                        <p class="description">
                            {{ $ticket->message }}
                        </p>

                        <div class="bottom--area">

                            <form action="{{ route('admin.reply.store') }}" method="POST" style="width: 100%">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}" class="form-control"
                                        id="ticketId" placeholder="Enter Ticket ID">
                                </div>
                                <div class="form-group">
                                    <label for="additionalInfo">Reply</label>
                                    <input type="text" name="content" class="form-control mt-2" id="additionalInfo"
                                        placeholder="Enter additional information" required>
                                </div>
                                <button type="submit" class="btn btn-success mt-3">

                                    <span>Add Reply</span>
                                </button>
                            </form>


                        </div>
                        <!-- Displaying Replies -->
                        @if ($ticket->replies->count() > 0)
                            <div class="replies mt-3">
                                <h4>Replies:</h4>
                                @foreach ($ticket->replies as $reply)
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <p class="reply--user font-weight-bold mb-0">
                                                <span>From:</span> {{ $reply->user->name ?? 'Unknown User' }}
                                            </p>
                                            <p class="card-text">{{ $reply->content }}</p>
                                            <p class="card-subtitle text-muted mb-0">
                                                {{ $reply->created_at->format('D, M d, Y, h:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

            </div>


        </div>
    </div>
    </div>
@endsection
