<template>
    <div id="parent" >
        <div class="row" id="sale">
            <div class="col-sm-12">
                <div class="container">
                    <div class="widget">
                        <form @submit.prevent="validateForm">
                            <div class="widget-content padding">
                                <div v-if="!checkout_toggle" class="col-sm-6">
                                    <div class="form-group">
                                        <label for="customer_id">Customers</label>
                                        <select class="form-control input-sm" v-model="customer_id" name="customer_id"
                                                id="customer_id" value="" required>
                                            <option v-for="customer in customers" :value="customer.id">
                                                {{customer.name}}
                                            </option>
                                        </select>
                                    </div>
                                    <div>
                                        <v-select v-model="selected"
                                                  :on-change="changedProduct"
                                                  :options="multiselctopts"></v-select>

                                    </div>
                                </div>
                                <div v-if="!checkout_toggle" class="col-sm-6">
                                    <h4 class="text-right"><strong>Total</strong></h4>
                                    <h2 class="text-right">{{ total_inclusive.toLocaleString('en-GB') }}</h2>
                                </div>
                                <br>
                                <table v-if="!checkout_toggle" class="table table-responsive">
                                    <thead>
                                    <tr>
                                        <th class="text-nowrap">UOM</th>
                                        <th class="text-nowrap" width="120px">Quantity</th>
                                        <th class="text-nowrap" width="150px">Unit Excl. Price</th>
                                        <th class="text-nowrap" width="150px">Unit Incl. Price</th>
                                        <th class="text-nowrap text-right">Total Exclusive</th>
                                        <th class="text-nowrap text-right">Total Tax</th>
                                        <th class="text-nowrap text-right">Total Inclusive</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <select v-model="conversionId" class="form-control input-sm"
                                                    name="conversion_id" required>
                                                <option value="null" disabled>Select Conversion</option>
                                                <option v-for="conversion in conversions" :value="conversion.id">
                                                    {{ conversion.name }}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" onfocus="this.select()" class="form-control input-sm"
                                                   v-model="quantity" min="0" required/>
                                        </td>
                                        <td class="text-right">
                                            {{unitExclPrice.toLocaleString('en-GB')}}
                                        </td>
                                        <td class="text-right">
                                            {{unitInclPrice.toLocaleString('en-GB')}}
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
                                            <button @click.prevent="validateSaline" class="btn btn-success btn-xs"><i
                                                    class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <br>
                                <table v-if="!checkout_toggle" class="table table-responsive">
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
                                    <tr v-if="salesLines.length" v-for="sale in salesLines">
                                        <td>{{sale.code + ' ' + sale.name}}</td>
                                        <td>{{sale.uom}}</td>
                                        <td class="text-right">{{sale.quantity}}</td>
                                        <td class="text-right">{{sale.unitExclPrice.toLocaleString('en-GB')}}</td>
                                        <td class="text-right">{{sale.unitInclPrice.toLocaleString('en-GB')}}</td>
                                        <td class="text-right">{{sale.totalExcl.toLocaleString('en-GB')}}</td>
                                        <td class="text-right">{{sale.totalTax.toLocaleString('en-GB')}}</td>
                                        <td class="text-right">{{sale.totalIncl.toLocaleString('en-GB')}}</td>
                                        <td>
                                            <button @click.prevent="editSale(sale)" class="btn btn-xs btn-info"><i
                                                    class="fa fa-pencil"></i></button>
                                            <button @click.prevent="deleteSale(sale)" class="btn btn-xs btn-danger"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <checkout v-if="checkout_toggle" :taxes=taxes :saleLines=salesLines :customer=customer
                                          :payment_types=payment_types :total_inclusive=total_inclusive
                                          @paymentType="validateForm" @toggleCheckout="setCheckout"></checkout>
                            </div>
                        </form>
                        <div v-if="!checkout_toggle" class="widget-header" style="margin-left:25px; margin-top:20px">
                            <button type="submit" class="btn btn-info btn-sm" @click.prevent="setCheckout">Checkout
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div id="receipt" v-if="receipt">
            <receipt :total_inclusive=total_inclusive :taxes=taxes :balance=balance :credit=credit :cash=cash
                     :mpesa=mpesa :customer=customer :saleLines=salesLines></receipt>
        </div>
    </div>
