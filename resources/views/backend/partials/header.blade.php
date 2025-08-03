@php
    use Carbon\Carbon;
    $userDetails = null;
    if (auth()->check()) {
        $userDetails = \App\Models\UserDetail::where('user_id', auth()->id())->first();
        $notificationsAdmin = auth()->user()->notifications;
        $unreadNotificationsCount = auth()->user()->unreadNotifications->count();
    }
@endphp
<style>
    .notification-box {
        position: relative;
    }

    .notification-box .badge {}

    .header .header-right button span {
        position: absolute;
        width: 20px;
        height: 18px;
        background: #ff0014;
        border: 2px solid #fff;
        border-radius: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        top: -4px;
        right: -4px;
        font-size: 10px;
    }
</style>

<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
                <div class="header-left d-flex align-items-center">
                    <div class="menu-toggle-btn mr-15">
                        <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                            <i class="lni lni-chevron-left me-2"></i> Menu
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
                <div class="header-right">

                    <div class="notification-box ml-15 d-none d-md-flex">
                        <button class="dropdown-toggle" type="button" id="notification" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11 20.1667C9.88317 20.1667 8.88718 19.63 8.23901 18.7917H13.761C13.113 19.63 12.1169 20.1667 11 20.1667Z"
                                    fill />
                                <path
                                    d="M10.1157 2.74999C10.1157 2.24374 10.5117 1.83333 11 1.83333C11.4883 1.83333 11.8842 2.24374 11.8842 2.74999V2.82604C14.3932 3.26245 16.3051 5.52474 16.3051 8.24999V14.287C16.3051 14.5301 16.3982 14.7633 16.564 14.9352L18.2029 16.6342C18.4814 16.9229 18.2842 17.4167 17.8903 17.4167H4.10961C3.71574 17.4167 3.5185 16.9229 3.797 16.6342L5.43589 14.9352C5.6017 14.7633 5.69485 14.5301 5.69485 14.287V8.24999C5.69485 5.52474 7.60672 3.26245 10.1157 2.82604V2.74999Z"
                                    fill />
                            </svg>

                            <span class="badge">{{ $unreadNotificationsCount }}</span>

                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notification">
                            @foreach ($notificationsAdmin as $notification)
                                <li>
                                    <a href="#0">
                                        <div class="image">
                                            <img src="assets/images/lead/lead-6.png" alt />
                                        </div>
                                        <div class="content">
                                            <h6>
                                                @isset($notification->data['full_message'])
                                                    <p>{{ $notification->data['full_message'] }}</p>
                                                @endisset

                                                @isset($notification->data['full_reply_message'])
                                                    <p>{{ $notification->data['full_reply_message'] }}</p>
                                                @endisset

                                                @isset($notification->data['message'])
                                                    <p>{{ $notification->data['message'] }}</p>
                                                @endisset
                                            </h6>
                                            <span>{{ Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    {{-- notification end --}}

                    <div class="profile-box ml-15">
                        <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="profile-info">
                                <div class="info">
                                    <div class="image">
                                        @if ($userDetails && $userDetails->profile_picture)
                                            <img src="{{ asset($userDetails->profile_picture) }}" alt="image">
                                        @else
                                            <img src="{{ asset('frontend/images/profile.png') }}"
                                                alt="{{ asset('backend/images/profile/profile-image.png') }}">
                                        @endif
                                    </div>
                                    <div>
                                        <h6 class="fw-500">{{ Auth::user()->name }}</h6>
                                        <p>Admin</p>
                                    </div>
                                </div>
                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                            <li>
                                <div class="author-info flex items-center !p-1">
                                    <div class="image">
                                        @if ($userDetails && $userDetails->profile_picture)
                                            <img src="{{ asset($userDetails->profile_picture) }}" alt="image">
                                        @else
                                            <img src="{{ asset('frontend/images/profile.png') }}"
                                                alt="{{ asset('backend/images/profile/profile-image.png') }}">
                                        @endif
                                    </div>
                                    <div class="content">
                                        <h4 class="text-sm">{{ Auth::user()->name }}</h4>
                                        <a class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white text-xs"
                                            href="{{ route('admin-dashboard') }}">{{ Auth::user()->email }}</a>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('profile.setting') }}"><i class="lni lni-user"></i> Profile </a>
                            </li>

                            <li>
                                <a href="{{ route('home') }}"><i class="lni lni-home"></i> Home </a>
                            </li>

                            <li>
                                <a href="{{ route('system.index') }}"> <i class="lni lni-cog"></i> Settings </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="lni lni-exit"></i> Sign Out </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
