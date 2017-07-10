<template>
  <div class="row">
      <div class="col-sm-12">
          <div class="container">
              <div class="widget">
                  <div class="widget-header">
                      <h2><strong>Sales</strong></h2>
                  </div>
                  <form @submit.prevent="validateForm">
                  <div class="widget-content padding">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="customer_id">Customers</label>
                                  <select class="form-control input-sm" v-model="customer_id" name="customer_id" id="customer_id" required>
                                      <option value="null" disabled>Select a Customer</option>
                                      <option v-for="customer in customers" :value="customer.id">{{customer.name}}</option>
                                  </select>
                              </div>
                              </div>
                          <div class="col-sm-6">
                            <h4 class="text-right"><strong>Total</strong></h4>
                            <h2 class="text-right">{{ total_inclusive.toLocaleString('en-GB') }}</h2>
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

                   </tr>
                 </thead>
                 <tbody>
                 <tr>
                    <td>
                      <select class="form-control input-sm" id="stock_item" v-model="stockItem">
                             <option value="">select Item</option>
                             <option v-if="stock" v-for="stock_item in stock" :value="stock_item.id">{{stock_item.code+" "+stock_item.name}}</option>
                     </select></td>
                    <td>
                      <select v-model="conversionId" class="form-control input-sm" name="conversion_id" required>
                        <option value="null" disabled>Select Conversion</option>
                        <option v-for="conversion in conversions" :value="conversion.id">{{ conversion.name }}</option>
                      </select>
                    </td>
                    <td>
                      <input type="number" onfocus="this.select()" class="form-control input-sm" v-model="quantity" required/>
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
                      <button @click.prevent="validateSaline" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
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
                       <tr v-if="salesLines.length" v-for="sale in salesLines">
                           <td>{{sale.code+' '+sale.name}}</td>
                           <td>{{sale.uom}}</td>
                           <td class="text-right">{{sale.quantity}}</td>
                           <td class="text-right">{{sale.unitExclPrice.toLocaleString('en-GB')}}</td>
                           <td class="text-right">{{sale.unitInclPrice.toLocaleString('en-GB')}}</td>
                           <td class="text-right">{{sale.totalExcl.toLocaleString('en-GB')}}</td>
                           <td class="text-right">{{sale.totalTax.toLocaleString('en-GB')}}</td>
                           <td class="text-right">{{sale.totalIncl.toLocaleString('en-GB')}}</td>
                           <td>
                               <button @click.prevent="editSale(sale)" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button>
                               <button @click.prevent="deleteSale(sale)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                           </td>
                       </tr>
                       <tr>
                        <td colspan="9"><button type="submit" class="btn btn-info btn-sm pull-right" @click.prevent="validateForm">Complete Sale</button></td>
                       </tr>
                       </tbody>
                   </table>
         </div>
           </form>
     </div>
   </div>
 </div>
 </div>
   </template>
   <script>
   export default{
     data(){
       return{
          stock:[],
          customer_id: null,
          description: "",
          customers: [],
          salesLines: [],
          stockItem: "",
          quantity: 1,
          uoms:[],
          conversionId: null
       }
     },

     created(){
       this.getStock();
     },

     methods:{
       getStock(){
         axios.get('/sale/create').then(response=>{

            this.uoms = response.data.uoms;
            this.customers = response.data.customers;
            let stock = response.data.stock;
            stock = stock.map(item => {
              item.stock = item.stock[0].quantity_on_hand;
              item.selling_tax = item.selling_tax.rate;
              return item;
            });

            this.stock = stock;
         }).catch(response=>{
           console.log(response.data);
         });
       },

       validateSaline(){
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
         if ( !this.quantity || parseFloat(this.quantity) < 1) {
             Messenger().post({
                 message: "Quantity Should be greater than One!",
                 type: 'error',
                 showCloseButton: true
             });
             return;
         }
         this.addSaleLine();
       },

       addSaleLine(){
           this.salesLines.push(
             {
             id: this.stockItem,
             name: this.selected_stockItem.name,
             code: this.selected_stockItem.code,
             tax_rate: this.selected_stockItem.selling_tax,
             unit_conversion_id: this.conversionId,
             uom: this.uom,
             quantity: this.quantity,
             unitExclPrice: this.unitExclPrice,
             unitInclPrice: this.unitInclPrice,
             totalExcl: this.totalExcl,
             totalIncl: this.totalIncl,
             totalTax: this.totalTax
             });
           this.stockItem = "";
           this.conversionId = "";
           this.quantity = 1;
      },
      editSale(sale){
          if (sale) {
            this.stockItem = sale.id ;
            this.conversionId = sale.unit_conversion_id;
            this.quantity = sale.quantity;
            this.deleteSale(sale);
          }
      },

      deleteSale(sale){
        this.salesLines.splice(this.salesLines.indexOf(sale), 1);
      },

      validateForm(){
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
        this.completeSale();
      },

      completeSale(){
        axios.post('/sale',{
          salesLines: this.salesLines,
          customer_id: this.customer_id,
          description: this.description,
          total_inclusive: this.total_inclusive,
          total_exclusive: this.total_exclusive,
          total_tax: this.sale_total_tax,
        }).then(response=>{
          if(response.data.error){
            Messenger().post({
                message: response.data.error,
                type: 'error',
                showCloseButton: true
            });
          }
          if (response.data.message) {
            Messenger().post({
                message: response.data.message,
                type: 'success',
                showCloseButton: true
            });
            this.salesLines = [];
          }
          console.log(response.data);
        }).catch(response=>{
          console.log(response.data);
        });
      }
     },

     computed:{
       uom(){
         if (!this.conversionId) return null;
         return this.conversions.filter(conversion=>{
           return conversion.id == this.conversionId;
         }).map(conversion=>{
           return conversion.name;
         })[0];
       },
       total_price(){
         return (parseFloat(this.quantity)* parseFloat(this.selected_stockItem.unit_cost))
                +(parseFloat(this.quantity)* parseFloat(this.selected_stockItem.selling_tax.rate));
       },

       selected_stockItem(){
         if (this.stockItem) {
           let selectedStockItem = this.stock.filter(stki=>{
              return  stki.id == this.stockItem;
           });
           return selectedStockItem[0];
         }
       },

     conversions() {

         let conversions = [];
          if (! this.selected_stockItem) return conversions;
         if (! this.selected_stockItem.id) return conversions;

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
      //  console.log(this.selected_stockItem.prices);
       if (!this.selected_stockItem) return 0;
         let price = parseFloat(this.selected_stockItem.prices.filter(p=> p.unit_conversion_id == this.conversionId).
         map(prc =>{
           return prc.inclusive_price;
         })[0]);
         return price;
     },
    unitExclPrice() {
       if (!this.selected_stockItem) return 0;
       let rate = this.selected_stockItem.selling_tax;
       if (! rate) {
           this.unitInclPrice;
           return;
       }
      let price = parseFloat(this.unitInclPrice);
       rate = (100 - parseFloat(rate));
       return (Math.round(rate * price))/100;
      },
      totalExcl() {
          return parseFloat(this.unitExclPrice) * parseInt(this.quantity);
      },

      totalIncl() {
          return parseFloat(this.unitInclPrice) * parseInt(this.quantity);
      },

      totalTax() {
          return  this.totalIncl - this.totalExcl;
      },


      total_inclusive(){
        if(!this.salesLines.length) return 0;
        let total = this.salesLines.map(t=>{
            return t.totalIncl;
          }).reduce((s,t)=>{
            return parseFloat(s) + parseFloat(t);
          });
          return total;
      },
      total_exclusive(){
        if(!this.salesLines.length) return 0;
        let total = this.salesLines.map(t=>{
            return t.totalExcl;
          }).reduce((s,t)=>{
            return parseFloat(s) + parseFloat(t);
          });
          return total;
      },
      sale_total_tax(){
        if(!this.salesLines.length) return 0;
        let total = this.salesLines.map(t=>{
            return t.totalTax;
          }).reduce((s,t)=>{
            return parseFloat(s) + parseFloat(t);
          });
          return total;
      },

   },

     watch: {

     }
   }
   </script>
