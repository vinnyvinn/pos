<template>
 <div class="panel panel-default">
     <div class="panel-heading">
         <div class="row">
         <div class="col-xs-6">
                 CASH - CASH CUSTOMER
         </div>
     </div>
   </div>
     <div class="panel-body">
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
                             <option v-if="stock" v-for="stock_item in stock" :value="stock_item.id">{{stock_item.name}}</option>
                     </select></td>
                    <td>
                      <select v-model="conversionId" class="form-control input-sm" name="conversion_id" required>
                        <option value="null" disabled>Select Conversion</option>
                        <option v-for="conversion in conversions" :value="conversion.id">{{ conversion.name }}</option>
                      </select>
                    </td>
                    <td>
                      <input type="number" class="form-control input-sm" v-model="quantity" required/>
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
                    <td v-if="conversionId && totalIncl && stockItem">
                      <button @click.prevent="addSaleLine" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
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
                           <td>{{sale.name}}</td>
                           <td>{{sale.uom}}</td>
                           <td class="text-right">{{sale.quantity}}</td>
                           <td class="text-right">{{sale.unitExclPrice}}</td>
                           <td class="text-right">{{sale.unitInclPrice}}</td>
                           <td class="text-right">{{sale.totalExcl}}</td>
                           <td class="text-right">{{sale.totalTax}}</td>
                           <td class="text-right">{{sale.totalIncl}}</td>
                           <td>
                               <button @click.prevent="editSale(sale)" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button>
                               <button @click.prevent="deleteSale(sale)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                           </td>
                       </tr>
                       <tr v-if="salesLines.length">
                         <td colspan="4" class = "text-right"><strong>Total Sale Amount:</strong> {{total_sale.toLocaleString('en-GB')}}</td>
                         <td colspan="5"><button type="button" class="btn btn-info btn-sm pull-right" @click.prevent="completeSale(salesLines)">Complete Sale</button></td>
                       </tr>
                       </tbody>
                   </table>
         </div>
     </div>
   </template>
   <script>
   export default{
     data(){
       return{
          stock:[],
          salesLines:[],
          stockItem:"",
          quantity: 1,
          uoms:[],
          conversionId:null
       }
     },
     created(){
       this.getStock();
     },
     methods:{
       getStock(){
         axios.get('/sale/create').then(response=>{

            this.uoms = response.data.uoms;

            let stock = response.data.stock;
            stock = stock.map(item => {
              item.stock = item.stock[0].quantity_on_hand;
              item.selling_tax = item.selling_tax.rate;
              return item;
            });

            this.stock = stock;
         }).catch(response=>{
           console.log(response.data);
         }
         );
       },
       addSaleLine(){
    
           this.salesLines.push(
             {
             id: this.stockItem,
             name: this.selected_stockItem.name,
             uom: this.conversionId,
             quantity: this.quantity,
             unitExclPrice: this.unitExclPrice.toLocaleString('en-GB'),
             unitInclPrice: this.unitInclPrice.toLocaleString('en-GB'),
             totalExcl: this.totalExcl.toLocaleString('en-GB'),
             totalIncl: this.totalIncl.toLocaleString('en-GB'),
             totalTax: this.totalTax.toLocaleString('en-GB')
             });
           this.stockItem = "";
           this.conversionId = "";
           this.quantity = 1;
      },
      editSale(sale){
          if (sale) {
            this.stockItem = sale.id ;
            this.conversionId = sale.uom;
            this.quantity = sale.quantity;
            this.deleteSale(sale);
          }
      },
      deleteSale(sale){
        this.salesLines.splice(this.salesLines.indexOf(sale), 1);
      },
      completeSale(salesLines){
        axios.post('/sale',salesLines).then(response=>{
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
            setTimeout(function(){
                  window.location.href="/sale";
            },100);
          }
          console.log(response.data);
        }).catch(response=>{
          console.log(response.data);
        });
      }
     },
     computed:{
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

         conversions.push(this.uoms[this.selected_stockItem.selling_uom]);
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

      total_sale(){
        if(!this.salesLines.length) return 0;
        let total = this.salesLines.map(t=>{
            return t.totalIncl;
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
