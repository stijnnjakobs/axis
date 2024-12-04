<!-- main header @s -->
<div class="nk-header nk-header-fluid nk-header-fixed is-theme">
    <div class="container-xl wide-lg">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger me-sm-2 d-lg-none">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand">
                <a href="" class="logo-link">
                    <img class="logo-light logo-img" src="https://numblio.live/images/axis/light.png" srcset="https://numblio.live/images/axis/light.png" alt="logo">
                    <img class="logo-dark logo-img" src="https://numblio.live/images/axis/dark.png" srcset="https://numblio.live/images/axis/dark.png" alt="logo-dark">
                </a>
            </div><!-- .nk-header-brand -->
            <div class="nk-header-menu" data-content="headerNav">
                <div class="nk-header-mobile">
                    <div class="nk-header-brand">
                        <a href="" class="logo-link">
                            <img class="logo-light logo-img" src="https://numblio.live/images/axis/light.png" srcset="https://numblio.live/images/axis/light.png" alt="logo">
                            <img class="logo-dark logo-img" src="https://numblio.live/images/axis/dark.png" srcset="https://numblio.live/images/axis/dark.png" alt="logo-dark">
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div>
                <ul class="nk-menu nk-menu-main ui-s2">
                    <li class="nk-menu-item">
                        <a href="{{ route('clients.home') }}" class="nk-menu-link">
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{ route('services.index') }}" class="nk-menu-link">
                            <span class="nk-menu-text">Services</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{ route('clients.invoice.index') }}" class="nk-menu-link">
                            <span class="nk-menu-text">Invoices</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="/tickets" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-text">Support</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('clients.tickets.index') }}" class="nk-menu-link"><span class="nk-menu-text">Tickets</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link"><span class="nk-menu-text">Discord</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->

                </ul><!-- .nk-menu -->
            </div><!-- .nk-header-menu -->
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown notification-dropdown">
                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                            <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end dropdown-menu-s1">
                            <div class="dropdown-head">
                                <span class="sub-title nk-dropdown-title">Notifications</span>
                                <a href="#">Mark All as Read</a>
                            </div>
                            <div class="dropdown-body">
                                <div class="nk-notification">
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                            <div class="nk-notification-time">2 hrs ago</div>
                                        </div>
                                    </div>
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                            <div class="nk-notification-time">2 hrs ago</div>
                                        </div>
                                    </div>
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                            <div class="nk-notification-time">2 hrs ago</div>
                                        </div>
                                    </div>
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                            <div class="nk-notification-time">2 hrs ago</div>
                                        </div>
                                    </div>
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                            <div class="nk-notification-time">2 hrs ago</div>
                                        </div>
                                    </div>
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                            <div class="nk-notification-time">2 hrs ago</div>
                                        </div>
                                    </div>
                                </div><!-- .nk-notification -->
                            </div><!-- .nk-dropdown-body -->
                            <div class="dropdown-foot center">
                                <a href="#">View All</a>
                            </div>
                        </div>
                    </li><!-- .dropdown -->
                    <li class="dropdown user-dropdown order-sm-first">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                    <img alt="User Avatar" src="https://www.gravatar.com/avatar/{{md5(Auth::user()->email)}}?s=200&d=mp" />
                                </div>
                                <div class="user-info d-none d-xl-block">
                                    <div class="user-status">{{ auth()->user()->email }}</div>
                                    <div class="user-name dropdown-indicator">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1 is-light">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <img alt="User Avatar" src="https://www.gravatar.com/avatar/{{md5(Auth::user()->email)}}?s=200&d=mp" />
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
                                        <span class="sub-text">{{ auth()->user()->email }}</span>
                                    </div>
                                    <div class="user-action">
                                        <a class="btn btn-icon me-n2" href=""><em class="icon ni ni-setting"></em></a>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner user-account-info">
                                <h6 class="overline-title-alt">Account Balance</h6>
                                <div class="user-balance"><x-money :amount="Auth::user()->credits" /> <small class="currency currency-usd">USD</small></div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="{{ route('clients.profile') }}"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                    @if (Auth::user()->has('ADMINISTRATOR'))
                                    <li><a href="{{ route('clients.api.index') }}"><em class="icon ni ni-setting-alt"></em><span>API Keys</span></a></li>
                                    <li><a href="{{ route('admin.index') }}"><em class="icon ni ni-activity-alt"></em><span>Admin</span></a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="{{ route('logout') }}"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li><!-- .dropdown -->
                    <li class="dropdown language-dropdown d-none d-sm-flex me-n1">
                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                            <div class="quick-icon">
                                <img class="icon" src="./images/flags/english-sq.png" alt="">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-s1">
                            <ul class="language-list">
                                <li>
                                    <a href="#" class="language-item">
                                        <img src="./images/flags/english.png" alt="" class="language-flag">
                                        <span class="language-name">English</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item">
                                        <img src="./images/flags/spanish.png" alt="" class="language-flag">
                                        <span class="language-name">Español</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item">
                                        <img src="./images/flags/french.png" alt="" class="language-flag">
                                        <span class="language-name">Français</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item">
                                        <img src="./images/flags/turkey.png" alt="" class="language-flag">
                                        <span class="language-name">Türkçe</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li><!-- .dropdown -->
                </ul><!-- .nk-quick-nav -->
            </div><!-- .nk-header-tools -->
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
<!-- main header @e -->
