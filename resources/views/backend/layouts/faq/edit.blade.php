@extends('backend.app')

@section('title', 'FAQ Update')

@push('style')
    <style>
        /* Styling for the form inputs */
        .form-control {
            border-radius: 8px;
        }

        /* Styling for error messages */
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
@endpush

@section('content')
    {{--  ========== title-wrapper start ==========  --}}
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h2>Frequently Asked Questions</h2>
                </div>
            </div>

            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav>
                        <ol class="base-breadcrumb breadcrumb-three">
                            <li>
                                <a href="{{ route('admin-dashboard') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M8 0a8 8 0 1 0 4.596 14.104A5.934 5.934 0 0 1 8 13a5.934 5.934 0 0 1-4.596-2.104A7.98 7.98 0 0 0 8 0zm-2 3a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm-1.465 5.682A3.976 3.976 0 0 0 4 9c0 1.044.324 2.01.882 2.818a6 6 0 1 1 6.236 0A3.975 3.975 0 0 0 12 9a3.976 3.976 0 0 0-.536-1.318l-1.898.633-.018-.056 2.194-.732a4 4 0 1 0-7.6 0l2.194.733-.018.056-1.898-.634z" />
                                    </svg>
                                    Dashboard
                                </a>
                            </li>
                            <li><span><i class="lni lni-angle-double-right"></i></span>FAQ</li>
                            <li class="active"><span><i class="lni lni-angle-double-right"></i></span>Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{--  ========== title-wrapper end ==========  --}}


    <div class="form-layout-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-4">
                    <form method="POST" action="{{ route('faq.update', ['id' => $faq->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="input-style-1">
                            <label for="question">Question:</label>
                            <input type="text" placeholder="Enter your question" id="question"
                                class="form-control @error('question') is-invalid @enderror" name="question"
                                value="{{ old('question', $faq->question) }}" />
                            @error('question')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-style-1">
                            <label for="answer">Answer:</label>
                            <input type="text" placeholder="Enter your answer" id="answer"
                                class="form-control @error('answer') is-invalid @enderror" name="answer"
                                value="{{ old('answer', $faq->answer) }}" />
                            @error('answer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('faq.index') }}" class="btn btn-danger me-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
