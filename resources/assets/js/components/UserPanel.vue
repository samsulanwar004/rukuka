<template>
<div class="uk-width-1-3@m uk-flex uk-flex-middle">
  <div class="uk-width-1-1 uk-flex uk-flex-middle uk-flex-right uk-visible@m">
    <ul class="uk-grid-small " uk-grid>


      <li class="uk-margin-right">
        <a class="uk-button uk-button-text uk-button-small" href="#flag-modal" uk-toggle><img :src="flagImage+language+'.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt="">
        {{ currencyCode }}
        </a>
        <div id="flag-modal" class="uk-modal-full" uk-modal>
            <div class="uk-modal-dialog uk-flex uk-flex-center uk-flex-middle" uk-height-viewport>
                <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                <div class="uk-width-xxlarge uk-padding-large uk-text-center">
                    <h3 class="uk-text-uppercase">{{ trans.currency_title }}</h3>
                    <button class="uk-button uk-button-small uk-button-default uk-text-uppercase" disabled>{{ trans.currency_set }} <img :src="flagImage+language+'.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt="">
                      {{ currencyCode }}
                    </button>
                    <h5 class="uk-text-uppercase">{{ trans.usca }}</h5>
                    <div class="uk-grid uk-child-width-1-2@m uk-gird-small" uk-grid>
                      <div>
                        <a href="/lang/ca"><h6>{{ trans.cad }} <img :src="flagImage+'ca.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.ca }}</h6></a>
                      </div>
                      <div>
                        <a href="/lang/en"><h6>{{ trans.usd }} <img :src="flagImage+'en.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.us }}</h6></a>
                      </div>
                    </div>
                    <h5 class="uk-text-uppercase">{{ trans.asea }}</h5>
                    <div class="uk-grid uk-child-width-1-3@m uk-grid-small" uk-grid>
                      <div>
                        <a href="/lang/id"><h6>{{ trans.idr }} <img :src="flagImage+'id.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.id }}</h6></a>
                      </div>
                      <div>
                        <a href="/lang/sg"><h6>{{ trans.sgd }} <img :src="flagImage+'sg.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.sg }}</h6></a>
                      </div>
                      <div>
                        <a href="/lang/my"><h6>{{ trans.myr }} <img :src="flagImage+'my.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.my }}</h6></a>
                      </div>
                      <div>
                        <a href="/lang/bn"><h6>{{ trans.bnd }} <img :src="flagImage+'bn.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.bn }}</h6></a>
                      </div>
                      <div>
                        <a href="/lang/jp"><h6>{{ trans.jpy }} <img :src="flagImage+'jp.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.jp }}</h6></a>
                      </div>
                      <div>
                        <a href="/lang/kr"><h6>{{ trans.krw }} <img :src="flagImage+'kr.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.kr }}</h6></a>
                      </div>
                      <div>
                        <a href="/lang/cn"><h6>{{ trans.cny }} <img :src="flagImage+'cn.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.cn }}</h6></a>
                      </div>
                      <div>
                        <a href="/lang/hk"><h6>{{ trans.hkd }} <img :src="flagImage+'hk.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.hk }}</h6></a>
                      </div>
                    </div>
                    <h5 class="uk-text-uppercase">{{ trans.euro }}</h5>
                      <a href="/lang/eu"><h6>{{ trans.eur }} <img :src="flagImage+'eu.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.eu }}</h6></a>
                </div>
            </div>
        </div>
      </li>
      <li v-if="auth == 1"  class="uk-margin-right">
        <a :href="wishlist_link"><i class="material-icons" style="font-size: 18px; vertical-align:middle">favorite_border</i>
          <div class="uk-badge" v-if="wishlistCount > 0">
            {{ wishlistCount }}
          </div>
        </a>
      </li>
      <li>
        <a v-on:click.prevent="goBag"> <i class="material-icons" style="font-size: 18px; vertical-align:middle; margin-right: 5px;">shopping_basket</i>
          <div class="uk-badge" v-if="bagCount > 0">
            {{ bagCount }}
          </div>
        </a>
        <div class="uk-card-border uk-background-default uk-card" uk-drop="pos: bottom-center; delay-hide:0" v-if="bagCount > 0">
              <div class="uk-card-body uk-card-small">
                <div class="uk-grid-small" uk-grid v-for="bag in filteredBags">
                  <div class="uk-width-1-3">
                    <lazy-background
                      :image-source="bag.options.photo | awsLink(aws_link)"
                      :alt="bag.name"
                      :loading-image="loadingImage"
                      :error-image="errorImage">
                    </lazy-background>
                  </div>
                  <div class="uk-width-2-3">
                    <div class="uk-panel">
                      <span class="uk-text-small"><b>{{ bag.name }}</b></span><br>
                      <span class="uk-text-small">{{ bag.price | round(exchangeRate.symbol, exchangeRate.value) }} </span><br>
                      <span class="uk-text-meta">{{ trans.color }} : {{ bag.options.color }}</span><br>
                      <span class="uk-text-meta">{{ trans.size }}  : {{ bag.options.size }}</span><br>
                      <a :href="product_link+'/'+bag.options.slug+'/bag/'+bag.id" class="uk-button uk-button-text uk-button-small" name="button"><span class="uk-icon" uk-icon="icon: pencil; ratio: 0.8"></span>{{ trans.edit }}</a>
                      <button type="button" class="uk-button uk-button-text uk-button-small" name="button" v-on:click="removeBag(bag.id)"><span class="uk-icon" uk-icon="icon: trash; ratio: 0.8"></span>{{trans.remove}}</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-card-footer uk-background-muted">
                <div class="uk-text-center">
                  <a :href="bag_link" class="uk-button uk-button-text">{{ trans.your_shop}}</a>
                </div>
              </div>
              <div class="uk-card-footer uk-padding-small">
                <div class="uk-text-center">
                  <h4 class="uk-text-uppercase">{{ trans.subtotal}}: {{ subtotal | round(exchangeRate.symbol, exchangeRate.value) }}</h4>
                  <a :href="checkout_link" class="uk-button-secondary uk-button uk-button-small uk-width-1-1 uk-text-uppercase">{{ trans.checkout_now}}</a>
                </div>
              </div>
          </div>
          <div class="uk-card-border uk-background-default uk-card" uk-drop="pos: bottom-right; delay-hide:0" id="bag-hidden" v-else></div>

      </li>
      <li v-if="auth == 0" class="uk-margin-left">
        <a :href="login_link"><i class="material-icons" style="font-size: 18px; vertical-align:middle">person</i> </a>
      </li>
      <li v-if="auth == 1" class="uk-margin-left">
        <a :href="profile_link"> <i class="material-icons" style="font-size: 18px; vertical-align:middle">person</i> {{ accounts.first_name }}</a>

          <div class="uk-card uk-card-default uk-background-default uk-card-small" uk-drop="pos: bottom-right; delay-hide:0" style="width: 150px">
            <div class="uk-card-body">
              <ul class="uk-list uk-text-meta">
                <li><a :href="profile_link">{{trans.account}}</a> </li>
                <li><a :href="history_link">{{trans.order_history}}</a> </li>
                <li><a :href="logout_link">{{trans.sign_out}}</a> </li>
              </ul>
            </div>
          </div>

      </li>
    </ul>
  </div>
