<template>
    <div class="uk-grid-small uk-margin-top" uk-grid>
      <div class="uk-width-3-4@m">

        <table class="uk-table uk-table-divider">
          <thead>
              <tr>
                  <th class="uk-table-shrink" colspan="4"><b>Y O U R &nbsp;&nbsp; B A G ({{ bags.length }}) </b></th>
              </tr>
          </thead>
            <thead>
                <tr>
                    <th class="uk-table-shrink">ITEM</th>
                    <th class="uk-table-expand">PRODUCT NAME</th>
                    <th class="uk-width-medium">QTY</th>
                    <th class="uk-table-shrink uk-text-nowrap">UNIT PRICE</th>
                </tr>
            </thead>
            <tbody v-for="bag in bags">
                <tr>
                    <td><img class="uk-preserve-width" :src="'/'+bag.options.photo" width="130" alt=""></td>
                    <td class="uk-table-link">
                      <ul class="uk-list uk-margin-small-top">
                        <li><b>{{ bag.name }}</b></li>
                        <li class="uk-margin-remove"><span class="uk-text-small">Color: {{ bag.options.color }}</span></li>
                        <li class="uk-margin-remove"><span class="uk-text-small">Size : {{ bag.options.size }}</span></li>
                      </ul>
                      <form v-on:submit.prevent="moveWishlist">
                          <input type="hidden" name="size" :value="bag.id">
                          <input type="hidden" name="qty" :value="bag.qty">
                          <input type="hidden" name="move" :value="bag.id">
                          <button class="uk-button uk-button-small uk-button-default uk-padding-small-right uk-margin-remove" type="submit">MOVE TO WISHLIST</button>
                    <a class="uk-button uk-button-small uk-button-default uk-padding-small-right uk-text-right" v-on:click="removeBag(bag.id, bag.name)">REMOVE</a>
                    </form>
                    </td>
                    <td class="uk-text-nowrap">
                    <ul class="uk-grid-small uk-flex-middle" uk-grid>
                      <li><a class="uk-icon-link" uk-icon="icon: minus" v-on:click.prevent="min(bag.id, bag.qty, bag.name)"></a></li>
                      <li><input type="text" name="qty" class="uk-input uk-form-width-xsmall uk-form-small" :value="bag.qty" v-on:keyup="countQty(bag.id, $event)"></li>
                      <li><a class="uk-icon-link" uk-icon="icon: plus" v-on:click.prevent="plus(bag.id)"></a></li>
                    </ul>
                    </td>
                    <td class="uk-text-nowrap">{{ bag.price }}</td>
                </tr>
            </tbody>
            <tbody v-if="bags == 0">
                <tr><td colspan="6" align="center"><p>You have no items in the shopping bag</p></td></tr>
            </tbody>
        </table>
      </div>
      <div class="uk-width-1-4@m">
        <div class="uk-card uk-card-border uk-card-default uk-card-small">
          <div class="uk-card-header">
            <b>SUMMARY</b>
          </div>
          <div class="uk-card-body">
            <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
              <div class="uk-text-small"><b>SUBTOTAL</b></div>
              <div class="uk-text-right">{{ subtotal }}</div>
            </div>
            <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
              <div class="uk-text-small">Shipping Cost</div>
              <div class="uk-text-right">FREE</div>
            </div>
            <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
              <div class="uk-text-small">Tax</div>
              <div class="uk-text-right">FREE</div>
            </div>
          </div>
          <div class="uk-card-footer">
            <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
              <div><b>TOTAL</b></div>
              <div class="uk-text-right">{{ subtotal }}</div>
            </div>
          </div>
          <div class="uk-card-footer">
            <input type="submit" class="uk-button uk-button-small uk-button-danger uk-width-1-1" name="checkout" value="c h e c k o u t">
          </div>
          </div>
          <hr>
          <div class="uk-card uk-card-default uk-card-border uk-card-small">
            <div class="uk-card-header">
              PROMO CODE
            </div>
            <div class="uk-card-body">

            </div>
          </div>
        </div>
      </div>

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
            removeBag: function (sku, name) {
              let bag_link = this.bag_link;
              UIkit.modal.confirm('Do you remove '+ name +' from your bag?').then(function() {
                  axios.get(bag_link, {
                    params: {
                      remove: sku
                    }
                  })
                  .then(function (response) {
                    Event.fire('bags', response);
                    Event.fire('removePopUp', response);
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
              }, function () {
                  console.log('Rejected.')
              });
            },

            min: function (sku, qty, name) {
                let bag_link = this.bag_link;
                if (qty <= 1) {
                  UIkit.modal.confirm('Do you remove '+ name +' from your bag?').then(function() {
                      axios.get(bag_link, {
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
                  }, function () {
                      console.log('Rejected.')
                  });
                } else {
                  axios.get(bag_link, {
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
                }
                
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
