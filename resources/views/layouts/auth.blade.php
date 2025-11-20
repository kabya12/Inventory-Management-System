<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <meta name="msapplication-TileColor" content="#0054a6" />
    <meta name="theme-color" content="#0054a6" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <link rel="icon" href="{{ asset('tsc.png') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('tsc.png') }}" type="image/x-icon" />
    <meta name="description"
        content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!" />
    <meta name="canonical" content="https://tabler.io/demo/sign-in.html">
    <meta name="twitter:image:src" content="https://tabler.io/demo/static/og.png">
    <meta name="twitter:site" content="@tabler_ui">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title"
        content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI.">
    <meta name="twitter:description"
        content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!">
    <meta property="og:image" content="https://tabler.io/demo/static/og.png">
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="640">
    <meta property="og:site_name" content="Tabler">
    <meta property="og:type" content="object">
    <meta property="og:title"
        content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI.">
    <meta property="og:url" content="https://tabler.io/demo/static/og.png">
    <meta property="og:description"
        content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!">
    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
            background-image: url('https://img.freepik.com/premium-photo/print-minimalist-3d-rendering-blue-purple-blue-navy-blue-darker-abstract-wallpaper_551880-788.jpg?w=900');
            background-size: cover;
        }

        .card-body {
            background-image: url('https://img.freepik.com/free-vector/hand-painted-abstract-blue-wallpaper-watercolor_23-2149106510.jpg?t=st=1708984218~exp=1708987818~hmac=2c871821516ba0441b52dc47f7f8bd7393e27129ea4e12a13212c0f7df67c2de&w=826');
        }

    </style>
    @stack('page-styles')
</head>

<body class="d-flex flex-column">
    <script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>

    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="{{ url('/') }}" class="navbar-brand navbar-brand-autodark">
                    <img src="{{ asset('static/tsc.png') }}" width="110" height="32" alt="Tabler"
                        class="navbar-brand-image">
                </a>
            </div>

            @include('components.alert')

            @if (session('status'))
                <div class="alert alert-info alert-dismissible" role="alert">
                    <h3 class="mb-1">Success</h3>
                    <p>{{ session('status') }}</p>

                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('dist/js/demo.min.js') }}" defer></script>
    @stack('page-scripts')
</body>

</html>
