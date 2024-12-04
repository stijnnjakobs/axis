<x-app-layout title="{{ __('Edit profile') }}" clients>
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <x-success />

                    <!-- Header -->
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{{ __('Profile Settings') }}</h3>
                                <div class="nk-block-des text-soft">
                                    <p>{{ __('Manage your account settings and preferences') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-aside-wrap">
                                <!-- Profile Menu -->
                                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg">
                                    <div class="card-inner-group">
                                        <div class="card-inner">
                                            <div class="user-card">
                                                <div class="user-avatar bg-primary">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{{ Auth::user()->name }}</span>
                                                    <span class="sub-text">{{ Auth::user()->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-inner p-0">
                                            <ul class="link-list-menu">
                                                <li>
                                                    <a class="active" href="{{ route('clients.profile') }}">
                                                        <em class="icon ni ni-user-fill-c"></em>
                                                        <span>{{ __('My Details') }}</span>
                                                    </a>
                                                </li>
                                                @if(config('settings::credits'))
                                                    <li>
                                                        <a href="{{ route('clients.credits') }}">
                                                            <em class="icon ni ni-wallet-fill"></em>
                                                            <span>{{ __('Credits') }}</span>
                                                        </a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <a href="{{ route('clients.api.index') }}">
                                                        <em class="icon ni ni-shield-star-fill"></em>
                                                        <span>{{ __('Account API') }}</span>
                                                    </a>
                                                </li>
                                                @if(config('settings::affiliate'))
                                                    <li>
                                                        <a href="{{ route('clients.affiliate') }}">
                                                            <em class="icon ni ni-users-fill"></em>
                                                            <span>{{ __('Affiliate') }}</span>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Profile Content -->
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title">{{ __('Personal Information') }}</h4>
                                            <div class="nk-block-des">
                                                <p>{{ __('Basic info, like your name and address') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Personal Info Form -->
                                    <div class="nk-block">
                                        <div class="nk-data data-list">
                                            <form method="POST" action="{{ route('clients.profile.update') }}">
                                                @csrf
                                                <div class="row g-4">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label">{{ __('First Name') }}</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" name="first_name" value="{{ Auth::user()->first_name }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label">{{ __('Last Name') }}</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" name="last_name" value="{{ Auth::user()->last_name }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label">{{ __('Address') }}</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}" {{ config('settings::requiredClientDetails_address') == 1 ? 'required' : '' }}>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label">{{ __('City') }}</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" name="city" value="{{ Auth::user()->city }}" {{ config('settings::requiredClientDetails_city') == 1 ? 'required' : '' }}>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label">{{ __('Zip Code') }}</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" name="zip" value="{{ Auth::user()->zip }}" {{ config('settings::requiredClientDetails_zip') == 1 ? 'required' : '' }}>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label">{{ __('Country') }}</label>
                                                            <div class="form-control-wrap">
                                                                <select class="form-select" name="country" {{ config('settings::requiredClientDetails_country') == 1 ? 'required' : '' }}>
                                                                    @if(!config('settings::requiredClientDetails_country') == 1)
                                                                        <option value="">{{ __('Select a country') }}</option>
                                                                    @endif
                                                                    @foreach (App\Classes\Constants::countries() as $key => $country)
                                                                        <option value="{{ $key }}" @if (Auth::user()->country == $key) selected @endif>
                                                                            {{ $country }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label">{{ __('Phone') }}</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}" {{ config('settings::requiredClientDetails_phone') == 1 ? 'required' : '' }}>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary">{{ __('Update Profile') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Security Settings -->
                                    <div class="nk-block-head">
                                        <div class="nk-block-between-md g-4">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">{{ __('Security Settings') }}</h4>
                                                <div class="nk-block-des">
                                                    <p>{{ __('These settings help keep your account secure') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 2FA Settings -->
                                    <div class="card card-bordered">
                                        <div class="card-inner-group">
                                            <div class="card-inner">
                                                <div class="between-center flex-wrap g-3">
                                                    <div class="nk-block-text">
                                                        <h6>{{ __('Two-Factor Authentication') }}</h6>
                                                        <p>{{ __('Add an extra layer of security to your account') }}</p>
                                                    </div>
                                                    <div class="nk-block-actions">
                                                        @isset($secret)
                                                            <button data-bs-toggle="modal" data-bs-target="#tfa" class="btn btn-primary">
                                                                {{ __('Enable 2FA') }}
                                                            </button>
                                                        @else
                                                            <button data-bs-toggle="modal" data-bs-target="#tfa" class="btn btn-danger">
                                                                {{ __('Disable 2FA') }}
                                                            </button>
                                                        @endisset
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<br>
                                    <!-- Browser Sessions -->
                                    <div class="card card-bordered">
                                        <div class="card-inner-group">
                                            <div class="card-inner">
                                                <div class="between-center flex-wrap g-3">
                                                    <div class="nk-block-text">
                                                        <h6>{{ __('Browser Sessions') }}</h6>
                                                        <p>{{ __('Manage your active sessions') }}</p>
                                                    </div>
                                                    <div class="nk-block-actions">
                                                        <form action="{{ route('clients.profile.sessions') }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-dim btn-danger">
                                                                {{ __('Logout Other Sessions') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            @foreach (Auth::user()->sessions as $session)
                                                <div class="card-inner">
                                                    <div class="between-center flex-wrap g-3">
                                                        <div class="nk-block-text">
                                                            <div class="d-flex align-items-center">
                                                                <div class="user-avatar sm bg-light">
                                                                    @if($session->is_mobile)
                                                                        <em class="icon ni ni-mobile"></em>
                                                                    @else
                                                                        <em class="icon ni ni-monitor"></em>
                                                                    @endif
                                                                </div>
                                                                <div class="ms-3">
                                                                    <h6 class="mb-0">{{ $session->formatted_device }}</h6>
                                                                    <span class="sub-text">
                                                                        {{ $session->ip_address }}
                                                                        @if($session->is_current_device)
                                                                            <span class="badge badge-dim bg-success">{{ __('This device') }}</span>
                                                                        @else
                                                                            - {{ $session->formatted_last_active }}
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include 2FA Modals -->
    @include('clients.profile.partials.2fa-modals')
</x-app-layout>
