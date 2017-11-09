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
                      <li><a class="uk-icon-button" uk-icon="icon: minus" v-on:click.prevent="min(bag.id)"></a></li>
                      <li><input type="text" name="qty" class="uk-input uk-form-width-xsmall uk-form-small" :value="bag.qty" v-on:keyup="countQty(bag.id, $event)"></li>
                      <li><a class="uk-icon-button" uk-icon="icon: plus" v-on:click.prevent="plus(bag.id)"></a></li>
                    </ul>
                    </td>
                    <td class="uk-text-nowrap">{{ bag.price }}</td>
                </tr>
                <tr class="uk-background-muted">
                    <td colspan="3"></td>
                    <td colspan="2" class="uk-text-right">
                        <form v-on:submit.prevent="moveWishlist">
                            <input type="hidden" name="size" :value="bag.id">
                            <input type="hidden" name="qty" :value="bag.qty">
                            <input type="hidden" name="move" :value="bag.id">
                            <button class="uk-button uk-button-small uk-button-default uk-padding-small-right uk-margin-remove" type="submit">MOVE TO WISHLIST</button>
                      <a class="uk-button uk-button-small uk-button-default uk-padding-small-right uk-text-right" v-on:click="removeBag(bag.id)">REMOVE FROM BAG</a>
                      </form>
                    </td>
                </tr>
            </tbody>
            <tbody v-if="bags == 0">
                <tr><td colspan="6" align="center"><p>You have no items in the shopping bag</p></td></tr>
            </tbody>
            <tbody>
              <tr>
                <td colspan="6" class="uk-text-right">SUB TOTAL: {{ subtotal }}</td>
              </tr>
              <tr>
                <td colspan="6" class="uk-text-right">SHIPPING COST: FREE</td>
              </tr>
            </tbody>
        </table>
    </div>
</template>


<script>
    import axios from 'axios';
    export default {
        props: ['bag_link', 'wishlist_link', 'auth'],
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
            },

            min: function (sku) {
                axios.get(this.bag_link, {
                  params: {
                    decrease: sku
                  }
                })
                .then(function (response) {
                  Event.fire('bags', response);
                  Event.fire('removePopUp', response);
                })
                .catch(function (error) {
                  console.log(error);
                });
            },

            plus: function (sku) {
                axios.get(this.bag_link, {
                  params: {
                    increment: sku
                  }
                })
                .then(function (response) {
                  Event.fire('bags', response);
                  Event.fire('removePopUp', response);
                })
                .catch(function (error) {
                  console.log(error);
                });
            }, 

            countQty: function (sku, event) {
                var qty = event.target.value;
                if (qty !== '') {
                    axios.get(this.bag_link, {
                      params: {
                        count: sku,
                        qty: qty
                      }
                    })
                    .then(function (response) {
                      Event.fire('bags', response);
                      Event.fire('removePopUp', response);
                    })
                    .catch(function (error) {
                      console.log(error);
                    });
                }                
            },

            moveWishlist: function (event) {
                var size = event.target.elements.size.value;
                var qty = event.target.elements.qty.value;
                var move = event.target.elements.move.value;

                if (this.auth == 1) {

                    axios.post(this.wishlist_link, {
                        size: size,
                        qty: qty,
                        move: move
                    })
                    .then(function (response) {
                        if (typeof response.data.message !== 'undefined') {
                            if (response.data.status.toLowerCase() == 'error') {
                                UIkit.notification(response.data.message.size[0], {
                                    status:'danger'
                                });
                            }
                            if (response.data.status.toLowerCase() == 'ok') {
                                UIkit.notification("<span uk-icon='icon: check'></span> Add product from bag to wishlist successfully", {
                                    status:'success'
                                });

                                Event.fire('addWishlist', response);
                                Event.fire('bags', response);
                                Event.fire('removePopUp', response);
                            }
                        }
                    })
                    .catch(function (error) {
                        var error = JSON.parse(JSON.stringify(error));
                        if (typeof error.response.data.message !== 'undefined') {
                            UIkit.notification(error.response.data.message, {
                                status:'danger'
                            });
                        }
                    });
                } else {
                    UIkit.notification("Please login!", {
                        status:'danger'
                    });
                }
            }
        }
    }
</script>
