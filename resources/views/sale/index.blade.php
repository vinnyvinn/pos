@extends('layouts.app')

@section('content')
    @component('components.page-header')
    @slot('icon')
        fa fa-dollar
    @endslot
    @slot('header')
        Sales
    @endslot

    @endcomponent
    <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
              <div class="col-xs-6 clearfix">
                  <button class="btn btn-sm btn-success">Complete Sale</button>
                  <button class="btn btn-sm btn-info">Save Transaction</button>
                  <button class="btn btn-sm btn-danger">Void Sale</button>
              </div>
              <div class="col-xs-6">
                <table class="table pull-right">
                  <thead>
                    <tr>
                    <th>
                      Discount
                    </th>
                    <th>
                      Sale Total
                    </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>0.00</td>
                        <td>0.00</td>
                    </tr>
                    <tr>
                        <td colspan="2">Total Weight:0.00KGs</td>
                    </tr>
                  </tbody>
                </table>
              </div>
          </div>
        </div
    </div>


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
