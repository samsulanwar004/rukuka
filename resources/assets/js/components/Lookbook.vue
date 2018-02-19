<template>
    <div>
        <div v-for="collect in collection" class="uk-margin">
            <div class="uk-inline">
                    <lazy-background
                            :image-source="collect.photo | awsLink(aws_link)"
                            :alt="collect.name"
                            :loading-image="loadingImage"
                            :error-image="errorImage"
                            image-style="max-height:700px">
                        >
                    </lazy-background>
                <div class="uk-position-top-left uk-position-medium uk-text-center">
                    <div uk-slideshow-parallax="scale: 1,1,0.8">
                        <p class="uk-text-lead" uk-slideshow-parallax="x: 400,0,0;">{{ collect.title }}</p>
                    </div>
                </div>
            </div>
            <h4 class="uk-margin-small">{{ collect.name }}</h4>
            <loobook-product
                    :api="api"
                    :product_api="product_api"
                    :bag_api="bag_api"
                    :wishlist_api="wishlist_api"
                    :auth="auth"
                    :aws_link="aws_link"
                    :default_image="default_image"
                    :recently="collect.product_id"
                    :bag_link="bag_link"
                    :locale="locale"
                    :modal_code="collect.id"
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
