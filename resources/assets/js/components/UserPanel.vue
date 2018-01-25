<template>
<div class="uk-width-1-3@m uk-flex uk-flex-middle">
  <div class="uk-width-1-1 uk-flex uk-flex-middle uk-flex-right uk-visible@m">
    <ul class="uk-grid-small " uk-grid>
      <li v-if="auth == 1" class="uk-margin-right">
        <a class="uk-button uk-button-text uk-button-small" :href="profile_link"> Hallo, <b>{{ accounts.first_name }}</b></a>
        <div class="uk-drop uk-drop-bottom-left" uk-drop="delay-hide:0" style="width: 150px">
          <div class="uk-card uk-card-border uk-background-default uk-card-small">
            <div class="uk-card-body">
              <ul class="uk-list uk-text-meta">
                <li><a :href="profile_link">MY ACCOUNT</a> </li>
                <li><a :href="logout_link">SIGN OUT</a> </li>
              </ul>
            </div>
          </div>
        </div>
      </li>
      <li v-if="auth == 1"  class="uk-margin-right">
        <a class="uk-button uk-button-text uk-button-small" :href="wishlist_link"><b>LOVE</b></a>
          <div class="uk-badge" v-if="wishlistCount > 0">
            {{ wishlistCount }}
          </div>
      </li>

      <li>
        <a class="uk-button uk-button-text uk-button-small" v-on:click.prevent="goBag"> <b>BAG</b></a>
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
                      <span class="uk-text-meta">color : {{ bag.options.color }}</span><br>
                      <span class="uk-text-meta">size  : {{ bag.options.size }}</span><br>
                      <a :href="product_link+'/'+bag.options.slug+'/bag/'+bag.id" class="uk-button uk-button-text uk-button-small" name="button"><span class="uk-icon" uk-icon="icon: pencil; ratio: 0.8"></span>edit</a>
                      <button type="button" class="uk-button uk-button-text uk-button-small" name="button" v-on:click="removeBag(bag.id)"><span class="uk-icon" uk-icon="icon: trash; ratio: 0.8"></span>remove</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-card-footer uk-padding-remove uk-background-muted">
                <div class="uk-text-center">
                  <a :href="bag_link">See all your shop</a>
                </div>
              </div>
              <div class="uk-card-footer uk-padding-small">
                <div class="uk-text-center">
                  <b>SUB TOTAL: {{ subtotal }}</b>
                  <a :href="checkout_link" class="uk-button-secondary uk-button uk-button-small uk-width-1-1">CHECKOUT NOW</a>
                </div>
              </div>
          </div>
          <div class="uk-card-border uk-background-default uk-card" uk-drop="pos: bottom-right; delay-hide:0" id="bag-hidden" v-else></div>
          <div class="uk-badge" v-if="bagCount > 0">
            {{ bagCount }}
          </div>
      </li>
      <li v-if="auth == 0" class="uk-margin-left">
        <a class="uk-button uk-button-text uk-button-small" :href="login_link"><b>LOGIN</b></a>
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
      'default_image'
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
        defaultImage: JSON.parse(this.default_image,true)
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
