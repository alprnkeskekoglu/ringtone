@if($ringtones->isNotEmpty())
<ul class="music-list ringtone" data-player-id="player">
    @foreach($ringtones as $ringtone)

        <li class="stopped">
            <audio class="audio">
                <source src="{!! asset($ringtone->file) !!}" type="audio/mpeg">
            </audio><i class="fa fa-play-circle play-button"></i>
            <span class="small text-primary">{!! $ringtone->type_string !!}</span>
            <a href="{!! asset($ringtone->file) !!}" download="{!! $ringtone->name !!}" data-id="{{$ringtone->id}}" class="download-btn"><i class="fa fa-download float-right"></i></a>
            <h5 class="title">{!! $ringtone->name !!}</h5>
            <span class="small text-contrast-variant-1">{!! $ringtone->credit !!} credit -</span>
            <span class="small text-contrast-variant-1">{!! number_format($ringtone->download_count) !!} downloads</span>
        </li>
    @endforeach
</ul>
<div class="d-inline-block mt-6">
    {!! $ringtones->links() !!}
</div>
@else
    <p>You have not yet purchased any ringtone.</p>
@endif
