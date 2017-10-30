<template>
    <div class="uk-grid-small uk-margin-top" uk-grid>
        <table class="uk-table uk-table-divider" width="1000">
            <thead>
                <tr>
                    <th class="uk-table-shrink">ITEM</th>
                    <th class="uk-table-expand">DESCRIPTION</th>
                    <th class="uk-table-shrink">COLOR</th>
                    <th class="uk-table-shrink">SIZE</th>
                    <th class="uk-width-medium">QTY</th>
                    <th class="uk-table-shrink uk-text-nowrap">UNIT PRICE</th>
                </tr>
            </thead>
            <tbody v-for="bag in bags">
                <tr>
                    <td rowspan="2"><img class="uk-preserve-width" :src="'/'+bag.options.photo" width="130" alt=""></td>
                    <td class="uk-table-link">
                      <a class="uk-link-reset" href="">{{ bag.options.description }}</a>
                    </td>
                    <td>{{ bag.options.color }}</td>
                    <td class="uk-text-truncate">{{ bag.options.size }}</td>
                    <td class="uk-text-nowrap">
                    <ul class="uk-grid-small uk-flex-middle" uk-grid>
                      <li><a class="uk-icon-button" uk-icon="icon: minus" href=""></a></li>
                      <li><input type="text" class="uk-input uk-form-width-xsmall uk-form-small" :value="bag.qty"></li>
                      <li><a class="uk-icon-button" uk-icon="icon: plus" href=""></a></li>
                    </ul>
                    </td>
                    <td class="uk-text-nowrap">{{ bag.price }}</td>
                </tr>
                <tr class="uk-background-muted">
                    <td colspan="3"></td>
                    <td colspan="2" class="uk-text-right">
                        <input type="hidden" name="size" value="{{ bag.id }}">
                        <input type="hidden" name="qty" value="{{ bag.qty }}">
                        <input type="hidden" name="move" value="{{ bag.id }}">
                      <button class="uk-button uk-button-small uk-button-default uk-padding-small-right uk-margin-remove">MOVE TO WISHLIST</button>
                      <a class="uk-button uk-button-small uk-button-default uk-padding-small-right uk-text-right" v-on:click="removeBag(bag.id)">REMOVE FROM BAG</a>
                    </td>
                </tr>
            </tbody>
<!--             <tbody>
                <tr><td colspan="6" align="center"><p>You have no items in the shopping bag</p></td></tr>
            </tbody> -->
        </table>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props: ['bag_link'],
        created () {
            var self = this;
            Event.listen('bags', function (response) {
                self.bags = response.data.bags;
                self.subtotal = response.data.subtotal;
            });

            Event.listen('removeBag', function (response) {
                self.bags = response.data.bags;
                self.subtotal = response.data.subtotal;
            });
        },

        data () {
            return {
                bags: {},
                subtotal: {}
            }
        },

        methods: {
            removeBag: function (sku) {
                var self = this;
                axios.get(this.bag_link, {
                  params: {
                    remove: sku
                  }
                })
                .then(function (response) {
                  self.bags = response.data.bags;
                  self.subtotal = response.data.subtotal;

                  Event.fire('removePopUp', response);
                })
                .catch(function (error) {
                  console.log(error);
                });
            }
        }
    }
</script>
