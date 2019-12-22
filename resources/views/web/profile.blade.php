@extends('web.layouts.app')
@php
    $user = auth()->user();
@endphp

@section('content')
    <main id="main-container" style="background: white">
        <!-- Page Content -->
        <div class="content">
            <div class="bg-image" style="background-image: url('{!! asset("assets/media/photos/photo17@2x.jpg") !!}');">
                <div class="bg-black-25">
                    <div class="content content-full">
                        <div class="py-5 text-center">
                            <a class="img-link" href="javascript:void(0)">
                                <img class="img-avatar img-avatar96 img-avatar-thumb"
                                     src="{!! asset("assets/media/photos/avatar10.jpg") !!}" alt="">
                            </a>
                            <h1 class="font-w700 my-2 text-white">{!! $user->name !!}</h1>
                            <h2 class="h4 font-w700 text-white-75">
                                {!! $user->email !!} | <a class="text-primary-lighter"
                                                        href="javascript:void(0)">{!! $user->credit !!} Credit</a>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <h2>Own Ringtones</h2>
            </div>
            <div class="bg-white p-3 pr-4 pl-5 rounded">

                <!-- Navigation -->
                <div class="block-content">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" id="category-select" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option disabled value="{!! $category->id !!}">{!! $category->name !!}</option>
                                        @if($category->children->isNotEmpty())
                                            @foreach($category->children as $child)
                                                <option value="{!! $child->id !!}">&nbsp;&nbsp;&nbsp; {!! $child->name !!}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" id="type-select" name="type">
                                    <option value="">Select Type</option>
                                    <option value="1">Monophonic</option>
                                    <option value="2">Polyphonic</option>
                                    <option value="3">True Tones</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" id="order-select" name="order">
                                    <option value="">Order</option>
                                    <option value="download_k-b">Download: Low to High</option>
                                    <option value="download_b-k">Download: High to Low</option>
                                    <option value="credit_k-b">Credit: Low to High</option>
                                    <option value="credit_b-k">Credit: High to Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Navigation -->
            </div>
            <div class="block-rounded text-center" style="margin-bottom: 1.75rem">
                <div class="block-content"><ul class="music-list ringtone" data-player-id="player">
                        @foreach($ringtones as $ringtone)
                            <li class="stopped">
                                <audio class="audio">
                                    <source src="{!! asset($ringtone->file) !!}" type="audio/mpeg">
                                </audio>
                                <i class="fa fa-play-circle"></i>
                                <span class="small text-primary">{!! $ringtone->type_string !!}</span>
                                <h5 class="title">{!! $ringtone->name !!}</h5>
                                <span class="small text-contrast-variant-1">{!! $ringtone->credit !!} credit -</span>
                                <span class="small text-contrast-variant-1">{!! number_format($ringtone->download_count) !!} downloads</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection
