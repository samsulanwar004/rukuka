<template>
<div class="uk-width-1-3@m">
 <div class="uk-card uk-card-default uk-card-small uk-box-shadow-small">
    <div class="uk-card-header">
       <h4 class="uk-text-uppercase">{{ trans.summary }}</h4>
    </div>
    <div class="uk-card-body">
        <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid v-if="youSave > 0">
          <div class="uk-text-small"><h6 class="uk-text-danger">{{ trans.you_save }}</h6></div>
          <div class="uk-text-right uk-text-danger">{{ youSave | round(exchangeRate.symbol, exchangeRate.value) }}</div>
        </div>
       <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
         <div class="uk-text-small"><h6 class="uk-text-uppercase">{{ trans.subtotal }}</h6></div>
         <div class="uk-text-right">{{ subtotal | round(exchangeRate.symbol, exchangeRate.value) }}</div>
          <input type="hidden" id="sub_total" :value="subtotal">
          <input type="hidden" id="currency" :value="exchangeRate.symbol">
          <input type="hidden" id="rate" :value="exchangeRate.value">
       </div>
       <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
          <div class="uk-text-small"><h6 class="uk-text-uppercase">{{ trans.shipping_cost_label }}</h6></div>
          <div id="shiping_fee" class="uk-text-right">{{ shipping_cost | round(exchangeRate.symbol, exchangeRate.value) }}</div>
       </div>
    </div>
    <div class="uk-card-footer">
       <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
          <div class="uk-text-uppercase"> <h4><b>{{ trans.total }}</b></h4> </div>
          <div id="total_fee" class="uk-text-right"><h4>{{ total | round(exchangeRate.symbol, exchangeRate.value) }}</h4></div>
       </div>
    </div>
    <div class="uk-card-footer">
       <button class="uk-button uk-button-secondary uk-width-1-1" id="continue">{{ trans.continue }}</button>
    </div>
 </div>

</div>
</template>

<script>
    export default {
        props :['shipping_cost','locale'],
        data () {
            return {
                subtotal: {},
                total: {},
                trans: JSON.parse(this.locale,true),
                exchangeRate: {},
                youSave: {}
            }
        },

        created () {
            var self = this;

            Event.listen('exchange', function (response) {
              self.exchangeRate = response.data.data;
            });

            var shipping_cost = parseFloat(this.shipping_cost.replace(/,/g, ''));
            Event.listen('bags', function (response) {
              var subtotal = parseFloat(response.data.subtotal.replace(/,/g, ''));
              self.subtotal = subtotal;
              self.total = Number(subtotal) + Number(shipping_cost);
              self.youSave = response.data.discount;
            });

        },

        filters: {
          round: function(value, currency, rate) {
            var value = value / rate;
            var money = function(n, currency) {
              return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
            };

            return money(Number(Math.round(value+'e'+2)+'e-'+2), currency);
          }
        }
    }
</script>
