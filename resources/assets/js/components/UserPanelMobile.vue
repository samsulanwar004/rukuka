<template>
    <div class="uk-grid-small uk-flex uk-flex-middle uk-hidden@m" uk-grid>
      <div class="uk-width-auto"><a class="uk-icon-link" uk-icon="icon: more; ratio: 0.9" href="#offcanvas-overlay-slide" uk-toggle></a></div>
      <div class="uk-width-auto">
        <a class="uk-icon-link" uk-icon="icon: search;  ratio: 0.9" uk-toggle="target: .test-overlay; animation: uk-animation-fade" href="#"></a>
      </div>
      <div class="uk-width-expand uk-text-center">
        <a href="/">
          <lazy-background
                  :image-source="logoImage | awsLink(aws_link)"
                  :alt="rukukalogo"
                  :loading-image="loadingImage"
                  :error-image="errorImageSale"
                  image-style="width: 60px">
          </lazy-background>
        </a>
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
    import VueLazyBackgroundImage from '../components/VueLazyBackgroundImage.vue';

    export default {
    props: [
      'profile_link',
      'bag_link',
      'login_link',
      'auth',
      'aws_link',
      'default_image',
      'logo',
      'locale'
    ],

    components: {
        'lazy-background': VueLazyBackgroundImage
    },

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

      self.errorImage = this.aws_link+'/images/'+this.defaultImage.image_6;
      self.loadingImage = this.aws_link+'/images/loading-image.gif';
    },

    data () {
      return {
        bagCount: {},
        defaultImage: JSON.parse(this.default_image,true),
        errorImage: {},
        loadingImage: {},
        logoImage: this.aws_link+'/images/'+JSON.parse(this.logo,true),
        trans: JSON.parse(this.locale,true)
      }
    }
  }
</script>
