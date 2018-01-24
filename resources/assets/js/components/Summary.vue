<template>
<div class="uk-width-1-4@m">
 <div class="uk-card uk-card-border uk-card-default uk-card-small">
    <div class="uk-card-header">
       <h4>SUMMARY</h4>
    </div>
    <div class="uk-card-body">
       <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
          <div class="uk-text-small"><b>SUBTOTAL</b></div>
          <div class="uk-text-right">{{ subtotal | round }}</div>
          <input type="hidden" id="sub_total" :value="subtotal">
       </div>
       <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
          <div class="uk-text-small">Shipping Cost</div>
          <div id="shiping_fee" class="uk-text-right">{{ shipping_cost | round }}</div>
       </div>
    </div>
    <div class="uk-card-footer">
       <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
          <div> <h5>TOTAL</h5> </div>
          <div id="total_fee" class="uk-text-right">{{ total | round }}</div>
       </div>
    </div>
 </div>
 <div class="uk-panel uk-margin-small-top">
    <button class="uk-button uk-button-danger uk-width-1-1" id="continue">CONTINUE</button>
 </div>
</div>
</template>

<script>
    export default {
        props :['shipping_cost'],
        data () {
            return {
                subtotal: {},
                total: {}
            }
        },

        created () {
            var self = this;
            var shipping_cost = parseFloat(this.shipping_cost.replace(/,/g, ''));
            Event.listen('bags', function (response) {
              var subtotal = parseFloat(response.data.subtotal.replace(/,/g, ''));
              self.subtotal = subtotal;
              self.total = Number(subtotal) + Number(shipping_cost);
            });

        },

        methods: {
          money: function(n, currency) {
            return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
          }
        },

        filters: {
          round: function(value) {
            var money = function(n, currency) {
              return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
            };
            
            return money(Number(Math.round(value+'e'+2)+'e-'+2), '$');
          }
        }
    }
</script>
