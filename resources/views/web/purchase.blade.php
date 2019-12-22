@extends('web.layouts.app')

@section('content')
    <main id="main-container" style="background: white">
        <div class="pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 p-5 bg-white rounded shadow-sm mb-5">

                        <div class="show_error alert alert-warning" style="display: none">
                            You need to buy some credits for this order!
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Product</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Price</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Remove</div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ringtones as $ringtone)
                                    <tr>
                                        <th scope="row" class="border-0">
                                            <div class="p-2">
                                                <div class="ml-3 d-inline-block align-middle">
                                                    <h5 class="mb-0">
                                                        <a href="#" class="text-dark d-inline-block align-middle">{!! $ringtone->name !!}</a>
                                                    </h5>
                                                    <span class="text-muted font-weight-normal font-italic d-block">Category: {!! $ringtone->category->name !!}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="border-0 align-middle"><strong>{!! $ringtone->credit !!}</strong></td>
                                        <td class="border-0 align-middle">
                                            <a href="#" class="text-dark">
                                                <i class="fa fa-trash js-swal-confirm2" data-id="{!! $ringtone->id !!}"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End -->
                    </div>
                    <div class="col-lg-4 p-5 bg-white rounded shadow-sm mb-5">
                        <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary</div>
                        <div class="p-4">
                            <p class="font-italic mb-4">Purchased products can be found on the profile page</p>
                            <ul class="list-unstyled mb-4">
                                <li class="d-flex justify-content-between py-3 border-bottom">
                                    <strong class="text-muted">Total</strong>
                                    <h5 class="font-weight-bold">{!! $ringtones->sum('credit') !!} Credit</h5>
                                </li>
                            </ul>
                            <a href="#" class="btn btn-dark rounded-pill py-2 btn-block" id="purchase_btn">Purchase</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        $('#purchase_btn').on('click', function() {
           $.ajax({
               method: "POST",
               url: "{{route('purchase')}}",
               data: {'_token': "{{csrf_token()}}"},
               success: function(result) {
                    if(result.status === true) {
                        window.location.href = "{{route('profile')}}"
                    } else {
                        $('.show_error').show()
                    }
               }
           })
        });
    </script>
@endpush
