<template>
<div class="uk-width-1-5@m">
  <ul class="uk-grid-small uk-flex-middle" uk-grid>
    <li v-if="auth == 0">
      <a class="uk-button uk-button-default" :href="loginLink">Sign In</a>
    </li>
    <li v-if="auth == 1">
      <a class="uk-icon-button" uk-icon="icon: user" :href="profileLink">

      </a>
    </li>
    <li v-if="auth == 1">
      <a class="uk-icon-button" uk-icon="icon: heart" :href="wishlistLink"></a>
        <div class="uk-badge custom-badge" v-if="wishlistCount > 0">
          {{ wishlistCount }}
        </div>
    </li>

    <li>
      <a class="uk-icon-button" uk-icon="icon: cart" :href="bagLink"></a>
      <div uk-drop="pos: bottom-right" v-if="bags.length != 0">
            <div class="uk-card uk-card-body uk-card-small uk-card-default">
              <div class="uk-grid-small" uk-grid v-for="bag in bags">
                <div class="uk-width-1-3">
                  <img :src="'/'+bag.options.photo" :alt="bag.name">
                </div>
                <div class="uk-width-2-3">
                  <div class="uk-panel">
                    <h4 class="uk-margin-remove uk-padding-remove">{{ bag.name }}</h4>
                    <h5 class="uk-margin-remove uk-padding-remove">{{ bag.options.currency }} {{ bag.price }}</h5>
                    <span class="uk-text-meta">color : {{ bag.options.color }}</span><br>
                    <span class="uk-text-meta">size  : {{ bag.options.size }}</span><br>
                    <!-- <button type="button" class="uk-button uk-button-default uk-button-small" name="button">edit</button>
                    <button type="button" class="uk-button uk-button-default uk-button-small" name="button">remove</button> -->
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="uk-badge custom-badge" v-if="bagCount > 0">
          {{ bagCount }}
        </div>
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
        'bag'
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
        self.bags = JSON.parse(this.bag);

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
                bags: {}
            }
        }
    }
</script>
