<template>
  <div class="uk-grid-small uk-child-width-1-4@m uk-child-width-1-2 uk-margin-large-bottom" uk-grid>
    <!-- start product -->
    <div class="uk-text-left" v-for="product in products">
      <div class="uk-card uk-card-small uk-padding-remove">
        <div class="uk-card-media-top uk-inline-clip uk-transition-toggle">
          <a :href="'/product/'+ product.slug">
            <lazy-image
                :src='product.photo | awsLink(aws_link, errorImage)'
                :img-class="['uk-transition-scale-up','uk-transition-opaque']"
                :placeholder='loadingImage'
                :img-alt='product.name'
            ></lazy-image>
            <div class="uk-postion-small uk-position-top-right" v-if="product.price_before_discount > 0">
              <span class="uk-label uk-label-danger">SALE</span>
            </div>
            <div class="uk-postion-small uk-position-top-left" v-if="product.is_new">
              <span class="uk-label uk-label-success">NEW</span>
            </div>
            <div class="uk-postion-medium uk-position-bottom-left uk-visible@m" uk-tooltip="Quick shop">
              <a :href="'#modal-related'" uk-toggle v-on:click.prevent="quick(product.id)" class="like-position">
                <i class="material-icons" style="color:#666 ;font-size: 35px;">shopping_basket</i>
              </a>
            </div>
            <div class="uk-postion-small uk-position-bottom-right" :id="'tooltip-related-'+product.id" :uk-tooltip="product.like ? 'Remove wishlist' : 'Add to wishlist'">
              <a href="#" v-on:click.prevent="toggleLike(product.id)" class="like-position">
                <i class="material-icons" :id="'like-related-'+product.id" style="color: pink;font-size: 35px;">
                  {{ product.like | like }}
                </i>
              </a>
            </div>
          </a>
        </div>
        <div class="uk-card-body uk-padding-small">
          <!-- <div class="margin-5px-bot">
            <a :href="'#modal-related'" class="uk-button uk-button-small uk-visible@m uk-button-secondary uk-width-1-1" uk-toggle v-on:click.prevent="quick(product.id)">{{ trans.quick_shop }}</a>
          </div> -->
          <a :href="product.gender | menu(menu)+'&designer='+product.designer_slug" class="uk-link-muted uk-link-reset">
            <b>{{ product.designer_name }}</b>
          </a> <br>
          <a :href="'/product/'+ product.slug" class="uk-text-small k-link-reset">{{ product.name.substring(0,35) }}
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
          </a>
        </div>
      </div>
    </div>
    <!-- end product single -->
    <div :id="'modal-related'" class="uk-modal-container-small" uk-modal="center: true">
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
                    <button v-if="isPreOrder == 0" class="uk-button uk-button-default uk-button-small uk-text-uppercase" type="button" v-on:click="bag">{{ trans.bag_label }} <span class="uk-icon" uk-icon="icon:  plus; ratio: 0.6"></span></button>
                    <button v-else class="uk-button uk-button-default uk-button-small uk-text-uppercase" type="button" v-on:click="bag">Pre Order <span class="uk-icon" uk-icon="icon:  plus; ratio: 0.6"></span></button>
                    <button class="uk-button uk-button-default uk-button-small uk-text-uppercase" type="button" v-on:click="wishlist(productId)">{{ trans.wishlist_label }} <span class="uk-icon" uk-icon="icon:  plus; ratio: 0.6"></span></button>
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
              <a :href="bag_link"><i class="material-icons" style="font-size: 18px">shopping_basket</i></a>
              <div class="uk-badge">
                <a :href="bag_link" class="uk-light uk-link-reset">{{ bagCount }}</a>
              </div>
            </div>
          </div>
          <div class="uk-panel">
            <div>
                <button v-if="isPreOrder == 0" class="uk-button uk-button-default uk-button-small uk-text-uppercase" type="button" v-on:click="bag">{{ trans.bag_label }} <span class="uk-icon" uk-icon="icon:  plus; ratio: 0.6"></span></button>
                <button v-else class="uk-button uk-button-default uk-button-small uk-text-uppercase" type="button" v-on:click="bag"> Pre Order <span class="uk-icon" uk-icon="icon:  plus; ratio: 0.6"></span></button>
                <button class="uk-button uk-button-default uk-button-small uk-text-uppercase" type="button" v-on:click="wishlist(productId)">{{ trans.wishlist_label }} <span class="uk-icon" uk-icon="icon:  plus; ratio: 0.6"></span></button>
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
  .like-position {
    margin-right: 10px;
    margin-bottom: 10px;
  }
