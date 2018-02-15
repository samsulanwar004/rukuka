<template>
    <div class="uk-grid-small uk-hidden@m" uk-grid>
      <div class="uk-width-auto"><a class="uk-icon-link" uk-icon="icon: more; ratio: 0.9" href="#offcanvas-overlay-slide" uk-toggle></a></div>
      <div class="uk-width-auto">
        <a class="uk-icon-link" uk-icon="icon: search;  ratio: 0.9" uk-toggle="target: .test-overlay; animation: uk-animation-fade" href="#"></a>
      </div>
      <div class="uk-width-expand uk-text-center">
        <img src="{{ imageCDN(config('common.logo')) }}" alt="rukuka" width="90">
      </div>
      <div class="uk-width-auto"><a class="uk-icon-link" uk-icon="icon: cart; ratio: 0.9" :href="bag_link"></a>
        <div class="uk-badge" v-if="bagCount > 0">
          {{ bagCount }}
        </div>
      </div>
      <div v-if="auth == 0" class="uk-width-auto"><a class="uk-icon-link" uk-icon="icon: user;  ratio: 0.9" :href="login_link"></a></div>
      <div v-if="auth == 1"  class="uk-width-auto"><a class="uk-icon-link" uk-icon="icon: user;  ratio: 0.9" :href="profile_link"></a>
      </div>
    </div>
</template>

<script>
  export default {
    props: [
      'profile_link',
      'bag_link',
      'login_link',
      'auth',
      'locale'
    ],

    created () {
      var self = this;

      Event.listen('bags', function (response) {
        self.bagCount = response.data.bagCount;
      });

      Event.listen('addBag', function (response) {
        self.bagCount = response.data.bagCount;
      });

      Event.listen('removePopUp', function (response) {
        self.bagCount = response.data.bagCount;
      });
    },

    data () {
      return {
        bagCount: {},
        trans: JSON.parse(this.locale,true)
      }
    }
  }
</script>
