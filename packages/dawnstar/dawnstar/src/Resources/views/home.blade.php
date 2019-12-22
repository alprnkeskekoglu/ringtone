@extends('Dawnstar::layouts.app')
@php
    $ringtone_transaction_stats = ringtoneTransactionStats();
    $credit_transaction_stats = creditTransactionStats();
    $user_stats = userStats();
@endphp
@section('content')
    <main id="main-container">
        <div class="bg-body-dark">
            <div class="content">
                <div class="row gutters-tiny push invisible" data-toggle="appear">

                    <div class="col-6 col-md-4 col-xl-2">
                        <a class="block text-center bg-image" style="background-image: url('{!! asset("vendor/dawnstar/media/photos/photo15.jpg") !!}');" href="{!! route('panel.index') !!}">
                            <div class="block-content block-content-full bg-gd-fruit-op aspect-ratio-16-9 d-flex justify-content-center align-items-center">
                                <div>
                                    <i class="fa fa-2x fa-home text-white"></i>
                                    <div class="font-w600 mt-3 text-uppercase text-white">Home</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-6 col-md-4 col-xl-2">
                        <a class="block text-center bg-image" style="background-image: url('{!! asset("vendor/dawnstar/media/photos/photo20.jpg") !!}');" href="{!! route('panel.category.index') !!}">
                            <div class="block-content block-content-full bg-gd-sublime-op aspect-ratio-16-9 d-flex justify-content-center align-items-center">
                                <div>
                                    <i class="fa fa-2x fa-tag text-white"></i>
                                    <div class="font-w600 mt-3 text-uppercase text-white">Categories</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-xl-2">
                        <a class="block text-center bg-image" style="background-image: url('{!! asset("vendor/dawnstar/media/photos/photo16.jpg") !!}');" href="{!! route('panel.ringtone.index') !!}">
                            <div class="block-content block-content-full bg-gd-lake-op aspect-ratio-16-9 d-flex justify-content-center align-items-center">
                                <div>
                                    <i class="fa fa-2x fa-question text-white"></i>
                                    <div class="font-w600 mt-3 text-uppercase text-white">Ringtones</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-xl-2">
                        <a class="block text-center bg-image" style="background-image: url('{!! asset("vendor/dawnstar/media/photos/photo19.jpg") !!}');" href="{!! route('panel.ringtone_transaction.index') !!}">
                            <div class="block-content block-content-full bg-gd-sea-op aspect-ratio-16-9 d-flex justify-content-center align-items-center">
                                <div>
                                    <i class="fa fa-2x fa-reply text-white"></i>
                                    <div class="font-w600 mt-3 text-uppercase text-white">Ringtone Transactions</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-xl-2">
                        <a class="block text-center bg-image" style="background-image: url('{!! asset("vendor/dawnstar/media/photos/photo17.jpg") !!}');" href="{!! route('panel.report.index') !!}">
                            <div class="block-content block-content-full bg-gd-leaf-op aspect-ratio-16-9 d-flex justify-content-center align-items-center">
                                <div>
                                    <i class="fa fa-2x fa-comment-dots text-white"></i>
                                    <div class="font-w600 mt-3 text-uppercase text-white">Reports</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-xl-2">
                        <a class="block text-center bg-image" style="background-image: url('{!! asset("vendor/dawnstar/media/photos/photo18.jpg") !!}');" href="{!! route('panel.user.index') !!}">
                            <div class="block-content block-content-full bg-xdream-dark-op aspect-ratio-16-9 d-flex justify-content-center align-items-center">
                                <div>
                                    <i class="fas fa-2x fa-users text-white"></i>
                                    <div class="font-w600 mt-3 text-uppercase text-white">Users</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="row invisible" data-toggle="appear">
                <div class="col-md-4">
                    <div class="block" href="javascript:void(0)">
                        <div class="block-content block-content-full bg-white-90 overflow-hidden">
                            <div class="py-3">
                                <span class="js-sparkline" data-type="line"
                                      data-points="[{!! $user_stats !!}]"
                                      data-width="100%"
                                      data-height="200px"
                                      data-line-color="#6a82fb"
                                      data-fill-color="transparent"
                                      data-spot-color="transparent"
                                      data-min-spot-color="transparent"
                                      data-max-spot-color="transparent"
                                      data-highlight-spot-color="#6a82fb"
                                      data-highlight-line-color="#6a82fb"
                                      data-tooltip-suffix="User"></span>
                            </div>
                        </div>
                        <div class="block-content block-content-full d-flex align-items-end justify-content-between bg-body-light">
                            <div>
                                <i class="fa fa-2x fa-file-alt text-muted"></i>
                                <span>User Statistics</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="block" href="javascript:void(0)">
                        <div class="block-content block-content-full bg-white-90 overflow-hidden">
                            <div class="py-3">
                                <span class="js-sparkline" data-type="line"
                                      data-points="[{!! $ringtone_transaction_stats !!}]"
                                      data-width="100%"
                                      data-height="200px"
                                      data-line-color="#6a82fb"
                                      data-fill-color="transparent"
                                      data-spot-color="transparent"
                                      data-min-spot-color="transparent"
                                      data-max-spot-color="transparent"
                                      data-highlight-spot-color="#6a82fb"
                                      data-highlight-line-color="#6a82fb"
                                      data-tooltip-suffix="Ringtone"></span>
                            </div>
                        </div>
                        <div class="block-content block-content-full d-flex align-items-end justify-content-between bg-body-light">
                            <div>
                                <i class="fa fa-2x fa-file-alt text-muted"></i>
                                <span>Ringtone Purchased Statistics</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="block" href="javascript:void(0)">
                        <div class="block-content block-content-full bg-white-90 overflow-hidden">
                            <div class="py-3">
                                <span class="js-sparkline" data-type="line"
                                      data-points="[{!! $credit_transaction_stats !!}]"
                                      data-width="100%"
                                      data-height="200px"
                                      data-line-color="#6a82fb"
                                      data-fill-color="transparent"
                                      data-spot-color="transparent"
                                      data-min-spot-color="transparent"
                                      data-max-spot-color="transparent"
                                      data-highlight-spot-color="#6a82fb"
                                      data-highlight-line-color="#6a82fb"
                                      data-tooltip-suffix="Credit"></span>
                            </div>
                        </div>
                        <div class="block-content block-content-full d-flex align-items-end justify-content-between bg-body-light">
                            <div>
                                <i class="fa fa-2x fa-file-alt text-muted"></i>
                                <span>Credit Purchased Statistics</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
