<template>
  <div class="uk-grid-small uk-child-width-1-4@m uk-child-width-1-2 uk-margin-large-bottom" uk-grid>
    <!-- start product -->
    <div class="uk-panel uk-text-left uk-margin-small-bottom" v-for="product in products">
      <div class="uk-card uk-card-small uk-padding-remove">
        <div class="uk-card-media-top uk-inline-clip uk-transition-toggle">
          <a :href="'/product/'+ product.slug">
            <img :src="'/'+ product.photo" :alt="product.name">
          </a>
          <div class="uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-default uk-visible@m">
            <div class="uk-text-center">
              <a href="#modal-overflow" class="uk-button uk-button-small uk-button-secondary" uk-toggle v-on:click.prevent="quick(product.id)">QUICK SHOP</a>
            </div>
          </div>
        </div>
        <div class="uk-card-body uk-padding-remove uk-margin-small-top">
          <a :href="'/product/'+ product.slug" class="uk-text-meta">{{ product.name.substring(0,35) }}</a>
          <br>
            <span v-if="product.price_before_discount > 0 ">
              <del class="uk-text-small">
                  {{ product.currency }} {{ product.price_before_discount }}
              </del>
            </span>
            <span class="uk-text-danger uk-text-small" v-if="product.price_before_discount > 0 ">
               &nbsp;{{ product.currency }} {{ product.price }}
            </span>
            <span v-else class="uk-text-small">
                {{ product.currency }} {{ product.price }}
            </span>
            <div class="uk-hidden@m">
              <a href="#modal-overflow" class="uk-button uk-button-small uk-button-default uk-width-1-1" uk-toggle v-on:click.prevent="quick(product.id)">quick shop</a>
            </div>
        </div>
      </div>
    </div>
    <!-- end product single -->
    <div id="modal-overflow" class="uk-modal-container-small" uk-modal="center: true">
      <div class="uk-modal-dialog">

        <button class="uk-modal-close-default" type="button" uk-close></button>

        <div class="uk-modal-header uk-visible@m">
          <h3 class="uk-margin-remove">{{ name }}</h3>
            <span v-if="priceBeforeDiscount > 0 ">
                <span style="text-decoration: line-through;">
                    {{ currency }} {{ priceBeforeDiscount }}
                </span>
            </span>
            <span class="uk-text-danger" v-if="priceBeforeDiscount > 0 ">
                &nbsp; {{ currency }} {{ price }}
            </span>
            <span v-else>
                {{ currency }} {{ price }}
            </span>
        </div>

        <div class="uk-modal-body uk-padding-small" uk-overflow-auto>
          <div class="uk-grid" uk-grid>
            <div class="uk-width-1-2@m">
              <div class="uk-hidden@m">
                <h5 class="uk-margin-remove">{{ name }}</h5>
                  <span v-if="priceBeforeDiscount > 0 ">
                      <span style="text-decoration: line-through;">
                          {{ currency }} {{ priceBeforeDiscount }}
                      </span>
                  </span>
                  <span class="uk-text-danger" v-if="priceBeforeDiscount > 0 ">
                      &nbsp; {{ currency }} {{ price }}
                  </span>
                  <span v-else>
                      {{ currency }} {{ price }}
                  </span>
              </div>
              <div class="uk-inline">
                <div class="">
                <ul class="uk-switcher uk-margin" id="component-tab-left">
                  <li v-for="image in images">
                    <img :src="'/'+image.photo" :alt="image.name">
                    <div class="uk-position uk-position-small uk-position-center-left">
                      <a href="#" class="uk-icon uk-icon-button" uk-switcher-item="previous" uk-icon="icon: chevron-left"></a>
                    </div>
                    <div class="uk-position uk-position-small uk-position-center-right">
                      <a href="#" class="uk-icon uk-icon-button" uk-switcher-item="next" uk-icon="icon: chevron-right"></a>
                    </div>
                  </li>
                </ul>
                </div>
                <div class="">
                <ul class="uk-grid-small uk-flex-middle uk-flex-center uk-margin-remove uk-padding-remove" uk-switcher="connect: #component-tab-left; animation: uk-animation-fade" uk-grid>
                  <li class="uk-padding-remove" v-for="image in images">
                      <a href="#"><img :src="'/'+image.photo" width="55"></a>
                  </li>
                </ul>
              </div>
              </div>
            </div>
            <div class="uk-width-1-2@m">
              <div class="uk-grid uk-child-width-1-2">
                <div>
                    <b>Color :</b> {{ color }}
                </div>
                <div>
                  <!-- <div uk-form-custom="target: > * > span:first"> -->
                      <select name="size" v-model="size" v-validate="'required'" class="uk-select">
                          <option :value="null" disabled>Choose Size</option>
                          <option v-for="stock in stocks" :value="stock.sku" :disabled="stock.unit <= 0">
                            {{ stock.size }} {{ stock.unit | unit }}
                          </option>
                      </select>
                      <!-- <button class="uk-button uk-button-default" type="button" tabindex="-1">
                          <span uk-icon="icon: chevron-down"></span>
                      </button>
                  </div> -->

                </div>
              </div>
              <ul uk-accordion="animation: true; multiple: false">
                  <li class="uk-open">

                      <h5 class="uk-accordion-title"><b>EDITORS NOTES</b></h5>
                      <div class="uk-accordion-content uk-text-muted">
                        {{ content }}
                      </div>

                  </li>
                  <li>

                      <h5 class="uk-accordion-title"><b>SIZE & FIT</b></h5>
                      <div class="uk-accordion-content  uk-text-muted">
                        {{ sizeAndFit }}
                      </div>

                  </li>
                  <li>

                      <h5 class="uk-accordion-title"><b>DETAILS & CARE</b></h5>
                      <div class="uk-accordion-content uk-text-muted">
                        {{ detailAndCare }}
                      </div>

                  </li>
              </ul>
              <div class="uk-card uk-card-small uk-card-border">
                <div class="uk-card-body">
                  <h4>DELIVERY & FREE RETURNS</h4>
                    <p v-html="deliveryReturns"></p>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="uk-modal-footer uk-text-right uk-visible@m">
            <button class="uk-button uk-button-secondary" type="button" v-on:click="bag">ADD TO BAG</button>
            <button class="uk-button uk-button-default" type="button" v-on:click="wishlist">ADD TO WISHLIST</button>
        </div>
        <div class="uk-modal-footer uk-text-right uk-padding-small uk-hidden@m">
            <button class="uk-button uk-button-secondary" type="button" v-on:click="bag">BAG <span class="uk-icon" uk-icon="icon:  chevron-right"></span></button>
            <button class="uk-button uk-button-default" type="button" v-on:click="wishlist">WISHLIST <span class="uk-icon" uk-icon="icon:  chevron-right"></span></button>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
  import axios from 'axios';
  export default {
    props: ['api', 'product_api', 'bag_api', 'wishlist_api', 'auth'],
    created() {
      var self = this;
      let api = this.api;
      axios.get(api)
      .then(function (response) {
        if (response.data.data !== 'undefined') {
            self.products = response.data.data;
        }
      })
      .catch(function (error) {
        console.log(error);
      });
    },

    data() {
        return {
            products: {},
            name: {},
            currency: {},
            price: {},
            priceBeforeDiscount: {},
            color: {},
            images: {},
            stocks: {},
            content: {},
            sizeAndFit: {},
            detailAndCare: {},
            size: null,
            deliveryReturns: null
        }
    },

    methods: {
      quick: function (e) {
        var self = this;
        self.size = null;
        axios.get(this.product_api+'/'+e)
        .then(function (response) {
          if (typeof response.data.data !== 'undefined') {
            var data = response.data.data;
            self.name = data.name;
            self.currency = data.currency;
            self.price = data.sell_price;
            self.priceBeforeDiscount = data.price_before_discount;
            self.color = data.color;
            self.images = data.images;
            self.stocks = data.stocks;
            self.content = data.content;
            self.sizeAndFit = data.size_and_fit;
            self.detailAndCare = data.detail_and_care;
            self.deliveryReturns = data.delivery_returns;
          }
        })
        .catch(function (error) {
          console.log(error);
        });
      },

      bag: function (event) {
        this.$validator.validateAll().then((result) => {
          if (result) {

              var size = this.size;
              axios.post(this.bag_api, {
                size: size
              })
              .then(function (response) {
                  if (typeof response.data.message !== 'undefined') {
                      if (response.data.status.toLowerCase() == 'error') {
                          UIkit.notification(response.data.message.size[0], {
                              status:'danger'
                          });
                      }
                      if (response.data.status.toLowerCase() == 'ok') {
                          UIkit.notification("<span uk-icon='icon: check'></span> Add product to bag successfully", {
                              status:'success'
                          });

                          Event.fire('addBag', response);
                      }
                  }
              })
              .catch(function (error) {
                  var error = JSON.parse(JSON.stringify(error));
                  if (typeof error.response.data.message !== 'undefined') {
                      UIkit.notification(error.response.data.message, {
                          status:'danger'
                      });
                  }
              });

          } else {
              var items = this.errors.items;
              $.each(items, function (index, item) {
                  UIkit.notification(item.msg, {
                      status:'danger'
                  });
              });
          }
        });
      },

      wishlist: function (event) {
        this.$validator.validateAll().then((result) => {
          if(result) {
              if (this.auth == 1) {
                  var size = this.size;

                  axios.post(this.wishlist_api, {
                      size: size
                  })
                  .then(function (response) {
                      if (typeof response.data.message !== 'undefined') {
                          if (response.data.status.toLowerCase() == 'error') {
                              UIkit.notification(response.data.message.size[0], {
                                  status:'danger'
                              });
                          }
                          if (response.data.status.toLowerCase() == 'ok') {
                              UIkit.notification("<span uk-icon='icon: check'></span> Add product to wishlist successfully", {
                                  status:'success'
                              });

                              Event.fire('addWishlist', response);
                          }
                      }
                  })
                  .catch(function (error) {
                      var error = JSON.parse(JSON.stringify(error));
                      if (typeof error.response.data.message !== 'undefined') {
                          UIkit.notification(error.response.data.message, {
                              status:'danger'
                          });
                      }
                  });
              } else {
                  UIkit.notification("Please login!", {
                      status:'danger'
                  });
              }
          } else {
              var items = this.errors.items;
              $.each(items, function (index, item) {
                  UIkit.notification(item.msg, {
                      status:'danger'
                  });
              });
          }
        });
      }
    },

    filters: {
      unit: function (unit) {
          if (unit < 10) {
              if (unit <= 0) {
                  return '(Sold Out)';
              } else {
                  return '(Only '+unit+' Left)';
              }
          }
      }
    }
  }
</script>
