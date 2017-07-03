<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="container">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Purchase Order</strong></h2>
                </div>
                <div class="widget-content padding">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="supplier_id">Supplier</label>
                            <select class="form-control input-sm" name="supplier_id" id="supplier_id">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stall_id">Stall</label>
                            <select class="form-control input-sm" name="stall_id" id="stall_id">
                                <option value="stall_id"></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control input-sm" name="description" id="description" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="order_date">Order Date</label>
                            <input class="form-control input-sm" type="text" name="order_date" id="order_date">
                        </div>
                        <div class="form-group">
                            <label for="due_date">Due Date</label>
                            <input class="form-control input-sm" type="text" name="due_date" id="due_date">
                        </div>
                        <div class="form-group">
                            <label for="order_number">Order Number</label>
                            <input class="form-control input-sm" type="text" name="order_number" id="order_number" readonly>
                        </div>
                        <div class="form-group">
                            <label for="external_order_number">External Order Number</label>
                            <input class="form-control input-sm" type="text" name="external_order_number" id="external_order_number" readonly>
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
                        <tr v-for="orderLine in orderLines">
                            <td>
                                <!--<select class="form-control input-sm" name="stock_item_id" id="stock_item_id">-->
                                <!--<option value="">Stock Item</option>-->
                            <!--</select>-->
                                {{ orderLine.stock_item_id }}
                            </td>
                            <td>
                                <!--<select class="form-control input-sm" name="uom" id="uom">-->
                                    <!--<option value=""></option>-->
                                <!--</select>-->
                                {{ orderLine.uom }}
                            </td>
                            <td>
                                <!--<input class="form-control input-sm" type="text" name="order_quantity" id="order_quantity">-->
                                {{ orderLine.order_quantity }}
                            </td>
                            <td>
                                {{ orderLine.order_quantity }}
                            </td>
                            <td>
                                {{ orderLine.total_exclusive }}
                            </td>
                            <td>
                                {{ orderLine.order.total_tax }}
                            </td>
                            <td>
                                {{ orderLine.total_inclusive }}
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
                        <tr v-for="orderLine in orderLines">
                            <td>
                                <!--<select class="form-control input-sm" name="stock_item_id" id="stock_item_id">-->
                                <!--<option value="">Stock Item</option>-->
                                <!--</select>-->
                                {{ orderLine.stock_item_id }}
                            </td>
                            <td>
                                <!--<select class="form-control input-sm" name="uom" id="uom">-->
                                <!--<option value=""></option>-->
                                <!--</select>-->
                                {{ orderLine.uom }}
                            </td>
                            <td>
                                <!--<input class="form-control input-sm" type="text" name="order_quantity" id="order_quantity">-->
                                {{ orderLine.order_quantity }}
                            </td>
                            <td>
                                {{ orderLine.order_quantity }}
                            </td>
                            <td>
                                {{ orderLine.total_exclusive }}
                            </td>
                            <td>
                                {{ orderLine.order.total_tax }}
                            </td>
                            <td>
                                {{ orderLine.total_inclusive }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="pull-right" style="padding-bottom: 10px;">
                        <a href="" class="btn btn-success">Place Order</a>
                        <a href="" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                items: [],
                suppliers: [],
                uoms: [],
            };
        },
        created() {
          this.fetchData();
        },
        methods: {
            fetchData() {
                axios.get('/purchaseOrder/create')
                    .then(response => response.data)
                    .then(({ items, suppliers, uoms }) => {
                        this.items = items;
                        this.suppliers = suppliers;
                        this.uoms = uoms;
                    });
            },
        }
    }
</script>
