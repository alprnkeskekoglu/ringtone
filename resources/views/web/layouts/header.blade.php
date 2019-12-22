<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div>

            <a class="link-fx font-w600 font-size-lg text-white" href="{!! route('home') !!}">
                            <span class="smini-hidden">
                                <span class="text-white-75">N</span><span class="text-white">r</span>
                            </span>
                <span class="smini-hidden">
                                <span class="text-white">Natu</span><span class="text-white-75">ring</span>
                            </span>
            </a>
            <!-- Open Search Section -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <!-- END Open Search Section -->
        </div>
        <!-- END Left Section -->


        <!-- Right Section -->
        <div>
            <div class="d-inline-block align-items-center">
                <!-- Menu -->
                <ul class="nav-main nav-main-horizontal nav-main-hover">
                    <li class="nav-main-item">
                        <a class="nav-main-link" data-toggle="scroll-to" data-speed="750" href="{!! route('home') !!}">
                            <span class="nav-main-link-name">Home</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" data-toggle="scroll-to" data-speed="750"
                           href="{!! route('ringtone') !!}">
                            <span class="nav-main-link-name">Ringtones</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" data-toggle="scroll-to" data-speed="750"
                           href="{!! route('contact') !!}">
                            <span class="nav-main-link-name">Contact</span>
                        </a>
                    </li>
                    @if(auth()->check())
                        <li class="nav-main-item">
                            <a class="nav-main-link" data-toggle="scroll-to" data-speed="750"
                               href="{!! route('credit') !!}">
                                <span class="nav-main-link-name">Credit</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" data-toggle="scroll-to" data-speed="750"
                               href="{!! route('profile') !!}">
                                <span class="nav-main-link-name">Profile</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" data-toggle="scroll-to" data-speed="750"
                               href="{!! route('logout_get') !!}">
                                <span class="nav-main-link-name">Logout</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-main-item">
                            <a class="nav-main-link" data-toggle="scroll-to" data-speed="750"
                               href="{!! route('login') !!}">
                                <span class="nav-main-link-name">Login</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" data-toggle="scroll-to" data-speed="750"
                               href="{!! route('register') !!}">
                                <span class="nav-main-link-name">Register</span>
                            </a>
                        </li>
                    @endif
                </ul>
                <!-- END Menu -->
            </div>

            <!-- Notifications Dropdown -->
            <button type="button" class="btn btn-dual" data-toggle="layout" data-action="header_search_on">
                <i class="fa fa-fw fa-search"></i> <span class="ml-1 d-none d-sm-inline-block"></span>
            </button>
            @auth('web')
                @php
                    $cart = [];
                    $cart_ringtones = collect();
                    if(session()->get(auth()->id() . "_cart")) {
                        $cart = json_decode(decrypt(session()->get(auth()->id() . "_cart")), 1);
                        $cart_ringtones = \Dawnstar\Models\Ringtone::whereIn('id', $cart)
                            ->get();
                    }
                @endphp
                <div class="dropdown d-inline-block" id="cart">
                    @include('web.layouts.cart')
                </div>
            @endauth
        <!-- END Notifications Dropdown -->
        </div>
    </div>

    <!-- Header Search -->
    <div id="page-header-search" class="overlay-header bg-primary">
        <div class="content-header">
            <form class="w-100" action="{!! route('search') !!}" method="get">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-primary" data-toggle="layout"
                                data-action="header_search_off">
                            <i class="fa fa-fw fa-times-circle"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control border-0" placeholder="Search or hit ESC.."
                           id="page-header-search-input" name="q">
                </div>
            </form>
        </div>
    </div>
    <!-- END Header Search -->

    <!-- Header Loader -->
    <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-primary-darker">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>
