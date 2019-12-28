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
