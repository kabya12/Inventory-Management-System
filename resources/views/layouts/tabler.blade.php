<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Inventory</title>

    <link rel="icon" type="image/ico" href="{{ asset('tscc.ico') }}">

    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-p+8r+qnX3I+McCrVlEAMJsoyPfNLWv+VdGq2+lnfRfBLN2vfwfjjzn0Zo5aA3y+00Hwxz+bwhcVq7qSdXc5zQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .form-control:focus {
            box-shadow: none;
        }

        .icon {
            color: rgb(3, 142, 202);
        }

        .card-body {
            background-color: #DDEFF5;
        }

        .custom-button {
            background-color: lightblue;
            border-radius: 0.5rem;
        }

        .custom-button:hover {
            background-color: #8fc5ff;
        }

        .nav-link:hover {
            color: #21c6dc;
        }

        .offcanvas-body {
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #DDEFF5 #ffffff;
        }

        .offcanvas-body::-webkit-scrollbar {
            width: 5px;
        }

        .offcanvas-body::-webkit-scrollbar-track {
            background: #ffffff;
        }

        .offcanvas-body::-webkit-scrollbar-thumb {
            background-color: #a4e8fd;
            border-radius: 5px;
            border: 2px solid #ffffff;
        }
    </style>

    {{-- - Page Styles - --}}
    @stack('page-styles')
    @livewireStyles
</head>

