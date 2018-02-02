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
                    <img v-if="bag.options.photo" :src="bag.options.photo | awsLink(aws_link)" :alt="bag.name">
                    <img v-else :src="aws_link+'/'+'images/'+defaultImage.image_2" :alt="rukuka">
                  </div>
                  <div class="uk-width-2-3">
                    <div class="uk-panel">
                      <span class="uk-text-small"><b>{{ bag.name }}</b></span><br>
                      <span class="uk-text-small">{{ bag.options.currency }} {{ bag.price }} </span><br>
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
                  <h4 class="uk-text-uppercase">{{ trans.subtotal}}: {{ subtotal }}</h4>
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
  export default {
    props: [
      'profile_link',
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
      'locale'
    ],

    created () {
      var self = this;

      if (this.auth == 1) {
        self.getWishlist();
      }

      self.accounts = this.account ? JSON.parse(this.account) : {};

      self.getBag();

      Event.listen('addBag', function (response) {
        self.bagCount = response.data.bagCount;
        self.bags = response.data.bags;
        self.subtotal = response.data.subtotal;
      });

      Event.listen('removePopUp', function (response) {
        self.bagCount = response.data.bagCount;
        self.bags = response.data.bags;
        self.subtotal = response.data.subtotal;
      });

      Event.listen('addWishlist', function (response) {
        self.wishlistCount = response.data.wishlistCount;
      });

      Event.fire('user', this.accounts);
    },

    data () {
      return {
        wishlistCount: {},
        bagCount: {},
        bags: {},
        accounts: {},
        subtotal: {},
        defaultImage: JSON.parse(this.default_image,true),
        trans: JSON.parse(this.locale,true)
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
          self.subtotal = response.data.subtotal;

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
          self.subtotal = response.data.subtotal;

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
      }
    }
  }
</script>
