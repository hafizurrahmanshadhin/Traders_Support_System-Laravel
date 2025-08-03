@php
    $settings = App\Models\SystemSetting::first();
@endphp

<style>
    .modal-header .btn-close {
        padding: calc(var(--bs-modal-header-padding-y) * 1) calc(var(--bs-modal-header-padding-x) * 1);
        margin: calc(-7 * var(--bs-modal-header-padding-y)) calc(-1 * var(--bs-modal-header-padding-x)) calc(-.5 * var(--bs-modal-header-padding-y)) auto;
    }

    .modal-title {
        margin-left: -90px;
        margin-bottom: 0;
        line-height: var(--bs-modal-title-line-height);
    }

    .modal-body p {
        margin-bottom: 1rem;
    }

    .modal-body ul {
        padding-left: 1.5rem;
        list-style-type: disc;
    }
</style>

<div class="modal fade" id="viewQuestionModal" tabindex="-1" aria-labelledby="viewQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="logo col-sm-4">
                    <img src="{{ $setting->logo ?? 'frontend/images/logo.svg' }}" alt="" />
                </div>
                <div class="col-sm-4">
                    <h1 class="modal-title text-center" id="viewQuestionModalLabel">View Question</h1>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Question Category:</strong> <span id="questionCategory"></span></p>
                <p><strong>Question Type:</strong> <span id="questionType"></span></p>
                <p><strong>Question:</strong> <span id="questionText"></span></p>
                <div id="optionsContainer">
                    <p><strong>Options:</strong></p>
                    <ul id="optionsList"></ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to view question details in the modal
    function viewQuestion(questionId) {
        $.ajax({
            url: '/questions/' + questionId,
            method: 'GET',
            success: function(response) {
                // Update modal content with the fetched question details
                $('#questionCategory').text(response.question.category);
                $('#questionType').text(response.question.type);
                $('#questionText').text(response.question.question_text);

                // Clear existing options and add the new ones
                $('#optionsList').empty();
                if (response.options.length > 0) {
                    response.options.forEach(option => {
                        $('#optionsList').append('<li>' + option.option_text + '</li>');
                    });
                    $('#optionsContainer').show();
                } else {
                    $('#optionsContainer').hide();
                }

                // Show the modal
                $('#viewQuestionModal').modal('show');
            },
            error: function(error) {
                console.error('Error fetching question data:', error);
            }
        });
    }
</script>
