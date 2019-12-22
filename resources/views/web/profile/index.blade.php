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
            @php
                $cart = [];
                if(session()->get(auth()->id() . "_cart")) {
                    $cart = json_decode(decrypt(session()->get(auth()->id() . "_cart")), 1);
                }
            @endphp
            <div class="block-rounded text-center" style="margin-bottom: 1.75rem">
                <div class="block-content" id="ringtone-content">
                    @include('web.profile.ajax')
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')

    <script>
        var category_id = "";
        var type = "";
        var order = "";

        $('#category-select').on('change', function() {
            category_id = $(this).val();
            ajax();
        });

        $('#type-select').on('change', function() {
            type = $(this).val();
            ajax();
        });

        $('#order-select').on('change', function() {
            order = $(this).val();
            ajax();
        });


        function ajax() {
            $.ajax({
                'method': 'post',
                'url': '{{route('ringtone.filter')}}',
                'data': {'category_id': category_id, 'type': type, 'order': order},
                success: function(result) {
                    $('#ringtone-content').html(result);
                }
            })
        }

        $('.download-btn').on('click', function(e) {
            var ringtone_id = $(this).data('id');
            $.ajax({
                'method': 'post',
                'url': '{{route('ringtone.download')}}',
                'data': {'ringtone_id': ringtone_id}
            })
        })
    </script>
@endpush
