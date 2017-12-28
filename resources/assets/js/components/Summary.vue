<template>
<div class="uk-width-1-4@m">
 <div class="uk-card uk-card-border uk-card-default uk-card-small">
    <div class="uk-card-header">
       <h4>SUMMARY</h4>
    </div>
    <div class="uk-card-body">
       <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
          <div class="uk-text-small"><b>SUBTOTAL</b></div>
          <div id="sub_total" class="uk-text-right">{{ subtotal | round }}</div>
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
            var shipping_cost = this.shipping_cost;
            Event.listen('bags', function (response) {
              var subtotal = response.data.subtotal;
              self.subtotal = subtotal;
              self.total = Number(subtotal) + Number(shipping_cost);
            });

        },

        filters: {
          round: function(value) {
            return Number(Math.round(value+'e'+2)+'e-'+2);
          }
        }
    }
</script>
