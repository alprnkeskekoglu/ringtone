@extends('web.layouts.app')

@section('content')
    <main id="main-container" style="background: white">
        <div class="pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

                        <div class="show_error alert alert-warning" style="display: none">
                            You need to buy some credits for this order!
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Credit</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Price</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Buy</div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @for($i = 5; $i <= 100; $i+=10)
                                        <tr>
                                            <td class="border-0 align-middle"><strong>{!! $i !!} Credit</strong></td>
                                            <td class="border-0 align-middle"><strong>{!! $i - ($i / 10) !!} $</strong></td>
                                            <td class="border-0 align-middle">
                                                <a href="javascript:void(0);" class="btn btn-primary buy-credit" data-credit="{{$i}}">
                                                    BUY
                                                </a>
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                        <!-- End -->
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        $('.buy-credit').on('click', function() {
            var credit = $(this).data('credit');
           $.ajax({
               method: "POST",
               url: "{{route('credit')}}",
               data: {'_token': "{{csrf_token()}}", 'credit': credit},
               success: function(result) {
                    //window.location.href = "{{route('profile')}}"
               }
           })
        });
    </script>
@endpush
