<!-- Enable 2FA Modal -->
@isset($secret)
    <div class="modal fade" id="tfa" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Two Factor Authentication') }}</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="nk-block">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h5 class="nk-block-title">{{ __('Scan QR Code') }}</h5>
                                <div class="nk-block-des">
                                    <p>{{ __('Scan the QR code below with your authenticator app. If you do not have an authenticator app, you can use the code below to manually enter it.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <img src="{{ $qr }}" alt="QR Code" class="mx-auto mb-3">
                            <div class="alert alert-pro alert-info">
                                <div class="alert-text">
                                    <h6 class="alert-heading">{{ __('Manual Entry Code') }}</h6>
                                    <p class="mb-0">{{ $secret }}</p>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('clients.profile.tfa') }}" class="mt-4">
                            @csrf
                            <input type="hidden" name="secret" value="{{ $secret }}">
                            <div class="form-group">
                                <label class="form-label" for="code">{{ __('Verification Code') }}</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="code" name="code" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="password">{{ __('Current Password') }}</label>
                                <div class="form-control-wrap">
                                    <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                    </a>
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary btn-block">
                                    {{ __('Enable Two-Factor Authentication') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <!-- Disable 2FA Modal -->
    <div class="modal fade" id="tfa" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Disable Two-Factor Authentication') }}</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="nk-block">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <div class="nk-block-des">
                                    <div class="alert alert-pro alert-warning">
                                        <div class="alert-text">
                                            <h6 class="alert-heading">{{ __('Warning') }}</h6>
                                            <p>{{ __('This will remove two-factor authentication from your account, making it more vulnerable to unauthorized access.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('clients.profile.tfa') }}">
                            @csrf
                            <input type="hidden" name="disable" value="true">
                            <div class="form-group">
                                <label class="form-label" for="password">{{ __('Current Password') }}</label>
                                <div class="form-control-wrap">
                                    <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                    </a>
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-danger btn-block">
                                    {{ __('Disable Two-Factor Authentication') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endisset

<script>
    // Password visibility toggle
    document.addEventListener('DOMContentLoaded', function() {
        const passcodeToggles = document.querySelectorAll('.passcode-switch');
        
        passcodeToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-target');
                const target = document.getElementById(targetId);
                
                if(target.type === 'password') {
                    target.type = 'text';
                    this.classList.add('is-shown');
                } else {
                    target.type = 'password';
                    this.classList.remove('is-shown');
                }
            });
        });
    });
</script> 