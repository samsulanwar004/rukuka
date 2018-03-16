<template>
    <div class="uk-grid-small uk-child-width-1-3@m uk-child-width-1-2" uk-grid>

        <!-- start product -->
        <div class="uk-panel uk-text-left" v-for="product in products">
            <div class="uk-card uk-card-small">
                <div class="uk-card-media-top uk-inline-clip uk-transition-toggle">
                    <a :href="'/product/'+ product.slug">
                         <lazy-background
                          :image-source="product.photo | awsLink(aws_link)"
                          :alt="product.name"
                          :loading-image="loadingImage"
                          :error-image="errorImage"
                          image-class="uk-transition-scale-up uk-transition-opaque">
                        </lazy-background>
                        <div class="uk-postion-small uk-position-top-right" v-if="product.price_before_discount > 0">
                          <span class="uk-label uk-label-danger">SALE</span>
                        </div>
                        <div class="uk-postion-small uk-position-top-left" v-if="product.is_new">
                          <span class="uk-label uk-label-success">NEW</span>
                        </div>
                    </a>
                </div>
                <div class="uk-card-body uk-padding-remove">
                  <div>
                    <a href="#modal-shop" class="uk-button uk-button-small uk-button-secondary uk-width-1-1 uk-text-uppercase" uk-toggle v-on:click.prevent="quick(product.id)">{{ trans.quick_shop }}</a>
                  </div>
                    <a :href="'/product/'+ product.slug" alt="product.name">{{ product.name.substring(0,30) }}</a>
                    <br>
                    <span v-if="product.price_before_discount > 0 ">
                        <del>
                            {{ product.price_before_discount | round(exchangeRate.symbol, exchangeRate.value) }}
                        </del>
                    </span>
                    <span class="uk-text-danger" v-if="product.price_before_discount > 0 ">
                       &nbsp;{{ product.price | round(exchangeRate.symbol, exchangeRate.value) }}
                    </span>
                    <span v-else>
                        {{ product.price | round(exchangeRate.symbol, exchangeRate.value) }}
                    </span>
                </div>
            </div>
        </div>
        <!-- end product single -->
        <div id="modal-shop" class="uk-modal-container-small" uk-modal="center: true">
          <div class="uk-modal-dialog uk-margin-auto-vertical">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-body uk-padding-remove" uk-overflow-auto>
              <div class="uk-grid uk-grid-collapse" uk-grid>
                <div class="uk-width-1-2@m">
                  <div class="js-slideshow-animation"  uk-slideshow="animation: pull; ratio: 4:5">
                    <div class="uk-position-relative uk-visible-toggle uk-dark">
                      <ul class="uk-slideshow-items">
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
                        </li>
                      </ul>
                      <a class="uk-slidenav-large uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                      <a class="uk-slidenav-large uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
                      <div class="uk-position-bottom-center uk-position-medium">
                          <ul class="uk-slideshow-nav uk-dotnav"></ul>
                      </div>
                    </div>
                    </div>
                </div>
                <div class="uk-width-1-2@m uk-padding-small uk-flex uk-flex-wrap uk-flex-wrap-between">
                  <div class="uk-width-1-1">


                  <transition name="fade">
                    <h4 class="uk-margin-small" v-if="isLoading">{{ trans.loading }}</h4>
                    <h4 class="uk-margin-small" v-else>{{ name }}</h4>
                  </transition>
                  <h4 class="uk-margin-remove">
                    <span v-if="priceBeforeDiscount > 0 ">
                      <del>
                          {{ priceBeforeDiscount | round(exchangeRate.symbol, exchangeRate.value) }}
                      </del>
                    </span>
                    <span class="uk-text-danger" v-if="priceBeforeDiscount > 0 ">
                        &nbsp;{{ price | round(exchangeRate.symbol, exchangeRate.value) }}
                    </span>
                    <span v-else>
                        {{ price | round(exchangeRate.symbol, exchangeRate.value) }}
                    </span>
                  </h4>

                  <h5 class="uk-margin-small"> {{ trans.color }} :
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
                      <p class="uk-margin-small-bottom">
                          <span class="uk-text-small uk-text-danger"><b> {{ trans.european }} </b> | <a href="/help/size-charts" target="_blank" class="uk-text-primary"><u> {{ trans.size_chart}} </u></a></span>
                      </p>
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
                            <span v-html="content"></span>
                          </div>
                      </li>
                      <li>
                          <h5 class="uk-accordion-title">{{ trans.size_fit }}</h5>
                          <div class="uk-accordion-content">
                            <span v-html="sizeAndFit"></span>
                          </div>
                      </li>
                      <li>
                          <h5 class="uk-accordion-title">{{ trans.detail_care }}</h5>
                          <div class="uk-accordion-content">
                            <span v-html="detailAndCare"></span>
                          </div>
                      </li>
                  </ul>
                  <a :href="'/product/' +slug" class="uk-text-danger uk-text-right">{{ trans.see_detail }} <span uk-icon="icon: chevron-right"></span> </a>
                  </div>
                  <div class="uk-width-1-1">


                  <div class="uk-grid-match uk-child-width-auto uk-flex-between uk-grid uk-visible@m" uk-grid>
                  <div class="uk-first-column">
                    <div v-if="bagCount > 0">
                      <a class="uk-icon uk-icon-link" :href="bag_link" uk-icon="icon: cart"></a>
                      <div class="uk-badge">
                        <a :href="bag_link" class="uk-light uk-link-reset">{{ bagCount }}</a>
                      </div>
                    </div>
                  </div>
                  <div class="uk-panel">
                    <div>
                        <button class="uk-button uk-button-default uk-button-small uk-text-uppercase" type="button" v-on:click="bag">{{ trans.bag_label }} <span class="uk-icon" uk-icon="icon:  plus; ratio: 0.6"></span></button>
                        <button class="uk-button uk-button-default uk-button-small uk-text-uppercase" type="button" v-on:click="wishlist">{{ trans.wishlist_label }} <span class="uk-icon" uk-icon="icon:  plus; ratio: 0.6"></span></button>
                    </div>
                  </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-modal-footer uk-padding-small uk-hidden@m">
              <div class="uk-grid-match uk-child-width-auto uk-flex-between uk-grid" uk-grid>
              <div class="uk-first-column">
                <div v-if="bagCount > 0">
                  <a class="uk-icon uk-icon-link" :href="bag_link" uk-icon="icon: cart"></a>
                  <div class="uk-badge">
                    <a :href="bag_link" class="uk-light uk-link-reset">{{ bagCount }}</a>
                  </div>
                </div>
              </div>
              <div class="uk-panel">
                <div>
                    <button class="uk-button uk-button-default uk-button-small uk-text-uppercase" type="button" v-on:click="bag">{{ trans.bag_label }} <span class="uk-icon" uk-icon="icon:  plus; ratio: 0.6"></span></button>
                    <button class="uk-button uk-button-default uk-button-small uk-text-uppercase" type="button" v-on:click="wishlist">{{ trans.wishlist_label }} <span class="uk-icon" uk-icon="icon:  plus; ratio: 0.6"></span></button>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="uk-text-center">
      <a href="#" class="uk-icon-link uk-icon" uk-icon="icon: plus; ratio: 1.5"></a>
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
          'shops',
          'product_api',
          'bag_api',
          'wishlist_api',
          'auth',
          'aws_link',
          'default_image',
          'bag_link',
          'locale'
        ],

        components: {
          'lazy-background': VueLazyBackgroundImage
        },

        created () {
            var self = this;

            Event.listen('exchange', function (response) {
              self.exchangeRate = response.data.data;
            });

            self.products = this.shops ? JSON.parse(this.shops) : {};

            Event.listen('bags', function (response) {
              self.bagCount = response.data.bagCount;
            });

            Event.listen('addBag', function (response) {
              self.bagCount = response.data.bagCount;
            });

            Event.listen('removeBag', function (response) {
                self.bagCount = response.data.bagCount;
            });

            self.errorImage = this.aws_link+'/images/'+this.defaultImage.image_2;
            self.loadingImage = this.aws_link+'/images/loading-image.gif';
        },

        data () {
            return {
                products: {},
                name: {},
                currency: {},
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
