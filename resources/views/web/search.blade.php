@extends('web.layouts.app')

@section('content')
    <main id="main-container" style="background: white">
        <div class="bg-image" style="background-image: url('{!! asset("assets/media/photos/photo17@2x.jpg") !!}');">
            <div class="bg-black-25">
                <div class="content content-full">
                    <div class="py-5 text-center">
                        <h1 class="font-w700 my-2 text-white">Search Results</h1>
                        <h2 class="h4 font-w700 text-white-75">
                            Search Key |
                            <a class="text-primary-lighter" href="javascript:void(0)">{!! request()->get('q') !!}</a>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Content -->
        @php
            $cart = [];
            if(session()->get(auth()->id() . "_cart")) {
                $cart = json_decode(decrypt(session()->get(auth()->id() . "_cart")), 1);
            }
        @endphp
        <div class="content">
            <div class="block-rounded text-center" style="margin-bottom: 1.75rem">
                <div class="block-content">
                    <ul class="music-list ringtone" data-player-id="player">
                        @foreach($ringtones as $ringtone)
                            <li class="stopped">
                                <audio class="audio">
                                    <source src="{!! asset($ringtone->demo_file) !!}" type="audio/mpeg">
                                </audio>
                                <i class="fa fa-play-circle play-button"></i>
                                <span class="small text-primary">{!! $ringtone->type_string !!}</span>
                                @auth('web')
                                    @php
                                        $users = auth()->user()->ringtones->pluck('id')->toArray();
                                    @endphp
                                    @if(in_array($ringtone->id, $users))
                                        <i class="fa fa-check-circle float-right"></i>
                                    @else
                                        <i class="fa fa-shopping-basket float-right cart-button"
                                           style="{{ in_array($ringtone->id, $cart) ? 'color: #22bd4c' : 'color: #e41443' }}"
                                           data-id="{!! $ringtone->id !!}"></i>
                                    @endif
                                @endauth
                                <h5 class="title">{!! $ringtone->name !!}</h5>
                                <span class="small text-contrast-variant-1">{!! $ringtone->credit !!} credit -</span>
                                <span class="small text-contrast-variant-1">{!! number_format($ringtone->download_count) !!} downloads</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="d-inline-block mt-6">
                        {!! $ringtones->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
