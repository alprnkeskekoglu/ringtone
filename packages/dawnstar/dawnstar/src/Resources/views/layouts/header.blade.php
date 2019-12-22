@php
    $sections = collect();
    $user_types = [];
@endphp

<aside id="side-overlay">
    <a class="content-header bg-body-dark justify-content-center text-danger" data-toggle="layout" data-action="side_overlay_close" href="javascript:void(0)">
        <i class="fa fa-2x fa-times-circle"></i>
    </a>
</aside>

<nav id="sidebar" aria-label="Main Navigation">
    <div class="smini-hidden">
        <div class="content-header justify-content-lg-center">
            <a class="link-fx font-size-lg text-dual" href="{!! route('panel.index') !!}">
                <span class="text-white-75">Dawnstar</span>
            </a>

            <div class="d-lg-none">
                <a class="text-white ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                    <i class="fa fa-times-circle"></i>
                </a>
            </div>
        </div>
    </div>


    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link" href="{!! route('panel.index') !!}">
                    <i class="nav-main-link-icon si si-bar-chart"></i>
                    <span class="nav-main-link-name">Dashboard</span>
                </a>
            </li>
            <li class="nav-main-heading">Manage</li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="{!! route('panel.index') !!}">
                    <i class="nav-main-link-icon si si-home"></i>
                    <span class="nav-main-link-name">Home</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="{!! route('panel.category.index') !!}">
                    <i class="nav-main-link-icon si si-tag"></i>
                    <span class="nav-main-link-name">Categories</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="{!! route('panel.ringtone.index') !!}">
                    <i class="nav-main-link-icon si si-question"></i>
                    <span class="nav-main-link-name">Ringtones</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="{!! route('panel.ringtone_transaction.index') !!}">
                    <i class="nav-main-link-icon si si-docs"></i>
                    <span class="nav-main-link-name">Ringtone Transactions</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="{!! route('panel.credit_transaction.index') !!}">
                    <i class="nav-main-link-icon si si-docs"></i>
                    <span class="nav-main-link-name">Credit Transactions</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="{!! route('panel.user.index') !!}">
                    <i class="nav-main-link-icon si si-users"></i>
                    <span class="nav-main-link-name">Users</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="{!! route('panel.report.index') !!}">
                    <i class="nav-main-link-icon si si-flag"></i>
                    <span class="nav-main-link-name">Reports</span>
                </a>
            </li>
            <li class="nav-main-heading">Settings</li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="{!! route('panel.logout_get') !!}">
                    <i class="nav-main-link-icon fa fa-sign-out-alt"></i>
                    <span class="nav-main-link-name">Logout</span>
                </a>
            </li>
            <li class="nav-main-item border mt-10">
                <a class="nav-main-link" href="{!! url()->previous() !!}">
                    <i class="nav-main-link-icon si si-arrow-left"></i>
                    <span class="nav-main-link-name">Go Back</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
