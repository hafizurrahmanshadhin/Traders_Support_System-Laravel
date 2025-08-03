@extends('frontend.app')

@section('title', 'Questions')

@section('content')
    <form method="POST" action="{{ route('questionnaires.store') }}" enctype="multipart/form-data">
        @csrf
        <section class="questions--total--area--wrapper">
            <div class="questions--total--area--content">
                {{-- header area start --}}
                <div class="questions--header--area">
                    <div class="logo">
                        <img src="{{ asset('frontend/images/logo.svg') }}" alt="" />
                    </div>

                    <p class="title">
                        Please give some information about your Administrative Assistants
                    </p>
                </div>
                {{-- header area end --}}

                {{-- body area start --}}
                <div class="questions--body--area">
                    {{-- progress area start --}}
                    <div class="question--progress--bar--wrapper">
                        <div class="question--progress--bar">
                            <div class="question--progress--status"></div>
                            <div class="question--progress"></div>
                        </div>
                    </div>
                    {{-- progress area end --}}

                    {{-- question slides area start --}}
                    <div class="questions--slides--wrapper">
                        <div class="single--question--slide">
                            <div class="questionnaire">
                                @foreach ($questions->chunk(5) as $index => $questionChunk)
                                    <div class="question-group" id="question-group-{{ $index }}"
                                        style="display: {{ $index === 0 ? 'block' : 'none' }}">
                                        @foreach ($questionChunk as $question)
                                            <div class="mb-5">
                                                <p class="small--bold">{{ $question->question_text }}</p>
                                                @if ($question->type == 'radio' || $question->type == 'checkbox')
                                                    <div class="{{ $question->type }}--input--wrapper">
                                                        @foreach ($question->options as $option)
                                                            <div class="">
                                                                <input class="" type="{{ $question->type }}"
                                                                    name="question_{{ $question->id }}[]"
                                                                    value="{{ $option->id }}"
                                                                    id="option_{{ $option->id }}">
                                                                <label class="m-2"
                                                                    for="option_{{ $option->id }}">{{ $option->option_text }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @elseif($question->type == 'textarea')
                                                    <textarea class="question--textarea" name="question_{{ $question->id }}"></textarea>
                                                @elseif($question->type == 'file')
                                                    <input class="form-control" type="file"
                                                        name="question_{{ $question->id }}" id="add-file" />
                                                    <div class="file--preview"></div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach

                                @if (count($questions) <= 5)
                                    <button type="submit" class="next--button">
                                        <span>Next</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                                fill="white" />
                                        </svg>
                                    </button>
                                @endif

                                {{-- next step button start --}}
                                <button type="button" class="next--button" onclick="showNextGroup()"
                                    style="display: {{ count($questions) > 5 ? 'block' : 'none' }}">
                                    <span>Next</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                            fill="white" />
                                    </svg>
                                </button>
                                {{-- next step button end --}}
                            </div>
                        </div>
                    </div>
                    {{-- question slides area end --}}
                </div>
                {{-- body area end --}}
            </div>
        </section>
    </form>
@endsection

@push('script')
    <script>
        let currentProgress = 0;
        // Function to update progress bar
        function updateProgressBar() {
            const totalQuestions = {{ count($questions) }};
            const questionsPerPage = 5;
            const currentPageIndex = Math.floor(currentProgress / questionsPerPage);
            const progressPercentage = ((currentPageIndex + 1) / Math.ceil(totalQuestions / questionsPerPage)) * 100;

            const progressBar = document.querySelector('.question--progress');
            progressBar.style.width = `${progressPercentage}%`;
        }

        // Function to show next group of questions
        function showNextGroup() {
            const questionGroups = document.querySelectorAll('.question-group');
            const currentGroup = Array.from(questionGroups).find(group => group.style.display === 'block');

            if (currentGroup) {
                currentGroup.style.display = 'none';
                const nextGroup = currentGroup.nextElementSibling;
                if (nextGroup) {
                    nextGroup.style.display = 'block';
                    currentProgress += 5;
                    updateProgressBar();
                }
            } else {
                const nextButton = document.querySelector('.next--button');
                nextButton.type = 'submit';
                nextButton.click();
            }
        }
        updateProgressBar();
    </script>
@endpush
