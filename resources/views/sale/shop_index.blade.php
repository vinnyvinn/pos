@extends('layouts.app')
@section('content')

@section('content')
    @if(session('message'))
        <div id="success-alert" class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('message') }}
        </div>
    @endif
    <div class="panel panel-default products-page">
        <div class="panel panel-heading">MENU
            <a href="{{url('drinks')}}" class="btn btn-success">COLD & HOT DRINKS</a>
            <a href="{{url('snacks')}}" class="btn btn-success">SNACKS/CAKES</a>
            <a href="{{url('dishes')}}" class="btn btn-success">MAIN DISHES</a>
            <a href="{{url('specials')}}" class="btn btn-success">CHEF SPECIALS</a>
     <?php count(session()->get('cart'))?>
            <a href="{{url('cart')}}"><img src="{{ asset('images/empty-cart.png') }}"  class="rounded-circle cart-icon"></a>
        </div>
        <div class="panel panel-body cart-panel">

                    <div class="row">

                        @foreach ($products as $product)

                            <div class="col-md-3" style="width: 26%">
                                <div class="image">
                                    <img src="{{ asset('images/item.png') }}"  alt="{{ $product->name }}" class="img-responsive food-pic">
                                </div>
                                <div class="description">
                                    <b>{{ $product->name }}</b>

                                </div>
                                <div class="price">KES {{ $product->price }} </div>
                                <div class="buy">
                                    <form method="POST" action="{{ URL::to('addcart') }}" class="form-inline" role="form">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    </form>
                                    <a href="#" id="add" class="btn btn-primary order-food" data-id="{{ $product->id }}" data-product="{{ $product->name }}" data-price="{{ $product->price }}">Order now</a>
                                </div>
                            </div>
                        @endforeach
                    </div>


        </div>
    </div>



@endsection
