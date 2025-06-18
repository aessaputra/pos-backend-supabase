<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <!-- CSS files -->
    <link href="{{ asset('tabler/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('tabler/css/demo.css') }}" rel="stylesheet"/> --}} {{-- DIHAPUS/DIKOMENTARI --}}
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" d-flex flex-column">
    {{-- <script src="{{ asset('tabler/js/demo-theme.min.js') }}"></script> --}} {{-- DIHAPUS/DIKOMENTARI --}}
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark">
                    <img src="{{ asset('tabler/static/logo.svg') }}" height="36" alt="Tabler">
                </a>
            </div>
            @yield('content')
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('tabler/js/tabler.min.js') }}" defer></script>
    {{-- <script src="{{ asset('tabler/js/demo.min.js') }}" defer></script> --}} {{-- DIHAPUS/DIKOMENTARI --}}
</body>

</html>
