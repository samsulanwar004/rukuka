<template>
<div class="uk-width-1-4@m">
 <div class="uk-card uk-card-border uk-card-default uk-card-small">
    <div class="uk-card-header">
       <b>SUMMARY</b>
    </div>
    <div class="uk-card-body">
       <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
          <div class="uk-text-small"><b>SUBTOTAL</b></div>
          <div class="uk-text-right">{{ subtotal }}</div>
       </div>
       <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
          <div class="uk-text-small">Shipping Cost</div>
          <div class="uk-text-right">FREE</div>
       </div>
       <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
          <div class="uk-text-small">Tax</div>
          <div class="uk-text-right">FREE</div>
       </div>
    </div>
    <div class="uk-card-footer">
       <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
          <div><b>TOTAL</b></div>
          <div class="uk-text-right">{{ subtotal }}</div>
       </div>
    </div>
 </div>
 <div class="uk-panel uk-margin-small-top">
    <a href="#" class="uk-button uk-button-small uk-button-danger uk-width-1-1" id="continue">C O N T I N U E</a>
 </div>
 <hr>
 <div class="uk-card uk-card-default uk-card-border uk-card-small">
    <div class="uk-card-header">
       PROMO CODE
    </div>
    <div class="uk-card-body">
    </div>
 </div>
</div>
</template>

<script>
    export default {
        data () {
            return {
                subtotal: {}
            }
        },

        created () {
            var self = this;
            Event.listen('bags', function (response) {
                self.subtotal = response.data.subtotal;
            });
        }
    }
</script>
