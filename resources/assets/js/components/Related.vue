<template>
  <div class="uk-grid-small uk-child-width-1-4@m uk-child-width-1-2 uk-margin-large-bottom" uk-grid>
    <!-- start product -->
    <div class="uk-panel uk-text-left" v-for="product in products">
      <div class="uk-card uk-card-small uk-padding-remove">
        <div class="uk-card-media-top uk-inline-clip uk-transition-toggle">
          <a :href="'/product/'+ product.slug">
            <lazy-background
              :image-source="product.photo | awsLink(aws_link)"
              :alt="product.name"
              :loading-image="loadingImage"
              :error-image="errorImage">
            </lazy-background>
          </a>
          <div class="uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-default uk-visible@m">
            <div class="uk-text-center">
              <a href="#modal-related" class="uk-button uk-button-small uk-button-secondary uk-text-uppercase" uk-toggle v-on:click.prevent="quick(product.id)">{{ trans.quick_shop }}</a>
            </div>
          </div>
        </div>
        <div class="uk-card-body uk-padding-remove uk-margin-small-top">
          <div class="uk-hidden@m">
            <a href="#modal-related" class="uk-button uk-button-small uk-button-default-warm uk-width-1-1 uk-text-uppercase" uk-toggle v-on:click.prevent="quick(product.id)">{{ trans.quick_shop }}</a>
          </div>
          <a :href="'/product/'+ product.slug" class="uk-text-muted">{{ product.name.substring(0,35) }}</a>
          <br>
          <span v-if="product.price_before_discount > 0 ">
            <del class="uk-text-small">
                {{ product.price_before_discount | round(exchangeRate.symbol, exchangeRate.value) }}
            </del>
          </span>
          <span class="uk-text-danger uk-text-small" v-if="product.price_before_discount > 0 ">
             &nbsp;{{ product.price | round(exchangeRate.symbol, exchangeRate.value) }}
          </span>
          <span v-else class="uk-text-small">
              {{ product.price | round(exchangeRate.symbol, exchangeRate.value) }}
          </span>

        </div>
      </div>
    </div>
    <!-- end product single -->
    <div id="modal-related" class="uk-modal-container-small" uk-modal="center: true">
      <div class="uk-modal-dialog uk-margin-auto">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header uk-visible@m">
          <transition name="fade">
            <h3 class="uk-margin-remove" v-if="isLoading">{{ trans.loading }}</h3>
            <h3 class="uk-margin-remove" v-else>{{ name }}</h3>
          </transition>
          <div class="uk-text-right">
            <a :href="'/product/' +slug" class="uk-button uk-button-text uk-text-right uk-text-uppercase">{{ trans.see_detail }} <span uk-icon="icon: chevron-right"></span> </a>
          </div>
        </div>

        <div class="uk-modal-body uk-padding-small-left" uk-overflow-auto>
          <div class="uk-grid" uk-grid>
            <div class="uk-width-1-2@m">
              <div class="uk-hidden@m">
                <transition name="fade">
                  <h5 class="uk-margin-small" v-if="isLoading">{{ trans.loading }}</h5>
                  <h5 class="uk-margin-small" v-else><a :href="'/product/' +slug">{{ name }}</a></h5>
                </transition>
              </div>
              <div class="uk-inline">
                <div class="">
                  <ul class="uk-switcher uk-margin" id="component-tab-left-related">
                    <li v-for="image in images">
                      <lazy-background v-if="isLoading"
                        :image-source="loadingImage"
                        :alt="image.name"
                        :loading-image="loadingImage"
                        :error-image="errorImage">
                      </lazy-background>
                      <lazy-background v-else
                        :image-source="image.photo | awsLink(aws_link)"
                        :alt="image.name"
                        :loading-image="loadingImage"
                        :error-image="errorImage">
                      </lazy-background>
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
                  <ul class="uk-grid-small uk-flex-middle uk-flex-center uk-margin-remove uk-padding-remove" uk-switcher="connect: #component-tab-left-related; animation: uk-animation-fade" uk-grid>
                    <li class="uk-padding-remove" v-for="image in images">
                        <a href="#">
                          <lazy-background v-if="isLoading"
                            :image-source="loadingImage"
                            :alt="image.name"
                            :loading-image="loadingImage"
                            :error-image="errorImage"
                            width="55px">
                          </lazy-background>
                          <lazy-background v-else
                            :image-source="image.photo | awsLink(aws_link)"
                            :alt="image.name"
                            :loading-image="loadingImage"
                            :error-image="errorImage"
                            width="55px">
                          </lazy-background>
                        </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="uk-width-1-2@m">
              <h4 class="uk-margin-remove">
                <span v-if="priceBeforeDiscount > 0 ">
                  <del>
                      {{ priceBeforeDiscount | round(exchangeRate.symbol, exchangeRate.value) }}
                  </del>
                </span>
                <span class="uk-text-danger" v-if="priceBeforeDiscount > 0 ">
                    &nbsp; {{ price | round(exchangeRate.symbol, exchangeRate.value) }}
                </span>
                <span v-else>
                    {{ price | round(exchangeRate.symbol, exchangeRate.value) }}
                </span>
              </h4>
              <h5 class="uk-margin-small">{{ trans.color }} : 
                <lazy-background v-if="isLoading"
                  :image-source="loadingImage"
                  alt="rukuka palette"
                  :loading-image="loadingImage"
                  :error-image="errorImage"
                  width="20px">
                </lazy-background>
                <lazy-background v-else
                  :image-source="palette | awsLink(aws_link)"
                  alt="rukuka palette"
                  :loading-image="loadingImage"
                  :error-image="errorImage"
                  width="20px"
                  image-class="uk-border-rounded uk-box-shadow-small">
                </lazy-background>
               {{ color }}
              </h5>
              <div v-if="stocks.length > 0">
                <select name="size" v-model="size" v-validate="'required'" class="uk-select uk-form-small uk-form-width-medium">
                  <option v-for="stock in stocks" :value="stock.sku" :disabled="stock.unit <= 0">
                    {{ stock.size }} {{ stock.unit | unit }}
                  </option>
                </select>
                <span class="uk-text-meta"><i> {{ trans.choose_size_label }} </i> </span>
              </div>
              <div v-else>
                <span class="uk-text-meta"><i class="uk-text-danger">{{ trans.no_size }} </i> <br>{{ trans.contact_cs }} </span>
              </div>
              <ul uk-accordion="animation: true; multiple: false">
                  <li class="uk-open">

                    <h5 class="uk-accordion-title">{{ trans.editors_notes }}</h5>
                      <div class="uk-accordion-content">
                        {{ content }}
                      </div>
                  </li>
                  <li>
                    <h5 class="uk-accordion-title">{{ trans.size_fit }}</h5>
                      <div class="uk-accordion-content">
                        {{ sizeAndFit }}
                      </div>
                  </li>
                  <li>
                    <h5 class="uk-accordion-title">{{ trans.detail_care }}</h5>
                      <div class="uk-accordion-content">
                        {{ detailAndCare }}
                      </div>
                  </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="uk-modal-footer uk-text-right uk-visible@m">
            <button class="uk-button uk-button-secondary uk-text-uppercase" type="button" v-on:click="bag">{{ trans.add_to_bag}}</button>
            <button class="uk-button uk-button-default uk-text-uppercase" type="button" v-on:click="wishlist">{{ trans.add_to_wishlist }}</button>
        </div>
        <div class="uk-modal-footer uk-padding-small uk-hidden@m">
          <div class="uk-grid-match uk-child-width-auto uk-flex-between uk-grid" uk-grid>
          <div class="uk-first-column">
            <div v-if="bagCount > 0">
              <a class="uk-icon uk-icon-link" href="#" uk-icon="icon: cart"></a>
              <div class="uk-badge">
                <a :href="bag_link" class="uk-light uk-link-reset">{{ bagCount }}</a>
              </div>
            </div>

          </div>
          <div class="uk-panel">
            <div>
              <button class="uk-button uk-button-secondary uk-button-small uk-text-uppercase" type="button" v-on:click="bag">{{ trans.bag_label }} <span class="uk-icon" uk-icon="icon:  plus; ratio: 0.6"></span></button>
              <button class="uk-button uk-button-default uk-button-small uk-text-uppercase" type="button" v-on:click="wishlist">{{ trans.wishlist_label }} <span class="uk-icon" uk-icon="icon:  plus; ratio: 0.6"></span></button>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
  .fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
  }
  .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
  }
