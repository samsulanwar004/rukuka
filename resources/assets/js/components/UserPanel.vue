<template>
<div class="uk-width-1-3@m uk-flex uk-flex-right">
  <ul class="uk-grid-small uk-flex-middle" uk-grid>

    <li v-if="auth == 1" class="uk-margin-right">
      <a class="uk-button uk-button-text uk-button-small" :href="profileLink"> Hallo, <b>{{ accounts.first_name }}</b></a>
      </a>
    </li>
    <li v-if="auth == 1"  class="uk-margin-right">
      <a class="uk-button uk-button-text uk-button-small" :href="wishlistLink"><b>L O V E</b></a>
        <div class="uk-badge" v-if="wishlistCount > 0">
          {{ wishlistCount }}
        </div>
    </li>

    <li>
      <a class="uk-button uk-button-text uk-button-small" :href="bagLink"> <b>B A G</b></a>
      <div class="uk-card-border uk-background-default uk-card" uk-drop="pos: bottom-right; delay-hide:0" v-if="bags.length != 0">
            <div class="uk-card-body uk-card-small ">
              <div class="uk-grid-small" uk-grid v-for="bag in bags">
                <div class="uk-width-1-3">
                  <img :src="'/'+bag.options.photo" :alt="bag.name">
                </div>
                <div class="uk-width-2-3">
                  <div class="uk-panel">
                    <span class="uk-text-small"><b>{{ bag.name }}</b></span><br>
                    <span class="uk-text-small">{{ bag.options.currency }} {{ bag.price }} </span><br>
                    <span class="uk-text-meta">color : {{ bag.options.color }}</span><br>
                    <span class="uk-text-meta">size  : {{ bag.options.size }}</span><br>
                    <button type="button" class="uk-button uk-button-text uk-button-small" name="button"><span class="uk-icon" uk-icon="icon: pencil; ratio: 0.8"></span>edit</button>
                    <button type="button" class="uk-button uk-button-text uk-button-small" name="button"><span class="uk-icon" uk-icon="icon: trash; ratio: 0.8"></span>remove</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-card-footer uk-padding-remove uk-background-muted">
              <div class="uk-text-center">
                <a href="#">see all your shop</a>
              </div>
            </div>
            <div class="uk-card-footer uk-padding-small">
              <div class="uk-text-center">
                <b>SUB TOTAL: IDR 1200000</b>
                <input type="submit" class="uk-button-secondary uk-button uk-button-small uk-width-1-1" name="" value="CHECKOUT NOW">
              </div>
            </div>
        </div>
        <div class="uk-badge" v-if="bagCount > 0">
          {{ bagCount }}
        </div>
    </li>
    <li v-if="auth == 0" class="uk-margin-left">
      <a class="uk-button uk-button-text uk-button-small" :href="loginLink"><b>L O G I N</b></a>
    </li>
  </ul>

</div>
</template>

<script>
    export default {
      props: [
        'profile_link',
        'wishlist_link',
        'bag_link',
        'bag_count',
        'login_link',
        'auth',
        'wishlist_api',
        'bag',
        'account'
      ],

      created () {
        var self = this;
        var wishlist_api = this.wishlist_api;

        if (this.auth == 1) {
          $.get(wishlist_api, function(wishlist) {
            if (typeof wishlist.data !== 'undefined') {
              self.wishlistCount = wishlist.data.length;
            }
          });
        }

        self.bags = this.bag ? JSON.parse(this.bag) : {};

        self.accounts = this.account ? JSON.parse(this.account) : {};
      },

      data() {
        return {
          profileLink: this.profile_link,
          wishlistLink: this.wishlist_link,
          loginLink: this.login_link,
          bagLink: this.bag_link,
          bagCount: this.bag_count,
          auth: this.auth,
          wishlistCount: {},
          bags: {},
          accounts: {}
        }
      }
    }
</script>
