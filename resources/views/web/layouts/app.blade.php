<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Naturing</title>

    <meta name="description"
          content="Dashmix - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="Dashmix - Bootstrap 4 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="Dashmix">
    <meta property="og:description"
          content="Dashmix - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link rel="shortcut icon" href="{!! asset("vendor/dawnstar/media/favicons/favicon.png") !!}">
    <link rel="icon" type="image/png" sizes="192x192" href="{!! asset("vendor/dawnstar/media/favicons/favicon-192x192.png") !!}">
    <link rel="apple-touch-icon" sizes="180x180"
          href="{!! asset("vendor/dawnstar/media/favicons/apple-touch-icon-180x180.png") !!}">

    <link rel="stylesheet" id="css-main" href="{!! asset("vendor/dawnstar/css/dashmix.min.css") !!}">
    <link rel="stylesheet" href="{!! asset("assets/css/custom.css") !!}">
    <link rel="stylesheet" href="{!! asset("assets/js/plugins/sweetalert2/sweetalert2.min.css") !!}">
    <link href="//fonts.googleapis.com/css?family=Roboto:400,300%7CMontserrat" rel="stylesheet" type="text/css">

    @stack('styles')
</head>

<body>

<div id="page-container" class=" page-header-fixed page-header-dark main-content-boxed">
    @include('web.layouts.header')

    @yield('content')

    @include('web.layouts.footer')
</div>

<script src="{!! asset("vendor/dawnstar/js/dashmix.core.min.js") !!}"></script>
<script src="{!! asset("vendor/dawnstar/js/dashmix.app.min.js") !!}"></script>
<script src="{!! asset("assets/js/plugins/vide/jquery.vide.min.js") !!}"></script>
<script src="{!! asset("assets/js/plugins/es6-promise/es6-promise.auto.min.js") !!}"></script>
<script src="{!! asset("assets/js/plugins/sweetalert2/sweetalert2.min.js") !!}"></script>
<script src="{!! asset("assets/js/be_comp_dialogs.min.js") !!}"></script>

<script>
    $(document).delegate('.music-list li i.play-button', 'click', function () {
        var obj = $(this).parent('li');

        if(obj.hasClass('listen')) {
            stopAudio();
        } else {
            stopAudio();

            obj.children('audio')[0].play();
            obj.removeClass("stopped");
            obj.addClass("listen");
            obj.children('i.play-button').removeClass("fa-play-circle");
            obj.children('i.play-button').addClass("fa-pause-circle");

            obj.children('audio')[0].addEventListener('ended', () => {
                obj.children('i.play-button').removeClass("fa-pause-circle");
                obj.children('i.play-button').addClass("fa-play-circle");

                obj.removeClass("listen");
                obj.addClass("stopped");
            })
        }
    });

    function stopAudio() {
        $.each($('.music-list li.listen'), function(k, v) {
            v = $(v);
            v.children('audio')[0].pause();
            v.children('audio')[0].currentTime = 0;
            v.children('i.play-button').removeClass("fa-pause-circle");
            v.children('i.play-button').addClass("fa-play-circle");

            v.removeClass("listen");
            v.addClass("stopped");
        })
    }
</script>


<script>
    $('.music-list li i.cart-button').on('click', function () {
        var obj = $(this);
        var ringtone_id = obj.data('id');

        $.ajax({
            'method': "POST",
            'data': {'_token': "{{csrf_token()}}", 'ringtone_id': ringtone_id },
            'url': "{{route('cart')}}",
            success: function(result) {
                if(result.status === true) {
                    obj.css('color', "#22bd4c")
                } else {
                    obj.css('color', "#e41443")
                }
                $("#cart").html(result.view);
            }
        })
    });


    $("body").delegate( ".js-swal-confirm2", "click", function() {
        var ringtone_id = $(this).data('id');
        swal.fire({
            title: 'Are you sure?',
            text: 'You will remove this product from the basket?',
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function (dismiss) {
            if (dismiss.value) {
                $.ajax({
                    'method': "POST",
                    'data': {'_token': "{{csrf_token()}}", 'ringtone_id': ringtone_id },
                    'url': "{{route('cart')}}",
                    success: function(result) {
                        location.reload()
                    }
                })
            }
        });
    });
</script>

@stack('scripts')
</body>
</html>
