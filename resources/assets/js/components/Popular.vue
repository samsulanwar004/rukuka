<script>
    export default {
        created() {
            var self = this;
            $.get("/api/v1/popular", function(products) {
                if (products.status == 'Ok') {
                  self.products = products.data;
                }
              });
        },

        data() {
            return {
                products: {}
            }
        }
    }
</script>

<template>
    <div class="uk-grid-small uk-child-width-1-4@m uk-margin-large-bottom" uk-grid>
        <!-- start product -->
        <div class="uk-panel uk-text-left" v-for="product in products">
          <div class="uk-card uk-card-small uk-padding-remove">
              <div class="uk-card-media-top">
                  <img :src="'/'+ product.photo" :alt="product.name">

              </div>
              <div class="uk-card-body uk-padding-remove uk-margin-small-top">
                <a :href="'/product/'+ product.slug" class="uk-text-muted">{{ product.name }}</a>
                <br>
                <span class="uk-text-bold">{{ product.currency }}{{ product.price }}</span>
              </div>
              <!-- <div class="uk-card-footer">
                <span class="uk-text-meta">Shirt<h4 class="uk-card-price">$400</h4></span>
              </div> -->
          </div>
        </div>
        <!-- end product single -->
    </div>
</template>
