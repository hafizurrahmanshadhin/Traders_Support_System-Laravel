<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>@yield('title')</title>
    @include('frontend.partials.styles')
</head>

<body class="dashboard--body">
    {{--  ======== Preloader ===========  --}}
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    {{--  ======== Preloader ===========  --}}

    @include('frontend.partials.dashboard.header')

    <div class="dashboard--area--wrapper">

        @include('frontend.partials.dashboard.sidebar')
        <div class="dashboard--main--content">
            @yield('content')
        </div>
    </div>

    @include('frontend.partials.scripts')
</body>

</html>
