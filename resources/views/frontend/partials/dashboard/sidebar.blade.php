<section class="sidebar--area--wrapper">
    <div class="menu--lists">
        <p class="title">General</p>
        <ul class="list">
            <li class="{{ request()->routeIs(['pro.dashboard', 'trade.dashboard']) ? 'active' : '' }}">
                <a href="{{ Auth::user()->role === 'trade' ? route('trade.dashboard') : route('pro.dashboard') }}">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M14 21C13.4477 21 13 20.5523 13 20V12C13 11.4477 13.4477 11 14 11H20C20.5523 11 21 11.4477 21 12V20C21 20.5523 20.5523 21 20 21H14ZM4 13C3.44772 13 3 12.5523 3 12V4C3 3.44772 3.44772 3 4 3H10C10.5523 3 11 3.44772 11 4V12C11 12.5523 10.5523 13 10 13H4ZM9 11V5H5V11H9ZM4 21C3.44772 21 3 20.5523 3 20V16C3 15.4477 3.44772 15 4 15H10C10.5523 15 11 15.4477 11 16V20C11 20.5523 10.5523 21 10 21H4ZM5 19H9V17H5V19ZM15 19H19V13H15V19ZM13 4C13 3.44772 13.4477 3 14 3H20C20.5523 3 21 3.44772 21 4V8C21 8.55228 20.5523 9 20 9H14C13.4477 9 13 8.55228 13 8V4ZM15 5V7H19V5H15Z"
                                fill="#5A5C5F" />
                        </svg>
                    </div>
                    <p class="label">Dashboard</p>
                </a>
            </li>

            <li class="{{ request()->routeIs('pro.profile') ? 'active' : '' }}">
                <a href="{{ route('pro.profile') }}">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M21.0082 3C21.556 3 22 3.44495 22 3.9934V20.0066C22 20.5552 21.5447 21 21.0082 21H2.9918C2.44405 21 2 20.5551 2 20.0066V3.9934C2 3.44476 2.45531 3 2.9918 3H21.0082ZM20 5H4V19H20V5ZM18 15V17H6V15H18ZM12 7V13H6V7H12ZM18 11V13H14V11H18ZM10 9H8V11H10V9ZM18 7V9H14V7H18Z"
                                fill="#5A5C5F" />
                        </svg>
                    </div>
                    <p class="label">Profile</p>
                </a>
            </li>

            <li class="{{ request()->routeIs(['chatify', 'not-subscribed']) ? 'active' : '' }}">
                @if (Auth::user()->membership() != [])
                    <a href="{{ route('chatify') }}">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M8.5 19H8C4 19 2 18 2 13V8C2 4 4 2 8 2H16C20 2 22 4 22 8V13C22 17 20 19 16 19H15.5C15.19 19 14.89 19.15 14.7 19.4L13.2 21.4C12.54 22.28 11.46 22.28 10.8 21.4L9.3 19.4C9.14 19.18 8.77 19 8.5 19Z"
                                    stroke="#5A5C5F" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M15.9945 11H16.0035" stroke="#5A5C5F" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M11.9945 11H12.0035" stroke="#5A5C5F" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M7.99451 11H8.00349" stroke="#5A5C5F" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <p class="label">Message</p>
                    </a>
                @else
                    <a href="{{ route('not-subscribed') }}">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M8.5 19H8C4 19 2 18 2 13V8C2 4 4 2 8 2H16C20 2 22 4 22 8V13C22 17 20 19 16 19H15.5C15.19 19 14.89 19.15 14.7 19.4L13.2 21.4C12.54 22.28 11.46 22.28 10.8 21.4L9.3 19.4C9.14 19.18 8.77 19 8.5 19Z"
                                    stroke="#5A5C5F" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M15.9945 11H16.0035" stroke="#5A5C5F" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M11.9945 11H12.0035" stroke="#5A5C5F" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M7.99451 11H8.00349" stroke="#5A5C5F" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <p class="label">Message</p>
                    </a>
                @endif
            </li>

            <li
                class="{{ request()->routeIs(['trade.frontend.subscription', 'pro.frontend.subscription']) ? 'active' : '' }}">
                <a
                    href="{{ Auth::user()->role === 'trade' ? route('trade.frontend.subscription') : route('pro.frontend.subscription') }}">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <g clip-path="url(#clip0_12179_2485)">
                                <mask id="mask0_12179_2485" style="mask-type: luminance" maskUnits="userSpaceOnUse"
                                    x="0" y="0" width="24" height="24">
                                    <path d="M0 7.05719e-05H23.9999V24H0V7.05719e-05Z" fill="white" />
                                </mask>
                                <g mask="url(#mask0_12179_2485)">
                                    <path
                                        d="M11.7338 23.6484H15.9457V21.8554L16.9286 18.355C17.2834 17.0915 17.2967 15.7565 16.9671 14.4862L16.5333 12.8153C16.4826 12.6199 16.3684 12.4469 16.2087 12.3233C16.049 12.1998 15.8528 12.1328 15.6509 12.1329H15.6366C15.4307 12.1324 15.2308 12.2021 15.0698 12.3303C14.9175 12.4511 14.8078 12.6174 14.7567 12.805C14.7389 12.8818 14.7268 12.9214 14.7247 13.0439V12.6976C14.7247 12.4459 14.6226 12.2181 14.4577 12.0532C14.3731 11.9685 14.2727 11.9013 14.1622 11.8556C14.0516 11.8098 13.9331 11.7863 13.8135 11.7864H13.6697C13.1663 11.7864 12.7586 12.1941 12.7585 12.6975V12.1649C12.7585 11.8694 12.6178 11.6068 12.3998 11.4403C12.2502 11.3138 11.973 11.2342 11.7036 11.2534C11.2244 11.2534 10.8322 11.6233 10.7956 12.0931C10.791 12.097 10.7928 12.5295 10.7925 12.5513C10.7925 12.5284 10.7914 12.5057 10.7897 12.4832V8.03353C10.7897 7.53075 10.3821 7.12317 9.87934 7.12317C9.37661 7.12317 8.96908 7.53075 8.96908 8.03353V14.5959C8.96908 14.46 8.93425 14.2149 8.74211 13.9955C8.60444 13.8384 8.35689 13.6856 8.05872 13.6856C7.59611 13.6856 7.20686 14.0321 7.15399 14.4914L6.69176 18.4936C6.68034 18.5926 6.67503 18.6922 6.67587 18.7919L6.67591 18.7936C6.67908 19.1382 6.75582 19.4781 6.90098 19.7907C7.04615 20.1032 7.25639 20.3811 7.51765 20.6058L8.96908 21.8554V23.6484H10.0508"
                                        stroke="#5A5C5F" stroke-width="0.84375" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.96875 14.5967V17.5605" stroke="#5A5C5F" stroke-width="0.84375"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M5.86422 10.7441H0.898438V1.51903H5.86422" stroke="#5A5C5F"
                                        stroke-width="0.84375" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M19.6216 10.7441H23.1019V1.51903H17.9688" stroke="#5A5C5F"
                                        stroke-width="0.84375" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M16.7558 13.6641H17.9713V0.352398H5.86719V13.6641H8.97143"
                                        stroke="#5A5C5F" stroke-width="0.84375" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M10.7852 8.03416H14.335C14.717 8.03416 15.027 8.3441 15.027 8.72655V9.40188C15.027 9.78381 14.717 10.0938 14.335 10.0938H12.4108"
                                        stroke="#5A5C5F" stroke-width="0.84375" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.96875 9.40039V8.72506" stroke="#5A5C5F" stroke-width="0.84375"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M5.8645 2.94531H0.898438V1.51952H5.8645V2.94531ZM5.8645 2.94531H17.9682M5.8645 2.94531V0.351445H17.9682V2.94531M17.9682 2.94531H23.1015V1.51952H17.9682V2.94531Z"
                                        stroke="#5A5C5F" stroke-width="0.84375" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9.875 1.66602H13.9517" stroke="#5A5C5F" stroke-width="0.84375"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10.4673 5.92969H7.69141V4.32404H10.4673V5.92969Z" stroke="#5A5C5F"
                                        stroke-width="0.84375" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M19.375 5.49609H21.4634" stroke="#5A5C5F" stroke-width="0.84375"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M19.375 7.00781H21.4634" stroke="#5A5C5F" stroke-width="0.84375"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M2.32031 5.49609H4.40868" stroke="#5A5C5F" stroke-width="0.84375"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M2.32031 7.00781H4.40868" stroke="#5A5C5F" stroke-width="0.84375"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12.2148 5.12695H15.9444" stroke="#5A5C5F" stroke-width="0.84375"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                            </g>
                            <defs>
                                <clipPath id="clip0_12179_2485">
                                    <rect width="24" height="24" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <p class="label">Subscription</p>
                </a>
            </li>
        </ul>
    </div>


    <div class="menu--lists others">
        <p class="title">Others</p>
        <ul class="list">
            @if (Auth::user()->role === 'pro')
                <li
                    class="{{ (Auth::user()->role === 'trade' && request()->routeIs('help')) || (Auth::user()->role !== 'trade' && request()->routeIs('pro-help')) || request()->routeIs('faq') ? 'active' : '' }}">
                    <a href="{{ Auth::user()->role === 'trade' ? route('help') : route('pro-help') }}">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25"
                                viewBox="0 0 24 25" fill="none">
                                <path
                                    d="M12 21.3633C13.1819 21.3633 14.3522 21.1305 15.4442 20.6782C16.5361 20.2259 17.5282 19.563 18.364 18.7272C19.1997 17.8915 19.8626 16.8994 20.3149 15.8074C20.7672 14.7155 21 13.5452 21 12.3633C21 11.1814 20.7672 10.0111 20.3149 8.91913C19.8626 7.8272 19.1997 6.83505 18.364 5.99932C17.5282 5.16359 16.5361 4.50066 15.4442 4.04837C14.3522 3.59607 13.1819 3.36328 12 3.36328C9.61305 3.36328 7.32387 4.31149 5.63604 5.99932C3.94821 7.68715 3 9.97633 3 12.3633C3 14.7502 3.94821 17.0394 5.63604 18.7272C7.32387 20.4151 9.61305 21.3633 12 21.3633Z"
                                    stroke="#64748B" stroke-width="1.16667" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M12 15.3633H12.01" stroke="#64748B" stroke-width="1.16667"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M12 12.3633C12.3956 12.3633 12.7822 12.246 13.1111 12.0262C13.44 11.8065 13.6964 11.4941 13.8478 11.1286C13.9991 10.7632 14.0387 10.3611 13.9616 9.9731C13.8844 9.58514 13.6939 9.22877 13.4142 8.94907C13.1345 8.66936 12.7781 8.47888 12.3902 8.40171C12.0022 8.32454 11.6001 8.36415 11.2346 8.51552C10.8692 8.6669 10.5568 8.92324 10.3371 9.25214C10.1173 9.58104 10 9.96772 10 10.3633"
                                    stroke="#64748B" stroke-width="1.16667" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <p class="label">Help & Support</p>
                    </a>
                </li>
            @endif

            <li class="{{ request()->routeIs('settings') ? 'active' : '' }}">
                <a href="{{ route('settings') }}">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25"
                            fill="none">
                            <path
                                d="M13.9971 21.3633H9.99712L9.44613 18.8833C8.79038 18.6269 8.17712 18.2729 7.62712 17.8333L5.20312 18.5963L3.20312 15.1323L5.07512 13.4143C4.97036 12.7182 4.97036 12.0104 5.07512 11.3143L3.20312 9.59528L5.20312 6.13128L7.62712 6.89428C8.17737 6.45425 8.79097 6.09992 9.44712 5.84328L9.99712 3.36328H13.9971L14.5481 5.84328C15.2041 6.09928 15.8171 6.45328 16.3681 6.89328L18.7911 6.13028L20.7911 9.59428L18.9191 11.3123C19.0239 12.0084 19.0239 12.7162 18.9191 13.4123L20.7911 15.1303L18.7911 18.5943L16.3671 17.8313C15.8172 18.2715 15.2039 18.6261 14.5481 18.8833L13.9981 21.3633H13.9971Z"
                                stroke="#64748B" stroke-width="1.16667" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M12 15.3633C12.7956 15.3633 13.5587 15.0472 14.1213 14.4846C14.6839 13.922 15 13.1589 15 12.3633C15 11.5676 14.6839 10.8046 14.1213 10.242C13.5587 9.67935 12.7956 9.36328 12 9.36328C11.2044 9.36328 10.4413 9.67935 9.87868 10.242C9.31607 10.8046 9 11.5676 9 12.3633C9 13.1589 9.31607 13.922 9.87868 14.4846C10.4413 15.0472 11.2044 15.3633 12 15.3633Z"
                                stroke="#64748B" stroke-width="1.16667" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <p class="label">Settings</p>
                </a>
            </li>

            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25"
                            fill="none">
                            <path d="M19 12.3633H9M19 12.3633L15 8.36328M19 12.3633L15 16.3633" stroke="#64748B"
                                stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M15 3.36328H7C6.46957 3.36328 5.96086 3.57399 5.58579 3.94907C5.21071 4.32414 5 4.83285 5 5.36328V19.3633C5 19.8937 5.21071 20.4024 5.58579 20.7775C5.96086 21.1526 6.46957 21.3633 7 21.3633H15"
                                stroke="#64748B" stroke-width="1.4" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <p class="label">Logout</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

    {{-- upgrade area --}}
    <div class="upgrade--area">
        <div class="top">
            <div class="logo">
                <img class="mb-3" width="200px" height="120"
                    src="{{ asset($systemSetting->logo ?? 'frontend/images/logo.svg') }}" alt="logo" />
            </div>

            <p class="title">{{ $systemSetting->title ?? 'Trade Support Pros' }}</p>
            <p class="subtitle">Get access to all features</p>
        </div>
        <div class="bottom">
            <a href="{{ Auth::user()->role === 'trade' ? route('trade.frontend.subscription') : route('pro.frontend.subscription') }}"
                class="upgrade--btn">
                <span>Get Subscription</span>
            </a>
        </div>

        <div class="overlay">
            <svg xmlns="http://www.w3.org/2000/svg" width="175" height="100" viewBox="0 0 175 100"
                fill="none">
                <circle cx="121" cy="121" r="121" transform="matrix(-1 0 0 1 242 -142)"
                    fill="url(#paint0_linear_12165_808)" fill-opacity="0.6" />
                <defs>
                    <linearGradient id="paint0_linear_12165_808" x1="276.637" y1="273.654" x2="169.609"
                        y2="144.783" gradientUnits="userSpaceOnUse">
                        <stop stop-color="white" stop-opacity="0.4" />
                        <stop offset="1" stop-color="white" stop-opacity="0" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <div class="overlay second">
            <svg xmlns="http://www.w3.org/2000/svg" width="175" height="100" viewBox="0 0 175 100"
                fill="none">
                <circle cx="121" cy="121" r="121" transform="matrix(-1 0 0 1 242 -142)"
                    fill="url(#paint0_linear_12165_808)" fill-opacity="0.6" />
                <defs>
                    <linearGradient id="paint0_linear_12165_808" x1="276.637" y1="273.654" x2="169.609"
                        y2="144.783" gradientUnits="userSpaceOnUse">
                        <stop stop-color="white" stop-opacity="0.4" />
                        <stop offset="1" stop-color="white" stop-opacity="0" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
    </div>
</section>


{{-- sidebar button --}}
<div class="sidebar--button">
    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512"
        height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background: new 0 0 512 512"
        xml:space="preserve" class>
        <g>
            <path
                d="M4.13 3.05a4.264 4.264 0 0 0-1.08 1.08A6.143 6.143 0 0 0 2 7.81v8.38C2 19.83 4.17 22 7.81 22h7.47V2H7.81a6.143 6.143 0 0 0-3.68 1.05zM8.5 9.971A.75.75 0 1 1 9.556 8.91l2.56 2.56a.749.749 0 0 1 0 1.06l-2.56 2.56A.75.75 0 0 1 8.5 14.029L10.525 12zM22 7.81v8.38a6.143 6.143 0 0 1-1.05 3.68 4.264 4.264 0 0 1-1.08 1.08 5.779 5.779 0 0 1-3.09 1.03V2.03C20.06 2.24 22 4.37 22 7.81z"
                data-name="1" fill="#073d71" opacity="1" data-original="#000000" class></path>
        </g>
    </svg>
</div>
{{-- sidebar button --}}
