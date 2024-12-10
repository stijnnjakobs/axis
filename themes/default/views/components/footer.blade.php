<!-- footer @s -->
<div class="nk-footer nk-footer-fluid bg-lighter">
    <div class="container-xl wide-lg">
        <div class="nk-footer-wrap">
            <div class="nk-footer-copyright"> 
                &copy; 2024 Axis by Numblio.
            </div>
            <div class="nk-footer-links">
                <ul class="nav nav-sm">
                    <li class="nav-item">
                        <a href="{{ route('clients.tickets.create') }}" class="nav-link">
                            <em class="icon ni ni-help-alt"></em>
                            <span>{{ __('Support') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="https://status.numblio.com" target="_blank" class="nav-link">
                            <em class="icon ni ni-activity"></em>
                            <span>{{ __('System Status') }}</span>
                        </a>
                    </li>
                    <li class="nav-item ms-3">
                        <div class="dropup">
                            <a href="#" class="dropdown-toggle dropdown-indicator has-indicator nav-link" data-bs-toggle="dropdown">
                                <em class="icon ni ni-files"></em>
                                <span>{{ __('Legal') }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                <ul class="link-list-plain">
                                    <li><a href="https://numblio.com/documents/terms">{{ __('Terms of Service') }}</a></li>
                                    <li><a href="https://numblio.com/documents/privacy">{{ __('Privacy Policy') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="nk-footer-info text-center text-soft fs-12px mt-2">
            {{ __('Registered at the Dutch Chamber of Commerce - KVK: 95732888') }}
        </div>
    </div>
</div>
<!-- footer @e -->

<style>
.nk-footer-fluid {
    border-top: 1px solid #e5e9f2;
}
.nk-footer .nav-link {
    padding: 0.25rem 0.75rem;
    font-size: 0.8125rem;
}
.nk-footer .nav-link .icon {
    font-size: 1rem;
    margin-right: 0.25rem;
}
.language-flag {
    width: 20px;
    height: 15px;
    margin-right: 0.5rem;
}
.nk-footer-info {
    padding-top: 0.75rem;
    border-top: 1px solid #e5e9f2;
}
</style>
