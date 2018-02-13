<template>
    <div class="uk-card uk-background-muted uk-box-shadow-small uk-card-small uk-margin-top">
      <div class="uk-card-body">
          <h4>Color Palette</h4>
            <ul class="uk-grid uk-grid-collapse">
              <li v-for="color in palette">
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
    </div>
</template>

<script>
    import axios from 'axios';
    import VueLazyBackgroundImage from '../components/VueLazyBackgroundImage.vue';
    export default {
        props: ['api', 'default_image', 'aws_link', 'color_id'],

        components: {
          'lazy-background': VueLazyBackgroundImage
        },

        created () {
            var self = this;
            axios.get(this.api, {
            })
            .then(function (response) {
              self.palette = response.data.data;
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
            }
        },

        methods: {
            pickColor: function (colorId) {
                window.location.href = '?color_id='+colorId;
            }
        }
    }
</script>
