@extends('frontend.app')

@section('title', 'Join')

@section('content')
    <div class="joining--background--wrapper">
        <div class="overlay"></div>

        <div class="joining--content">
            <div class="logo">
                <img src="{{ asset('frontend/images/logo.svg') }}" alt="" />
            </div>

            <div class="middle--area">
                <h3 class="title">What do you want to join here as?</h3>

                <div class="role--choice--wrapper">
                    <div class="single--role">
                        <input type="radio" name="join-role" id="trade" value="trade" />
                        <label for="trade">Trade</label>
                    </div>
                    <div class="single--role">
                        <input type="radio" name="join-role" id="pro" value="pro" />
                        <label for="pro">Pro</label>
                    </div>
                </div>
            </div>

            <div class="bottom--area single--input">
                <div class="experience--select--wrapper single--input">
                    <select name="experience" id="experience">
                        <option selected disabled value="">
                            {{ $question ? $question->question_text : 'What is your primary Trade Experience?' }}
                        </option>
                        @if ($question && $question->options)
                            @foreach ($question->options as $option)
                                <option value="{{ $option->option_text }}">{{ ucfirst($option->option_text) }}</option>
                            @endforeach
                        @else
                            <option value="hvac">HVAC Technician</option>
                            <option value="Electrician">Electrician</option>
                            <option value="Carpenter">Carpenter</option>
                            <option value="Plumber">Plumber</option>
                            <option value="Welder">Welder</option>
                            <option value="Mason">Mason</option>
                            <option value="Excavator">Excavator</option>
                            <option value="Contractor">Contractor</option>
                            <option value="Handyman">Handyman</option>
                            <option value="Facility">Facility Maintenance</option>
                            <option value="painter">Painter/Drywaller</option>
                            <option value="Roofer">Roofer</option>
                            <option value="Locksmith">Locksmith</option>
                            <option value="Landscaper">Landscaper</option>
                            <option value="other">Other</option>
                        @endif
                    </select>
                </div>

                <div class="single--input" id="other-experience-wrapper" style="display: none; margin-top: 10px;">
                    <input type="text" id="other-experience" name="other_experience"
                        placeholder="Please specify your trade experience" />
                </div>


                <form id="joinForm" action="{{ route('register') }}" method="GET">
                    <input type="hidden" name="role" id="selectedRole">
                    <input type="hidden" name="question_id" id="selectedQuestionId"
                        value="{{ $question ? $question->id : '' }}">
                    <input type="hidden" name="option_id" id="selectedOptionId">
                    <input type="hidden" name="answer_text" id="answerText">
                    <button type="submit" class="btn--fill large">Next</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            const roleRadios = $('input[name="join-role"]');
            const selectedRoleInput = $('#selectedRole');
            const nextButton = $('.btn--fill.large');
            const experienceSelect = $('#experience');
            const otherExperienceWrapper = $('#other-experience-wrapper');
            const answerTextInput = $('#answerText');

            // Initially disable the "Next" button
            nextButton.prop('disabled', true);

            // Enable "Next" button when a role is selected
            roleRadios.change(function() {
                if (this.checked) {
                    selectedRoleInput.val(this.value);
                    nextButton.prop('disabled', false);
                }
            });

            // Handle experience selection change
            experienceSelect.change(function() {
                const selectedValue = $(this).val();

                // Show the "Other" experience input field when "Other" is selected
                if (selectedValue === 'other' || selectedValue === 'Other') {
                    otherExperienceWrapper.show();
                    answerTextInput.val(''); // Clear answer text for "Other"
                } else {
                    otherExperienceWrapper.hide();
                    answerTextInput.val(selectedValue); // Set answer text to the selected option's value
                }
            });

            // Update answer text when typing in "Other" experience input field
            $('#other-experience').on('input', function() {
                answerTextInput.val($(this).val());
            });
        });
    </script>
@endpush
