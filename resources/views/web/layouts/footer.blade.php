@php
    $categories = \Dawnstar\Models\Category::whereNull('parent_id')
                ->where('status', 1)
                ->with('children')
                ->get();
@endphp

<div class="" style="background: whitesmoke">
    <div class="footer-menu">
        <div class="col-md-9 col-xs-12 col-sm-9 offset-md-2 offset-sm-2 pa">
            <ul>
                <li class="head">Naturing</li>
                <li><a href="{!! route('home') !!}">Home</a></li>
                <li><a href="{!! route('ringtone') !!}">Ringtone</a></li>
                <li><a href="{!! route('contact') !!}">Contact</a></li>
                <li><a href="{!! route('credit') !!}">Credit</a></li>
            </ul>
            @foreach($categories as $category)
                <ul>
                    <li class="head">{!! strtoupper($category->name) !!}</li>
                    @if($category->children->isNotEmpty())
                        @foreach($category->children as $child)
                            <li><a href="javascript:void(0)">{!! $child->name !!}</a></li>
                        @endforeach
                    @endif
                </ul>
            @endforeach
        </div>
    </div>
</div>
<footer id="page-footer" class="bg-body-light">
    <div class="content py-0">
        <div class="row font-size-sm">
            <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-right">
                <i class="fa fa-heart text-danger"></i> by <a class="font-w600"
                                                                           href="https://github.com/alprnkeskekoglu"
                                                                           target="_blank">alprnkeskekoglu</a>
            </div>
            <div class="col-sm-6 order-sm-1 text-center text-sm-left">
                Naturing &copy; <span
                    data-toggle="year-copy"></span>
            </div>
        </div>
    </div>
</footer>
