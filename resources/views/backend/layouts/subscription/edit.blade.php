@extends('backend.app')

@section('title', 'Update Pro Subscription')

@section('content')
    {{--  ========== title-wrapper start ==========  --}}
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h2>Update Subscription</h2>
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
                            <li><span><i class="lni lni-angle-double-right"></i></span>Settings</li>
                            <li class="active"><span><i class="lni lni-angle-double-right"></i></span>Update Pro
                                Subscription</li>
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
                    <form method="POST" action="{{ route('admin.subscription.update', ['id' => $subscription->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-style-1">
                                    <label for="user_type">User Type:</label>
                                    <select id="user_type" name="user_type"
                                        class="form-control @error('user_type') is-invalid @enderror"
                                        onchange="updatePackageTypeOptions()">
                                        <option value="">Select Type</option>
                                        <option value="pro"
                                            {{ old('user_type', $subscription->user_type) == 'pro' ? 'selected' : '' }}>Pro
                                        </option>
                                        <option value="trade"
                                            {{ old('user_type', $subscription->user_type) == 'trade' ? 'selected' : '' }}>
                                            Trade
                                        </option>
                                    </select>
                                    @error('user_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-style-1">
                                    <label for="package_type">Package Type:</label>
                                    <select id="package_type" name="package_type"
                                        class="form-control @error('package_type') is-invalid @enderror">
                                        <option value="">Select Type</option>
                                        {{-- Options will be dynamically comes here --}}
                                    </select>
                                    @error('package_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-style-1">
                                    <label for="price">Price:</label>
                                    <input type="text" placeholder="Enter Price" id="price"
                                        class="form-control @error('price') is-invalid @enderror" name="price"
                                        value="{{ old('price', $subscription->price) }}" />
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-style-1">
                                    <label for="package_duration">Package Duration:</label>
                                    <input type="text" placeholder="Enter Package Duration" id="package_duration"
                                        class="form-control @error('package_duration') is-invalid @enderror"
                                        name="package_duration"
                                        value="{{ old('package_duration', $subscription->package_duration) }}" />
                                    @error('package_duration')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-style-1">
                                    <label for="view_limit">View Limit:</label>
                                    <input type="text" placeholder="Enter View Limit" id="view_limit"
                                        class="form-control @error('view_limit') is-invalid @enderror" name="view_limit"
                                        value="{{ old('view_limit', $subscription->view_limit) }}" />
                                    @error('view_limit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-style-1">
                                    <label for="message_limit">Message Limit:</label>
                                    <input type="text" placeholder="Enter Message Limit" id="message_limit"
                                        class="form-control @error('message_limit') is-invalid @enderror"
                                        name="message_limit"
                                        value="{{ old('message_limit', $subscription->message_limit) }}" />
                                    @error('message_limit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="input-style-1">
                            <label for="timeline">TimeLine:</label>
                            <select id="timeline" name="timeline"
                                class="form-control @error('timeline') is-invalid @enderror">
                                <option value="">Select Type</option>
                                <option value="Monthly"
                                    {{ old('timeline', $subscription->timeline) == 'Monthly' ? 'selected' : '' }}>Monthly
                                </option>
                                <option value="Yearly"
                                    {{ old('timeline', $subscription->timeline) == 'Yearly' ? 'selected' : '' }}>Yearly
                                </option>
                            </select>
                            @error('timeline')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-style-1">
                            <label for="feature">Feature:</label>
                            <textarea class="form-control @error('feature') is-invalid @enderror" placeholder="Type here..." id="feature"
                                name="feature">
                                {{ old('feature', $subscription->feature) }}
                            </textarea>
                            @error('feature')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('admin.subscription.index') }}" class="btn btn-danger me-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#feature'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        function updatePackageTypeOptions() {
            var userType = document.getElementById('user_type').value;
            var packageTypeSelect = document.getElementById('package_type');

            // Clear existing options
            packageTypeSelect.innerHTML = '<option value="">Select Type</option>';

            if (userType === 'pro') {
                packageTypeSelect.innerHTML +=
                    '<option value="basic" {{ old('package_type', $subscription->package_type) == 'basic' ? 'selected' : '' }}>Basic</option>';
                packageTypeSelect.innerHTML +=
                    '<option value="elite" {{ old('package_type', $subscription->package_type) == 'elite' ? 'selected' : '' }}>Elite</option>';
            } else if (userType === 'trade') {
                packageTypeSelect.innerHTML +=
                    '<option value="popular" {{ old('package_type', $subscription->package_type) == 'popular' ? 'selected' : '' }}>Popular</option>';
                packageTypeSelect.innerHTML +=
                    '<option value="month" {{ old('package_type', $subscription->package_type) == 'month' ? 'selected' : '' }}>Month</option>';
                packageTypeSelect.innerHTML +=
                    '<option value="year" {{ old('package_type', $subscription->package_type) == 'year' ? 'selected' : '' }}>Year</option>';
            }
        }

        // Call the function initially to set the correct options if there's an old value
        updatePackageTypeOptions();
    </script>
@endpush
