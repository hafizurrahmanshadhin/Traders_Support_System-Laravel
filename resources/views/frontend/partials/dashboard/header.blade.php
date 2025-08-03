@php
    $systemSetting = App\Models\SystemSetting::first();

    $userDetails = null;
    if (auth()->check()) {
        $userDetails = \App\Models\UserDetail::where('user_id', auth()->id())->first();
        $notificationsUser = auth()->user()->notifications;
        $unreadUserNotificationsCount = auth()->user()->unreadNotifications->count();
    }
@endphp

<section class="dashboard--header--wrapper">
    <div class="dashboard--header--content">
        <div class="intro">
            <div class="logo">
                <a href="{{ Auth::user()->role === 'trade' ? route('trade.dashboard') : route('pro.dashboard') }}">
                    <img class="mb-3" width="200px" height="120"
                        src="{{ asset($systemSetting->logo ?? 'frontend/images/logo.svg') }}" alt="logo" />
                </a>
            </div>
        </div>

        <div class="profile--area">
            {{-- mobile search icon --}}
            @if (Auth::user()->role === 'trade')
                <div class="mobile--search--icon">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="512" height="512" x="0" y="0" viewBox="0 0 461.516 461.516"
                        style="enable-background: new 0 0 512 512" xml:space="preserve" class>
                        <g>
                            <path
                                d="M185.746 371.332a185.294 185.294 0 0 0 113.866-39.11L422.39 455c9.172 8.858 23.787 8.604 32.645-.568 8.641-8.947 8.641-23.131 0-32.077L332.257 299.577c62.899-80.968 48.252-197.595-32.716-260.494S101.947-9.169 39.048 71.799-9.204 269.394 71.764 332.293a185.64 185.64 0 0 0 113.982 39.039zM87.095 87.059c54.484-54.485 142.82-54.486 197.305-.002s54.486 142.82.002 197.305-142.82 54.486-197.305.002l-.002-.002c-54.484-54.087-54.805-142.101-.718-196.585l.718-.718z"
                                fill="#073d71" opacity="1" data-original="#000000" class></path>
                        </g>
                    </svg>
                </div>
            @endif
            {{-- mobile search icon --}}

            <div class="notification--wrapper">
                <a href="#" class="notification">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path
                            d="M4 20H10C10 20.5304 10.2107 21.0391 10.5858 21.4142C10.9609 21.7893 11.4696 22 12 22C12.5304 22 13.0391 21.7893 13.4142 21.4142C13.7893 21.0391 14 20.5304 14 20H20C20.2652 20 20.5196 19.8946 20.7071 19.7071C20.8946 19.5196 21 19.2652 21 19C21 18.7348 20.8946 18.4804 20.7071 18.2929C20.5196 18.1054 20.2652 18 20 18V11C20 8.87827 19.1571 6.84344 17.6569 5.34315C16.1566 3.84285 14.1217 3 12 3C9.87827 3 7.84344 3.84285 6.34315 5.34315C4.84285 6.84344 4 8.87827 4 11V18C3.73478 18 3.48043 18.1054 3.29289 18.2929C3.10536 18.4804 3 18.7348 3 19C3 19.2652 3.10536 19.5196 3.29289 19.7071C3.48043 19.8946 3.73478 20 4 20V20ZM6 11C6 9.4087 6.63214 7.88258 7.75736 6.75736C8.88258 5.63214 10.4087 5 12 5C13.5913 5 15.1174 5.63214 16.2426 6.75736C17.3679 7.88258 18 9.4087 18 11V18H6V11Z"
                            fill="#073D71" />
                    </svg>

                    <p class="count">{{ $unreadUserNotificationsCount }}</p>
                </a>

                {{-- Notification Content --}}
                <div class="content">
                    @foreach ($notificationsUser as $user)
                        <div class="single--one">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <g clip-path="url(#clip0_11989_398)">
                                        <path
                                            d="M4.00156 10.1867H9.20156C9.30765 10.1867 9.40939 10.1446 9.48441 10.0696C9.55942 9.99455 9.60156 9.89281 9.60156 9.78672C9.60156 9.68063 9.55942 9.57889 9.48441 9.50388C9.40939 9.42886 9.30765 9.38672 9.20156 9.38672H4.00156C3.89548 9.38672 3.79373 9.42886 3.71872 9.50388C3.64371 9.57889 3.60156 9.68063 3.60156 9.78672C3.60156 9.89281 3.64371 9.99455 3.71872 10.0696C3.79373 10.1446 3.89548 10.1867 4.00156 10.1867ZM14.4016 11.7867H4.00156C3.89548 11.7867 3.79373 11.8289 3.71872 11.9039C3.64371 11.9789 3.60156 12.0806 3.60156 12.1867C3.60156 12.2928 3.64371 12.3945 3.71872 12.4696C3.79373 12.5446 3.89548 12.5867 4.00156 12.5867H14.4016C14.5077 12.5867 14.6094 12.5446 14.6844 12.4696C14.7594 12.3945 14.8016 12.2928 14.8016 12.1867C14.8016 12.0806 14.7594 11.9789 14.6844 11.9039C14.6094 11.8289 14.5077 11.7867 14.4016 11.7867ZM14.4016 14.1867H4.00156C3.89548 14.1867 3.79373 14.2289 3.71872 14.3039C3.64371 14.3789 3.60156 14.4806 3.60156 14.5867C3.60156 14.6928 3.64371 14.7945 3.71872 14.8696C3.79373 14.9446 3.89548 14.9867 4.00156 14.9867H14.4016C14.5077 14.9867 14.6094 14.9446 14.6844 14.8696C14.7594 14.7945 14.8016 14.6928 14.8016 14.5867C14.8016 14.4806 14.7594 14.3789 14.6844 14.3039C14.6094 14.2289 14.5077 14.1867 14.4016 14.1867Z"
                                            fill="#073D71" />
                                        <path
                                            d="M21.6288 1.01433L7.972 0.986328C6.664 0.986328 5.6 2.05033 5.6 3.35833V5.40793L2.372 5.41473C1.064 5.41473 0 6.47873 0 7.78673V16.2431C0 17.5511 1.064 18.6147 2.372 18.6147H4.8V22.6147C4.79997 22.6955 4.82438 22.7743 4.87002 22.841C4.91566 22.9076 4.98039 22.9588 5.0557 22.988C5.13102 23.0171 5.21339 23.0227 5.29197 23.0042C5.37056 22.9856 5.44169 22.9437 5.496 22.8839L9.3776 18.6139L16.028 18.5867C17.336 18.5867 18.4 17.5227 18.4 16.2151V16.1699L20.504 18.4843C20.5585 18.5437 20.6296 18.5852 20.7081 18.6035C20.7865 18.6218 20.8687 18.6161 20.9438 18.587C21.0189 18.558 21.0836 18.507 21.1293 18.4406C21.175 18.3743 21.1996 18.2957 21.2 18.2151V14.2151H21.628C22.936 14.2151 24 13.1511 24 11.8435V3.38633C23.9993 2.7576 23.7492 2.15482 23.3047 1.71017C22.8602 1.26552 22.2575 1.01528 21.6288 1.01433ZM17.6 16.2147C17.5995 16.6317 17.4334 17.0315 17.1384 17.3261C16.8433 17.6208 16.4434 17.7863 16.0264 17.7863L9.1984 17.8143C9.14294 17.8145 9.08813 17.8263 9.03745 17.8488C8.98677 17.8713 8.94132 17.9041 8.904 17.9451L5.6 21.5799V18.2143C5.6 18.1082 5.55786 18.0065 5.48284 17.9315C5.40783 17.8565 5.30609 17.8143 5.2 17.8143H2.372C1.95528 17.8139 1.55574 17.6482 1.26104 17.3536C0.966333 17.0589 0.800529 16.6594 0.8 16.2427V7.78633C0.80053 7.36943 0.96643 6.96977 1.2613 6.67506C1.55616 6.38034 1.9559 6.21465 2.3728 6.21433L6 6.20673H6.0008L16.028 6.18593C16.4448 6.18635 16.8444 6.35211 17.1391 6.64682C17.4338 6.94154 17.5996 7.34114 17.6 7.75793V16.2147ZM23.2 11.8427C23.1995 12.2594 23.0337 12.6589 22.739 12.9536C22.4443 13.2482 22.0447 13.4139 21.628 13.4143H20.8C20.6939 13.4143 20.5922 13.4565 20.5172 13.5315C20.4421 13.6065 20.4 13.7082 20.4 13.8143V17.1799L18.4 14.9799V7.75833C18.4 6.45033 17.336 5.38633 16.0272 5.38633L6.4 5.40593V3.35793C6.40042 2.94128 6.56607 2.5418 6.86061 2.24711C7.15516 1.95241 7.55455 1.78656 7.9712 1.78593L21.6276 1.81393H21.6284C22.0452 1.81435 22.4448 1.98011 22.7395 2.27482C23.0342 2.56954 23.2 2.96914 23.2004 3.38593L23.2 11.8427Z"
                                            fill="#073D71" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_11989_398">
                                            <rect width="24" height="24" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="text">
                                @isset($user->data['full_message'])
                                    <p>{{ $user->data['full_message'] }}</p>
                                @endisset

                                @isset($user->data['full_reply_message'])
                                    <p>{{ $user->data['full_reply_message'] }}</p>
                                @endisset

                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="dropdown profile-dropdown">
                <button class="dropdown-toggle bg-transparent border-0" type="button" id="profileDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar">
                        <div class="profile">
                            <img src="{{ asset(Auth::user()->avatar ?? 'uploads/users/jobaed-bhuiyan-1723955257.png') }}"
                                alt="image">

                        </div>
                        <p class="name">{{ ucwords(Auth::user()->name) }}</p>
                    </div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li>
                        <div class="author-info flex items-center !p-1">
                            <div class="image">
                                <img src="{{ asset(Auth::user()->avatar ?? 'uploads/users/jobaed-bhuiyan-1723955257.png') }}"
                                    alt="image">
                            </div>
                            <div class="content">
                                <h4>{{ ucwords(Auth::user()->name) }}</h4>
                                <span class="text-black/40 dark:text-white/40 text-xs m-0"
                                    style="
                                    margin-left: 11px;
                                    padding-left: 0px;">
                                    {{ Auth::user()->email }}
                                </span>
                            </div>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('pro.profile') }}"><i class="lni lni-user"></i> Profile</a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}"><i class="lni lni-user"></i> Home</a>
                    </li>
                    <li>
                        <a href="{{ route('settings') }}"><i class="lni lni-cog"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="lni lni-exit"></i> Sign Out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
