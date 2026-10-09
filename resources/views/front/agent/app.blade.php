<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'realState24world') }}</title>
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- css   -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/plugins.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/dashboard-style.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/color.css') }}">

    <link href="{{ asset('assets/plugins/summernote/dist/summernote-lite.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/toaster.css') }}" rel="stylesheet" />

</head>

<body>
    <!--loader-->
    <div class="loader-wrap">
        <div class="loader-inner">
            <svg>
                <defs>
                    <filter id="goo">
                        <fegaussianblur in="SourceGraphic" stdDeviation="2" result="blur" />
                        <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 5 -2"
                            result="gooey" />
                        <fecomposite in="SourceGraphic" in2="gooey" operator="atop" />
                    </filter>
                </defs>
            </svg>
        </div>
    </div>
    <!--loader end-->
    <div id="main">
        {{-- Header --}}
        @include('front.agent.seller-header')

        @include('front.agent.sidebar')
        {{-- Content --}}
        @yield('content')
        {{-- Foter --}}
        @include('front.agent.seller-footer')
        <a class="to-top color-bg"><i class="fas fa-caret-up"></i></a>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/dist/summernote-lite.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/toaster.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/select2/dist/js/select2.min.js') }}" type="text/javascript"></script>

    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @elseif (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @elseif ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
    {{-- <script src="https://kit.fontawesome.com/9056e64c50.js" crossorigin="anonymous"></script> --}}
    @yield('custom-javascript')
</body>

</html>
