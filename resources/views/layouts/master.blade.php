<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('tabler/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    @stack('css')
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

<body>
    <div class="page">
        <!-- Sidebar -->
        @include('layouts.partials.navbar')

        <!-- Header -->
        @include('layouts.partials.header')

        <div class="page-wrapper">
            <!-- Page header -->
            @yield('page-header')

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    @yield('content')
                </div>
            </div>

            <!-- Footer -->
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="https://tabler.io/docs" target="_blank"
                                        class="link-secondary" rel="noopener">Documentation</a></li>
                                <li class="list-inline-item"><a href="https://github.com/sponsors/codecalm"
                                        target="_blank" class="link-secondary" rel="noopener">Sponsor</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; {{ date('Y') }}
                                    <a href="." class="link-secondary">{{ config('app.name', 'Laravel') }}</a>.
                                    All rights reserved.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Libs JS -->
    <script src="{{ asset('tabler/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
    <!-- Tabler Core -->
    <script src="{{ asset('tabler/js/tabler.min.js') }}" defer></script>

    {{-- SWAL --}}
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    @include('sweetalert::alert')

    @stack('js')
</body>

</html>
