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

<div class="modal fade @if ($errors->any()) show @endif" id="addQuestionModal" tabindex="-1"
    aria-labelledby="addQuestionModalLabel" aria-hidden="true"
    style="@if ($errors->any()) display: block; @endif">
    {{-- <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true"> --}}
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="logo col-sm-4">
                    <img src="{{ $setting->logo ?? 'frontend/images/logo.svg' }}" alt="" />
                </div>
                <div class="col-sm-4">
                    <h1 class="modal-title text-center" id="addQuestionModalLabel">Add New Question</h1>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <form action="{{ route('questions.store') }}" method="POST" id="addQuestionForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="category" class="form-label">Select Category</label>
                        <select name="category" id="category"
                            class="form-select @error('category') is-invalid @enderror" required>
                            <option value="" disabled selected>Choose Category</option>
                            <option value="register" {{ old('category') == 'register' ? 'selected' : '' }}>Register
                            </option>
                            <option value="pro" {{ old('category') == 'pro' ? 'selected' : '' }}>Pro</option>
                            <option value="trade" {{ old('category') == 'trade' ? 'selected' : '' }}>Trade</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Question Type</label>
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror"
                            required>
                            <option value="" disabled selected>Choose Type</option>
                            <option value="radio" {{ old('type') == 'radio' ? 'selected' : '' }}>Radio</option>
                            <option value="checkbox" {{ old('type') == 'checkbox' ? 'selected' : '' }}>Checkbox</option>
                            <option value="textarea" {{ old('type') == 'textarea' ? 'selected' : '' }}>Textarea</option>
                            <option value="file" {{ old('type') == 'file' ? 'selected' : '' }}>File</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="question_text" class="form-label">Question</label>
                        <input type="text" name="question_text" id="question_text"
                            class="form-control @error('question_text') is-invalid @enderror"
                            placeholder="Enter Your Question" value="{{ old('question_text') }}" required>
                        @error('question_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>
                    <div id="options-container" style="display: none;">
                        <h5 class="mb-3">Options</h5>
                        <div class="option-items">
                            <div class="mb-3 option-item">
                                <div class="input-group">
                                    <input type="text" name="option_text[]"
                                        class="form-control option-input @error('option_text.*') is-invalid @enderror"
                                        placeholder="Enter Option..." required>
                                    <button type="button" class="btn btn-outline-danger remove-option"><i
                                            class="bi bi-x"></i></button>
                                </div>
                                @error('option_text.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-secondary mt-3" id="add-option"><i
                                class="bi bi-plus"></i> Add Another Option</button>
                        <div class="invalid-feedback" id="option-error">At least one option is required.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save-btn">Save Question and Options</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="{{ asset('backend/js/jquery-3.7.1.js') }}" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        // Initially hide options container and add option button, and disable the type select box.
        // This is to ensure that the form starts in a consistent state where options are only shown when relevant.
        $('#options-container').hide();
        $('#add-option').hide();
        $('#type').prop('disabled', true);

        // Handle category selection changes.
        // This function enables or disables the type select box based on the selected category.
        // For the 'register' category, it automatically selects 'radio', shows options, and disables the type select box.
        $('#category').change(function() {
            var selectedCategory = $(this).val();
            if (selectedCategory === 'register') {
                $('#type').val('radio').prop('disabled', true);
                $('#options-container').slideDown();
                $('#add-option').slideDown();
                enableOptions();
            } else {
                $('#type').val('').prop('disabled', false);
                $('#options-container').slideUp();
                $('#add-option').slideUp();
                disableOptions();
            }
        });

        // Handle type selection changes.
        // This function shows or hides the options container based on the selected question type.
        // Options are only shown for 'radio' and 'checkbox' types.
        $('#type').change(function() {
            var selectedType = $(this).val();
            if (selectedType === 'radio' || selectedType === 'checkbox') {
                $('#options-container').slideDown();
                $('#add-option').slideDown();
                enableOptions();
            } else {
                $('#options-container').slideUp();
                $('#add-option').slideUp();
                disableOptions();
            }
        });

        // Add a new option input when the "Add Another Option" button is clicked.
        // This allows users to input multiple options for radio or checkbox questions.
        $('#add-option').click(function() {
            var optionInput = '<div class="mb-3 option-item">' +
                '<div class="input-group">' +
                '<input type="text" name="option_text[]" class="form-control option-input" placeholder="Enter Option...">' +
                '<button type="button" class="btn btn-outline-danger remove-option"><i class="bi bi-x"></i></button>' +
                '</div>' +
                '<div class="invalid-feedback">Option cannot be empty.</div>' +
                '</div>';

            $('#add-option').before(optionInput);
        });

        // Remove an option input when the remove button is clicked.
        // This allows users to remove any unwanted option inputs.
        $(document).on('click', '.remove-option', function() {
            $(this).closest('.option-item').remove();
            checkOptionCount();
        });

        // Disable all option inputs and the "Add Another Option" button.
        // Used when options are not relevant for the selected question type.
        function disableOptions() {
            $('.option-input').prop('disabled', true);
            $('#add-option').prop('disabled', true);
        }

        // Enable all option inputs and the "Add Another Option" button.
        // Used when options are relevant for the selected question type.
        function enableOptions() {
            $('.option-input').prop('disabled', false);
            $('#add-option').prop('disabled', false);
        }

        // Validate form inputs before submission.
        // Checks for category, type, question text, and options (if applicable) validity.
        // Prevents form submission if any validation fails.
        $('#save-btn').click(function(event) {
            var isValid = true;
            var selectedType = $('#type').val();

            // Validate category selection
            if ($('#category').val() === '') {
                isValid = false;
                $('#category').addClass('is-invalid');
            } else {
                $('#category').removeClass('is-invalid');
            }

            // Validate type selection
            if ($('#type').val() === '') {
                isValid = false;
                $('#type').addClass('is-invalid');
            } else {
                $('#type').removeClass('is-invalid');
            }

            // Validate question text input
            if ($('#question_text').val().trim() === '') {
                isValid = false;
                $('#question_text').addClass('is-invalid');
            } else {
                $('#question_text').removeClass('is-invalid');
            }

            // Validate options if applicable
            if (selectedType === 'radio' || selectedType === 'checkbox') {
                var optionInputs = $('.option-input');
                var hasOption = false;
                optionInputs.each(function() {
                    if ($(this).val().trim() !== '') {
                        hasOption = true;
                        $(this).removeClass('is-invalid');
                    } else {
                        isValid = false;
                        $(this).addClass('is-invalid');
                    }
                });

                if (!hasOption) {
                    isValid = false;
                    $('#option-error').show();
                } else {
                    $('#option-error').hide();
                }
            }

            // If validation fails, prevent form submission
            if (!isValid) {
                event.preventDefault();
            } else {
                // Ensure type select box is enabled before submission to pass data correctly
                $('#type').prop('disabled', false);
            }
        });

        // Trigger category change on document ready to ensure correct initial state
        $('#category').trigger('change');
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if ($errors->any())
            var addQuestionModal = new bootstrap.Modal(document.getElementById('addQuestionModal'));
            addQuestionModal.show();
        @endif
    });
</script>
