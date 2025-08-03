@php
    $settings = App\Models\SystemSetting::first();
@endphp

<style>
    .modal-header .btn-close {
        padding: calc(var(--bs-modal-header-padding-y)* 1) calc(var(--bs-modal-header-padding-x)* 1);
        margin: calc(-7* var(--bs-modal-header-padding-y)) calc(-1* var(--bs-modal-header-padding-x)) calc(-.5* var(--bs-modal-header-padding-y)) auto;
    }

    .modal-title {
        margin-left: -90px;
        margin-bottom: 0;
        line-height: var(--bs-modal-title-line-height);
    }
</style>

<div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="editQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="logo col-sm-4">
                    <img src="{{ $setting->logo ?? 'frontend/images/logo.svg' }}" alt="" />
                </div>
                <div class="col-sm-4">
                    <h1 class="modal-title text-center" id="addQuestionModalLabel">Edit Question</h1>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editQuestionForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="question_id" id="edit_question_id">
                    <div class="mb-3">
                        <label for="edit_category" class="form-label">Category</label>
                        <select name="category" id="edit_category" class="form-control">
                            <option value="register">Register</option>
                            <option value="pro">Pro</option>
                            <option value="trade">Trade</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_type" class="form-label">Type</label>
                        <select name="type" id="edit_type" class="form-control">
                            <option value="radio">Radio</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="textarea">Textarea</option>
                            <option value="file">File</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_question_text" class="form-label">Question</label>
                        <input type="text" name="question_text" id="edit_question_text" class="form-control"
                            placeholder="Enter the question here...">
                    </div>
                    <div id="edit-options-container"></div>
                    <button type="button" class="btn btn-secondary mt-3" id="edit-add-option">Add Option</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Edit Question
    function editQuestion(id) {
        $.ajax({
            url: '/questions/' + id + '/edit',
            method: 'GET',
            success: function(data) {
                const question = data.question;
                const options = data.options;

                // Populate the question details
                $('#edit_question_id').val(question.id);
                $('#edit_category').val(question.category);
                $('#edit_type').val(question.type);
                $('#edit_question_text').val(question.question_text);

                // Populate the options
                $('#edit-options-container').empty();
                options.forEach(option => {
                    var optionField = `
                        <div class="mb-3 option-item">
                            <div class="input-group">
                                <input type="hidden" name="option_id[]" value="${option.id}">
                                <input type="text" name="option_text[]" class="form-control option-input" value="${option.option_text}" placeholder="Enter option text...">
                                <button type="button" class="btn btn-outline-danger remove-option"><i class="bi bi-x"></i></button>
                            </div>
                        </div>`;
                    $('#edit-options-container').append(optionField);
                });

                // Set form action to the correct URL
                $('#editQuestionForm').attr('action', '/questions/' + id);
                $('#editQuestionModal').modal('show');
            },
            error: function(error) {
                console.error('Error fetching question data:', error);
            }
        });
    }


    // Add Option in Edit Modal
    $(document).ready(function() {
        $('#edit-add-option').click(function() {
            var optionField = `
                <div class="mb-3 option-item">
                    <div class="input-group">
                        <input type="text" name="option_text[]" class="form-control option-input" placeholder="Enter option text...">
                        <button type="button" class="btn btn-outline-danger remove-option"><i class="bi bi-x"></i></button>
                    </div>
                </div>`;
            $('#edit-options-container').append(optionField);
        });

        $('#edit-options-container').on('click', '.remove-option', function() {
            $(this).closest('.option-group').remove();
        });
    });
</script>
