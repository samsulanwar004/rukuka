<template>
      <div>
          <h5 class="uk-text-uppercase uk-accordion-title">{{ trans.color }}</h5>
            <ul class="uk-grid uk-grid-collapse">
              <li v-for="color in palette" :uk-tooltip="color.name">
                  <div v-for="colArr in colorArr">
                      <div v-if="colArr == color.name ">
                        <label>
                          <input type="radio" name="palette" v-on:click="pickColor(color.id)" :checked="color.id == color_id"/>
                            <lazy-background
                              :image-source="color.palette"
                              :loading-image="loadingImage"
                              :error-image="errorImage"
                              :alt="color.name"
                              width="27px"
                              image-class="uk-border-circle uk-box-shadow-small">
                            </lazy-background>
                        </label>
                      </div>
                  </div>
              </li>
            </ul>
      </div>

</template>

<script>
    import axios from 'axios';
    import VueLazyBackgroundImage from '../components/VueLazyBackgroundImage.vue';
    export default {
        props: ['default_image', 'aws_link', 'color_id', 'locale', 'action_link','color_array'],

        components: {
          'lazy-background': VueLazyBackgroundImage
        },

        created() {
            var self = this;

            Event.listen('api-color', function (response){

                if (typeof response !== 'undefined') {
                    self.palette = response;
                }
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
                colorArr: JSON.parse(this.color_array,true),
            }
        },

        methods: {
          pickColor: function (colorId) {
            var search = function searchStringInArray (str, strArray) {
                  for (var j=0; j<strArray.length; j++) {
                      if (strArray[j].match(str)) return j;
                  }
                  return -1;
              }
              var myarr = this.action_link.split("&");
              var position = search('color',myarr);
              if(position == -1) {
                  window.location.href = this.action_link+'&color_id='+colorId;
              } else {
                  delete myarr[position];
                  window.location.href = myarr.join('&')+'&color_id='+colorId;
              }
          }
        }
    }
</script>
