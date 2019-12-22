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
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <div class="block block-rounded block-bordered">
                <div class="block-content">
                    <form action="{!! route("panel.user.store") !!}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row push">
                            <div class="col-lg-3 col-xl-2">
                            </div>
                            <div class="col-lg-9 col-xl-8">
                                <div class="form-group row mt-5">
                                    <label class="col-4"><b>Type</b></label>
                                    <div class="col-8">
                                        <div class="custom-control-inline custom-radio custom-control-success custom-control-lg mb-1">
                                            <input type="radio" class="custom-control-input" id="user"
                                                   name="type" value="1" checked>
                                            <label class="custom-control-label" for="user">User</label>
                                        </div>
                                        <div
                                            class="custom-control-inline custom-radio custom-control-danger custom-control-lg mb-1">
                                            <input type="radio" class="custom-control-input" id="admin"
                                                   name="type" value="99">
                                            <label class="custom-control-label" for="admin">Admin</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="example-text-input">Credit</label>
                                    <input type="number" class="form-control" name="credit"
                                           placeholder="Credit" autocomplete="off"">
                                </div>
                                <div class="form-group">
                                    <label for="example-text-input">Name</label>
                                    <input type="text" class="form-control" name="name"
                                           placeholder="Name" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="example-email-input">E-mail</label>
                                    <input type="email" class="form-control" name="email"
                                           placeholder="E-mail" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="example-email-input">Password</label>
                                    <input type="password" class="form-control" name="password"
                                           placeholder="Password" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-hero-success mr-1 mb-3 ">
                                <i class="fa fa-save mr-1"></i> Create
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
