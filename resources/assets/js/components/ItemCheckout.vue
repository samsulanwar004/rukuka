<template>
    <div class="uk-overflow-auto uk-margin-bottom">
    <table class="uk-table uk-table-striped">
        <thead>
            <tr>
                <th class="uk-table-shrink" colspan="3"><h4 class="uk-margin-remove">ITEMS ({{ bags.length }})</h4></th>
            </tr>
        </thead>
        <thead>
        <tr>
            <th class="uk-table-shrink"></th>
            <th class="uk-table-expand">ITEM</th>
            <th class="uk-width-medium">QTY</th>
            <th class="uk-table-shrink uk-text-nowrap">UNIT PRICE</th>
        </tr>
        </thead>
        <tbody v-for="bag in bags">
            <tr>
                <td>
                    <lazy-background
                      :image-source="bag.options.photo | awsLink(aws_link)"
                      :alt="product.name"
                      :loading-image="loadingImage"
                      :error-image="errorImage"
                      :image-success-callback="successCallback"
                      :image-error-callback="errorCallback"
                      :alt="bag.name"
                      image-class="uk-preserve-width"
                      width="130px">
                    </lazy-background>
                </td>
                <td class="uk-table-link">
                  <ul class="uk-list uk-margin-small-top">
                    <li><h4>{{ bag.name }}</h4></li>
                    <li class="uk-margin-remove"><span class="uk-text-small">Color: {{ bag.options.color }}</span></li>
                    <li class="uk-margin-remove"><span class="uk-text-small">Size : {{ bag.options.size }}</span></li>
                  </ul>
                </td>
                <td class="uk-text-nowrap">
                <ul class="uk-grid-small uk-flex-middle" uk-grid>
                  <li>{{ bag.qty }}</li>
                </ul>
                </td>
                <td class="uk-text-nowrap"><h4>{{ bag.price | round }}</h4></td>
            </tr>
        </tbody>
    </table>
    </div>
</template>

<script>
    import axios from 'axios';
    import VueLazyBackgroundImage from '../components/VueLazyBackgroundImage.vue';

    export default {
        props: ['bag_api','aws_link','default_image'],

        components: {
          'lazy-background': VueLazyBackgroundImage
        },

        data () {
            return {
                bags: {},
                defaultImage: JSON.parse(this.default_image,true),
                errorImage: {},
                loadingImage: {}
            }
        },

        created () {
            var self = this;
            self.getBag();

            self.errorImage = this.aws_link+'/images/'+this.defaultImage.image_2;      
            self.loadingImage = this.aws_link+'/images/loading-image.gif'; 
        },

        methods: {
            getBag: function () {
                var self = this;
                axios.get(this.bag_api, {
                })
                .then(function (response) {
                  self.bags = response.data.bags;

                  Event.fire('bags', response);
                })
                .catch(function (error) {
                  console.log(error);
                });
            }
        },

        filters: {
          awsLink: function (value, aws) {
            var link = value == null ? '#' : aws+'/'+value;
            return link;
          },

          round: function(value) {
            var money = function(n, currency) {
              return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
            };

            return money(Number(Math.round(value+'e'+2)+'e-'+2), '$');
          }
        }
    }
</script>
