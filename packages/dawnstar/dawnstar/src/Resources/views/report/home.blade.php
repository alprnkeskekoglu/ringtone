@extends('Dawnstar::layouts.app')

@section('content')
    <main id="main-container">
        <div class="content content-full">
            <div class="d-flex justify-content-between align-items-center mt-6 mb-3">
                <h2 class="font-w300 mb-0">Reports</h2>
            </div>


            <div class="col-xl-12">
                <!-- Lines Chart -->
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Ringtone Sales Report</h3>
                    </div>
                    <div class="block-content block-content-full text-center">
                        <div class="col-md-12 row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-control" id="ringtone-date" name="ringtone-date">
                                        <option value="1" {!! request()->get('ringtone_type') == 1 ? 'selected' : '' !!}>Today</option>
                                        <option value="2" {!! request()->get('tyringtone_typepe') == 2 ? 'selected' : '' !!}>Yesterday</option>
                                        <option value="3" {!! request()->get('ringtone_type') == 3 ? 'selected' : '' !!}>Last Week</option>
                                        <option value="4" {!! request()->get('ringtone_type') == 4 ? 'selected' : '' !!}>Last Month</option>
                                        <option value="5" {!! request()->get('ringtone_type') == 5 ? 'selected' : '' !!}>Last Year</option>
                                        <option value="6" {!! request()->get('ringtone_type') == 6 ? 'selected' : '' !!}>All</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 pt-6">
                                <table class="table table-bordered table-vcenter">
                                    <thead>
                                    <tr>
                                        <th style="width: 25%;">Date</th>
                                        <th class="text-center d-none d-sm-table-cell" style="width: 15%;">Number</th>
                                        <th class="text-center" style="width: 100px;">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ringtone_transactions as $trans)
                                        <tr>
                                            <td class="font-w600">
                                                <a href="javascript:void(0);">{!! $trans['time'] !!}</a>
                                            </td>
                                            <td class="text-center d-none d-sm-table-cell">
                                                <span>{!! $trans['ringtones_count'] !!}</span>
                                            </td>
                                            <td class="text-center">
                                                <span>{!! $trans['ringtones_amount'] !!} Credit</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-5 float-right">
                                <!-- Lines Chart Container -->
                                <canvas id="js-chartjs-lines"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Lines Chart -->
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Credit Sales Report</h3>
                    </div>
                    <div class="block-content block-content-full text-center">
                        <div class="col-md-12 row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-control" id="credit-date" name="credit-date">
                                        <option value="1" {!! request()->get('credit_type') == 1 ? 'selected' : '' !!}>Today</option>
                                        <option value="2" {!! request()->get('credit_type') == 2 ? 'selected' : '' !!}>Yesterday</option>
                                        <option value="3" {!! request()->get('credit_type') == 3 ? 'selected' : '' !!}>Last Week</option>
                                        <option value="4" {!! request()->get('credit_type') == 4 ? 'selected' : '' !!}>Last Month</option>
                                        <option value="5" {!! request()->get('credit_type') == 5 ? 'selected' : '' !!}>Last Year</option>
                                        <option value="6" {!! request()->get('credit_type') == 6 ? 'selected' : '' !!}>All</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 pt-6">
                                <table class="table table-bordered table-vcenter">
                                    <thead>
                                    <tr>
                                        <th style="width: 25%;">Date</th>
                                        <th class="text-center d-none d-sm-table-cell" style="width: 15%;">Credit</th>
                                        <th class="text-center" style="width: 100px;">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($credit_transactions as $trans)
                                        <tr>
                                            <td class="font-w600">
                                                <a href="javascript:void(0);">{!! $trans['time'] !!}</a>
                                            </td>
                                            <td class="text-center d-none d-sm-table-cell">
                                                <span>{!! $trans['credits_count'] !!} Credit</span>
                                            </td>
                                            <td class="text-center">
                                                <span>{!! $trans['credits_amount'] !!} $</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-5 float-right">
                                <!-- Lines Chart Container -->
                                <canvas id="js-chartjs-lines2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Lines Chart -->
            </div>

        </div>
    </main>
@endsection

@push('scripts')

    <!-- Page JS Plugins -->
    <script src="{!! asset("vendor/dawnstar/js/plugins/chart.js/Chart.bundle.min.js") !!}"></script>

    <script>
        var ctx = document.getElementById('js-chartjs-lines');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! '["' . implode('", "', $labels) . '"]' !!},
                datasets: [{
                    label: "Ringtone Amount",
                    fill: !0,
                    backgroundColor: "rgba(6, 101, 208, .75)",
                    borderColor: "rgba(6, 101, 208, 1)",
                    pointBackgroundColor: "rgba(6, 101, 208, 1)",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(6, 101, 208, 1)",
                    data: {!! '[' . implode(', ', $data) . ']' !!}
                }]
            }
        });

        var ctx2 = document.getElementById('js-chartjs-lines2');
        var myChart = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: {!! '["' . implode('", "', $credit_labels) . '"]' !!},
                datasets: [{
                    label: "Credit Amount",
                    fill: !0,
                    backgroundColor: "rgba(6, 101, 208, .75)",
                    borderColor: "rgba(6, 101, 208, 1)",
                    pointBackgroundColor: "rgba(6, 101, 208, 1)",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(6, 101, 208, 1)",
                    data: {!! '[' . implode(', ', $credit_data) . ']' !!}
                }]
            }
        });
    </script>

    <script>

        var ringtone_type = "{{request()->get('credit_type') ?: 1}}";
        var credit_type = "{{request()->get('credit_type') ?: 1}}";
        $('#ringtone-date').on('change', function() {
            ringtone_type = $(this).val();
            window.location.href = location.origin + location.pathname + "?ringtone_type=" + ringtone_type + "&credit_type=" + credit_type;
        });
        $('#credit-date').on('change', function() {
            credit_type = $(this).val();
            window.location.href = location.origin + location.pathname + "?credit_type=" + credit_type + "&ringtone_type=" + ringtone_type;
        });
    </script>


@endpush
