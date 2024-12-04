<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- Software build by https://paymenter.org -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">



    @if (config('settings::app_logo'))
        <link rel="icon" href="{{ asset(config('settings::app_logo')) }}" type="image/png">
    @else
        <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    @endif
    @empty($title)
        <title>{{ config('app.name', 'Paymenter') }}</title>
    @else
        <title>{{ config('app.name', 'Paymenter') . ' - ' . ucfirst($title) }}</title>
    @endempty






    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap">

    <!-- Your existing styles -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/dashlite.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/theme.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

    <meta content="{{ ucfirst($title) ?? config('settings::seo_title') }}" property="og:title">
    <meta content="{{ $description ?? config('settings::seo_description') }}" property="og:description">
    <meta content="{{ $description ?? config('settings::seo_description') }}" name="description">
    <meta content='{{ $image ?? config('settings::seo_image') }}' property='og:image'>

    <link type="application/json+oembed"
        href="{{ url('/') }}/manifest.json?title={{ config('app.name', 'Paymenter') }}&author_url={{ url('/') }}&author_name={{ config('app.name', 'Paymenter') }}" />
    <meta name="twitter:card" content="@if (config('settings::seo_twitter_card')) summary_large_image @endif">
    <meta name="theme-color" content="#5270FD">
</head>

<body class="nk-body npc-invest bg-lighter">

    <div id="app" class="nk-app-root">
        <div class="nk-wrap">

            @include('layouts.navigation')
            <div class="nk-content nk-content-lg nk-content-fluid">
                <!-- Page content -->
                {{ $slot }}
            </div>
            <x-footer />

        </div>
    </div>

    <script src="{{ asset('dashboard/assets/js/bundle.js?ver=3.2.4') }}"></script>
    <script src="{{ asset('dashboard/assets/js/scripts.js?ver=3.2.4') }}"></script>
    <script src="{{ asset('dashboard/assets/js/charts/chart-invest.js?ver=3.2.4') }}"></script>

</body>
</html>
