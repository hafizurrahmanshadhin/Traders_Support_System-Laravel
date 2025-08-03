<section id="about" class="professional--works--area--wrapper">
    <div class="container">
        <div class="professional--works--content">
            <div class="left">
                <img src="{{ $tradesmanSpecific->image ?? 'uploads/users/jobaed-bhuiyan-1723955257.png' }}"
                    alt="{{ $tradesmanSpecific->title ?? '' }}" />
            </div>
            <div class="right">
                <h3 class="common--heading--title">
                    {{ $tradesmanSpecific->title ?? 'How Tradesman Specific Professional' }} <span>Works</span>
                </h3>

                <div class="list">
                    @if (!empty($tradesmanSpecific->description))
                        {!! $tradesmanSpecific->description !!}
                    @else
                        <div class="single--one">
                            <p>Matching Platform:</p>
                            <span>Trade Support Pros is an online platform where tradespersons and service professionals
                                can register their profiles.</span>
                        </div>
                        <div class="single--one">
                            <p>Profiles and Preferences:</p>
                            <span>Tradespersons list their specific trade skills, location, availability, and any other
                                relevant details. Similarly, service professionals list their expertise, services
                                offered, rates, and availability.</span>
                        </div>
                        <div class="single--one">
                            <p>Matching Platform:</p>
                            <span>Trade Support Pros is an online platform where tradespersons and service professionals
                                can register their profiles.</span>
                        </div>
                        <div class="single--one">
                            <p>Search and Connect:</p>
                            <span>Tradespersons seeking support can search the database of service professionals based
                                on their specific needs. They can filter professionals by location, service offerings,
                                experience, and reviews.</span>
                        </div>
                        <div class="single--one">
                            <p>Search and Connect:</p>
                            <span>Trade Support Pros is an online platform where tradespersons and service professionals
                                can register their profiles.</span>
                        </div>
                        <div class="single--one">
                            <p>Services Provided:</p>
                            <span>Service professionals can offer a range of services to tradespersons, including
                                administrative support, bookkeeping, accounting (CPA services), legal advice, contract
                                drafting, and more.</span>
                        </div>
                        <div class="single--one">
                            <p>Vetting and Quality Assurance:</p>
                            <span>Trade Support Pros is an online platform where tradespersons and service professionals
                                can register their profiles.</span>
                        </div>
                        <div class="single--one">
                            <p>Payment and Transactions:</p>
                            <span>The platform may facilitate payment processing for services rendered, ensuring both
                                parties a seamless and secure transaction experience.</span>
                        </div>
                        <div class="single--one">
                            <p>Feedback and Reviews:</p>
                            <span>Tradespersons can leave feedback and reviews for the service professionals they work
                                with, helping further to establish trust and accountability within the platform's
                                community.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        #about .list ul {
            list-style-type: disc;
            margin-left: 20px;
        }
    </style>
</section>
