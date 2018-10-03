<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <style>
        @media print {
            .content-page {
                margin-left: 0 !important;
            }
        }
    </style>
    @include('layouts.partials.content.css')

    @yield('header')
    <link href="{{asset('css/toastr.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>

    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
    <link href="{{asset('css/shop.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/shop.js')}}" type="text/javascript"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>-->
    <!--<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>-->
    {{--<!--<script src="{{ asset('assets/libs/jquery/jquery-1.11.1.min.js') }}"></script>-->--}}

    <![endif]-->


    @include('layouts.partials.content.icons')
</head>
<body class="fixed-left">
    <div id="alertConfirm"></div>
    <div id="app">
        <loader v-if="isLoading"></loader>
        @include('layouts.partials.modals')

        <div id="wrapper">
            @include('layouts.partials.header')
            @if(Auth::user())
                @include('layouts.partials.left-nav')
                @endif

{{--            @include('layouts.partials.right-nav')--}}

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

    @if(session('flash_message'))
        <script>
            Messenger().post({
                message: '{{ session('flash_message') }}',
                type: '{{ session('flash_status') }}',
                showCloseButton: true
            });
        </script>
    @endif
    <script src="{{asset('js/toastr.min.js')}}"></script>

    <script>
        @if(Session::has('success'))
        toastr.success("{{Session::get('success')}}")
        @endif

        @if(Session::has('warning'))
        toastr.warning("{{Session::get('warning')}}")
        @endif
    </script>




    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('a#add').click( function() {
                var product_id = $(this).data('id');
                var url = "{{url('ajaxadd')}}";


                $.ajax({

                    type: "POST",
                    url: url,
                    data: { product_id: product_id},
                    success: function (data) {
                        console.log(data);

                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });
        });



        function increment_quantity(cart_id) {
            var inputQuantityElement = $("#input-quantity-"+cart_id);
            var newQuantity = parseInt($(inputQuantityElement).val())+1;
            save_to_db(cart_id, newQuantity);
        }

        function decrement_quantity(cart_id) {
            var inputQuantityElement = $("#input-quantity-"+cart_id);
            if($(inputQuantityElement).val() > 1)
            {
                var newQuantity = parseInt($(inputQuantityElement).val()) - 1;
                save_to_db(cart_id, newQuantity);
            }
        }

        function save_to_db(cart_id, new_quantity) {
            var inputQuantityElement = $("#input-quantity-"+cart_id);

            var url2 = "{{url('update-qn')}}" +'/'+new_quantity +'/'+ cart_id;
            $.ajax({
                url : url2,
                data : {product_id:cart_id,qty:new_quantity},
                type : 'post',
                success : function(response) {
                    $(inputQuantityElement).val(new_quantity);
                }
            });
        }

        $(document).ready(function () {
            $('#cash').keyup(function () {
                var amount = $(this).val();
                var total = $('#sum-total').val();
                var change = amount-total;
                   if(change>=0){
                       $('.change-amount').html(change);
                       $('#change-amount').attr('value',change);
                   }

               })
            {{--$('#pay').click(function () {--}}
                {{--if ($('#sum-total').val() > $('#cash').val()) {--}}
                    {{--alert('Please Enter amount first to proceed')--}}
                    {{--window.location.href = "{{url('cart')}}";--}}
                {{--}--}}

            {{--})--}}

        })

         </script>

</body>
</html>
