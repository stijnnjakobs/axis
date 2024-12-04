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
                <h1 class="text-2xl font-semibold text-gray-900">Get started with {{ config('app.name', 'Paymenter') }}</h1>
                <p class="mt-2 text-sm text-gray-600">
                    Create your account to access all services in one place.
                </p>
            </div>

            @if (config('settings::registrationAbillity_disable') == 1)
                <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                REGISTRATION IS CURRENTLY DISABLED
                            </h3>
                        </div>
                    </div>
                </div>
            @else

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
                                There are some problems with your input
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

            <!-- Main Card -->
            <div class="space-y-6">
                <!-- Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    <!-- Personal Information -->
                    <div class="space-y-5">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">
                                    First name
                                </label>
                                <input
                                    type="text"
                                    name="first_name"
                                    class="w-full px-3 py-2 border @error('first_name') border-red-500 @enderror border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-600 transition-all outline-none"
                                    placeholder="John"
                                    value="{{ old('first_name') }}"
                                >
                                @error('first_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Last name
                                </label>
                                <input
                                    type="text"
                                    name="last_name"
                                    class="w-full px-3 py-2 border @error('last_name') border-red-500 @enderror border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-600 transition-all outline-none"
                                    placeholder="Doe"
                                    value="{{ old('last_name') }}"
                                >
                                @error('last_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="space-y-5">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                Email
                            </label>
                            <input
                                type="email"
                                name="email"
                                class="w-full px-3 py-2 border @error('email') border-red-500 @enderror border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-600 transition-all outline-none"
                                placeholder="john@example.com"
                                value="{{ old('email') }}"
                            >
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Account Security -->
                    <div class="space-y-5">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                Password
                            </label>
                            <input
                                type="password"
                                name="password"
                                class="w-full px-3 py-2 border @error('password') border-red-500 @enderror border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-600 transition-all outline-none"
                                placeholder="Create a strong password"
                            >
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Must be at least 8 characters long with 1 number and 1 special character</p>
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                                Confirm Password
                            </label>
                            <input
                                type="password"
                                name="password_confirmation"
                                class="w-full px-3 py-2 border @error('password_confirmation') border-red-500 @enderror border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-600 transition-all outline-none"
                                placeholder="Confirm Password"
                            >
                            @error('password_confirmation')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Terms and Privacy -->
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <input
                                type="checkbox"
                                id="terms"
                                name="terms"
                                class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                required
                            >
                            <label for="terms" class="ml-2 text-sm text-gray-600">
                                I agree to the <a href="#" class="text-blue-600 hover:text-blue-700">Terms of Service</a> and <a href="#" class="text-blue-600 hover:text-blue-700">Privacy Policy</a>
                            </label>
                        </div>
                        <div class="flex items-start">
                            <input
                                type="checkbox"
                                id="updates"
                                name="updates"
                                class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                            >
                            <label for="updates" class="ml-2 text-sm text-gray-600">
                                I want to receive product updates and newsletters
                            </label>
                        </div>
                    </div>

                    <x-recaptcha form="register" />

                    <button
                        type="submit"
                        class="w-full bg-blue-600 text-white py-2.5 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium"
                    >
                        Create account
                    </button>
                </form>

                <!-- Below Form -->
                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-700 ml-1">
                            Sign in
                        </a>
                    </p>
                </div>
            </div>
            @endif
        </div>

        <!-- Right side - Enhanced Banner -->
        <div class="hidden lg:block lg:w-[55%] bg-gray-900 relative overflow-hidden">
            <div class="h-full bg-gradient-to-br from-blue-900 to-blue-800 p-14 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-16 -mr-16 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -mb-16 -ml-16 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl"></div>

                <div class="relative">
                    <h2 class="text-3xl font-bold text-white mb-6 leading-tight max-w-sm">
                        One platform, endless possibilities
                    </h2>
                    <p class="text-gray-300 text-lg leading-relaxed mb-8">
                        From hosting services to support tickets, manage everything through a single, intuitive interface.
                    </p>

                    <!-- Feature List -->
                    <ul class="space-y-4 text-gray-300">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-400 mr-2"></i>
                            Centralized hosting management
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-400 mr-2"></i>
                            Unified support system
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-400 mr-2"></i>
                            Seamless service integration
                        </li>
                    </ul>

                    <!-- Copyright -->
                    <div class="text-gray-400 text-sm mt-8 space-y-1.5">
                        <p>Numblio Axis simplifies service management by providing a central hub for all your Numblio needs. Experience the power of unified control.</p>
                    </div>
                </div>

                <div class="relative mt-16">
                    <!-- Trust badges -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/10 rounded-lg p-4">
                            <div class="text-2xl font-bold text-white mb-1">Instant</div>
                            <div class="text-gray-300 text-sm">Access</div>
                        </div>
                        <div class="bg-white/10 rounded-lg p-4">
                            <div class="text-2xl font-bold text-white mb-1">Unified</div>
                            <div class="text-gray-300 text-sm">Control</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
