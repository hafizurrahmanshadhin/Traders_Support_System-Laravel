@extends('frontend.app')

@section('title', 'Join')

@section('content')
    <div class="joining--background--wrapper">
        <div class="overlay"></div>

        <div class="joining--content">
            <div class="logo">
                <img src="{{ asset('frontend/images/logo.svg') }}" alt=""/>
            </div>

            <div class="middle--area">
                <h3 class="title">What do you want to join here as?</h3>

                <div class="role--choice--wrapper">
                    <div class="single--role">
                        <input type="radio" name="role" id="trade" value="trade"/>
                        <label for="trade">Trade</label>
                    </div>
                    <div class="single--role">
                        <input type="radio" name="role" id="pro" value="pro"/>
                        <label for="pro">Pro</label>
                    </div>
                </div>
            </div>

            <div class="bottom--area">
                {{-- <div class="experience--select--wrapper">
                    <select name="experience" id="experience">
                        <option selected disabled value="">
                            What is your primary Trade Experience?
                        </option>
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
                        <option value="other">Other (with fillable text box)</option>
                    </select>
                </div> --}}

                <form id="registerForm" action="{{ route('completeRegistration') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role" id="selectedRole">
                    <button type="submit" class="btn--fill large">Next</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleRadios = document.querySelectorAll('input[name="role"]');
            const selectedRoleInput = document.getElementById('selectedRole');
            const nextButton = document.querySelector('.btn--fill.large');

            // Initially disable the "Next" button
            nextButton.disabled = true;

            roleRadios.forEach(function (radio) {
                radio.addEventListener('change', function () {
                    if (this.checked) {
                        selectedRoleInput.value = this.value;
                        // Enable the "Next" button when a role is selected
                        nextButton.disabled = false;
                    }
                });
            });
        });
    </script>
@endpush
