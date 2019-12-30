@extends('web.layouts.app')
@php
    $cart = [];
    if(session()->get(auth()->id() . "_cart")) {
        $cart = json_decode(decrypt(session()->get(auth()->id() . "_cart")), 1);
    }
@endphp

@php
    $users = auth()->user() ? auth()->user()->ringtones->pluck('id')->toArray() : [];
@endphp

@section('content')
    <main id="main-container" style="background: white">

        <div class="bg-video" data-vide-bg="{!! asset("assets/media/videos/forest") !!}"
             data-vide-options="posterType: jpg">
            <div class="hero">
                <div class="hero-inner">
                    <div class="content content-full text-center">
                        <h1 class="display-4 font-w700 text-white mb-3 invisible" data-toggle="appear"
                            data-class="animated fadeInDown">
                            Natu<span class="text-primary-light">ring</span>
                        </h1>
                        <h2 class="font-w300 text-white-75 mb-5 invisible" data-toggle="appear"
                            data-class="animated fadeInUp" data-timeout="400">Sounds from the nature.</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="content">

            <div class="block-rounded text-center" style="margin-bottom: 1.75rem">
                <div class="block-content">
                    <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#tab-popularity">POPULARITY</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab-newest">NEWEST</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab-price">BY PRICE</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-popularity" role="tabpanel">
                            <ul class="music-list" data-player-id="player">
                                @foreach($popularities as $popular)
                                    <li class="stopped">
                                        <audio class="audio">
                                            <source src="{!! asset($popular->demo_file) !!}" type="audio/mpeg">
                                        </audio>
                                        <i class="fa fa-play-circle play-button"></i>
                                        <span class="small text-primary">{!! $popular->type_string !!}</span>
                                        @auth('web')
                                            @if(in_array($popular->id, $users))
                                                <i class="fa fa-check-circle float-right"></i>
                                            @else
                                                <i class="fa fa-shopping-basket float-right cart-button"
                                                   style="{{ in_array($popular->id, $cart) ? 'color: #22bd4c' : 'color: #e41443' }}"
                                                   data-id="{!! $popular->id !!}"></i>
                                            @endif                                        @endauth
                                        <h5 class="title">{!! $popular->name !!}</h5>
                                        <span class="small text-contrast-variant-1">{!! $popular->credit !!} credit -</span>
                                        <span class="small text-contrast-variant-1">{!! number_format($popular->download_count) !!} downloads</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-pane" id="tab-newest" role="tabpanel">
                            <ul class="music-list" data-player-id="player">
                                @foreach($newest as $new)
                                    <li class="stopped">
                                        <audio class="audio">
                                            <source src="{!! asset($new->demo_file) !!}" type="audio/mpeg">
                                        </audio>
                                        <i class="fa fa-play-circle play-button"></i>
                                        <span class="small text-primary">{!! $new->type_string !!}</span>
                                        @auth('web')
                                            @if(in_array($new->id, $users))
                                                <i class="fa fa-check-circle float-right"></i>
                                            @else
                                                <i class="fa fa-shopping-basket float-right cart-button"
                                                   style="{{ in_array($new->id, $cart) ? 'color: #22bd4c' : 'color: #e41443' }}"
                                                   data-id="{!! $new->id !!}"></i>
                                            @endif
                                        @endauth
                                        <h5 class="title">{!! $new->name !!}</h5>
                                        <span class="small text-contrast-variant-1">{!! $new->credit !!} credit -</span>
                                        <span
                                            class="small text-contrast-variant-1">{!! \Carbon\Carbon::parse($new->created_at)->format('d F') !!}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-pane" id="tab-price" role="tabpanel">
                            <ul class="music-list" data-player-id="player">
                                @foreach($prices as $price)
                                    <li class="stopped">
                                        <audio class="audio">
                                            <source src="{!! asset($price->demo_file) !!}" type="audio/mpeg">
                                        </audio>
                                        <i class="fa fa-play-circle play-button"></i>
                                        <span class="small text-primary">{!! $price->type_string !!}</span>
                                        @auth('web')
                                            @if(in_array($price->id, $users))
                                                <i class="fa fa-check-circle float-right"></i>
                                            @else
                                                <i class="fa fa-shopping-basket float-right cart-button"
                                                   style="{{ in_array($price->id, $cart) ? 'color: #22bd4c' : 'color: #e41443' }}"
                                                   data-id="{!! $price->id !!}"></i>
                                            @endif
                                        @endauth
                                        <h5 class="title">{!! $price->name !!}</h5>
                                        <span class="small text-contrast-variant-1">{!! $price->credit !!} credit -</span>
                                        <span class="small text-contrast-variant-1">{!! number_format($price->download_count) !!} downloads</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <a href="{!! route('ringtone') !!}" class="btn btn-rounded btn-hero-secondary">See All Ringtones</a>
            </div>

        </div>


        <div class="parallax bg-image" style="background-image: url('assets/media/photos/photo12@2x.jpg');">
            <div class="bg-black-75 text-center">
                <div class="content py-6 text-center col-sm-8">
                    <h2 class="text-white">
                        SERVICES
                    </h2>
                    <div class="row mt-6 col-sm-8 offset-sm-2">
                        <div class="col-sm-4">
                            <i class="fa fa-7x fa-headphones" style="color: #2dcd75"></i>
                            <br>
                            <a href="javascript:void(0);" class="btn btn-rounded btn-hero-success mt-6"
                               style="background: #fff; color: #000">listen</a>
                        </div>
                        <div class="col-sm-4">
                            <i class="fa fa-7x fa-coins" style="color: #2dcd75"></i>
                            <br>
                            <a href="javascript:void(0);" class="btn btn-rounded btn-hero-success mt-6"
                               style="background: #fff; color: #000">pay</a>
                        </div>
                        <div class="col-sm-4">
                            <i class="fa fa-7x fa-laptop" style="color: #2dcd75"></i>
                            <br>
                            <a href="javascript:void(0);" class="btn btn-rounded btn-hero-success mt-6"
                               style="background: #fff; color: #000">download</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="block block-rounded text-center">
                <div class="block-content">
                    <h2 class="display-3 mb-6">WHY US</h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>Share Ringtones</h5>

                            <p>Access unlimited number of ringtones and download them without sign up or registration.
                                Surveys reveal that more than half of the mobile phone users between 15 to 30 years of
                                age
                                download
                                ringtones at least once.</p>
                        </div>
                        <div class="col-sm-6">
                            <h5>Ringtone and Your Personality</h5>

                            <p>This may sound amusing, but studies show that your ringtone explains a lot about your
                                personality. Yes, its true, just like your favorite color, book, movie or food, your
                                choice
                                of ringtones
                                reflects your character and personality, too. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
