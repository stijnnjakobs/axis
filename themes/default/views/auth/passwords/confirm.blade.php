<x-app-layout>
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xs">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head">

                        <div class="nk-block-head-content text-center">
                            <h4 class="nk-block-title">{{ __('Confirm Password') }}</h4>
                            <div class="nk-block-des">
                                <p>{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <form method="POST" action="{{ route('password.confirm') }}" id="pw-confirm">
                                    @csrf

                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">{{ __('Password') }}</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" 
                                                   class="form-control form-control-lg" 
                                                   id="password"
                                                   name="password"
                                                   required 
                                                   autocomplete="current-password"
                                                   placeholder="{{ __('Enter your password') }}">
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <x-recaptcha form="pw-confirm" />

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary btn-block">
                                            {{ __('Confirm Password') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
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
</x-app-layout>
