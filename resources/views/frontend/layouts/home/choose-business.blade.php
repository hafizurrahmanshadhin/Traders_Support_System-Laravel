<section id="services">
    <section class="why--choose--area--wrapper support--pro">
        <div class="container">
            <div class="why--choose--area--content">
                <h3 class="common--heading--title">
                    Why Choose Trade Support Pros For Your Skilled Trade Business?
                </h3>

                <div class="feature--wrapper">
                    @forelse ($chooseBusinessesPro as $business)
                        <div class="single--feature">
                            <div class="icon">
                                <img src="{{ asset($business->image) }}" alt="{{ $business->title }}" />
                            </div>
                            <p class="title">{{ $business->title }}</p>
                            <p class="description">
                                {!! $business->description !!}
                            </p>
                        </div>
                    @empty
                        <div class="single--feature">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/feature-icon.png') }}" alt="" />
                            </div>

                            <p class="title">Tailored Expertise</p>
                            <p class="description">
                                We provide support services specifically designed for
                                skilled trade professionals. Whether you're a plumber,
                                electrician, carpenter, or HVAC technician, our team matches
                                you with Pros that understands your industry's unique needs
                                and challenges ensuring that you receive tailored solutions
                                that align with your business goals.
                            </p>
                        </div>
                        <div class="single--feature">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/feature-icon.png') }}" alt="" />
                            </div>

                            <p class="title">Comprehensive Support</p>
                            <p class="description">
                                From administrative assistance to bookkeeping, legal advice
                                to marketing strategies, we offer comprehensive support
                                services to streamline your business operations. Instead of
                                juggling multiple service providers, you can rely on us as
                                your one-stop shop for all your support needs.
                            </p>
                        </div>
                        <div class="single--feature">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/feature-icon.png') }}" alt="" />
                            </div>

                            <p class="title">Cost-Effective Solutions</p>
                            <p class="description">
                                Outsourcing support services to Trade Support Pros can be a
                                cost-effective alternative to hiring full-time staff or
                                managing tasks internally. By paying for only the services
                                you need when you need them, you can optimize your budget
                                and allocate resources more efficiently.
                            </p>
                        </div>
                        <div class="single--feature">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/feature-icon.png') }}" alt="" />
                            </div>

                            <p class="title">Tailored Expertise</p>
                            <p class="description">
                                As a skilled trade professional, your time is best spent
                                focusing on your core business activities. By delegating
                                administrative tasks, bookkeeping, and other support
                                functions to us, you can reclaim valuable time and energy to
                                invest in growing your business and serving your clients.
                            </p>
                        </div>
                        <div class="single--feature">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/feature-icon.png') }}" alt="" />
                            </div>

                            <p class="title">Tailored Expertise</p>
                            <p class="description">
                                We provide support services specifically designed for
                                skilled trade professionals. Whether you're a plumber,
                                electrician, carpenter, or HVAC technician, our team matches
                                you with Pros that understands your industry's unique needs
                                and challenges ensuring that you receive tailored solutions
                                that align with your business goals.
                            </p>
                        </div>
                        <div class="single--feature">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/feature-icon.png') }}" alt="" />
                            </div>

                            <p class="title">Tailored Expertise</p>
                            <p class="description">
                                We provide support services specifically designed for
                                skilled trade professionals. Whether you're a plumber,
                                electrician, carpenter, or HVAC technician, our team matches
                                you with Pros that understands your industry's unique needs
                                and challenges ensuring that you receive tailored solutions
                                that align with your business goals.
                            </p>
                        </div>
                        <div class="single--feature">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/feature-icon.png') }}" alt="" />
                            </div>

                            <p class="title">Tailored Expertise</p>
                            <p class="description">
                                We provide support services specifically designed for
                                skilled trade professionals. Whether you're a plumber,
                                electrician, carpenter, or HVAC technician, our team matches
                                you with Pros that understands your industry's unique needs
                                and challenges ensuring that you receive tailored solutions
                                that align with your business goals.
                            </p>
                        </div>
                        <div class="single--feature">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/feature-icon.png') }}" alt="" />
                            </div>

                            <p class="title">Tailored Expertise</p>
                            <p class="description">
                                We provide support services specifically designed for
                                skilled trade professionals. Whether you're a plumber,
                                electrician, carpenter, or HVAC technician, our team matches
                                you with Pros that understands your industry's unique needs
                                and challenges ensuring that you receive tailored solutions
                                that align with your business goals.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>



    <section class="why--choose--area--wrapper be--pro--area">
        <div class="container">
            <div class="why--choose--area--content">
                <h3 class="common--heading--title">
                    Why Choose To Be A Pro For A Skilled Trade Business?
                </h3>

                <div class="feature--wrapper">
                    @forelse ($chooseBusinessesTrade as $business)
                        <div class="single--feature">
                            <div class="icon">
                                <img src="{{ asset($business->image) }}" alt="{{ $business->title }}" />
                            </div>
                            <p class="title">{{ $business->title }}</p>
                            <p class="description">
                                {!! $business->description !!}
                            </p>
                        </div>
                    @empty
                        <div class="single--feature">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/feature-icon.png') }}" alt="" />
                            </div>

                            <p class="title">Varied Opportunities</p>
                            <p class="description">
                                As a service professional with Trade Support Pros, you'll
                                have many opportunities to collaborate with skilled
                                tradespersons. From providing legal advice and financial
                                services to offering administrative support and marketing
                                assistance, diverse roles are available to suit your skills
                                and interests.
                            </p>
                        </div>
                        <div class="single--feature">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/feature-icon.png') }}" alt="" />
                            </div>

                            <p class="title">Client Base Expansion</p>
                            <p class="description">
                                Partnering with skilled tradespersons opens new avenues for
                                expanding your client base. You'll have the opportunity to
                                connect with tradespersons' existing clients and networks,
                                allowing you to reach a broader audience and grow your
                                business.
                            </p>
                        </div>
                        <div class="single--feature">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/feature-icon.png') }}" alt="" />
                            </div>

                            <p class="title">Holistic Solutions</p>
                            <p class="description">
                                By working with skilled tradespersons, you'll have the
                                chance to offer solutions to clients. Whether assisting with
                                contract negotiations, providing financial planning
                                services, or offering legal guidance, you can complement the
                                tradespersons' expertise with your own, delivering
                                comprehensive support that adds value to client projects
                            </p>
                        </div>
                        <div class="single--feature">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/feature-icon.png') }}" alt="" />
                            </div>

                            <p class="title">Collaborative Environment</p>
                            <p class="description">
                                Trade Support Pros fosters a collaborative environment where
                                service professionals and tradespersons work together to
                                achieve common goals. You'll be able to collaborate on
                                projects, share knowledge and resources, and build mutually
                                beneficial partnerships that contribute to collective
                                success.
                            </p>
                        </div>
                        <div class="single--feature">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/feature-icon.png') }}" alt="" />
                            </div>

                            <p class="title">Flexibility and Independence</p>
                            <p class="description">
                                As a service professional with Trade Support Pros, you'll
                                enjoy flexibility and independence in your work. You can
                                choose the projects you want to work on, schedule, and
                                manage your workload according to your preferences, allowing
                                you to achieve a healthy work-life balance.
                            </p>
                        </div>
                        <div class="single--feature">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/feature-icon.png') }}" alt="" />
                            </div>

                            <p class="title">Professional Development</p>
                            <p class="description">
                                Trade Support Pros is committed to supporting the
                                professional development of its team members. You'll have
                                access to training opportunities, workshops, and resources
                                to enhance your skills and stay updated on industry trends,
                                ensuring you're equipped to deliver top-notch service to
                                clients.
                            </p>
                        </div>
                        <div class="single--feature">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/feature-icon.png') }}" alt="" />
                            </div>

                            <p class="title">Stability and Growth</p>
                            <p class="description">
                                Joining Trade Support Pros provides stability and
                                opportunities for growth in your career. You'll be part of a
                                reputable organization with a strong presence in the trade
                                industry, offering long-term prospects for advancement and
                                success
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</section>
