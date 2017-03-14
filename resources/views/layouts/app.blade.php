<!DOCTYPE html>
<html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="apple-mobile-web-app-capable" content="yes" />

    @include('layouts.partials.content.css')

    @yield('header')

    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    @include('layouts.partials.content.icons')
</head>
<body class="fixed-left">
    <div id="alertConfirm"></div>
    <div id="app">
        @include('layouts.partials.modals')

        <div id="wrapper">
            @include('layouts.partials.header')

            @include('layouts.partials.left-nav')

            @include('layouts.partials.rigth-nav')

            <div class="content-page">
                <div class="content">
                    @yield('content')
                </div>
            </div>

        </div>

        <div id="contextMenu" class="dropdown clearfix">
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block;position:static;margin-bottom:5px;">
                <li><a tabindex="-1" href="javascript:;" data-priority="high"><i class="fa fa-circle-o text-red-1"></i> High Priority</a></li>
                <li><a tabindex="-1" href="javascript:;" data-priority="medium"><i class="fa fa-circle-o text-orange-3"></i> Medium Priority</a></li>
                <li><a tabindex="-1" href="javascript:;" data-priority="low"><i class="fa fa-circle-o text-yellow-1"></i> Low Priority</a></li>
                <li><a tabindex="-1" href="javascript:;" data-priority="none"><i class="fa fa-circle-o text-lightblue-1"></i> None</a></li>
            </ul>
        </div>

        <div class="md-overlay"></div>

    </div>
    @include('layouts.partials.content.js')

    @yield('footer')

    <script src="{{ asset(mix('js/app.js')) }}"></script>

    @if(session('flash_message'))
        <script>
            Messenger().post({
                message: '{{ session('flash_message') }}',
                type: '{{ session('flash_status') }}',
                showCloseButton: true
            });
        </script>
    @endif
</body>
</html>