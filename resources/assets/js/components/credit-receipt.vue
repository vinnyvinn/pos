<template>
    <div class="row">
      <div class="text-center">
          <img :src="'/images/garden_grow.png'" style="width:20%" alt="">
        <h4>Gardens Grow.</h4>
        <h5>P.O. Box xxxx.</h5>
        <h5>Nairobi.</h5>
      </div>
      <div class="col-xs-12">
  <table class="table">
    <tbody>
      <tr>
        <td colspan="3" style="padding-left:-10px; text-align: left">
          <h5>{{ customer.name }}</h5>
      </td>
      <td colspan="3" class="text-right" style="padding-right:20px; text-align: right">
        <h5>{{ today.toLocaleDateString() +" "+ today.toLocaleTimeString('en-GB') }}</h5>
      </td>
      </tr>
      <tr>
          <th style="padding-left:-10px; text-align: left"> Item </th><th class="text-right"> QTY </th><th> UOM </th><th class="text-right">Price</th><th class="text-right">VAT</th><th style="padding-right:20px; text-align: right">Amount Icl</th>
      </tr>
      <tr v-for="saleline in saleLines">
          <td style="padding-left:-10px; text-align: left">{{ saleline.name }}</td>
          <td class="text-right">{{ saleline.quantity }}</td>
          <td>{{ saleline.uom }}</td>
          <td class="text-right">{{ (saleline.unitExclPrice.toFixed(2)).toLocaleString('en-GB') }}</td>
          <td class="text-right">{{ (saleline.totalTax.toFixed(2)).toLocaleString('en-GB') }}</td>
          <td style="padding-right: 20px; text-align: right">{{ (saleline.totalIncl.toFixed(2)).toLocaleString('en-GB') }}</td>
      </tr>
      <tr>
        <td style="padding-left: -10px; text-align: left; border-bottom-style: dotted;">
          <h6>Sub-total</h6>
          <h6>Discount</h6>
          <h4>TOTAL</h4>
        </td>
        <td colspan="5" style="padding-right: 20px; text-align: right; border-bottom-style: dotted;">
          <h6>{{ (total_inclusive.toFixed(2)).toLocaleString('en-GB') }}</h6>
          <h6>0.00</h6>
          <h4>{{ (total_inclusive.toFixed(2)).toLocaleString('en-GB') }}</h4>
        </td>
      </tr>
      <tr>
        <td style="padding-left: -10px; text-align: left; border-style: none">
          <h6 v-if="parseFloat(totalAmountMpesa) > parseFloat(0)">M-PESA: </h6>
              <div  class="text-center" v-if="parseFloat(totalAmountMpesa) > parseFloat(0)" v-for="pesa in mpesa">
                <strong>{{ pesa.m_pesa_code }}</strong><br/>
              </div>
          <h6>CASH</h6>
          <h6 v-if="parseInt(customer.is_credit) ==parseInt(1)">CREDIT : {{ customer.name }}</h6>
          <h6>CHANGE</h6>
        </td>
        <td colspan="5" style="padding-right: 20px; text-align: right; border-style: none;">
          <div v-if="parseFloat(totalAmountMpesa) > parseFloat(0)" style="margin-top:30px">
          <div v-if="parseFloat(totalAmountMpesa) > parseFloat(0)" v-for="pesa in mpesa">
            <strong>{{ pesa.m_pesa_amount }}</strong><br/>
          </div>
        </div>
          <h6>{{ (parseFloat(cash).toFixed(2)).toLocaleString('en-GB') }}</h6>
          <h6 v-if="parseInt(customer.is_credit) ==parseInt(1)">{{ (parseInt(credit).toFixed(2)).toLocaleString('en-GB') }}</h6>
          <h6>{{ (parseFloat(balance).toFixed(2)).toLocaleString('en-GB') }}</h6>
        </td>
      </tr>
      <tr><td style="padding-left: -10px; text-align: left" colspan="6"> TOTAL ITEMS: {{ saleLines.length }} </td></tr>
    </tbody>
  </table>
  <table class="table">
      <thead>
      <tr>
          <th class="text-nowrap">Code</th>
          <th class="text-nowrap">Rate</th>
          <th class="text-nowrap text-right" width="150px">Net AMT</th>
          <th class="text-nowrap text-right">VAT Amount</th>
          <th class="text-nowrap text-right">Total Amount</th>
      </tr>
      </thead>
      <tbody>
      <tr v-if="taxes.length" v-for="tax in taxes">
          <td>{{tax.code}}</td>
          <td>{{tax.rate}}%</td>
          <td class="text-right">{{ parseFloat(tax.rate) > 0 ? ((((parseFloat(100) - parseFloat(tax.rate))/parseFloat(100)) * parseFloat(total_inclusive)).toFixed(2)).toLocaleString('en-GB') : 0}}</td>
          <td class="text-right">{{ parseFloat(tax.rate) > 0 ? (((parseFloat(total_inclusive) - (((parseFloat(100) - parseFloat(tax.rate))/parseFloat(100)) * parseFloat(total_inclusive)))).toFixed(2)).toLocaleString('en-GB') : 0 }}</td>
          <td class="text-right">{{ parseFloat(tax.rate) > 0 ? (total_inclusive.toFixed(2)).toLocaleString('en-GB') : 0 }}</td>
      </tr>
      </tbody>
  </table>
</div>
</div>
</template>
<style scoped>
.row{
  margin-right: 30px;
  margin-right: 30px;
}

</style>
<script>
export default {
  data(){
    return {
      today: new Date()
    }
  },

  props: [ 'taxes', 'total_inclusive', 'balance', 'credit', 'cash', 'customer', 'saleLines', 'mpesa' ],

  computed: {
    totalAmountMpesa(){
    return this.mpesa.map(mpesa=>{
      return mpesa.m_pesa_amount;
    }).reduce((sum,value) => parseFloat(sum) + parseFloat(value));
    }
  }
}
</script>
