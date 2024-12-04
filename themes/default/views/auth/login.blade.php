<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Paymenter') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#f9fafb] min-h-screen flex flex-col">
<!-- Main Content -->
<main class="flex-grow flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-6xl rounded-xl shadow-sm border border-gray-200 flex overflow-hidden">
        <!-- Left side - Form -->
        <div class="w-full lg:w-[45%] p-12">
            <!-- Logo -->
            <img src="https://numblio.live/images/logo-dark.png" alt="Numblio" class="h-8 w-auto mb-12">

            <!-- Welcome Text -->
            <div class="mb-10">
                <h1 class="text-2xl font-semibold text-gray-900">{{ __('Welcome back to') }} {{ config('app.name', 'Paymenter') }}</h1>
                <p class="mt-2 text-sm text-gray-600">
                    {{ __('Sign in to access your central operations hub.') }}
                </p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                {{ __('Unable to sign in') }}
                            </h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Success message -->
            @if (session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Main Card -->
            <div class="space-y-6">
                <!-- Social Login Buttons -->
                @if (config('settings::discord_enabled') == 1 ||
                    config('settings::apple_enabled') == 1 ||
                    config('settings::google_enabled') == 1 ||
                    config('settings::github_enabled') == 1)
                    <div class="space-y-3">
                        @if (config('settings::github_enabled'))
                            <a href="{{ route('social.login', 'github') }}" 
                               class="w-full flex items-center justify-center px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors group">
                                <i class="fab fa-github text-xl mr-3"></i>
                                <span class="text-gray-700 text-sm font-medium group-hover:text-gray-900">{{ __('Continue with GitHub') }}</span>
                            </a>
                        @endif
                        @if (config('settings::google_enabled'))
                            <a href="{{ route('social.login', 'google') }}"
                               class="w-full flex items-center justify-center px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors group">
                                <i class="fab fa-google text-xl mr-3"></i>
                                <span class="text-gray-700 text-sm font-medium group-hover:text-gray-900">{{ __('Continue with Google') }}</span>
                            </a>
                        @endif
                    </div>

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">{{ __('or continue with email') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" id="login" class="space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('Email address') }}
                        </label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="w-full px-3 py-2 border @error('email') border-red-500 @enderror border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-600 transition-all outline-none"
                            placeholder="{{ __('name@company.com') }}"
                            value="{{ old('email') }}"
                            required
                        >
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('Password') }}
                        </label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="w-full px-3 py-2 border @error('password') border-red-500 @enderror border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-600 transition-all outline-none"
                            placeholder="{{ __('Enter your password') }}"
                            required
                        >
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                id="remember"
                                name="remember"
                                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                            >
                            <label for="remember" class="ml-2 text-sm text-gray-600">
                                {{ __('Stay signed in') }}
                            </label>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">
                            {{ __('Forgot password?') }}
                        </a>
                    </div>

                    <x-recaptcha form="login" />

                    <button
                        type="submit"
                        class="w-full bg-blue-600 text-white py-2.5 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium"
                    >
                        {{ __('Sign in') }}
                    </button>
                </form>

                <!-- Below Form -->
                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">
                        {{ __('New to') }} {{ config('app.name', 'Paymenter') }}?
                        <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-700 ml-1">
                            {{ __('Create an account') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Right side - Enhanced Banner -->
        <div class="hidden lg:block lg:w-[55%] bg-gray-900 relative overflow-hidden">
            <div class="h-full bg-gradient-to-br from-blue-900 to-blue-800 p-14 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-16 -mr-16 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -mb-16 -ml-16 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl"></div>

                <div class="relative">
                    <h2 class="text-3xl font-bold text-white mb-6 leading-tight max-w-sm">
                        Your central hub for everything Numblio
                    </h2>
                    <p class="text-gray-300 text-lg leading-relaxed mb-8">
                        Manage all your Numblio services in one place - from hosting to support, everything at your fingertips.
                    </p>

                    <!-- Testimonial -->
                    <blockquote class="mt-8 border-l-2 border-green-500 pl-4">
                        <p class="text-gray-300 italic">"Numblio Axis has transformed how we manage our services. Everything we need is just a click away."</p>
                        <footer class="mt-2">
                            <p class="text-white font-medium">Damiën Hiersteiner</p>
                            <p class="text-gray-400 text-sm">Product Manager, Numblio Axis</p>
                        </footer>
                    </blockquote>

                    <!-- Copyright -->
                    <div class="text-gray-400 text-sm mt-8 space-y-1.5">
                        <p>Numblio Axis is the central operations hub for all Numblio services. Access and manage your hosting services, support tickets, and software solutions all in one place.</p>
                    </div>
                </div>

                <div class="relative mt-16">
                    <!-- Trust badges -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/10 rounded-lg p-4">
                            <div class="text-2xl font-bold text-white mb-1">24/7</div>
                            <div class="text-gray-300 text-sm">Support Access</div>
                        </div>
                        <div class="bg-white/10 rounded-lg p-4">
                            <div class="text-2xl font-bold text-white mb-1">100K+</div>
                            <div class="text-gray-300 text-sm">Active Users</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    </div>
</main>
</body>
</html>