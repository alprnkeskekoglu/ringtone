@extends('web.layouts.app')

@section('content')
    <main id="main-container" style="background: white">
        <div class="content">
            <div class="block block-rounded">
                <div class="block-content">
                    <h2 class="display-3 mb-6">WHY US</h2>
                    <div class="row">
                        <div class="col-sm-5 col-md-5 address">
                            <em>Where we are?</em>
                            <ul>
                                <li>
                                    <span>A:</span><p style="display: inline-block">Muradiye Mah.Celal Bayar Üniversitesi Kampüsü, Yunusemre/Manisa</p>
                                </li>
                                <li>
                                    <span>T:</span><a href="tel:+902361231212">+90 236 123 12 12</a>
                                </li>
                                <li>
                                    <span>F:</span>+90 236 321 32 32
                                </li>
                                <li>
                                    <span>M:</span><a href="mailto:info@gloreglass.com">info@naturing.com</a>
                                </li>
                                <li>
                                    <span>M:</span><a href="mailto:export@gloreglass.com">export@naturing.com</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-7 col-xs-12 col-sm-7">
                            <div id="js-map-markers" style="height: 400px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection

@push('scripts')

    <script src="//maps.googleapis.com/maps/api/js?key="></script>
    <script src="{!! asset("assets/js/plugins/gmaps/gmaps.min.js") !!}"></script>
    <script src="{!! asset("assets/js/be_comp_maps_google.min.js") !!}"></script>
@endpush
