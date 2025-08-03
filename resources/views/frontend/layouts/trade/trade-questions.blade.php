@extends('frontend.app')

@section('title', 'Trade Questions')

@section('content')
    <section class="questions--total--area--wrapper">
        <div class="questions--total--area--content">
            {{-- header area start --}}
            <div class="questions--header--area">
                <div class="logo">
                    <img src="{{ asset('frontend/images/logo.svg') }}" alt="" />
                </div>

                <p class="title">
                    Please give some information about your Administrative Assistants
                </p>
            </div>
            {{-- header area end --}}

            {{-- body area start --}}
            <div class="questions--body--area">
                {{-- progress area start --}}
                <div class="question--progress--bar--wrapper">
                    <div class="question--progress--bar">
                        <div class="question--progress--status"></div>

                        <div class="question--progress"></div>
                    </div>
                </div>
                {{-- progress area end --}}

                {{-- question slides area start --}}
                <div class="questions--slides--wrapper traders--area">
                    <div class="single--question--slide">
                        <p class="small--bold large--descritpion">
                            Administrative assistants should have strong organizational
                            skills, attention to detail, and experience managing
                            administrative tasks for businesses like yours. Administrative
                            assistants should be able to prioritize tasks effectively,
                            communicate with clients and colleagues, and handle confidential
                            information. Consider the cost of administrative assistance
                            services and compare it to their efficiency and support in
                            managing day-to-day operations. Look for administrative
                            assistants with experience working with businesses in your
                            industry and understand your trade's specific administrative
                            needs.
                        </p>

                        {{-- next step button --}}
                        <button class="next--button">
                            <span>Next</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                    fill="white" />
                            </svg>
                        </button>
                    </div>

                    <div class="single--question--slide">
                        <div class="trades--info--text--wrapper">
                            <div class="single--text--info">
                                <p class="title">Financial Statement Preparation</p>
                                <p class="small--bold">
                                    Bookkeepers can prepare accurate and detailed financial
                                    statements, including balance sheets, income statements, and
                                    cash statements. These statements provide valuable insights
                                    into a company's financial health and performance, helping
                                    business owners and managers make informed decisions.
                                </p>
                            </div>
                            <div class="single--text--info">
                                <p class="title">Accounts Receivables/Payables/Collections</p>
                                <p class="small--bold">
                                    Bookkeepers can prepare accurate and detailed financial
                                    statements, including balance sheets, income statements, and
                                    cash statements. These statements provide valuable insights
                                    into a company's financial health and performance, helping
                                    business owners and managers make informed decisions.
                                </p>
                            </div>
                            <div class="single--text--info">
                                <p class="title">Payroll Processing</p>
                                <p class="small--bold">
                                    Bookkeepers can prepare accurate and detailed financial
                                    statements, including balance sheets, income statements, and
                                    cash statements. These statements provide valuable insights
                                    into a company's financial health and performance, helping
                                    business owners and managers make informed decisions.
                                </p>
                            </div>
                            <div class="single--text--info">
                                <p class="title">Budgeting/Forecasting</p>
                                <p class="small--bold">
                                    Bookkeepers can prepare accurate and detailed financial
                                    statements, including balance sheets, income statements, and
                                    cash statements. These statements provide valuable insights
                                    into a company's financial health and performance, helping
                                    business owners and managers make informed decisions.
                                </p>
                            </div>
                            <div class="single--text--info">
                                <p class="title">Tax Preparation</p>
                                <p class="small--bold">
                                    Bookkeepers can prepare accurate and detailed financial
                                    statements, including balance sheets, income statements, and
                                    cash statements. These statements provide valuable insights
                                    into a company's financial health and performance, helping
                                    business owners and managers make informed decisions.
                                </p>
                            </div>
                            <div class="single--text--info">
                                <p class="title">Auditing Services</p>
                                <p class="small--bold">
                                    Bookkeepers can prepare accurate and detailed financial
                                    statements, including balance sheets, income statements, and
                                    cash statements. These statements provide valuable insights
                                    into a company's financial health and performance, helping
                                    business owners and managers make informed decisions.
                                </p>
                            </div>
                        </div>

                        {{-- next step button --}}
                        <button class="next--button">
                            <span>Next</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                    fill="white" />
                            </svg>
                        </button>
                    </div>

                    <div class="single--question--slide">
                        <div class="single--subject--description">
                            <p class="top--title">Attorney/Legal Services</p>

                            <p class="small--bold">
                                <span class="highlighted">Qualifications & Experience:</span>
                                Lawyers should have expertise in business law and contracts
                                and experience representing clients in their industry.
                            </p>
                            <p class="small--bold">
                                <span class="highlighted">Industry Knowledge:</span>
                                Look for lawyers who understand the specific legal challenges
                                businesses face in your industry and can provide proactive
                                legal advice
                            </p>
                        </div>
                        {{-- next step button --}}
                        <button class="next--button">
                            <span>Next</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                    fill="white" />
                            </svg>
                        </button>
                    </div>

                    <div class="single--question--slide">
                        <div class="single--subject--description">
                            <p class="top--title">Social Media Management:</p>

                            <p class="small--bold">
                                Social media managers should have a strong understanding of
                                social media platforms and analytics and experience creating
                                and managing social media campaigns for businesses similar to
                                yours.
                            </p>
                            <p class="small--bold">
                                <span class="highlighted">Communication Skills:</span>
                                Social media managers should be able to effectively engage
                                with their target audience through content creation and
                                interaction.
                            </p>
                            <p class="small--bold">
                                Consider the cost of social media management services and
                                compare it to their value in increasing brand awareness and
                                driving traffic to your website.
                            </p>

                            <p class="small--bold">
                                Look for social media managers with experience working with
                                businesses in your industry and understand the specific social
                                media strategies that work best for your target market.
                            </p>
                        </div>
                        {{-- next step button --}}
                        <button class="next--button">
                            <span>Next</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                    fill="white" />
                            </svg>
                        </button>
                    </div>

                    <div class="single--question--slide">
                        <div class="single--subject--description">
                            <p class="top--title">Graphic Design:</p>

                            <p class="small--bold">
                                Graphic designers should have a strong portfolio showcasing
                                their creativity and technical skills, as well as experience
                                creating visual assets for businesses like yours.
                            </p>
                            <p class="small--bold">
                                Graphic designers should be able to understand your brand
                                identity and translate it into visually appealing designs.
                            </p>
                            <p class="small--bold">
                                Consider the cost of graphic design services and compare it to
                                their value in enhancing your brand image and marketing
                                materials.
                            </p>
                        </div>
                        {{-- next step button --}}
                        <button class="next--button">
                            <span>Next</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                    fill="white" />
                            </svg>
                        </button>
                    </div>

                    <div class="single--question--slide">
                        <div class="single--subject--description">
                            <p class="top--title">Content Marketing:</p>

                            <p class="small--bold">
                                Content marketers should have a strong understanding of
                                content strategy, SEO, and digital marketing tactics and
                                experience creating and promoting content for businesses like
                                yours.
                            </p>
                            <p class="small--bold">
                                Content marketers should be able to effectively communicate
                                your brand message through various content formats, including
                                blog posts, videos, and social media posts.
                            </p>
                            <p class="small--bold">
                                Consider the cost of content marketing services and compare it
                                to their value in driving traffic to your website and
                                generating leads.
                            </p>
                        </div>
                        {{-- next step button --}}
                        <a href="{{ route('questionnaires') }}" class="btn next--button">
                            <span>Next</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </div>
                </div>
                {{-- question slides area end --}}
            </div>
            {{-- body area end --}}
        </div>
    </section>