</style>
<script>
  import axios from 'axios';
  import VueLazyBackgroundImage from '../components/VueLazyBackgroundImage.vue';

  export default {
    props: [
      'api',
      'menu',
      'product_api',
      'bag_api',
      'wishlist_api',
      'auth',
      'token',
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
      let token = this.token;
      let menu = this.menu;
      var recently = this.recently;

      if (recently) {
        var product = JSON.parse(recently);
        axios.post(api, {
            product: product,
            api_token: token,
            menu: menu
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
        axios.get(api+'?menu='+menu+'&api_token='+token)
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

      Event.listen('removeBag', function (response) {
          self.bagCount = response.data.bagCount;
      });

      self.errorImage = this.aws_link+'/images/'+this.defaultImage.image_2;
      self.loadingImage = this.aws_link+'/images/loading-image.gif';

    },

    data() {
        return {
            products: {},
            productId: {},
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

      wishlist: function (productId) {
        this.$validator.validateAll().then((result) => {
          if(result) {
              if (this.auth == 1) {

                  axios.post(this.wishlist_api, {
                      products_id: productId
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

                              document.getElementById('like-related-'+productId).textContent = "favorite";

                              var _like = document.getElementById('like-'+productId);

                              _like ? _like.textContent = "favorite" : '';

                              // custom tooltip
                              document.getElementById('tooltip-related-'+productId).setAttribute("uk-tooltip", "Remove wishlist");

                              var _tooltip = document.getElementById('tooltip-'+productId);

                              _tooltip ? _tooltip.setAttribute("uk-tooltip", "Remove wishlist") : '';
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
                  var _link = window.location.href.replace('&', '|');
                  UIkit.notification("<center>You are not logged in.<br> To login, please click <a href='/login?return="+_link+"'>here</a></center>", {
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
      },

      removeWishlist: function (productId) {
          this.$validator.validateAll().then((result) => {
              if(result) {
                  if (this.auth == 1) {

                      axios.post(this.wishlist_api, {
                          products_id: productId,
                          unlist: 'ok'
                      })
                          .then(function (response) {
                              if (typeof response.data.message !== 'undefined') {
                                  if (response.data.status.toLowerCase() == 'error') {
                                      UIkit.notification(response.data.message.size[0], {
                                          status:'danger'
                                      });
                                  }
                                  if (response.data.status.toLowerCase() == 'ok') {
                                      UIkit.notification("<span uk-icon='icon: check'></span> Delete product from wishlist successfully", {
                                          status:'success'
                                      });

                                      Event.fire('addWishlist', response);

                                      document.getElementById('like-related-'+productId).textContent = "favorite_border";

                                      _like = document.getElementById('like-'+productId);

                                      _like ? _like.textContent = "favorite_border" : '';

                                      // custom tooltip
                                      document.getElementById('tooltip-related-'+productId).setAttribute("uk-tooltip", "Add to wishlist");

                                      var _tooltip = document.getElementById('tooltip-'+productId);

                                      _tooltip ? _tooltip.setAttribute("uk-tooltip", "Add to wishlist") : '';
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
                      var _link = window.location.href.replace('&', '|');
                      UIkit.notification("<center>You are not logged in.<br> To login, please click <a href='/login?return="+_link+"'>here</a></center>", {
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
      },

      toggleLike: function(productId)
      {
        var _like = document.getElementById('like-related-'+productId).textContent;

        if (_like == 'favorite_border') {
          this.wishlist(productId);
        } else if (_like == 'favorite') {
          this.removeWishlist(productId);
        }

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

      awsLink: function (value, aws, error = '#') {
        var link = value == null ? error : aws+'/'+value;
        return link;
      },

      round: function(value, currency, rate) {
        var value = value / rate;
        var money = function(n, currency) {
          return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
        };

        return money(Number(Math.round(value+'e'+2)+'e-'+2), currency);
      },

      menu: function (value, menu) {
        if (value == 'unisex') {
          return '/shop?menu='+menu;
        } else {
          return '/shop?menu='+value;
        }
      },

      like: function (event) {
        if (event) {
          return 'favorite';
        } else {
          return 'favorite_border';
        }
      }
    }
  }
</script>
