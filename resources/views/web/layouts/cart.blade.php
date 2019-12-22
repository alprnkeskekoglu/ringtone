<button type="button" class="btn btn-dual" @if($cart_ringtones->count() > 0) id="page-header-notifications-dropdown"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"@endif>
    <i class="fa fa-fw fa-shopping-basket"></i>
    <span class="badge badge-secondary badge-pill">{!! isset($cart_ringtones) ? $cart_ringtones->count() : 0 !!}</span>
</button>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
     aria-labelledby="page-header-notifications-dropdown">

    @if($cart_ringtones->count() > 0)
        <ul class="nav-items my-2">
            @foreach($cart_ringtones as $ringtone)
                <li>
                    <a class="text-dark media py-2 js-swal-confirm2" data-id="{{$ringtone->id}}" href="javascript:void(0)">
                        <div class="mx-3">
                            <i class="fa fa-fw fa-times-circle text-danger remove-cart"></i>
                        </div>
                        <div class="media-body font-size-sm pr-2">
                            <div class="font-w600">{!! $ringtone->name !!}</div>
                            <div class="text-muted font-italic">{!! $ringtone->type_string !!} - <span>{!! $ringtone->credit !!} Credit</span>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="p-2 border-top">
            <a class="btn btn-light btn-block text-center" href="{!! route('purchase') !!}">
                <i class="fa fa-fw fa-eye mr-1"></i> Purchase
            </a>
        </div>
    @endif
</div>