@endsection


@push('script')
    <script>
        const multiStepQuestion = () => {
            let wrapper = document.querySelector(".questions--slides--wrapper");

            if (wrapper) {
                let progressBar = document.querySelector(".question--progress");
                let progressStatus = document.querySelector(
                    ".question--progress--status"
                );

                let slides = wrapper.querySelectorAll(".single--question--slide");

                let currentIndex = 0;

                let percentage = 0;

                progressBar.style.width = `${percentage}%`;
                progressStatus.innerText = `${percentage}%`;
                progressStatus.style.left = `${percentage}%`;

                // initializing
                slides.forEach((item) => {
                    item.classList.add("d-none");
                });
                slides[currentIndex].classList.remove("d-none");

                function showSlide() {
                    slides.forEach((item) => {
                        item.classList.add("d-none");
                    });
                    slides[currentIndex].classList.remove("d-none");

                    // changing the width of progress
                    let percentage = parseInt(((currentIndex + 1) / slides.length) * 100);
                    progressBar.style.width = `${percentage}%`;
                    progressStatus.innerText = `${percentage}%`;
                    progressStatus.style.left = `${percentage}%`;
                }

                // next button function
                slides.forEach((item) => {
                    // next button
                    let nextButton = item.querySelector(".next--button");

                    nextButton.addEventListener("click", () => {
                        currentIndex++;
                        if (currentIndex < slides.length) {
                            showSlide();
                            document
                                .querySelector(".questions--header--area .logo")
                                .scrollIntoView({
                                    behavior: "smooth",
                                    block: "start",
                                });

                            console.log(currentIndex);
                        } else {
                            // When it is the last slide, make sure progress is 100%
                            progressBar.style.width = "100%";
                            progressStatus.innerText = "100%";
                            progressStatus.style.left = "100%";
                        }
                    });
                });
            }
        };
        multiStepQuestion();
    </script>
@endpush
