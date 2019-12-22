@extends('Dawnstar::layouts.app')

@section('content')
    <main id="main-container">
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Categorys</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Category</li>
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
                    <form action="{!! route("panel.category.store") !!}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row push">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-9 col-xl-8">
                                <div class="form-group row mt-5">
                                    <label class="col-4"><b>Status</b></label>
                                    <div class="col-8">
                                        <div class="custom-control-inline custom-radio custom-control-success custom-control-lg mb-1">
                                            <input type="radio" class="custom-control-input" id="active"
                                                   name="status" value="1">
                                            <label class="custom-control-label" for="active">Active</label>
                                        </div>
                                        <div
                                            class="custom-control-inline custom-radio custom-control-warning custom-control-lg mb-1">
                                            <input type="radio" class="custom-control-input" id="uncheck"
                                                   name="status" value="2" checked>
                                            <label class="custom-control-label" for="uncheck">Uncheck</label>
                                        </div>
                                        <div
                                            class="custom-control-inline custom-radio custom-control-danger custom-control-lg mb-1">
                                            <input type="radio" class="custom-control-input" id="passive"
                                                   name="status" value="3">
                                            <label class="custom-control-label" for="passive">Passive</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-select-multiple">Parent Category</label>
                                    <select class="form-control" name="parent_id">
                                        <option value="">Select Parent Category</option>
                                        @foreach($parents as $id => $name)
                                            <option value="{{ $id }}">{!! $name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input type="text" class="form-control" id="category_name" name="name" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Category Slug</label>
                                    <input type="text" class="form-control" id="category_slug" name="slug" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Category Detail</label>
                                    <textarea id="js-ckeditor" name="detail"></textarea>
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
    <script src="{!! asset("vendor/dawnstar/js/plugins/ckeditor/ckeditor.js") !!}"></script>
    <script>
        jQuery(function () {
            Dashmix.helpers(['ckeditor']);
        });
    </script>


    <script>
        $('#category_name').on('keyup', function() {
            $('#category_slug').val(slugify($(this).val()));
        });

        slugify = function(text) {
            var trMap = {
                'çÇ':'c',
                'ğĞ':'g',
                'şŞ':'s',
                'üÜ':'u',
                'ıİ':'i',
                'öÖ':'o'
            };
            for(var key in trMap) {
                text = text.replace(new RegExp('['+key+']','g'), trMap[key]);
            }
            return  text.replace(/[^-a-zA-Z0-9\s]+/ig, '') // remove non-alphanumeric chars
                .replace(/\s/gi, "-") // convert spaces to dashes
                .replace(/[-]+/gi, "-") // trim repeated dashes
                .toLowerCase();

        }
    </script>
@endpush