</template>
<script>
    import checkout from './checkout.vue';
    import receipt from './credit-receipt.vue';
    import Multiselect from 'vue-multiselect'
    import vSelect from 'vue-select'

    export default {
        data() {
            return {
                receipt: false,
                stock: [],
                customer_id: 1,
                description: "",
                customers: [],
                salesLines: [],
                stockItem: "",
                quantity: 1,
                uoms: [],
                conversionId: null,
                quantity_check: [],
                checkout_toggle: false,
                cash: "",
                notes: "",
                credit: "",
                mpesa: "",
                balance: "",
                taxes: null,

                //extra
                searchitem: '',
                products: [],
                uomvals: [],
                multiselctopts: [],
                selected: ''


            }
        },

        created() {
            this.getStock();

        },


        watch: {
            searchitem() {
                this.filterProducts();
            }

        },

        methods: {
            changedProduct(obj) {
                this.stockItem = obj.value;
            },
            setCheckout() {
                if (!this.customer_id) {
                    Messenger().post({
                        message: "Select a Customer!",
                        type: 'error',
                        showCloseButton: true
                    });
                    return;
                }
                if (!this.salesLines.length) {
                    Messenger().post({
                        message: "No Sale Has Been Made!",
                        type: 'error',
                        showCloseButton: true
                    });
                    return;
                }
                return this.checkout_toggle = !this.checkout_toggle;

            },
            getStock() {
                axios.get('/sale/create').then(
                    (response) => {
                        this.uoms = response.data.uoms;
                        this.customers = response.data.customers;
                        this.payment_types = response.data.payment_types;
                        this.taxes = response.data.taxes;
                        let stock = response.data.stock;
                        stock = stock.map(item => {
                            item.stock = (item.stock[0]) ? item.stock[0].quantity_on_hand : null;
                            item.selling_tax = (item.selling_tax) ? item.selling_tax.rate : null;
                            return item;
                        });
                        this.stock = stock;
                        console.log(response);
                        this.products = response.data.products;
                        this.multiselctopts = [];
                        stock.forEach((val) => {
                            this.multiselctopts.push({label: val.name, value: val.id})
                        });
                    }
                ).catch((err) => {
                    console.log(err);
                });
            },
            filterProducts() {
                let prod = [];
                this.products.forEach((val) => {
                    if (val.name == this.searchitem) {
                        prod = val;
                    }
                });

                this.stockItem = prod.id;

            },

            validateSaline() {
                if (!this.stockItem) {
                    Messenger().post({
                        message: "Please Select A product!",
                        type: 'error',
                        showCloseButton: true
                    });
                    return;
                }
                if (!this.conversionId) {
                    Messenger().post({
                        message: "Please Select A Conversion!",
                        type: 'error',
                        showCloseButton: true
                    });
                    return;
                }
                if (!this.quantity || parseFloat(this.quantity) < 0.001) {
                    Messenger().post({
                        message: "Quantity Should be greater than One!",
                        type: 'error',
                        showCloseButton: true
                    });
                    return;
                }
                if (this.uom_checker(this.selected_stockItem, this.conversionId, this.quantity)) {
                    this.addQuantity(this.selected_stockItem, this.uom_checker(this.selected_stockItem, this.conversionId, this.quantity));
                }
                else {
                    this.addQuantity(this.selected_stockItem, this.quantity);
                }
                let item_sold = this.quantity_check.filter(stock => {
                    return stock.id == this.selected_stockItem.id;
                })[0];
                if (parseFloat(this.selected_stockItem.stock) < parseFloat(item_sold.quantity)) {
                    Messenger().post({
                        message: "Quantity Exceeds Amount In Stock!",
                        type: 'error',
                        showCloseButton: true
                    });
                    item_sold.quantity = parseFloat(item_sold.quantity) - parseFloat(item_sold.addedquantity);
                    return;
                }
                this.addSaleLine();
            },

            addSaleLine() {
                let existingSale = this.salesLines.filter(saleLine => {
                    return saleLine.id == this.stockItem && saleLine.unit_conversion_id == this.conversionId
                })[0];
                let quantity = this.quantity;
                if (existingSale) {
                    existingSale.quantity = parseFloat(existingSale.quantity) + parseFloat(this.quantity);
                    existingSale.totalExcl = parseFloat(existingSale.totalExcl) + parseFloat(this.totalExcl);
                    existingSale.totalIncl = parseFloat(existingSale.totalIncl) + parseFloat(this.totalIncl);
                    existingSale.totalTax = parseFloat(existingSale.totalTax) + parseFloat(this.totalTax);
                    this.stockItem = "";
                    this.conversionId = "";
                    this.quantity = 1;

                    return existingSale;
                }

                this.salesLines.unshift({
                    id: this.stockItem,
                    name: this.selected_stockItem.name,
                    code: this.selected_stockItem.code,
                    tax_rate: this.selected_stockItem.selling_tax,
                    unit_conversion_id: this.conversionId,
                    uom: this.uom,
                    has_conversions: this.selected_stockItem.has_conversions,
                    conversions: this.selected_stockItem.conversions,
                    quantity: quantity,
                    unitExclPrice: this.unitExclPrice,
                    unitInclPrice: this.unitInclPrice,
                    totalExcl: this.totalExcl,
                    totalIncl: this.totalIncl,
                    totalTax: this.totalTax,
                });

                let sale = {
                    id: this.stockItem,
                    unit_conversion_id: this.conversionId,
                    quantity: this.quantity,
                    has_conversions: this.selected_stockItem.has_conversions,
                    conversions: this.selected_stockItem.conversions

                };
                //  this.uom_checker(this.selected_stockItem, this.conversionId);
                this.stockItem = "";
                this.conversionId = "";
                this.quantity = 1;

            },

            editSale(sale) {
                if (sale) {
                    this.stockItem = sale.id;
                    this.conversionId = sale.unit_conversion_id;
                    this.quantity = sale.quantity;
                    this.deleteSale(sale);
                }
            },

            deleteSale(sale) {
                this.salesLines.splice(this.salesLines.indexOf(sale), 1);
                let sale_to_be_edited = this.quantity_check.filter(s => {
                    return s.id == sale.id
                })[0];

                if (this.deleteSaleQuantity(sale)) {
                    return sale_to_be_edited.quantity = parseFloat(sale_to_be_edited.quantity) - parseFloat(this.deleteSaleQuantity(sale));
                }

                return sale_to_be_edited.quantity = parseFloat(sale_to_be_edited.quantity) - parseFloat(sale.quantity);
            },

            validateForm(cash, mpesa, credit, balance, notes) {
                if (!this.customer_id) {
                    Messenger().post({
                        message: "Select a Customer!",
                        type: 'error',
                        showCloseButton: true
                    });
                    return;
                }
                if (!this.salesLines.length) {
                    Messenger().post({
                        message: "Please Make A Sale First!",
                        type: 'error',
                        showCloseButton: true
                    });
                    return;
                }
                console.log(mpesa);
                this.credit = credit;
                this.notes = notes;
                this.mpesa = mpesa;
                this.cash = cash;
                this.balance = balance;
                this.receipt = true;
                this.completeSale();
            },

            preparePrint() {

                $('#sale').hide();
                $('#button-menu-mobile').hide();
                $('#left-menu').hide();
                $('#receipt').show();

            },

            restorePrint() {
                $('#button-menu-mobile').show();
                $('#left-menu').show();
                $('#sale').show();
                $('#receipt').hide();
            },

            completeSale() {
                axios.post('/sale', {
                    salesLines: this.salesLines,
                    customer_id: this.customer_id,
                    description: this.description,
                    total_inclusive: this.total_inclusive,
                    total_exclusive: this.total_exclusive,
                    total_tax: this.sale_total_tax,
                    cash: this.cash,
                    credit: this.credit,
                    notes: this.notes,
                    mpesa: this.mpesa,
                    balance: this.balance
                }).then(response => {
                    if (response.data.message) {
                        this.preparePrint();
                        this.customer_id = 1;

                        window.print();
                        this.restorePrint();
                    }
                }).then(r => {

                    this.receipt = false;
                    this.salesLines = [];
                    this.checkout_toggle = !this.checkout_toggle;
                    this.cash = 0;
                    this.credit = 0;
                    this.notes = "",
                        this.mpesa = [];
                    this.balance = 0;
                    this.quantity_check = [];
                    this.quantity = 1;
                }).catch(response => {

                });

            },
            addQuantity(sale, quantity) {
                let stock = this.quantity_check.filter(stock => {
                    return stock.id == sale.id
                });
                if (stock.length) {
                    let sum = parseFloat(stock[0].quantity) + parseFloat(quantity);
                    stock[0].quantity = sum;
                    stock[0].addedquantity = quantity;
                }
                else {
                    this.quantity_check.push({id: sale.id, quantity: quantity, addedquantity: quantity});
                }
            },
            deleteSaleQuantity(sale) {
                if (!sale) return false;
                if (!sale.has_conversions || !sale.conversions.length) return false;
                let quantity_c = sale.conversions.filter(stk => {
                    return stk.stock_item_id == sale.id && stk.converted_unit_id == sale.unit_conversion_id;
                });
                // console.log(quantity_c);
                if (!quantity_c.length) return false;
                let quantity_to_delete = parseFloat(sale.quantity) * (parseFloat(quantity_c[0].converted_ratio) / parseFloat(quantity_c[0].stocking_ratio));
                return quantity_to_delete;
            },
            uom_checker(saleLine, conversion_id, quantity) {
                if (!saleLine) return false;
                if (!saleLine.has_conversions || !saleLine.conversions.length) return false;
                let quantity_c = saleLine.conversions.filter(stk => {
                    return stk.stock_item_id == saleLine.id && stk.converted_unit_id == conversion_id;
                });
                if (!quantity_c.length) return false;
                let quantity_to_add = parseFloat(quantity) * (parseFloat(quantity_c[0].converted_ratio) / parseFloat(quantity_c[0].stocking_ratio));
                return quantity_to_add;
            }
        },

        computed: {
            customer() {
                if (!this.customer_id) return null;
                return this.customers.filter(customer => {
                    return customer.id == this.customer_id;
                })[0];
            },
            uom() {
                if (!this.conversionId) return null;
                return this.conversions.filter(conversion => {
                    return conversion.id == this.conversionId;
                }).map(conversion => {
                    return conversion.name;
                })[0];
            },
            total_price() {
                return (parseFloat(this.quantity) * parseFloat(this.selected_stockItem.unit_cost))
                    + (parseFloat(this.quantity) * parseFloat(this.selected_stockItem.selling_tax.rate));
            },

            selected_stockItem() {
                if (this.stockItem) {
                    let selectedStockItem = this.stock.filter(stki => {
                        return stki.id == this.stockItem;
                    });
                    return selectedStockItem[0];
                }
            },

            conversions() {
                let conversions = [];
                if (!this.selected_stockItem) return conversions;
                if (!this.selected_stockItem.id) return conversions;

                conversions.push(this.uoms[this.selected_stockItem.stocking_uom]);
                this.selected_stockItem.conversions.forEach(conversion => {
                    conversions.push(this.uoms[conversion.converted_unit_id]);
                });

                if (conversions.length) {
                    this.conversionId = conversions[0].id;
                }

                return conversions;
            },
            unitInclPrice() {
                if (!this.selected_stockItem) return 0;
                let price = parseFloat(this.selected_stockItem.prices.filter(p => p.unit_conversion_id == this.conversionId).map(prc => {
                    return prc.inclusive_price;
                })[0]);
                return price;
            },
            unitExclPrice() {
                if (!this.selected_stockItem) return 0;
                let rate = this.selected_stockItem.selling_tax;
                if (!rate) {
                    this.unitInclPrice;
                    return;
                }
                let price = parseFloat(this.unitInclPrice);
                rate = (100 - parseFloat(rate));
                return (Math.round(rate * price)) / 100;
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

            total_inclusive() {
                if (!this.salesLines.length) return 0;
                let total = this.salesLines.map(t => {
                    return t.totalIncl;
                }).reduce((s, t) => {
                    return parseFloat(s) + parseFloat(t);
                });
                return total;
            },
            total_exclusive() {
                if (!this.salesLines.length) return 0;
                let total = this.salesLines.map(t => {
                    return t.totalExcl;
                }).reduce((s, t) => {
                    return parseFloat(s) + parseFloat(t);
                });
                return total;
            },
            sale_total_tax() {
                if (!this.salesLines.length) return 0;
                let total = this.salesLines.map(t => {
                    return t.totalTax;
                }).reduce((s, t) => {
                    return parseFloat(s) + parseFloat(t);
                });
                return total;
            }

        },
        components: {
            checkout,
            receipt,
            vSelect
//            Multiselect,
        }
    }
</script>

