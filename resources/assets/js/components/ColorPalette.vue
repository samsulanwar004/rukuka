<template>
      <div>
          <h5 class="uk-text-uppercase">{{ trans.color }}</h5>
            <ul class="uk-grid uk-grid-collapse">
              <li v-for="color in palette" :uk-tooltip="color.name">
                <label>
                  <input type="radio" name="palette" v-on:click="pickColor(color.id)" :checked="color.id == color_id"/>
                    <lazy-background
                      :image-source="color.palette"
                      :loading-image="loadingImage"
                      :error-image="errorImage"
                      :alt="color.name"
                      width="27px">
                    </lazy-background>
                </label>
              </li>
            </ul>
      </div>

</template>

<script>
    import axios from 'axios';
    import VueLazyBackgroundImage from '../components/VueLazyBackgroundImage.vue';
    export default {
        props: ['api', 'default_image', 'aws_link', 'color_id','filter','locale'],

        components: {
          'lazy-background': VueLazyBackgroundImage
        },

        created () {
            var self = this;
            var api = this.api;

            axios.get(api)
                .then(function (response) {

                    if (typeof response.data.data !== 'undefined') {

                        Event.fire('api-color', response.data.data);

                        if (typeof response.data.data !== 'undefined') {
                            self.palette = response.data.data;
                        }

                    }
                })
                .catch(function (error) {
                    console.log(error);
                });

            self.errorImage = this.aws_link+'/images/'+this.defaultImage.image_2;
            self.loadingImage = this.aws_link+'/images/loading-image.gif';
        },

        data () {
            return {
                palette: {},
                defaultImage: JSON.parse(this.default_image,true),
                errorImage: {},
                loadingImage: {},
                trans: JSON.parse(this.locale,true),
            }
        },

        methods: {
            pickColor: function (colorId) {
                if(this.filter){
                    window.location.href = '?'+this.filter+'&color_id='+colorId;
                }
                else{
                    window.location.href = '?color_id='+colorId;
                }
            }
        }
    }
</script>
