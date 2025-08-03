@extends('frontend.app')

@section('title', 'Trade Support')

@section('content')
    @include('frontend.partials.home.header')
    @include('frontend.layouts.home.top-banner')
    @include('frontend.layouts.home.tradesman-specific')
    @include('frontend.layouts.home.finding-the-perfect-matche')
    @include('frontend.layouts.home.help-business')
    @include('frontend.layouts.home.choose-business')
    @include('frontend.layouts.home.bottom-banner-and-gallery')
    @include('frontend.layouts.home.testimonial')
    @include('frontend.partials.home.footer')
@endsection
