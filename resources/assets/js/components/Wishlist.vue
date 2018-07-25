<template>
  <div class="uk-grid-small uk-child-width-1-3@m uk-child-width-1-2 uk-flex-left" uk-grid>
    <div class="uk-panel uk-visible-toggle list-item" v-for="wish in wishlists" v-bind:key="wish">

        <!-- start product -->
        <div class="uk-card uk-card-small uk-padding-remove uk-visible@m">
            <div class="uk-card-media-top">
                <lazy-background
                  :image-source="wish.photo | awsLink(aws_link)"
                  :loading-image="loadingImage"
                  :error-image="errorImage"
                  :alt="wish.name">
                </lazy-background>
            </div>
            <div class="uk-card-body uk-padding-remove uk-margin-small-top">

            </div>
        </div>
        <!-- end product single -->
        <div class="uk-panel uk-position-cover-card uk-invisible-hover uk-visible@m">
          <!-- start product -->
            <div class="uk-box-shadow-large uk-padding-remove">
                <div class="uk-card-media-top uk-inline">
                  <div class="uk-position-small uk-position-top-right">
                    <ul class="uk-list">
                      <li>
                        <a v-on:click.prevent="removeWishlist(wish.wishlists_id)" class="uk-icon-button"  uk-icon="icon: trash"></a>
                      </li>
                    </ul>
                  </div>
                    <lazy-background
                      :image-source="wish.photo | awsLink(aws_link)"
                      :loading-image="loadingImage"
                      :error-image="errorImage"
                      :alt="wish.name">
                    </lazy-background>
                </div>
                <div class="uk-card-body uk-background-default uk-padding-small uk-margin-small-top">
                    <a :href="'/shop?menu='+wish.gender+'&designer='+wish.designer_slug" class="shop_item_title uk-link-muted uk-link-reset">
                      <span>{{ wish.designer_name }}</span>
                    </a> <br>
                    <a :href="'/product/'+ wish.slug" alt="wish.name" class="uk-link-reset">{{ wish.name.substring(0,30) }}
                      <br>
                      <span v-if="wish.price_before_discount > 0 ">
                          <del>
                              {{ wish.price_before_discount | round(exchangeRate.symbol, exchangeRate.value) }}
                          </del>
                      </span>
                      <span class="uk-text-danger" v-if="wish.price_before_discount > 0 ">
                         &nbsp;{{ wish.price | round(exchangeRate.symbol, exchangeRate.value) }}
                      </span>
                      <span v-else>
                          {{ wish.price | round(exchangeRate.symbol, exchangeRate.value) }}
                      </span>
                    </a>
                    <br>
                      <a href="#modal-shop" class="uk-button uk-button-secondary uk-button-small uk-width-1-1" uk-toggle v-on:click.prevent="quick(wish.id)">{{ trans.quick_shop }}</a>
                </div>
            </div>

          <!-- end product single -->
        </div>
        <div class="uk-box-shadow-large uk-padding-remove uk-hidden@m">
            <div class="uk-card-media-top uk-inline">
              <div class="uk-position-small uk-position-top-right">
                <ul class="uk-list">
                  <li>
                    <a v-on:click.prevent="removeWishlist(wish.wishlists_id)" class="uk-icon-button"  uk-icon="icon: trash"></a>
                  </li>
                </ul>
              </div>
                <lazy-background
                  :image-source="wish.photo | awsLink(aws_link)"
                  :loading-image="loadingImage"
                  :error-image="errorImage"
                  :alt="wish.name">
                </lazy-background>
            </div>
            <div class="uk-card-body uk-background-default uk-padding-small">
                <a :href="'/shop?menu='+wish.gender+'&designer='+wish.designer_slug" class="shop_item_title uk-link-muted uk-link-reset">
                  <span>{{ wish.designer_name }}</span>
                </a> <br>
                <a :href="'/product/'+ wish.slug" alt="wish.name" class="uk-link-reset">{{ wish.name.substring(0,30) }}
                    <br>
                  <span v-if="wish.price_before_discount > 0 ">
                      <del>
                          {{ wish.price_before_discount | round(exchangeRate.symbol, exchangeRate.value) }}
                      </del>
                  </span>
                  <span class="uk-text-danger" v-if="wish.price_before_discount > 0 ">
                     &nbsp;{{ wish.price | round(exchangeRate.symbol, exchangeRate.value) }}
                  </span>
                  <span v-else>
                      {{ wish.price | round(exchangeRate.symbol, exchangeRate.value) }}
                  </span>
                </a>
                <br>
                  <a href="#modal-shop" class="uk-button uk-button-secondary uk-button-small uk-width-1-1" uk-toggle v-on:click.prevent="quick(wish.id)"><span class="uk-icon" uk-icon="icon: cart"></span> {{ trans.quick_shop }}</a>
            </div>
        </div>
    </div>
    <div v-if="wishlists == 0" class="uk-text-center"><h3>{{ trans.no_wishlist }}</h3></div>
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
                <div class="uk-visible@m">
                  <transition name="fade">
                    <h4 class="uk-margin-small" v-if="isLoading">{{ trans.loading }}</h4>
                    <h4 class="uk-margin-small" v-else>{{ name }}</h4>
                  </transition>
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
                </div>
                <div class="uk-grid-small uk-width-1-1 uk-hidden@m" uk-grid>
                  <div class="uk-width-3-5">
                    <transition name="fade">
                      <h5 class="uk-margin-small" v-if="isLoading">{{ trans.loading }}</h5>
                      <h5 class="uk-margin-small" v-else>{{ name }}</h5>
                    </transition>
                  </div>
                  <div class="uk-width-2-5 uk-text-right">
                      <span v-if="priceBeforeDiscount > 0 ">
                        <del>
                            {{ priceBeforeDiscount | round(exchangeRate.symbol, exchangeRate.value) }}
                        </del>
                        <br>
                      </span>
                      <span class="uk-text-danger" v-if="priceBeforeDiscount > 0 ">
                          &nbsp;{{ price | round(exchangeRate.symbol, exchangeRate.value) }}
                      </span>
                      <span v-else>
                          {{ price | round(exchangeRate.symbol, exchangeRate.value) }}
                      </span>
                  </div>
                </div>
                <hr class="uk-hidden@m uk-margin-small">
              <h6 class="uk-margin-small"> {{ trans.color }} :
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
                  image-class="uk-border-circle uk-box-shadow-small uk-margin-small-right uk-margin-small-left">
                </lazy-background>
               {{ color }}
             </h6>
              <div v-if="stocks.length > 0">
                <div v-if="stocks[0].size == 'none'">
                    <span class="uk-text-meta"><i class="uk-text-success">{{ trans.product_available }} ({{ stocks[0].unit }})</i>
                </div>
                <div v-else>
                  <div class="uk-grid uk-child-width-1-2 uk-margin-small-bottom" uk-grid>
                    <div>
                      <h6> <b> {{ trans.european }} </b></h6>
                    </div>
                    <div class="uk-text-right">
                      <span class="uk-text-meta"><a href="/help/size-charts" target="_blank"> {{ trans.size_chart}}</a></span>
                    </div>
                  </div>
                  <select name="size" v-model="size" v-validate="'required'" class="uk-select uk-form-small uk-form-width-medium">
                    <option v-for="stock in stocks" :value="stock.sku" :disabled="stock.unit <= 0">
                      {{ stock.size }} {{ stock.unit | unit }}
                    </option>
                  </select>
                </div>
              </div>
              <div v-else>
                  <span class="uk-text-meta"><i class="uk-text-danger">{{ trans.no_size }} </i> <br>{{ trans.contact_cs }} </span>
              </div>
              <div v-if="isPreOrder == 1">
                  <span class="uk-text-meta"><i class="uk-text-danger">Pre Order {{ preOrderDay }} days</i>
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
                      <a :href="bag_link"><i class="material-icons" style="font-size: 18px">shopping_basket</i></a>
                      <div class="uk-badge">
                        <a :href="bag_link" class="uk-light uk-link-reset">{{ bagCount }}</a>
                      </div>
                    </div>
                  </div>
                  <div class="uk-panel">
                    <div>
                        <button class="uk-button uk-button-default uk-button-small uk-text-uppercase" type="button" v-on:click="bag">{{ trans.bag_label }} <span class="uk-icon" uk-icon="icon:  plus; ratio: 0.6"></span></button>
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
                <a :href="bag_link"><i class="material-icons" style="font-size: 20px">shopping_basket</i></a>
                <div class="uk-badge">
                  <a :href="bag_link" class="uk-light uk-link-reset">{{ bagCount }}</a>
                </div>
              </div>
            </div>
            <div class="uk-panel">
              <div>
                  <button class="uk-button uk-button-default uk-button-small uk-text-uppercase" type="button" v-on:click="bag">{{ trans.bag_label }} <span class="uk-icon" uk-icon="icon:  plus; ratio: 0.6"></span></button>
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
      'wishlist_api', 
      'product_api', 
      'bag_api', 
      'wishlist_delete', 
      'product_link', 
      'aws_link',
      'default_image',
      'locale',
      'bag_link',
      'menu'
    ],

    components: {
      'lazy-background': VueLazyBackgroundImage
    },

    created () {
      var self = this;

      Event.listen('exchange', function (response) {
        self.exchangeRate = response.data.data;
      });

      self.getWishlist();

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
        wishlists: {},
        productId: {},
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
        isPreOrder: {},
        preOrderDay: {},
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
        let menu = this.menu;
        axios.get(this.product_api+'/'+e)
            .then(function (response) {
                if (typeof response.data.data !== 'undefined') {
                    var data = response.data.data;
                    self.productId = data.id;
                    self.name = data.name;
                    self.price = data.sell_price;
                    self.priceBeforeDiscount = data.price_before_discount;
                    self.color = data.color;
                    self.palette = data.color_palette;
                    self.images = data.images_medium;
                    self.stocks = data.stocks;
                    self.content = data.content;
                    self.sizeAndFit = data.size_and_fit;
                    self.detailAndCare = data.detail_and_care;
                    self.slug =  data.gender != 'unisex' ? data.slug : data.slug+'?menu='+menu;
                    self.size = self.stocks.length > 0 ? self.stocks[0].sku : null;
                    self.isPreOrder =  data.is_preorder;
                    self.preOrderDay =  data.preorder_day;

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

      getWishlist: function () {
        var self = this;
        axios.get(this.wishlist_api)
        .then(function (response) {
          self.wishlists = response.data.wishlists;
        })
        .catch(function (error) {
          console.log(error);
        });
      },

      removeWishlist: function (id) {
        var self = this;
        var id = id;

        axios.post(this.wishlist_delete, {
            _method: 'DELETE',
            id: id,
        })
        .then(function (response) {
            if (typeof response.data.message !== 'undefined') {
                if (response.data.status.toLowerCase() == 'ok') {
                    UIkit.notification("<span uk-icon='icon: check'></span> Delete product from wishlist successfully", {
                        status:'success'
                    });

                    self.getWishlist();

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
      }
    },

    filters: {
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
      },
    }
  }
</script>
