<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Two-Factor Authentication') }} | {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#f9fafb] min-h-screen flex flex-col">
    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center p-6">
        <div class="bg-white w-full max-w-xl rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Top Banner -->
            <div class="w-full bg-gradient-to-r from-blue-900 to-blue-800 p-8 relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-8 -mr-8 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl"></div>
                
                <div class="relative">
                    <h2 class="text-2xl font-bold text-white mb-2">{{ __('Two-Factor Authentication') }}</h2>
                    <p class="text-blue-100 text-sm leading-relaxed">
                        {{ __('Enter the verification code sent to your authentication app to continue.') }}
                    </p>

                    <!-- Copyright -->
                    <div class="text-blue-200/80 text-xs mt-4">
                        <p>{{ config('app.name') }} - {{ __('Your central hub for all services.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="p-8">
                <!-- Logo -->
                <img src="https://numblio.live/images/logo-dark.png" alt="Numblio" class="h-8 w-auto mb-8">


                <!-- Form -->
                <form method="POST" action="{{ route('tfa') }}" id="tfa" class="space-y-6">
                    @csrf
                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('Verification code') }}
                        </label>
                        <div class="grid grid-cols-6 gap-2">
                            @for ($i = 1; $i <= 6; $i++)
                                <input
                                    type="text"
                                    maxlength="1"
                                    class="w-full px-0 py-2 text-center border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-600 transition-all outline-none text-lg font-medium"
                                    autocomplete="off"
                                    data-position="{{ $i }}"
                                >
                            @endfor
                            <input type="hidden" name="code" id="hidden-code">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">{{ __('Enter the 6-digit code from your authenticator app') }}</p>
                    </div>

                    <x-recaptcha form="tfa" />

                    <div class="space-y-4">
                        <button type="submit" class="w-full bg-blue-600 text-white py-2.5 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                            {{ __('Verify code') }}
                        </button>

                        <a href="{{ route('login') }}" class="w-full bg-gray-50 text-gray-700 py-2.5 px-4 rounded-lg hover:bg-gray-100 transition-colors duration-200 font-medium border border-gray-200 flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2 text-sm"></i>
                            {{ __('Back to sign in') }}
                        </a>
                    </div>
                </form>

                <!-- Help Section -->
                <div class="mt-8 pt-6 border-t border-gray-100">
                    <p class="text-sm text-gray-600">
                        {{ __('Having trouble?') }} {{ __('Contact our support team at') }}
                        <a href="mailto:{{ config('settings::support_email', 'support@example.com') }}" class="text-blue-600 hover:text-blue-700">
                            {{ config('settings::support_email', 'support@example.com') }}
                        </a>
                    </p>
                </div>

                <!-- Security Notice -->
                <div class="mt-6 flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <i class="fas fa-shield-alt text-gray-400"></i>
                    </div>
                    <p class="text-xs text-gray-500">
                        {{ __('For security reasons, this code will expire in 5 minutes. If you need a new code, please use your authenticator app to generate one.') }}
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Bottom Links -->
    <footer class="py-4 text-center">
        <div class="space-x-4">
            <a href="#" class="text-sm text-gray-500 hover:text-gray-700">{{ __('Privacy Policy') }}</a>
            <a href="#" class="text-sm text-gray-500 hover:text-gray-700">{{ __('Terms of Service') }}</a>
            <a href="#" class="text-sm text-gray-500 hover:text-gray-700">{{ __('Contact') }}</a>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[type="text"]');
            const hiddenInput = document.getElementById('hidden-code');
            
            function updateHiddenInput() {
                hiddenInput.value = Array.from(inputs).map(input => input.value).join('');
            }
            
            inputs.forEach((input, index) => {
                input.addEventListener('input', function() {
                    if (this.value.length === 1) {
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        }
                        updateHiddenInput();
                    }
                });

                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && !this.value && index > 0) {
                        inputs[index - 1].focus();
                        updateHiddenInput();
                    }
                });

                // Prevent non-numeric input
                input.addEventListener('keypress', function(e) {
                    if (!/[0-9]/.test(e.key)) {
                        e.preventDefault();
                    }
                });
            });

            // Auto-focus first input
            inputs[0].focus();
        });
    </script>
</body>
</html>
