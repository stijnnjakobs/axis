<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Paymenter') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#f9fafb] min-h-screen">
<!-- Main Content -->
<main class="min-h-screen flex">
    <!-- Left Side - Content -->
    <div class="flex-1 flex flex-col justify-between p-8 lg:p-16 xl:p-24">
        <!-- Logo -->
        <div>
            <img src="https://numblio.live/images/logo-dark.png" alt="Numblio" class="h-8 w-auto mb-16">
        </div>

        <!-- Main Content -->
        <div class="max-w-2xl">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl xl:text-6xl mb-8">
                Welcome to {{ config('app.name', 'Paymenter') }}
            </h1>
            <p class="text-xl text-gray-600 mb-12 leading-relaxed">
                Your central operations hub for everything Numblio. Sign in to access your services, manage resources, and more.
            </p>

            <!-- Action Buttons -->
            <div class="space-y-4 mb-16">
                <a href="{{ route('login') }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-all">
                    Sign in to continue
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

        </div>

        <!-- Footer -->
        <div class="text-sm text-gray-500">
            <p>&copy; 2024 {{ config('app.name', 'Paymenter') }}. All rights reserved.</p>
        </div>
    </div>

    <!-- Right Side - Banner -->
    <div class="hidden lg:block lg:w-[45%] relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900 to-blue-800">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 -mt-16 -mr-16 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-16 -ml-16 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl"></div>

            <!-- Content -->
            <div class="relative h-full p-16 flex flex-col justify-between">
                <!-- Stats -->
                <div class="grid grid-cols-2 gap-8">
                    <div class="bg-white/10 rounded-2xl p-6 backdrop-blur-sm">
                        <div class="text-3xl font-bold text-white mb-1">10M+</div>
                        <div class="text-blue-100">Active Users</div>
                    </div>
                    <div class="bg-white/10 rounded-2xl p-6 backdrop-blur-sm">
                        <div class="text-3xl font-bold text-white mb-1">24/7</div>
                        <div class="text-blue-100">Support</div>
                    </div>
                </div>

                <!-- Features List -->
                <div class="space-y-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check text-green-400"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-medium mb-1">Unified Control</h3>
                            <p class="text-blue-100 text-sm">Manage all your Numblio services from a single dashboard</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check text-green-400"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-medium mb-1">Enterprise Security</h3>
                            <p class="text-blue-100 text-sm">Industry-leading security protocols and compliance</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check text-green-400"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-medium mb-1">Real-time Analytics</h3>
                            <p class="text-blue-100 text-sm">Monitor performance and usage in real time</p>
                        </div>
                    </div>
                </div>

                <!-- Quote -->
                <blockquote class="border-l-2 border-blue-400 pl-4">
                    <p class="text-blue-100 italic mb-2">
                        "Numblio {{ config('app.name', 'Paymenter') }} has revolutionized how we manage our enterprise infrastructure."
                    </p>
                    <footer class="text-sm">
                        <p class="text-white font-medium">David Chen</p>
                        <p class="text-blue-200">CTO, TechCorp International</p>
                    </footer>
                </blockquote>
            </div>
        </div>
    </div>
</main>
</body>
</html>