<body>
    <script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>

    <div class="page">
        <header class="navbar navbar-expand-md d-print-none" style="background-color: #00154D";>
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                    aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('static/tsc.png') }}" width="110" height="32" alt="tsc"
                            class="navbar-brand-image">
                    </a>
                </h1>

                <marquee behavior="scroll" direction="left" class="navbar-text"
                    style="margin-left: 50px; width: calc(80% - 50px); color: white;">For Any Support: +91 1234567890
                </marquee>


                <div class="navbar-nav flex-row order-md-last">
                    <div class="d-none d-md-flex">


                        <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                            </svg>
                        </a>
                        <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path
                                    d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                            </svg>
                        </a>


                        <div class="nav-item dropdown d-none d-md-flex me-3">
                            <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                                aria-label="Show notifications">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                                    <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                                </svg>

                                @if (auth()->user()->unreadNotifications->count() !== 0)
                                    <span class="badge bg-red"></span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">

                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Last updates</h3>
                                    </div>
                                    <div class="list-group list-group-flush list-group-hoverable">

                                        @foreach (auth()->user()->unreadNotifications as $notification)
                                            <a href="#" class="text-success">
                                                <li class="p-1 text-success"> {{ $notification->data['data'] }}</li>
                                            </a>
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-auto"><span
                                                            class="status-dot status-dot-animated bg-red d-block"></span>
                                                    </div>
                                                    <div class="col text-truncate"> <a href="#"
                                                            class="text-body d-block">Example 1</a>


                                                        <div class="col-auto">
                                                            <a href="#" class="list-group-item-actions">
                                                        </div>

                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon text-muted" width="24" height="24"
                                                            viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" style="color:white"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                                        </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <span class="dropdown-header"></span>
                                <a class="dropdown-item" href="#">
                                    Action
                                </a>
                                <a class="dropdown-item" href="#">
                                    Another action
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                            aria-label="Open user menu">

                            <span class="avatar avatar-sm shadow-none"
                                style="background-image: url('{{ Auth::user()->photo ? asset('storage/profile/' . Auth::user()->photo) : asset('assets/img/illustrations/profiles/') }}')">
                            </span>

                            <div class="d-none d-xl-block ps-2" style="color: white">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="mt-1 small text-muted">Admin</div>
                            </div>
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon dropdown-item-icon icon-tabler icon-tabler-settings" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                    </path>
                                    <path
                                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                                    </path>
                                    <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                </svg>
                                Account
                            </a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon dropdown-item-icon icon-tabler icon-tabler-logout" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                        <path d="M9 12h12l-3 -3" />
                                        <path d="M18 15l3 -3" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <header class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar">
                    <div class="container-xl">
                        <ul class="navbar-nav">
                            <li class="nav-item {{ request()->is('dashboard*') ? 'active' : null }}">
                                <a class="nav-link" href="{{ route('dashboard') }}">
                                    <span class="nav-link-title">
                                        {{ __('Dashboard') }}
                                    </span>
                                </a>
                            </li>


                            <li class="nav-item {{ request()->is('products*') ? 'active' : null }}">
                                <a class="nav-link" href="{{ route('products.index') }}">
                                    <span class="nav-link-title">
                                        {{ __('Products') }}
                                    </span>
                                </a>
                            </li>





                            <li class="nav-item dropdown {{ request()->is('purchases*') ? 'active' : null }}">
                                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">

                                    <span class="nav-link-title">
                                        {{ __('Purchases') }}
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        <div class="dropdown-menu-column">
                                            <a class="dropdown-item" href="{{ route('purchases.index') }}">
                                                {{ __('All') }}
                                            </a>
                                            <a class="dropdown-item"
                                                href="{{ route('purchases.approvedPurchases') }}">
                                                {{ __('Approval') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('purchases.purchaseReport') }}">
                                                {{ __('Daily Purchase Report') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>


                            <li class="nav-item dropdown {{ request()->is('sales*') ? 'active' : null }}">
                                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">

                                    <span class="nav-link-title">
                                        {{ __('Sale') }}
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        <div class="dropdown-menu-column">
                                            <a class="dropdown-item" href="{{ route('sale.index') }}">
                                                {{ __('All') }}
                                            </a>
                                            <a class="dropdown-item" href="">
                                                {{ __('Approval') }}
                                            </a>
                                            <a class="dropdown-item" href="">
                                                {{ __('Daily Sales Report') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>



                            <li class="nav-item {{ request()->is('quotations*') ? 'active' : null }}">
                                <a class="nav-link" href="{{ route('quotations.index') }}">

                                    <span class="nav-link-title">
                                        {{ __('Quotations') }}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('suppliers*') ? 'active' : null }}">
                                <a class="nav-link" href="{{ route('suppliers.index') }}">

                                    <span class="nav-link-title">
                                        {{ __('Suppliers') }}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('customers*') ? 'active' : null }}">
                                <a class="nav-link" href="{{ route('customers.index') }}">

                                    <span class="nav-link-title">
                                        {{ __('Customers') }}
                                    </span>
                                </a>
                            </li>


                            <li class="nav-item {{ request()->is('categories*') ? 'active' : null }}">
                                <a class="nav-link" href="{{ route('categories.index') }}">
                                    {{ __('Categories') }}
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('units*') ? 'active' : null }}">
                                <a class="nav-link" href="{{ route('units.index') }}">
                                    {{ __('Units') }}
                                </a>
                            </li>

                            <li class="nav-item {{ request()->is('users*') ? 'active' : null }}">
                                <a class="nav-link" href="{{ route('users.index') }}">
                                    {{ __('Users') }}
                                </a>
                            </li>


                            <li class="nav-item dropdown {{ request()->is('pos*') ? 'active' : null }}">
                                <a class="nav-link dropdown-toggle btn" href="#navbar-base" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" role="button" aria-expanded="false" style="background-color: rgb(4, 0, 83); color: white;">

                                <span class="nav-link-title">
                                    <i class="fas fa-shopping-bag"></i> <!-- Shopping bag icon -->
                                    {{ __('POS') }} <!-- Text for POS -->
                                </span>

                             </a>                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        <div class="dropdown-menu-column">
                                            <a class="dropdown-item" href="{{ route('orders.index') }}">
                                                {{ __('All') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('orders.complete') }}">
                                                {{ __('Completed') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('orders.pending') }}">
                                                {{ __('Pending') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('due.index') }}">
                                                {{ __('Due') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-wrapper">
            <div>
                @yield('content')
            </div>
            <div>
                @yield('contenti')
            </div>

            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">

                        <div class="col-12 col-lg-auto mt-3 mt-lg-0 d-flex justify-content-center"
                            style="margin: auto;">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; {{ now()->year }}
                                    <a href="." class="link-secondary">Tsc</a>.
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
    @stack('page-libraries')

    <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('dist/js/demo.min.js') }}" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    @stack('page-scripts')

    @livewireScripts
</body>

</html>
