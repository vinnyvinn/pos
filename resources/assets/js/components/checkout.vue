<template>
            <div class="col-md-12 main">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="col-md-4">
                  <div class="list-group" v-for="payment_type in payment_types">
                      <a v-if="parseInt(customer.is_credit) == parseInt(payment_type.is_credit)" class="list-group-item" href="#" :id="payment_type.id" @click.prevent="paymentType">{{payment_type.name}}</a>
                  </div>
                </div>
                <div class="col-md-8">
                  <h4>{{payment_method.name}}</h4>
                  <table v-if="payment_method.slug == 'cash' && parseInt(customer.is_credit) == parseInt(payment_method.is_credit)" class="table">
                    <tbody>
                      <tr>
                        <td>Received Amount</td>
                        <td class=""><input v-model="received_amount" type="number" class="form-control input-sm text-right" onfocus="this.select()" autofocus/></td>
                      </tr>
                      <tr>
                        <td>Total Amount</td>
                        <td class="text-right"><input type="number"  class="form-control input-sm text-right" :value="total_inclusive" disabled/></td>
                      </tr>
                      <tr>
                        <td>Balance</td>
                        <td class="text-right">{{balance}}</td>
                      </tr>
                      <tr>
                        <td>Notes</td>
                        <td class="text-right"><textarea v-model="notes" class="form-control input-sm" rows="2"></textarea></td>
                      </tr>
                      <tr>
                        <td colspan="2" class="text-right">
                          <button type="button" class="btn btn-sm btn-info" @click.prevent="completeSale(payment_method.id)">Complete Sale</button>
                          <button type="button" class="btn btn-sm btn-danger" @click.prevent="back">Back</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <table v-if="payment_method.slug == 'm_pesa' && parseInt(customer.is_credit) == parseInt(payment_method.is_credit)" class="table">
                    <tbody>
                      <tr>
                        <td>Enter M-pesa Codes(separate with comas(,))</td>
                        <td class=""><input v-model="transaction_codes" type="text" class="form-control input-sm text-right" onfocus="this.select()" autofocus/></td>
                      </tr>
                      <tr>
                        <td>Total Amount</td>
                        <td class="text-right">KSH: {{total_inclusive}}</td>
                      </tr>
                      <tr>
                        <td>Notes</td>
                        <td class="text-right"><textarea v-model="notes" class="form-control input-sm" rows="2"></textarea></td>
                      </tr>
                      <tr>
                        <td colspan="2" class="text-right">
                          <button type="button" class="btn btn-sm btn-info" @click.prevent="completeSale(payment_method.id)">Complete Sale</button>
                          <button type="button" class="btn btn-sm btn-danger" @click.prevent="back">Back</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <table v-if="payment_method.slug == 'credit' && parseInt(customer.is_credit) == parseInt(payment_method.is_credit)" class="table">
                    <tbody>
                        <td>Total Amount</td>
                        <td class="text-right">KSH: {{total_inclusive}}</td>
                      </tr>
                      <tr>
                        <td>Notes</td>
                        <td class="text-right"><textarea v-model="notes" class="form-control input-sm" rows="2"></textarea></td>
                      </tr>
                      <tr>
                        <td colspan="2" class="text-right">
                          <button type="button" class="btn btn-sm btn-info" @click.prevent="completeSale(payment_method.id)">Complete Sale</button>
                          <button type="button" class="btn btn-sm btn-danger" @click.prevent="back">Back</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
</template>
<style scoped>
.main {
   margin-top:-50px
}
</style>
<script>
export default{
  data(){
    return {
        payment_method: this.customer.is_credit == 0 ? this.payment_types[0] : this.payment_types[2],
        received_amount:0,
        notes: "",
        transaction_codes: ""
    }
  },
  watch:{
    payment_method()
    {
      if(!parseInt(this.customer.is_credit) ==0) return this.payment_types[0];
      return this.payment_types[2];
    }
  },
  computed:{
    balance()
    {
      let balance = parseFloat(this.received_amount) - parseFloat(this.total_inclusive);
      if(parseFloat(balance) < 0) return "Amount Is Not Enough!";
      return balance;
    }
  },

  methods:{
    paymentType(e)
    {
        if (!e.target.id){
          console.log(this.payment_types[1]);
            localStorage.setItem('payment_method', this.payment_types[1].id);
          return this.payment_types[1];
        }
        let payment_method = this.payment_types.filter(payment_method=>{
                return parseInt(payment_method.id) == parseInt(e.target.id);
          })[0];

          this.payment_method = payment_method;
          localStorage.setItem('payment_method', payment_method.id);
    },
    completeSale(id)
    {
      this.$emit('paymentType', id, this.notes, this.transaction_codes);
    },
    back()
    {
      this.$emit('toggleCheckout');
    }

  },
  props: ['total_inclusive', 'payment_types', 'customer'],
}
</script>
