@extends('Dawnstar::layouts.app')

@section('content')
    <main id="main-container">
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Report</h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Report</li>
                            <li class="breadcrumb-item">{!! $report->name !!}</li>
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
                    <form action="{!! route("panel.report.update", ['id' => $report->id]) !!}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <h2 class="content-heading pt-0">{!! $report->type !!}</h2>
                        <div class="row push">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-9 col-xl-8">
                                <hr>
                                <div class="form-group">
                                    <label for="example-text-input">User</label>
                                    <input type="text" class="form-control" disabled
                                           value="{!! $report->user->name !!}">
                                </div>
                                @if($report->answer)
                                    <div class="form-group">
                                        <label>Answer</label>
                                        <input type="text" class="form-control" disabled value="{!! $report->answer->name !!}">
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label>Question</label>
                                        <input type="text" class="form-control" disabled value="{!! $report->question->name !!}">
                                    </div>
                                @endif
                                <hr>
                                <div class="form-group">
                                    <label>Report Title</label>
                                    <input type="text" class="form-control" id="answer_name" name="name" autocomplete="off" value="{!! $report->type !!}">
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
