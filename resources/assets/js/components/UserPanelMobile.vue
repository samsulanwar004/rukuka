<template>
    <div class="uk-grid-small uk-flex uk-flex-middle uk-hidden@m" uk-grid>
      <div class="uk-width-auto"><a href="#offcanvas-overlay-slide" uk-toggle><i class="material-icons" style="font-size: 18px; vertical-align:middle">menu</i></a></div>
      <div class="uk-width-auto" v-if="navigation">
        <a uk-toggle="target: .test-overlay; animation: uk-animation-fade" href="#"><i class="material-icons" style="font-size: 18px; vertical-align:middle">search</i></a>
      </div>
      <div class="uk-width-expand uk-text-center">
        <a href="/">
          <div class="uk-inline">
          <lazy-background
                  :image-source="logoImage | awsLink(aws_link)"
                  :alt="rukukalogo"
                  :loading-image="loadingImage"
                  :error-image="errorImageSale"
                  image-style="width: 60px">
          </lazy-background>
          </div>
        </a>
      </div>
      <div class="uk-width-auto"><a :href="bag_link"><i class="material-icons" style="font-size: 18px; vertical-align:middle">shopping_basket</i>
        <div class="uk-badge" v-if="bagCount > 0">
          {{ bagCount }}
        </div>
        </a>
      </div>
      <div v-if="auth == 0" class="uk-width-auto"><a :href="login_link"><i class="material-icons" style="font-size: 18px; vertical-align:middle">person</i></a></div>
      <div v-if="auth == 1"  class="uk-width-auto"><a :href="profile_link"><i class="material-icons" style="font-size: 18px; vertical-align:middle">person</i></a>
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
      'locale',
      'navigation'
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
