 <template>
  <div class="row main">
    <div class="col-md-12">
      <div class="pull-left" style="margin-left:20px">
        <button type="button" class="btn btn-sm btn-danger" @click.prevent="back">Back</button>
          <button type="button" class="btn btn-sm btn-info" @click.prevent="completeSale()">Complete Sale</button>
      </div>
    </div>
      <div class="col-md-12">
        <table style="border-style:none;">
          <tbody>
            <tr>
              <td><h5>Customer Name:  {{ customer.name }}</h5></td>
            </tr>
            <tr>
              <td><h5>Account Bal.: {{ customer.account_balance }}</h5></td>
            </tr>
          </tbody>
        </table>
        <div class="pull-right" style="margin-top:-50px;">
          <h5>Total Amount: {{ total_inclusive }}</h5>
              <h5><strong>Balance : {{ balance }}</strong></h5>
        </div>
      </div>

        <div class="col-md-6">
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
                  <td class="text-right">{{ parseFloat(tax.rate) > 0 ? Math.round(((parseFloat(100) - parseFloat(tax.rate))/parseFloat(100)) * parseFloat(total_inclusive)).toLocaleString('en-GB') : 0}}</td>
                  <td class="text-right">{{ parseFloat(tax.rate) > 0 ? Math.round((parseFloat(total_inclusive) - (((parseFloat(100) - parseFloat(tax.rate))/parseFloat(100)) * parseFloat(total_inclusive)))) : 0 }}</td>
                  <td class="text-right">{{parseFloat(tax.rate) > 0 ? total_inclusive.toLocaleString('en-GB') : 0}}</td>
              </tr>
              </tbody>
          </table>

          <div class="form-group">
            <label for="comment">Comment</label>
            <textarea id="comment" v-model="notes" class="form-control input-sm" rows="2"></textarea>
          </div>
        </div>
            <div class="col-md-6 payment-form">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>Cash</td>
                        <td class=""><input v-model="cash_amount" type="number" min="0" class="form-control input-sm text-right" onfocus="this.select()" autofocus/></td>
                      </tr>
                      <tr>
                        <td>Credit</td>
                        <td class=""><input v-model="credit_amount" type="number" min="0" class="form-control input-sm text-right" :disabled="!parseInt(customer.is_credit) == 1" /></td>
                      </tr>
                      <tr>
                        <td>M-PESA</td>
                        <td>
                          <div style="display:flex;" v-for="row in rows">
                            <div class="form-group">
                              <label v-if="parseInt(row.default) == 1">Code</label>
                              <input v-model="row.m_pesa_code" type="text" onfocus="this.select()" class="form-control input-sm text-right" style="width:200px; margin-right: 50px;"/>
                            </div>
                            <div class="form-group">
                              <label v-if="parseInt(row.default) == 1">Amount :</label>
                               <input v-model="row.m_pesa_amount" type="number" onfocus="this.select()" min="0" class="form-control input-sm text-right" style="width:150px; margin-right: 20px;"/>
                             </div>

                           <div class="form-group">
                              <button v-if="parseInt(row.default) == 1" @click.prevent="addMpesaField" class="btn btn-success btn-xs" style="margin-top:25px;"><i class="fa fa-plus"></i></button>
                              <button v-if="parseInt(row.default) == 0" @click.prevent="removeMpesaField(rows.indexOf(row))" class="btn btn-danger btn-xs" style="margin-top:5px;"><i class="fa fa-minus"></i></button>
                          </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
            </div>
          </div>
</template>
<style scoped>
.main {
   margin-top:-50px
}
.payment-form {
   margin-top:35px
}
</style>
<script>
export default {
  data() {
    return {
        cash_amount:0,
        credit_amount: this.customer.is_credit == 1 ? 0 : "",
        notes: "",
        transaction_codes: "",
        rows:
        [
          {
             m_pesa_code:"",
             m_pesa_amount:0,
             default: 1
          }
        ]
    }
  },
  watch: {

  },
  computed: {
    balance() {
      let m_pesa_total = this.rows.map(row => {
        return row.m_pesa_amount;
      }).reduce((a,b) => {
        return parseFloat(a) + parseFloat(b);
      });
      if(!parseFloat(m_pesa_total)) m_pesa_total = 0;
      if(!parseFloat(this.credit_amount))   this.credit_amount =0;
      let balance = (parseFloat(m_pesa_total) + parseFloat(this.cash_amount) + parseFloat(this.credit_amount)) - parseFloat(this.total_inclusive);
      // if(parseFloat(balance) < 0) return "Amount Is Not Enough!";
      return balance < 0 ? 0 : balance;
    },
    validateCompletion() {
      let m_pesa_total = this.rows.map(row => {
        return row.m_pesa_amount;
      }).reduce((a,b) => {
        return parseFloat(a) + parseFloat(b);
      });
      if(!parseFloat(m_pesa_total)) m_pesa_total = 0;
      if(!parseFloat(this.credit_amount))   this.credit_amount =0;
      let balance = (parseFloat(m_pesa_total) + parseFloat(this.cash_amount) + parseFloat(this.credit_amount)) - parseFloat(this.total_inclusive);
      // if(parseFloat(balance) < 0) return "Amount Is Not Enough!";
      return balance < 0 ? false : true;
    },
  },

  methods: {
    paymentType(e) {
        if (!e.target.id){
          console.log(this.payment_types[1]);
            localStorage.setItem('payment_method', this.payment_types[1].id);
          return this.payment_types[1];
        }
        let payment_method = this.payment_types.filter(payment_method=>{
                return parseInt(payment_method.id) == parseInt(e.target.id);
          })[0];

          this.payment_method = payment_method;
    },
    completeSale() {
      if(!this.validateCompletion){
          Messenger().post({
              message: "Please Complete Payment!",
              type: 'error',
              showCloseButton: true
          });
          return;
      }
      this.$emit('paymentType', this.cash_amount, this.rows, this.credit_amount, this.balance, this.notes);
    },
    back() {
      this.$emit('toggleCheckout');
    },

    addMpesaField() {
      return  this.rows.push({ m_pesa_code:"", m_pesa_amount: 0, default: 0});
    },

    removeMpesaField(row) {
      return  this.rows.splice(row,1);
    }

  },
  props: ['total_inclusive', 'payment_types', 'customer', 'taxes' , 'saleLines'],
}
</script>