</style>
<script>
  import axios from 'axios';
  import VueLazyBackgroundImage from '../components/VueLazyBackgroundImage.vue';

  export default {
    props: [
      'api',
      'product_api',
      'bag_api',
      'wishlist_api',
      'auth',
      'aws_link',
      'default_image',
      'recently',
      'bag_link',
      'locale'
    ],

    components: {
      'lazy-background': VueLazyBackgroundImage
    },

    created() {
      var self = this;
      let api = this.api;
      var recently = this.recently;

      if (recently) {
        var product = JSON.parse(recently);
        axios.post(api, {
            product: product
        })
        .then(function (response) {
            if (response.data.data !== 'undefined') {
                self.products = response.data.data;
            }
        })
        .catch(function (error) {
            var error = JSON.parse(JSON.stringify(error));
            console.log(error);
        });
      } else {
        axios.get(api)
        .then(function (response) {
          if (response.data.data !== 'undefined') {
              self.products = response.data.data;
          }
        })
        .catch(function (error) {
          console.log(error);
        });
      }

      Event.listen('exchange', function (response) {
        self.exchangeRate = response.data.data;
      });

      Event.listen('bags', function (response) {
        self.bagCount = response.data.bagCount;
      });

      Event.listen('addBag', function (response) {
        self.bagCount = response.data.bagCount;
      });

      self.errorImage = this.aws_link+'/images/'+this.defaultImage.image_2;
      self.loadingImage = this.aws_link+'/images/loading-image.gif';

    },

    data() {
        return {
            products: {},
            name: {},
            price: {},
            priceBeforeDiscount: {},
            color: {},
            palette: null,
            images: {},
            stocks: {},
            content: {},
            sizeAndFit: {},
            detailAndCare: {},
            slug: {},
            size: {},
            deliveryReturns: null,
            defaultImage: JSON.parse(this.default_image,true),
            bagCount: {},
            isLoading: false,
            errorImage: {},
            loadingImage: {},
            trans: JSON.parse(this.locale,true),
            exchangeRate: {}
        }
    },

    methods: {
      quick: function (e) {
        var self = this;
        self.size = null;
        self.isLoading = true;
        axios.get(this.product_api+'/'+e)
        .then(function (response) {
          if (typeof response.data.data !== 'undefined') {
            var data = response.data.data;
            self.name = data.name;
            self.price = data.sell_price;
            self.priceBeforeDiscount = data.price_before_discount;
            self.color = data.color;
            self.palette = data.color_palette;
            self.images = data.images;
            self.stocks = data.stocks;
            self.content = data.content;
            self.sizeAndFit = data.size_and_fit;
            self.detailAndCare = data.detail_and_care;
            self.deliveryReturns = data.delivery_returns;
            self.slug =  data.slug;
            self.size = self.stocks.length > 0 ? self.stocks[0].sku : null;

            self.isLoading = false;

          }
        })
        .catch(function (error) {
          self.isLoading = false;
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
      },

      awsLink: function (value, aws) {
        var link = value == null ? '#' : aws+'/'+value;
        return link;
      },

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
