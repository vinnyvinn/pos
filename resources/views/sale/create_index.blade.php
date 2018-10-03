@extends('layouts.app')
@section('content')
    <form action="{{route('cart-details')}}" method="post">
        {{csrf_field()}}

<div class="panel panel-default">
    <div class="panel panel-heading">Menu</div>
    <div class="panel panel-body">
        <div class="row">

          @foreach($products as $product)
            <div class="col-md-3">
                <label for="">{{$product->name}}</label>
                <a class="add-to-cart" href="#" name="name" data-name="name" data-price="{{$product->price}}"><img data-name="product_image" src="http://placehold.it/250x150/2aabd2/ffffff?text=Product+5" alt="...">{{$product->name}} KES{{$product->price}}</a>
            </div>
            @endforeach


        </div>
        {{$products->links()}}
    </div>
    <button type="submit" class="btn btn-success btn-block checkout-form" name="submit">Checkout</button>

</div>

</div>

<div class="row">

    <div class="col-md-8 cart-banner">
        <ul id="show-cart" class="list-group">
            <li class="list-group-item">???????</li>
        </ul>


    <div>You have <span id="count-cart">X</span> items in your cart</div>
    <div>Total Cart:$<span id="total-cart"></span></div>
        <button id="clear-cart" class="btn btn-danger btn-sm">Clear Cart</button>

    </div>
</div>

</div>
    </form>


@endsection
