@extends('Dawnstar::layouts.app')

@section('content')
    <main id="main-container">
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Transactions</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Transaction</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->
        <!-- Page Content -->
        <div class="content">
            <div class="block block-rounded block-bordered">
                @if(session()->get('message'))
                    <div class="alert alert-success d-flex align-items-center" role="alert" id="success_div">
                        <div class="flex-00-auto">
                            <i class="fa fa-fw fa-check"></i>
                        </div>
                        <div class="flex-fill ml-3">
                            <p class="mb-0" id="success_message">{!! session()->get('message') !!}</p>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                <div class="block-content">
                    <form action="{!! route("panel.credit_transaction.update", ['id' => $transaction->id]) !!}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row push">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-9 col-xl-8">
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" class="form-control" id="user_name" name="name" disabled autocomplete="off" value="{!! $transaction->user->name !!}">
                                </div>
                                <div class="form-group">
                                    <label>Credit</label>
                                    <input type="text" class="form-control" id="credit" name="credit" disabled autocomplete="off" value="{!! $transaction->credit !!}">
                                </div>
                                <div class="form-group">
                                    <label>Total Amount</label>
                                    <input type="text" class="form-control" id="amount" name="amount" disabled autocomplete="off" value="{!! $transaction->amount !!}">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
