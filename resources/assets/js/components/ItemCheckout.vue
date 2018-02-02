<template>
    <div class="uk-overflow-auto uk-margin-bottom">
    <table class="uk-table uk-table-striped">
        <thead>
            <tr>
                <th class="uk-table-shrink" colspan="3"><h4 class="uk-margin-remove uk-text-uppercase">{{ trans.items }} ({{ bags.length }})</h4></th>
            </tr>
        </thead>
        <thead>
        <tr>
            <th class="uk-table-shrink"></th>
            <th class="uk-table-expand uk-text-uppercase">{{ trans.item }}</th>
            <th class="uk-width-medium uk-text-uppercase">{{ trans.qty }}</th>
            <th class="uk-table-shrink uk-text-nowrap uk-text-uppercase">{{ trans.unit_price }}</th>
        </tr>
        </thead>
        <tbody v-for="bag in bags">
            <tr>
                <td>
                    <img v-if="bag.options.photo" class="uk-preserve-width" :src="bag.options.photo | awsLink(aws_link)" width="130" alt="rukuka product">
                    <img v-else :src="aws_link+'/'+'images/'+defaultImage.image_2" :alt="rukuka" width="130">
                </td>
                <td class="uk-table-link">
                  <ul class="uk-list uk-margin-small-top">
                    <li><h4>{{ bag.name }}</h4></li>
                    <li class="uk-margin-remove"><span class="uk-text-small">{{ trans.color }} : {{ bag.options.color }}</span></li>
                    <li class="uk-margin-remove"><span class="uk-text-small">{{ trans.size }} : {{ bag.options.size }}</span></li>
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
    export default {
        props: ['bag_api','aws_link','default_image','locale'],
        data () {
            return {
                bags: {},
                defaultImage: JSON.parse(this.default_image,true),
                trans: JSON.parse(this.locale,true)
            }
        },

        created () {
            var self = this;
            self.getBag();
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
