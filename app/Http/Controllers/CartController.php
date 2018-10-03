<?php

namespace App\Http\Controllers;

use App\MenuDetail;
use Illuminate\Http\Request;
use App\ProductSubcategory;
use Session;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cartData = $request->session()->get('cart');

        $cart = [];
        $sum = 0;
        if ($request->session()->has('cart')) {
            foreach ($cartData as $key => $value) {
                //dd($key);
                $product = ProductSubcategory::where('id', '=', $key)->get()->toArray();
                //dd($product);
                $cart_item['item'] = $product['0'];
                $cart_item['total_price'] = $value['qty'] * $product['0']['price'];
                $cart_item['qty'] = $value['qty'];
                $sum = $sum + $cart_item['total_price'];
                array_push($cart, $cart_item);


            }
        }
        return view('sale.view_cart')->with('cart', $cart)->with('sum', $sum);
    }

    public function postAdd(Request $request)
    {
        $id = $request->input('product_id');
        $session = $request->session();
        $cartData = ($session->get('cart')) ? $session->get('cart') : array();
        if (array_key_exists($id, $cartData)) {
            $cartData[$id]['qty']++;
        } else {
            $cartData[$id] = array(
                'qty' => 1
            );
        }
        $request->session()->put('cart', $cartData);
        return redirect()->back()->with('message', 'Product Added Successfully!');
    }

    public function ajaxAdd(Request $request)
    {
        $id = $request->input('product_id');
        $session = $request->session();
        $cartData = ($session->get('cart')) ? $session->get('cart') : array();
        if (array_key_exists($id, $cartData)) {
            $cartData[$id]['qty']++;
        } else {
            $cartData[$id] = array(
                'qty' => 1
            );
        }
        $request->session()->put('cart', $cartData);

        //return redirect()->back()->with('message', 'Product Added Successfully!');
        return response()->json(['msg' => $id], 200);
    }

    public function delete($id, Request $request)
    {

        $session = $request->session();
        $cartData = $session->get('cart');

        if (array_key_exists($id, $cartData)) {
            unset($cartData[$id]);
        }
        $request->session()->put('cart', $cartData);
        $cartTotal = 0;
        foreach ($cartData as $cartItem) {
            $cartTotal = $cartTotal + $cartItem['qty'];
        }

        $request->session()->put('total', $cartTotal);


        return back();
    }

    function updateCartQuantity($quantity, $cart_id)
    {
        $id = request()->get('product_id');
        $session = request()->session();
        $cartData = ($session->get('cart')) ? $session->get('cart') : array();
        if (array_key_exists($cart_id, $cartData)) {
            $cartData[$id]['qty']++;
        } else {
            $cartData[$cart_id] = array(
                'qty' => $quantity
            );
        }
        request()->session()->put('cart', $cartData);

        return response()->json(['msg' => $cart_id], 200);
    }

    public function checkOut()

    {

        if (request()->get('amount') < request()->get('total')) {

            Session::flash('warning', 'Please Enter amount first to proceed');
            return redirect()->back();
        }

        $cartData = request()->session()->get('cart');
        if (request()->session()->has('cart')) {
            foreach ($cartData as $key => $value) {
                $product = ProductSubcategory::where('id', '=', $key)->get()->toArray();

                MenuDetail::create([
                    'item_id' => $key,
                    'quantity' => $value['qty'],
                    'unit_price' => $product['0']['price'],
                    'sub_total' => $value['qty'] * $product['0']['price'],
                    'item_name' => $product['0']['name']
                ]);

            }
        }
        Session::flash('success', 'You successfully placed an order');
        return redirect('receipt');

    }

    public function printReceipt()
    {
        $cartData = request()->session()->get('cart');
        $cart = [];
        $sum = 0;
        if (request()->session()->has('cart')) {
            foreach ($cartData as $key => $value) {
                $product = ProductSubcategory::where('id', '=', $key)->get()->toArray();
                $cart_item['item'] = $product['0'];
                $cart_item['total_price'] = $value['qty'] * $product['0']['price'];
                $cart_item['qty'] = $value['qty'];
                $sum = $sum + $cart_item['total_price'];
                array_push($cart, $cart_item);


            }
        }
        return view('sale.menu-receipt')->with('cart', $cart)->with('sum', $sum);
    }

}