</div>
</template>

<style>
  #bag-hidden {
    display: none;
  }
</style>

<script>
  import axios from 'axios';
  import VueLazyBackgroundImage from '../components/VueLazyBackgroundImage.vue';

  export default {
    props: [
      'profile_link',
      'history_link',
      'wishlist_link',
      'bag_link',
      'login_link',
      'auth',
      'wishlist_api',
      'bag_api',
      'account',
      'product_link',
      'checkout_link',
      'api_token',
      'logout_link',
      'aws_link',
      'default_image',
      'locale',
      'exchange_api',
      'currency_code',
      'language'
    ],

    components: {
      'lazy-background': VueLazyBackgroundImage
    },

    created () {
      var self = this;

      if (this.auth == 1) {
        self.getWishlist();
      }

      self.getExchange();

      self.accounts = this.account ? JSON.parse(this.account) : {};

      self.getBag();

      Event.listen('addBag', function (response) {
        self.bagCount = response.data.bagCount;
        self.bags = response.data.bags;
        self.subtotal = parseFloat(response.data.subtotal.replace(/,/g, ''));
      });

      Event.listen('removePopUp', function (response) {
        self.bagCount = response.data.bagCount;
        self.bags = response.data.bags;
        self.subtotal = parseFloat(response.data.subtotal.replace(/,/g, ''));
      });

      Event.listen('addWishlist', function (response) {
        self.wishlistCount = response.data.wishlistCount;
      });

      Event.fire('user', this.accounts);

      self.errorImage = this.aws_link+'/images/'+this.defaultImage.image_2;
      self.loadingImage = this.aws_link+'/images/loading-image.gif';
      self.flagImage = this.aws_link+'/images/flag1x1/';
    },

    data () {
      return {
        wishlistCount: {},
        bagCount: {},
        bags: {},
        accounts: {},
        subtotal: {},
        defaultImage: JSON.parse(this.default_image,true),
        errorImage: {},
        loadingImage: {},
        trans: JSON.parse(this.locale,true),
        currencyCode: this.currency_code,
        language: this.language,
        exchangeRate: {},
        flagImage:{}
      }
    },

    methods: {
      removeBag: function (sku) {
        var self = this;
        axios.get(this.bag_api, {
          params: {
            remove: sku
          }
        })
        .then(function (response) {
          self.bagCount = response.data.bagCount;
          self.bags = response.data.bags;
          self.subtotal = parseFloat(response.data.subtotal.replace(/,/g, ''));

          Event.fire('removeBag', response);
        })
        .catch(function (error) {
          console.log(error);
        });
      },

      getBag: function () {
        var self = this;
        axios.get(this.bag_api, {
        })
        .then(function (response) {
          self.bagCount = response.data.bagCount;
          self.bags = response.data.bags;
          self.subtotal = parseFloat(response.data.subtotal.replace(/,/g, ''));

          Event.fire('bags', response);
        })
        .catch(function (error) {
          console.log(error);
        });
      },

      getWishlist: function () {
        var self = this;
        var api_token = this.api_token;
        axios.post(this.wishlist_api, {
          api_token: api_token
        })
        .then(function (response) {
          if (typeof response.data.data !== 'undefined') {
            self.wishlistCount = response.data.data.length;
          }
        })
        .catch(function (error) {
          console.log(error);
        });
      },

      getExchange: function () {
        var self = this;
        axios.get(this.exchange_api, {
        })
        .then(function (response) {
          self.exchangeRate = response.data.data;

          Event.fire('exchange', response);
        })
        .catch(function (error) {
          console.log(error);
        });
      },

      goBag: function () {
        window.location.href = this.bag_link;
      }
    },

    computed: {
      filteredBags: function () {
        return typeof this.bags[0] !== 'undefined' ? this.bags.slice(0,2) : {};
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
      }
    }
  }
</script>
