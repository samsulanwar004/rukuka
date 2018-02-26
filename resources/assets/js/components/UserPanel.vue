<template>
<div class="uk-width-1-3@m uk-flex uk-flex-middle">
  <div class="uk-width-1-1 uk-flex uk-flex-middle uk-flex-right uk-visible@m">
    <ul class="uk-grid-small " uk-grid>
      <li v-if="auth == 1" class="uk-margin-right">
        <a class="uk-button uk-button-text uk-button-small" :href="profile_link"> {{trans.hallo}} <b>{{ accounts.first_name }}</b></a>
        <div class="uk-drop uk-drop-bottom-left" uk-drop="delay-hide:0" style="width: 150px">
          <div class="uk-card uk-card-border uk-background-default uk-card-small">
            <div class="uk-card-body">
              <ul class="uk-list uk-text-meta">
                <li><a :href="profile_link">{{trans.account}}</a> </li>
                <li><a :href="history_link">{{trans.order_history}}</a> </li>
                <li><a :href="logout_link">{{trans.sign_out}}</a> </li>
              </ul>
            </div>
          </div>
        </div>
      </li>
      <li v-if="auth == 1"  class="uk-margin-right">
        <a class="uk-button uk-button-text uk-button-small" :href="wishlist_link"><b>{{trans.love}}</b></a>
          <div class="uk-badge" v-if="wishlistCount > 0">
            {{ wishlistCount }}
          </div>
      </li>

      <li>
        <a class="uk-button uk-button-text uk-button-small" v-on:click.prevent="goBag"> <b>{{trans.bag_label}}</b></a>
        <div class="uk-card-border uk-background-default uk-card" uk-drop="pos: bottom-right; delay-hide:0" v-if="bagCount > 0">
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
          <div class="uk-badge" v-if="bagCount > 0">
            {{ bagCount }}
          </div>
      </li>
      <li v-if="auth == 0" class="uk-margin-left">
        <a class="uk-button uk-button-text uk-button-small" :href="login_link"><b>{{ trans.login }}</b></a>
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
      'exchange_api'
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
        exchangeRate: {}
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
