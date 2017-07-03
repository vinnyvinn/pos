@extends('layouts.app')

@section('content')
    @component('components.page-header')
    @slot('icon')
        fa fa-building
    @endslot
    @slot('header')
        Stalls
    @endslot
    Manage the stalls.
    @endcomponent

 <div class="panel panel-default">
     <div class="panel-heading">
         <div class="row">
         <div class="col-xs-6">
                 CASH - CASH CUSTOMER

                 <button class="btn btn-xs btn-info pull-right">CHANGE CUSTOMER</button>

         </div>
         <div class="col-xs-6">
                <strong> Credit Limit: </strong>

                 <strong class="pull-right">Account Balance: </strong>

         </div>
         </div>
     </div>
     <div class="panel-body">
             <table class="table">
                 <thead>
                 <tr>
                    <th>CODE</th>
                    <th>DESCRIPTION</th>
                    <th>IN STOCK</th>
                    <th>UOM</th>
                    <th>QUANTITY</th>
                    <th>UNIT PRICE</th>
                    <th>DISCOUNT</th>
                    <th>TOTAL PRICE</th>
                 </tr>
                 </thead>
                 <tbody>
                 <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                 </tr>
                 </tbody>
             </table>
         </div>
     </div>
@endsection