@extends('Dawnstar::layouts.app')

@section('content')
    <main id="main-container">
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Ringtone</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Ringtone</li>
                            <li class="breadcrumb-item">{!! $ringtone->name !!}</li>
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
                <div class="block-content">
                    <form action="{!! route("panel.ringtone.update", ['id' => $ringtone->id]) !!}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row push">
                            <div class="col-lg-3 col-xl-4">
                                <h4><b>Ringtone File</b></h4>
                                <div class="col-sm-6 col-lg-12">
                                    <span id="btnFile" style="cursor: pointer;">
                                        <img src="{{ asset('vendor/dawnstar/media/music.png') }}"
                                             alt="Ringtone File" class="card p-1"
                                             style="width: 60%; margin-left: auto; margin-right: auto; border: 1px dashed black">
                                    </span>
                                    <label>
                                        Dosyayı değiştirmek için icon'a tıklayınız. <br>
                                        Yüklü dosya: {{ $ringtone->file }}
                                    </label>
                                    <div class="form-group" style="display: none">
                                        <div class="custom-file ">
                                            <input type="file" class="form-control" id="upload-file"
                                                   name="file" accept=".mp3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 col-xl-8">
                                <div class="row">
                                    <div class="form-group mt-5">
                                        <label class="col-4"><b>Status</b></label>
                                        <div class="col-8">
                                            <div
                                                class="custom-control-inline custom-radio custom-control-success custom-control-lg mb-1">
                                                <input type="radio" class="custom-control-input" id="active"
                                                       name="status" value="1" {{ $ringtone->status == 1 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="active">Active</label>
                                            </div>
                                            <div
                                                class="custom-control-inline custom-radio custom-control-warning custom-control-lg mb-1">
                                                <input type="radio" class="custom-control-input" id="uncheck"
                                                       name="status" value="2"  {{ $ringtone->status == 2 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="uncheck">Uncheck</label>
                                            </div>
                                            <div
                                                class="custom-control-inline custom-radio custom-control-danger custom-control-lg mb-1">
                                                <input type="radio" class="custom-control-input" id="passive"
                                                       name="status" value="3" {{ $ringtone->status == 3 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="passive">Passive</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-5">
                                        <label class="col-4"><b>Type</b></label>
                                        <div class="col-8">
                                            <div class="custom-control-inline custom-radio custom-control-lg mb-1">
                                                <input type="radio" class="custom-control-input" id="mono"
                                                       name="type" value="1" {{ $ringtone->type == 1 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="mono">Monophonic</label>
                                            </div>
                                            <div
                                                class="custom-control-inline custom-radio custom-control-lg mb-1">
                                                <input type="radio" class="custom-control-input" id="poly"
                                                       name="type" value="2" {{ $ringtone->type == 2 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="poly">Polyphonic</label>
                                            </div>
                                            <div
                                                class="custom-control-inline custom-radio custom-control-lg mb-1">
                                                <input type="radio" class="custom-control-input" id="true_tones"
                                                       name="type" value="3" {{ $ringtone->type == 3 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="true_tones">True Tones</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-5">
                                        <div class="">
                                            <label><b>Credit</b></label>
                                            <input type="number" class="form-control" id="credit" name="credit" value="{{ $ringtone->credit }}">
                                        </div>
                                        <div class="">
                                            <label><b>Download Count</b></label>
                                            <input type="number" class="form-control" id="download_count" disabled value="{{ $ringtone->download_count }}"
                                                   name="download_count">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="example-select-multiple">Category</label>
                                    <select class="form-control" name="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $id => $name)
                                            <option {{ $ringtone->category->id == $id ? 'selected' : '' }} value="{{ $id }}">{!! $name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ringtone Title</label>
                                    <input type="text" class="form-control" id="ringtone_name" name="name" value="{{$ringtone->name}}"
                                           autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Ringtone Slug</label>
                                    <input type="text" class="form-control" id="ringtone_slug" name="slug" value="{{$ringtone->slug}}">
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
    <script src="{!! asset("vendor/dawnstar/js/plugins/ckeditor/ckeditor.js") !!}"></script>
    <script src="{!! asset("vendor/dawnstar/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js") !!}"></script>
    <script>
        $('#ringtone_name').on('keyup', function() {
            $('#ringtone_slug').val(slugify($(this).val()));
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
    <script>
        jQuery(function () {
            Dashmix.helpers(['ckeditor', 'datepicker']);
        });

        $('#btnFile').on('click', function () {
            $('#upload-file').trigger('click');
        });
    </script>
@endpush
