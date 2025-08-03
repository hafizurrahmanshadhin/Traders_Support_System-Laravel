@extends('frontend.dashboard')

@section('title', 'FAQ')

@section('content')
    <div class="help--support--area--wrapper faq--area">
        <a href="{{ Auth::user()->role == 'pro' ? route('pro-help') : (Auth::user()->role == 'trade' ? route('help') : '#') }}"
           class="go--back">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M9.57 5.92969L3.5 11.9997L9.57 18.0697" stroke="#292D32" stroke-width="1.5"
                      stroke-miterlimit="10"
                      stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M20.5019 12H3.67188" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span>Back To Previous Page</span>
        </a>

        <h3 class="common--dashboard--title">FAQ</h3>

        <div class="faq--wrapper">
            <div class="accordion" id="accordionExample">
                @forelse ($faqs as $index => $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $index }}" aria-expanded="true"
                                    aria-controls="collapse{{ $index }}">
                                {{ $faq->question }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse show"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                What types of goods do you trade?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Our goal is to provide high-quality products across these
                                categories to support businesses in different sectors. If
                                you have specific needs or inquiries about other types of
                                goods, please contact our sales team for more detailed
                                information.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                What regions or countries do you operate in?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Our goal is to provide high-quality products across these
                                categories to support businesses in different sectors. If
                                you have specific needs or inquiries about other types of
                                goods, please contact our sales team for more detailed
                                information.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Do you have any certifications or accreditations?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Our goal is to provide high-quality products across these
                                categories to support businesses in different sectors. If
                                you have specific needs or inquiries about other types of
                                goods, please contact our sales team for more detailed
                                information.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                What are your business hours?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Our goal is to provide high-quality products across these
                                categories to support businesses in different sectors. If
                                you have specific needs or inquiries about other types of
                                goods, please contact our sales team for more detailed
                                information.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                What regions or countries do you operate in?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Our goal is to provide high-quality products across these
                                categories to support businesses in different sectors. If
                                you have specific needs or inquiries about other types of
                                goods, please contact our sales team for more detailed
                                information.
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
