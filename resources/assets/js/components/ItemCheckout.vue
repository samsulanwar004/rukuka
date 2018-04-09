<template>
    <div class="uk-overflow-auto uk-margin-bottom">
    <h4 class="uk-margin-remove">{{ trans.items }} ({{ bags.length }})</h4>
    <table class="uk-table uk-table-small uk-margin-remove-bottom">
      <tr>
          <td colspan="2" class="uk-table-expand uk-text-uppercase">{{ trans.item }}</td>
          <td class="uk-width-medium uk-text-uppercase uk-text-center">{{ trans.qty }}</td>
          <td class="uk-table-shrink uk-text-nowrap uk-text-uppercase uk-text-center">{{ trans.unit_price }}</td>
      </tr>
    </table>
    <table class="uk-table uk-table-striped uk-margin-remove-top">
        <tbody v-for="bag in bags">
            <tr>
                <td>
                    <lazy-background
                      :image-source="bag.options.photo | awsLink(aws_link)"
                      :loading-image="loadingImage"
                      :error-image="errorImage"
                      :alt="bag.name"
                      image-class="uk-preserve-width"
                      width="130px">
                    </lazy-background>
                </td>
                <td class="uk-table-link">
                  <ul class="uk-list uk-margin-small-top">
                    <li><h4>{{ bag.name }}</h4></li>
                    <li class="uk-margin-remove"><span class="uk-text-small">{{ trans.color }} : {{ bag.options.color }}</span></li>
                    <li class="uk-margin-remove"><span class="uk-text-small">{{ trans.size }} : {{ bag.options.size }}</span></li>
                    <li class="uk-margin-remove" v-if="bag.options.preorder"><span class="uk-text-small uk-text-danger">Pre Order {{ bag.options.preorder }} days</span></li>
                  </ul>
                </td>
                <td class="uk-text-nowrap">
                <ul class="uk-grid-small uk-flex-middle" uk-grid>
                  <li>{{ bag.qty }}</li>
                </ul>
                </td>
                <td class="uk-text-nowrap"><h4>{{ bag.price | round(exchangeRate.symbol, exchangeRate.value) }}</h4></td>
            </tr>
        </tbody>
    </table>
    </div>
</template>

<script>
    import axios from 'axios';
    import VueLazyBackgroundImage from '../components/VueLazyBackgroundImage.vue';

    export default {
        props: ['bag_api','aws_link','default_image','locale', 'exchange_api'],

        components: {
          'lazy-background': VueLazyBackgroundImage
        },

        data () {
            return {
                bags: {},
                defaultImage: JSON.parse(this.default_image,true),
                errorImage: {},
                loadingImage: {},
                trans: JSON.parse(this.locale,true),
                exchangeRate: {}
            }
        },

        created () {
            var self = this;

            self.getExchange();

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
            },

            getExchange: function () {
                var self = this;
                axios.get(this.exchange_api, {
                })
                .then(function (response) {
                  self.exchangeRate = response.data.data;

                  Event.fire('exchange', response);
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

          round: function(value, currency, rate) {
            var value = value / rate;
            var money = function(n, currency) {
              return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
            };

            return money(Number(Math.round(value+'e'+2)+'e-'+2), currency);
          }
        }
    }
</script>
