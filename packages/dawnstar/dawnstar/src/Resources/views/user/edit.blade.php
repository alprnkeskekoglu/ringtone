@extends('Dawnstar::layouts.app')

@section('content')
    <main id="main-container">
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Users</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">User</li>
                            <li class="breadcrumb-item">{!! $user->name !!}</li>
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
                    <form action="{!! route("panel.user.update", ['id' => $user->id]) !!}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <h2 class="content-heading pt-0">{!! $user->name !!}</h2>
                        <div class="row push">
                            <div class="col-lg-3 col-xl-2">
                            </div>
                            <div class="col-lg-9 col-xl-8">
                                <div class="form-group">
                                    <label for="example-text-input">Credit</label>
                                    <input type="number" class="form-control" name="credit"
                                           placeholder="Credit" autocomplete="off" value="{!! $user->credit !!}">
                                </div>
                                <div class="form-group">
                                    <label for="example-text-input">Name</label>
                                    <input type="text" class="form-control" name="name"
                                           placeholder="Name" autocomplete="off" value="{!! $user->name !!}">
                                </div>
                                <div class="form-group">
                                    <label for="example-email-input">E-mail</label>
                                    <input type="email" class="form-control" name="email"
                                           placeholder="E-mail" autocomplete="off" value="{!! $user->email !!}">
                                </div>
                                <div class="form-group">
                                    <label for="example-email-input">Password</label>
                                    <input type="password" class="form-control" name="password"
                                           placeholder="Password" autocomplete="off" value="{!! $user->password !!}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-hero-success mr-1 mb-3 ">
                                <i class="fa fa-save mr-1"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        $('#btnFile').on('click', function () {
            $('#upload-file').trigger('click');
        });
    </script>
@endpush
