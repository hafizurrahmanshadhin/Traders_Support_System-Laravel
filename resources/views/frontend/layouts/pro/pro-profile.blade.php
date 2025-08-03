@extends('frontend.dashboard')

@section('title', 'Pro Profile')

@section('content')
    <div class="own--profile--area--wrapper">
        <a href="{{ route('pro.dashboard') }}" class="go--back">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                <path d="M9.57 6.42969L3.5 12.4997L9.57 18.5697" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"
                    stroke-linecap="round" stroke-linejoin="round" />
                <path d="M20.5019 12.5H3.67188" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span>Back To Dashboard</span>
        </a>

        <div class="profile--top--area">
            <div class="avatar">
                        <img id="profile-picture" src="{{ asset(Auth::user()->avatar ?? 'frontend/images/profile.png') }}" alt="Profile Picture">
                   
            </div>
            <div class="details">
                <p class="name">{{ Auth::user()->name }}</p>

                <div class="update-image">
                    <input type="file" name="profile_picture" id="profile_picture_input" style="display: none;">
                    <label for="profile_picture_input"><span class="btn--fill">Update your profile</span></label>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('update.pro.profile') }}" class="proifle--input--area--wrapper">
            @csrf
            <div class="multi--input--wrapper">
                <div class="single--input--wrapper">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your Name"
                        value="{{ old('name', Auth::user()->name) }}" />
                    @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="single--input--wrapper">
                    <label for="email">Email</label>
                    <input disabled type="email" name="email" id="email" placeholder="Enter your email"
                        value="{{ old('email', Auth::user()->email) }}" />
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="multi--input--wrapper">
                <div class="single--input--wrapper">
                    <label for="phone_number">Phone number</label>
                    <input type="number" name="phone_number" id="phone_number" placeholder="Enter your number"
                        value="{{ old('phone_number', $userDetails->phone_number ?? '') }}" />
                    @error('phone_number')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="single--input--wrapper">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" placeholder="Enter your address"
                        value="{{ old('address', $userDetails->address ?? '') }}" />
                    @error('address')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            {{-- <div class="single--input--wrapper">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender', $userDetails->gender ?? '') == 'male' ? 'selected' : '' }}>Male
                    </option>
                    <option value="female" {{ old('gender', $userDetails->gender ?? '') == 'female' ? 'selected' : '' }}>
                        Female</option>
                </select>
                @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> --}}

            <div class="single--input--wrapper">
                <label for="bio">Bio</label>
                <textarea name="bio" id="bio" placeholder="Enter your Bio here...">
                    {{ old('bio', $userDetails->bio ?? '') }}
                </textarea>
                @error('bio')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="single--input--wrapper">
                <label for="description">Description</label>
                <textarea name="description" id="description" placeholder="Enter your description here...">
                    {{ old('bio', $userDetails->description ?? '') }}
                </textarea>
                @error('description')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="single--input--wrapper">
                <label for="qualification">Qualification</label>
                <input type="text" name="qualification" id="qualification" placeholder="Enter your qualification"
                    value="{{ old('qualification', $userDetails->qualification ?? '') }}" />
                @error('qualification')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="multi--input--wrapper">
                <div class="single--input--wrapper">
                    <label for="current_company">Current Company</label>
                    <input type="text" name="current_company" id="current_company" placeholder="Enter your company"
                        value="{{ old('current_company', $userDetails->current_company ?? '') }}" />
                    @error('current_company')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="single--input--wrapper">
                    <label for="current_designation">Current Designation</label>
                    <input type="text" name="current_designation" id="current_designation"
                        placeholder="Enter your designation"
                        value="{{ old('current_designation', $userDetails->current_designation ?? '') }}" />
                    @error('current_designation')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="multi--input--wrapper">
                <div class="single--input--wrapper">
                    <label for="industry">Industry</label>
                    <input type="text" name="industry" id="industry" placeholder=" Industry"
                        value="{{ old('industry', $userDetails->industry ?? '') }}" />
                    @error('industry')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="single--input--wrapper">
                    <label for="experience">Experience</label>
                    <input type="text" name="experience" id="experience" placeholder=" experience"
                        value="{{ old('experience', $userDetails->experience ?? '') }}" />
                    @error('experience')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="multi--input--wrapper">
                <div class="single--input--wrapper">
                    <label for="location">Location</label>
                    <input type="text" name="location" id="location" placeholder="Enter your Location"
                        value="{{ old('location', $userDetails->location ?? '') }}" />
                    @error('location')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="single--input--wrapper">
                    <label for="languages">Languages</label>
                    <input type="text" name="languages" id="languages" placeholder="Languages"
                        value="{{ old('languages', $userDetails->languages ?? '') }}" />
                    @error('languages')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="single--input--wrapper">
                <label for="key_skills">Key Skills</label>
                <textarea name="key_skills" id="key_skills" placeholder="Enter your Key Skills">
                    {{ old('key_skills', $userDetails->key_skills ?? '') }}
                </textarea>
                @error('key_skills')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- experience  area start --}}
            <div class="experience--area--wrapper">
                <div class="top--part">
                    <h3 class="title">Experience</h3>
                    <a href="#" id="exp" class="add--more--btn"> Add Experience </a>
                </div>

                <div class="input--group--wrapper">
                    @if (isset($userDetails->experiences))
                        @foreach ($userDetails->experiences as $index => $experience)
                            <div class="input--group">
                                <div class="single--input--wrapper">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" name="experiences[{{ $index }}][company_name]"
                                        placeholder="Enter your company name" value="{{ $experience->company_name }}" />
                                </div>

                                <div class="single--input--wrapper">
                                    <label for="designation">Designation</label>
                                    <input type="text" name="experiences[{{ $index }}][designation]"
                                        placeholder="Enter your designation" value="{{ $experience->designation }}" />
                                </div>
                                <div class="single--input--wrapper">
                                    <label for="details">Description</label>
                                    <input type="text" name="experiences[{{ $index }}][details]"
                                        placeholder="Write details" value="{{ $experience->details }}" />
                                </div>
                                <div class="single--input--wrapper">
                                    <label for="starting_date">Start date</label>
                                    <input type="date" name="experiences[{{ $index }}][starting_date]"
                                        placeholder="Start date" value="{{ $experience->starting_date }}" />
                                </div>
                                <div class="single--input--wrapper">
                                    <label for="ending_date">End date</label>
                                    <input type="date" name="experiences[{{ $index }}][ending_date]"
                                        placeholder="End date" value="{{ $experience->ending_date }}" />
                                </div>
                                <div class="single--input--wrapper">
                                    <label for="company_location">Location</label>
                                    <input type="text" name="experiences[{{ $index }}][company_location]"
                                        placeholder="Enter your company location"
                                        value="{{ $experience->company_location }}" />
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            {{-- experience  area end --}}
            <button type="submit" class="submit">Save and Changes</button>
        </form>
    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            $('#profile_picture_input').change(function() {
                const formData = new FormData();
                formData.append('profile_picture', $(this)[0].files[0]);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '{{ route('update.profile.picture') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.success) {
                            $('#profile-picture').attr('src', data.image_url);
                            toastr.success('Profile picture updated successfully.');
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function() {
                        toastr.error(data.message);
                    }
                });
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const createExpField = () => {
                let wrapper = document.querySelector(".experience--area--wrapper");

                if (wrapper) {
                    let addButton = wrapper.querySelector(".add--more--btn");
                    let inputGroup = wrapper.querySelector(".input--group--wrapper");

                    addButton.addEventListener("click", (event) => {
                        event.preventDefault();

                        let index = inputGroup.querySelectorAll('.input--group').length;

                        let fieldContent = `
                        <div></div>
                        <div class="input--group">
                            <div class="single--input--wrapper">
                                <label for="company_name">Company Name</label>
                                <input type="text" name="experiences[${index}][company_name]" placeholder="Enter your company name" />
                            </div>
                            <div class="single--input--wrapper">
                                <label for="designation">Designation</label>
                                <input type="text" name="experiences[${index}][designation]" placeholder="Enter your designation" />
                            </div>
                            <div class="single--input--wrapper">
                                <label for="details">Description</label>
                                <input type="text" name="experiences[${index}][details]" placeholder="Write details" />
                            </div>
                            <div class="single--input--wrapper">
                                <label for="starting_date">Start date</label>
                                <input type="date" name="experiences[${index}][starting_date]" placeholder="Start date" />
                            </div>
                            <div class="single--input--wrapper">
                                <label for="ending_date">End date</label>
                                <input type="date" name="experiences[${index}][ending_date]" placeholder="End date" />
                            </div>
                            <div class="single--input--wrapper">
                                <label for="company_location">Location</label>
                                <input type="text" name="experiences[${index}][company_location]" placeholder="Enter your company location" />
                            </div>
                        </div>
                    `;

                        let newContent = document.createElement("div");
                        newContent.innerHTML = fieldContent;
                        inputGroup.appendChild(newContent);
                    });
                }
            };

            createExpField();
        });
    </script>
@endpush
