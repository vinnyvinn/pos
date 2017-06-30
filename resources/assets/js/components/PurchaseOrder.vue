<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Purchase Order</strong></h2>
                </div>
                <div class="widget-content padding">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="supplier_id">Supplier</label>
                            <select class="form-control" name="supplier_id" id="supplier_id">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stall_id">Stall</label>
                            <select class="form-control" name="stall_id" id="stall_id">
                                <option value="stall_id"></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="order_date">Order Date</label>
                            <input class="form-control" type="text" name="order_date" id="order_date">
                        </div>
                        <div class="form-group">
                            <label for="due_date">Due Date</label>
                            <input class="form-control" type="text" name="due_date" id="due_date">
                        </div>
                        <div class="form-group">
                            <label for="order_number">Order Number</label>
                            <input class="form-control" type="text" name="order_number" id="order_number" readonly>
                        </div>
                        <div class="form-group">
                            <label for="external_order_number">External Order Number</label>
                            <input class="form-control" type="text" name="external_order_number" id="external_order_number" readonly>
                        </div>
                    </div>
                    <br>
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th>Stock Item</th>
                            <th>UOM</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Excluded</th>
                            <th>Total Tax</th>
                            <th>Total Inclusive</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <select class="form-control" name="stock_item_id" id="stock_item_id">
                                <option value="">Stock Item</option>
                            </select></td>
                            <td>
                                <select class="form-control" name="uom" id="uom">
                                    <option value=""></option>
                                </select>
                            </td>
                            <td>
                                <input class="form-control" type="text" name="order_quantity" id="order_quantity">
                            </td>
                            <td>
                                <input class="form-control" type="text" name="" id="">
                            </td>
                            <td>
                                <input class="form-control" type="text" name="total_exclusive" id="total_exclusive">
                            </td>
                            <td>
                                <input class="form-control" type="text" name="" id="">
                            </td>
                            <td>
                                <input class="form-control" type="text" name="total_inclusive" id="total_inclusive">
                            </td>
                            <td>
                                <a href="" class="btn btn-success"><i class="fa fa-plus"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <br>
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th>Stock Item</th>
                            <th>UOM</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Exclusive</th>
                            <th>Total Tax</th>
                            <th>Total Inclusive</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <select class="form-control" name="" id="">
                                    <option value=""></option>
                                </select>
                            </td>
                            <td>
                                <input class="form-control "type="text" name="" id="">
                            </td>
                            <td>
                                <input class="form-control "type="text" name="" id="">
                            </td>
                            <td>
                                <input class="form-control "type="text" name="" id="">
                            </td>
                            <td>
                                <input class="form-control "type="text" name="" id="">
                            </td>
                            <td>
                                <input class="form-control "type="text" name="" id="">
                            </td>
                            <td>
                                <input class="form-control "type="text" name="" id="">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1"><select class="form-control" name="" id="">
                                <option value=""></option>
                            </select></td>
                            <td colspan="1"><select class="form-control" name="" id="">
                                <option value=""></option>
                            </select></td>
                            <td colspan="1"><input class="form-control "type="text" name="" id=""></td>
                            <td colspan="1"><input class="form-control "type="text" name="" id=""></td>
                            <td colspan="1"><input class="form-control "type="text" name="" id=""></td>
                            <td colspan="1"><input class="form-control "type="text" name="" id=""></td>
                            <td colspan="1"><input class="form-control "type="text" name="" id=""></td>
                        </tr>
                        <tr>
                            <td colspan="1"><select class="form-control" name="" id="">
                                <option value=""></option>
                            </select></td>
                            <td colspan="1"><select class="form-control" name="" id="">
                                <option value=""></option>
                            </select></td>
                            <td colspan="1"><input class="form-control "type="text" name="" id=""></td>
                            <td colspan="1"><input class="form-control "type="text" name="" id=""></td>
                            <td colspan="1"><input class="form-control "type="text" name="" id=""></td>
                            <td colspan="1"><input class="form-control "type="text" name="" id=""></td>
                            <td colspan="1"><input class="form-control "type="text" name="" id=""></td>
                        </tr>
                        <tr>
                        <td colspan="1"><select class="form-control" name="" id="">
                                <option value=""></option>
                            </select></td>
                            <td colspan="1"><select class="form-control" name="" id="">
                                <option value=""></option>
                            </select></td>
                            <td colspan="1"><input class="form-control "type="text" name="" id=""></td>
                            <td colspan="1"><input class="form-control "type="text" name="" id=""></td>
                            <td colspan="1"><input class="form-control "type="text" name="" id=""></td>
                            <td colspan="1"><input class="form-control "type="text" name="" id=""></td>
                            <td colspan="1"><input class="form-control "type="text" name="" id=""></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>