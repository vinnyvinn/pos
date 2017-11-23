<template>
    <div>
        <section class="step" data-step-title="Item Details">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name" class="control-label">Item Name</label>
                        <input type="text" placeholder="A4 Book" class="form-control" id="name" name="name" required v-model="item.name">
                    </div>

                    <div class="form-group">
                        <label for="code" class="control-label">Item Code</label>
                        <input type="text" placeholder="C001" class="form-control" id="code" name="code" required v-model="item.code">
                    </div>

                    <div class="form-group">
                        <label for="barcode" class="control-label">Barcode</label>
                        <input type="text" placeholder="Leave blank to autogenerate" class="form-control" id="barcode" name="barcode" v-model="item.barcode">
                    </div>

                    <div class="form-group">
                        <label for="description" class="control-label">Description</label>
                        <textarea rows="5" class="form-control" id="description" name="description" v-model="item.description"></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="buying_tax" class="control-label">Purchasing Tax Type</label>

                        <select name="buying_tax" id="buying_tax" class="form-control" v-model="item.buying_tax">
                            <option v-for="tax in taxes" :value="tax.id">{{ tax.code }} - {{ tax.rate }}%</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="selling_tax" class="control-label">Invoice & Orders Tax Type</label>

                        <select name="selling_tax" id="selling_tax" class="form-control" v-model="item.selling_tax">
                            <option v-for="tax in taxes" :value="tax.id">{{ tax.code }} - {{ tax.rate }}%</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="credit_note_tax" class="control-label">Credit Note Tax Type</label>

                        <select name="credit_note_tax" id="credit_note_tax" class="form-control" v-model="item.credit_note_tax">
                            <option v-for="tax in taxes" :value="tax.id">{{ tax.code }} - {{ tax.rate }}%</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="stocking_uom" class="control-label">Stocking Unit of Measure</label>

                        <select v-model="item.stocking_uom" name="stocking_uom" id="stocking_uom" class="form-control">
                            <option v-for="uom in uoms" :value="uom.id">{{ uom.name }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="is_active" v-model="item.is_active"> Is Active?
                            </label>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="step" data-step-title="Conversions">
            <div class="row">
                <div class="col-sm-12">

                    <div class="form-group">
                        <label for="has_conversions" class="control-label">Does Item have Conversions</label>

                        <select @change="validateConversions" v-model="item.has_conversions" name="has_conversions" id="has_conversions" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    <div class="form-group" v-if="item.has_conversions == '1'">
                        <label for="selling_uom" class="control-label">Default Selling Unit of Measure</label>

                        <select v-model="item.selling_uom" name="selling_uom" id="selling_uom" class="form-control">
                            <option v-for="uom in uoms" :value="uom.id">{{ uom.name }}</option>
                        </select>
                    </div>

                    <div class="row" v-if="item.has_conversions == '1'">
                        <div class="col-sm-12">
                            <h3><strong>Conversions</strong></h3>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="unit_a_quantity">Stocking Quantity</label>
                                <input min="1" id="unit_a_quantity" onclick="this.select()" v-model="currentConversion.unit_a_quantity" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="stocking_unit">Stocking Unit</label>
                                <input type="text" id="stocking_unit" class="form-control" :value="stockingUnit ? stockingUnit.name : ''" readonly>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="unit_b_quantity">Other Unit Qty.</label>
                                <input id="unit_b_quantity" required min="1" onclick="this.select()" v-model="currentConversion.unit_b_quantity" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="unit_b_id">Other Unit</label>
                                <select id="unit_b_id" v-model="currentConversion.unit_b_id" class="form-control">
                                    <option v-for="uom in conversionUOMs" :value="uom.id">{{ uom.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="unit_b_id">Add Conversion</label>
                                <button @click.prevent="addConversion()" class="btn btn-success btn-block"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

                    <div v-if="item.has_conversions == '1'" class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">Quantity A of</th>
                                <th class="text-center">Stocking Unit</th>
                                <th class="text-center">=</th>
                                <th class="text-center">Quantity B of</th>
                                <th class="text-center">Converted Unit</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(conversion, index) in conversions">
                                <td><input required min="1" onclick="this.select()" v-model="conversion.unit_a_quantity" type="number" class="form-control" number></td>
                                <td><input type="text" class="form-control" :value="stockingUnit ? stockingUnit.name : ''" readonly></td>
                                <td><strong>=</strong></td>
                                <td><input required min="1" onclick="this.select()" v-model="conversion.unit_b_quantity" type="number" class="form-control" number></td>
                                <td>
                                    <select v-model="conversion.unit_b_id" class="form-control">
                                        <option v-for="uom in conversionUOMs" :value="uom.id">{{ uom.name }}</option>
                                    </select>
                                </td>
                                <td>
                                    <a href="#" @click.prevent="deleteConversion(conversion)" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="conversions" :value="stringConversions">
                </div>
            </div>
        </section>
        <section class="step" data-step-title="Pricing">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="unit_cost" class="control-label">Average Unit Cost</label>
                        <input type="number" step="0.01" v-model="item.unit_cost" title="Numeric with optional decimal" pattern="[0-9\.]+$" class="form-control" id="unit_cost" name="unit_cost" required>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-12">
                    <h4>Enter the respective inclusive prices for the stock item.</h4>
                    <div class="table-responsive">
                        <table class="table" width="100%">
                            <thead>
                            <tr>
                                <th class="text-center">Price List</th>
                                <th>
                                    <select v-model="item.stocking_uom" class="form-control input-sm" readonly>
                                        <option v-for="uom in uoms" :value="uom.id">{{ uom.name }}</option>
                                    </select>
                                </th>
                                <th class="text-center" v-for="conversion in conversions">
                                    <select v-model="conversion.unit_b_id" class="form-control input-sm" readonly>
                                        <option v-for="uom in uoms" :value="uom.id">{{ uom.name }}</option>
                                    </select>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="list in priceLists">
                                <td>{{ list.name }}</td>
                                <td>
                                    <input type="text" :name="'prices[price_' + list.id + '][unit_' + item.stocking_uom + ']'"
                                           v-model="convertedPriceLists['price_' + list.id]['unit_' + item.stocking_uom].inclusive_price"
                                           placeholder="125" title="Numeric with optional decimal" pattern="[0-9\.]+$"
                                           class="form-control input-sm" onclick="this.select()" required>
                                </td>
                                <td v-for="conversion in conversions">
                                    <input type="text" :name="'prices[price_' + list.id + '][unit_' + conversion.unit_b_id + ']'"
                                           v-model="convertedPriceLists['price_' + list.id]['unit_' + conversion.unit_b_id].inclusive_price"
                                           placeholder="125" title="Numeric with optional decimal" pattern="[0-9\.]+$"
                                           class="form-control input-sm" onclick="this.select()" required>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.initializeVariables();
        },
        props: ['id'],
        data() {
            return {
                currentConversion: {
                    unit_a_quantity: 1,
                    unit_b_quantity: 1,
                    unit_b_id: 0,
                },
                uoms: [],
                taxes: [],
                priceLists: [],
                conversions: [],
                convertedPriceLists: {},
                item: {
                    name: '',
                    code: '',
                    barcode: '',
                    description: '',
                    buying_tax: 1,
                    selling_tax: 1,
                    credit_note_tax: 1,
                    stocking_uom: '',
                    selling_uom: '',
                    has_conversions: 0,
                    is_active: true,
                    unit_price: 0,
                    unit_cost: ''
                }
            };
        },
        computed: {
            stockingUnit() {
                return this.uoms.filter((uom) => {
                    return this.item.stocking_uom == uom.id;
                })[0];
            },

            conversionUOMs() {
                let units = JSON.parse(JSON.stringify(this.uoms));
                units.splice(this.uoms.indexOf(this.stockingUnit), 1);

                return units;
            },

            stringConversions() {
                return JSON.stringify(this.conversions);
            },
        },
        watch: {
            conversions() {
                this.updatePLs();
            },
            priceLists() {
                this.updatePLs();
            },
            stockingUnit() {
                this.updatePLs();
            },
        },

        methods: {
            updatePLs() {
                this.priceLists.forEach(price => {
                    if (! this.convertedPriceLists['price_' + price.id]) {
                        this.convertedPriceLists['price_' + price.id] = {};
                    }

                    if (! this.convertedPriceLists['price_' + price.id]['unit_' + this.item.stocking_uom]) {
                        this.convertedPriceLists['price_' + price.id]['unit_' + this.item.stocking_uom] = {
                            'price_list_name_id': price.id,
                            'unit_conversion_id': this.item.stocking_uom,
                            'inclusive_price': 0,
                            'exclusive_price': 0,
                            'tax': 0
                        };
                    }

                    this.conversions.forEach(conversion => {
                        if (! this.convertedPriceLists['price_' + price.id]['unit_' + conversion.unit_b_id]) {
                            this.convertedPriceLists['price_' + price.id]['unit_' + conversion.unit_b_id] = {
                                'price_list_name_id': price.id,
                                'unit_conversion_id': conversion.unit_b_id,
                                'inclusive_price': 0,
                                'exclusive_price': 0,
                                'tax': 0
                            };
                        }
                    });
                });
            },

            validateConversions() {
                if (this.item.has_conversions == 0) {
                    this.conversions = [];
                }
            },

            deleteConversion(conversion) {
                this.conversions.splice(this.conversions.indexOf(conversion), 1);
            },

            addConversion() {
                if (! this.currentConversion.unit_b_id) {
                    Messenger().post({
                        message: 'Please select the unit to convert to.',
                        type: 'error',
                        showCloseButton: true
                    });
                    return;
                }
                this.conversions.push(this.currentConversion);
                this.currentConversion = {
                    unit_a_quantity: 1,
                    unit_b_quantity: 1,
                    unit_b_id: 0,
                };
            },

            initializeVariables() {
                if (this.id) {
                    return this.initializeEdit();
                }

                axios.get('/stockItem/create')
                    .then((response) => {
                        if (response.status == 200) {
                            return response.data;
                        }

                        throw new Error('unable to complete request');
                    })
                    .then((response) => {
                        let defaultUOM = response.uoms.filter((item) => {
                            return item.system_install;
                        })[0];
                        this.uoms = response.uoms;
                        this.item.stocking_uom = defaultUOM.id;
                        this.item.selling_uom = defaultUOM.id;
                        this.taxes = response.taxes;
                        this.priceLists = response.priceLists;
                    });
            },

            initializeEdit() {
                axios.get('/stockItem/' + this.id + '/edit')
                    .then((response) => {
                        if (response.status == 200) {
                            return response.data;
                        }

                        throw new Error('unable to complete request');
                    })
                    .then((response) => {
                        let defaultUOM = response.uoms.filter((item) => {
                            return item.system_install;
                        })[0];
                        this.uoms = response.uoms;
                        this.item.stocking_uom = defaultUOM.id;
                        this.item.selling_uom = defaultUOM.id;
                        this.taxes = response.taxes;
                        this.priceLists = response.priceLists;

                        this.item = response.item;

                        this.priceLists.forEach(price => {
                            if (! this.convertedPriceLists['price_' + price.id]) {
                                this.convertedPriceLists['price_' + price.id] = {};
                            }
                        });


                        this.item.prices.forEach(price => {
                            let conversion = {};
                            conversion.price_list_name_id = price.price_list_name_id;
                            conversion.unit_conversion_id = price.unit_conversion_id;
                            conversion.inclusive_price = price.inclusive_price;
                            conversion.exclusive_price = price.exclusive_price;
                            conversion.tax = price.tax;
                            this.convertedPriceLists['price_' + price.price_list_name_id]['unit_' + price.unit_conversion_id] = conversion;
                        });


                        this.item.conversions.forEach(conversion => {
                            this.conversions.push({
                                unit_a_quantity: conversion.stocking_ratio,
                                unit_b_id: conversion.converted_unit_id,
                                unit_b_quantity: conversion.converted_ratio,
                            });
                        });
                    });
            },

        }
    }
</script>
