<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="container">
                <div class="widget">
                    <div class="widget-header">
                        <h2><strong>Purchase Order</strong></h2>
                    </div>
                    <div class="widget-content padding">
                        <form :action="'/purchaseOrder/' + id" method="POST" @submit="validateForm">
                            <input type="hidden" name="_token" :value="csrf">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="supplier_id">Supplier</label>
                                    <select v-model="order.supplier_id" class="form-control input-sm" name="supplier_id" id="supplier_id" required>
                                        <option value="disabled">Select Supplier</option>
                                        <option v-for="supplier in suppliers" :value="supplier.id">{{supplier.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="stall_id">Stall</label>
                                    <select v-model="order.stall_id" class="form-control input-sm" name="stall_id" id="stall_id" required>
                                        <option value="disabled">Select Supplier</option>
                                        <option v-for="stall in stalls" :value="stall.id">{{stall.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea v-model="order.description" class="form-control input-sm" name="description" id="description" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="order_date">Order Date</label>
                                    <input v-model="order.order_date" class="form-control input-sm datepicker" type="text" name="order_date" id="order_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="due_date">Due Date</label>
                                    <input v-model="order.due_date" class="form-control input-sm datepicker" type="text" name="due_date" id="due_date">
                                </div>
                                <div class="form-group">
                                    <label for="order_number">Order Number</label>
                                    <input v-model="order.order_number" class="form-control input-sm" type="text" name="order_number" id="order_number">
                                </div>
                                <div class="form-group">
                                    <label for="external_order_number">External Order Number</label>
                                    <input v-model="order.external_order_number" class="form-control input-sm" type="text" name="external_order_number" id="external_order_number">
                                </div>
                            </div>
                            <br>
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th class="text-nowrap">Stock Item</th>
                                    <th class="text-nowrap">UOM</th>
                                    <th class="text-nowrap" width="120px">Quantity</th>
                                    <th class="text-nowrap" width="150px">Unit Excl. Price</th>
                                    <th class="text-nowrap" width="150px">Unit Incl. Price</th>
                                    <th class="text-nowrap text-right">Total Exclusive</th>
                                    <th class="text-nowrap text-right">Total Tax</th>
                                    <th class="text-nowrap text-right">Total Inclusive</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr >
                                    <td>
                                        <select v-model="itemId" class="form-control input-sm" name="stockItem" required>
                                            <option value="null" disabled>Select Item</option>
                                            <option v-for="item in items" :value="item.id">{{ item.code }} - {{ item.name }}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select v-model="conversionId" class="form-control input-sm" name="conversion_id" required>
                                            <option value="null" disabled>Select Conversion</option>
                                            <option v-for="conversion in conversions" :value="conversion.id">{{ conversion.name }}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input min="1" v-model="quantity" onfocus="this.select()" class="form-control input-sm" type="number" name="quantity" required>
                                    </td>
                                    <td>
                                        <input step="0.01" min="0" @keydown="entry('unitExclPrice')" onfocus="this.select()" class="form-control input-sm" v-model="unitExclPrice" type="number" name="unit_excl_price">
                                    </td>
                                    <td>
                                        <input step="0.01" min="0" @keydown="entry('unitInclPrice')" onfocus="this.select()" class="form-control input-sm" v-model="unitInclPrice" type="number" name="unit_incl_price">
                                    </td>
                                    <td class="text-right">
                                        {{ totalExcl.toLocaleString('en-GB') }}
                                    </td>
                                    <td class="text-right">
                                        {{ totalTax.toLocaleString('en-GB') }}
                                    </td>
                                    <td class="text-right">
                                        {{ totalIncl.toLocaleString('en-GB') }}
                                    </td>
                                    <td>
                                        <button @click.prevent="addToOrder" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <br>
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th class="text-nowrap">Stock Item</th>
                                    <th class="text-nowrap">UOM</th>
                                    <th class="text-nowrap text-right" width="120px">Quantity</th>
                                    <th class="text-nowrap text-right" width="150px">Unit Excl. Price</th>
                                    <th class="text-nowrap text-right" width="150px">Unit Incl. Price</th>
                                    <th class="text-nowrap text-right">Total Exclusive</th>
                                    <th class="text-nowrap text-right">Total Tax</th>
                                    <th class="text-nowrap text-right">Total Inclusive</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="orderLine in orderLines">
                                    <td>{{ orderLine.code }} - {{ orderLine.name }}</td>
                                    <td>{{ orderLine.uom }}</td>
                                    <td class="text-right">{{ parseFloat(orderLine.quantity).toLocaleString('en-GB') }}</td>
                                    <td class="text-right">{{ parseFloat(orderLine.unitExclPrice).toLocaleString('en-GB') }}</td>
                                    <td class="text-right">{{ parseFloat(orderLine.unitInclPrice).toLocaleString('en-GB') }}</td>
                                    <td class="text-right">{{ parseFloat(orderLine.totalExcl).toLocaleString('en-GB') }}</td>
                                    <td class="text-right">{{ parseFloat(orderLine.totalTax).toLocaleString('en-GB') }}</td>
                                    <td class="text-right">{{ parseFloat(orderLine.totalIncl).toLocaleString('en-GB') }}</td>
                                    <td>
                                        <button @click.prevent="editLine(orderLine)" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button>
                                        <button @click.prevent="deleteLine(orderLine)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <input type="hidden" name="lines" :value="JSON.stringify(orderLines)">
                            <br>
                            <div class="pull-right" style="padding-bottom: 10px;">
                                <button type="submit" class="btn btn-success">Place Order</button>
                                <a href="/purchaseOrder/" class="btn btn-danger">Back</a>
                            </div>
                        </form>
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
                fromback: '',
                unitExclPrice: 0,
                unitInclPrice: 0,
                itemId: null,
                currentEntry: null,
                quantity: 1,
                conversionId: null,
                order: {},

                items: [],
                suppliers: [],
                uoms: [],
                orderLines: [],
                stalls: [],
                csrf: window.Laravel.csrfToken
            };
        },
        created() {
            this.fetchData();
        },
        computed: {
            stockItem() {
                let item = this.items.filter(item => item.id == this.itemId);
                if (item.length) {
                    return item[0];
                }

                return {
                    buying_tax: {},
                    conversions: [],
                };
            },
            selectedUOM() {
                if (this.conversionId != 'null' && this.conversionId) {
                    return this.uoms[this.conversionId];
                }

                return {};
            },
            conversions() {
                let conversions = [];
                if (! this.stockItem.id) return conversions;

                conversions.push(this.uoms[this.stockItem.stocking_uom]);

                this.stockItem.conversions.forEach(conversion => {
                    conversions.push(this.uoms[conversion.converted_unit_id]);
                });

                if (conversions.length) {
                    this.conversionId = conversions[0].id;
                }

                return conversions;
            },
            totalExcl() {
                return parseFloat(this.unitExclPrice) * parseInt(this.quantity);
            },
            totalIncl() {
                return parseFloat(this.unitInclPrice) * parseInt(this.quantity);
            },
            totalTax() {
                return this.totalIncl - this.totalExcl;
            },

        },
        mounted() {
            setTimeout(() => {

            }, 1000);
        },
        watch: {
            unitExclPrice(price) {
                if (this.currentEntry != 'unitExclPrice') return;
                price = parseFloat(price);
                let rate = this.stockItem.buying_tax.rate;
                if (! rate) {
                    this.unitInclPrice = price;
                    return;
                }

                rate = (100 + parseFloat(rate));
                this.unitInclPrice = (Math.round(rate * price))/100;
            },
            unitInclPrice(price) {
                if (this.currentEntry != 'unitInclPrice') return;
                price = parseFloat(price);
                let rate = this.stockItem.buying_tax.rate;
                if (! rate) {
                    this.unitExclPrice = price;
                    return;
                }

                rate = (100 + parseFloat(rate))/100;
                this.unitExclPrice = (Math.round((price/rate) * 100))/100;
            },
        },
        props: ['id'],
        methods: {
            entry(value) {
                this.currentEntry = value;
            },
            fetchData() {
                axios.get('/purchaseOrder/'+ this.id +'/edit')
                    .then(response => response.data)
                    .then(({ items, suppliers, uoms, stalls, order }) => {
                        this.items = items;
                        this.suppliers = suppliers;
                        this.uoms = uoms;
                        this.stalls = stalls;
                        this.order = order;
                        this.order.supplier_id = this.order.account_id;
                        this.order.lines.forEach(line => {
                            this.orderLines.push({
                                id: line.id,
                                code: line.code,
                                name: line.name,
                                itemId: line.stock_item_id,
                                taxId: line.tax_id,
                                taxRate: line.tax_rate,
                                uom: this.getUOM(line.uom).name,
                                conversionId: line.uom,
                                quantity: line.order_quantity,
                                unitExclPrice: line.unit_exclusive,
                                unitInclPrice: line.unit_inclusive,
                                totalExcl: line.total_exclusive,
                                totalIncl: line.total_inclusive,
                                totalTax: line.unit_tax,
                            });
                        });
                    });
            },
            getUOM(id) {
                return this.uoms[id];
            },
            validateForm(e) {
                if (! this.orderLines.length) {
                    e.preventDefault();

                    Messenger().post({
                        message: 'Please add at least one order item.',
                        type: 'error',
                        showCloseButton: true
                    });
                }
            },
            addToOrder() {
                //TODO: make sure itemId and conversionId != 'null'
                if (this.itemId == 'null' || !this.itemId) {
                    Messenger().post({
                        message: 'Please select an item',
                        type: 'error',
                        showCloseButton: true
                    });
                    return;
                }
                this.orderLines.push({
                    code: this.stockItem.code,
                    name: this.stockItem.name,
                    itemId: this.itemId,
                    taxId: this.stockItem.buying_tax.id,
                    taxRate: this.stockItem.buying_tax.rate,
                    uom: this.selectedUOM.name,
                    conversionId: this.conversionId,
                    quantity: this.quantity,
                    unitExclPrice: this.unitExclPrice,
                    unitInclPrice: this.unitInclPrice,
                    totalExcl: this.totalExcl,
                    totalIncl: this.totalIncl,
                    totalTax: this.totalTax,
                });

                this.itemId = 'null';
                this.conversionId = 'null';
                this.quantity = 1;
                this.unitExclPrice = 0;
                this.unitInclPrice = 0;
            },
            deleteLine(line) {
                this.orderLines.splice(this.orderLines.indexOf(line), 1);
            },
            editLine(line) {
                this.unitExclPrice = line.unitExclPrice;
                this.unitInclPrice = line.unitInclPrice;
                this.itemId = line.itemId;
                this.quantity = line.quantity;
                this.conversionId = line.conversionId;
                this.deleteLine(line);
            },
            updateOrder() {

            }
        }
    }
</script>