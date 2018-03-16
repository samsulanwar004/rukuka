<template>
    <div>
        <div class="uk-margin-small-top">
            <div class="uk-inline">
                    <lazy-background
                            :image-source="collection.photo | awsLink(aws_link)"
                            :alt="collection.name"
                            :loading-image="loadingImage"
                            :error-image="errorImage"
                            image-style="max-height:700px">
                        >
                    </lazy-background>
                <div class="uk-position-center-left uk-position-medium uk-text-center">
                  <div class="uk-width-1-5@m">
                    <div uk-slideshow-parallax="scale: 1,1,0.8">
                        <p class="uk-text-lead uk-visible@m" uk-slideshow-parallax="x: 400,0,0;">{{ collection.title }}</p>
                        <p class="uk-text-lead uk-visible@m" uk-slideshow-parallax="x: 400,0,0;">{{ collection.subtitle }}</p>
                    </div>
                  </div>

                </div>
            </div>
            <h6 class="uk-text-muted uk-margin-remove uk-hidden@m" uk-slideshow-parallax="x: 400,0,0;">{{ collection.title }}</h6>
            <h6 class="uk-text-muted uk-margin-remove uk-hidden@m" uk-slideshow-parallax="x: 400,0,0;">{{ collection.subtitle }}</h6>
            <p class="uk-text-lead uk-visible@m" uk-slideshow-parallax="x: 400,0,0;">{{ collection.subtitle }}</p>
            <h4 class="uk-margin-small">{{ collection.name }}</h4>
            <loobook-product
                    :api="api"
                    :product_api="product_api"
                    :bag_api="bag_api"
                    :wishlist_api="wishlist_api"
                    :auth="auth"
                    :aws_link="aws_link"
                    :default_image="default_image"
                    :recently="collection.product_id"
                    :bag_link="bag_link"
                    :locale="locale"
                    :modal_code="collection.id"
            ></loobook-product>
        </div>
    </div>

</template>

<script>
    import Related from '../components/Related.vue';
    import VueLazyBackgroundImage from '../components/VueLazyBackgroundImage.vue';
    export default {
        props: [
            'collections',
            'api',
            'product_api',
            'bag_api',
            'wishlist_api',
            'auth',
            'aws_link',
            'default_image',
            'recently',
            'bag_link',
            'locale'
        ],

        components: {
            'loobook-product': Related,
            'lazy-background': VueLazyBackgroundImage
        },

        created(){
            var self = this;

            self.collection = JSON.parse(this.collections);
            self.errorImage = this.aws_link+'/images/'+this.defaultImage.image_1;
            self.loadingImage = this.aws_link+'/images/loading-image.gif';
        },

        data(){
            return{
                collection : {},
                errorImage: {},
                loadingImage: {},
                defaultImage: JSON.parse(this.default_image,true),
            }
        },

        filters: {
            awsLink: function (value, aws) {
                var link = value == null ? '#' : aws+'/'+value;
                return link;
            },

        }
    }
</script>
