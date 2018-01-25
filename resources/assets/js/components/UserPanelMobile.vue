<template>
  <div class="uk-width-1-3@m uk-flex uk-flex-middle">
    <ul class="uk-grid-small uk-width-1-1 uk-flex-between uk-hidden@m" uk-grid>
      <li><a class="uk-icon-link" uk-icon="icon: more" href="#offcanvas-overlay-slide" uk-toggle></a></li>
      <li><a class="uk-icon-link" uk-icon="icon: search" uk-toggle="target: .test-overlay; animation: uk-animation-fade" href="#"></a></li>
      <li><a class="uk-icon-link" uk-icon="icon: cart" :href="bag_link"></a>
        <div class="uk-badge" v-if="bagCount > 0">
          {{ bagCount }}
        </div>
      </li>
      <li v-if="auth == 0"><a class="uk-icon-link" uk-icon="icon: user" :href="login_link"></a></li>
      <li v-if="auth == 1" ><a class="uk-icon-link" uk-icon="icon: user" :href="profile_link"></a>
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    props: [
      'profile_link',
      'bag_link',
      'login_link',
      'auth'
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
        bagCount: {}
      }
    }
  }
</script>
