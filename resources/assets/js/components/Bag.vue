<template>
    <div class="uk-margin-large" v-if="bags == 0" >
        <h3 align="center"><p>You have no items in the shopping bag</p></h3>
    </div>
    <div class="uk-margin-top" uk-grid v-else>
      <div class="uk-width-2-3@m">
        <div class="uk-overflow-auto">
            <table class="uk-table uk-table-striped">
                <thead>
                  <tr>
                      <th class="uk-table-shrink" colspan="4"><h4 class="uk-margin-remove">YOUR BAG ({{ bags.length }}) </h4></th>
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
                          <form v-on:submit.prevent="moveWishlist">
                              <input type="hidden" name="size" :value="bag.id">
                              <input type="hidden" name="qty" :value="bag.qty">
                              <input type="hidden" name="move" :value="bag.id">
                              <button class="uk-button uk-button-small uk-button-default-warm uk-padding-small-right uk-margin-bottom" type="submit">MOVE TO WISHLIST</button>
                        <a class="uk-button uk-button-small uk-button-default-warm uk-padding-small-right uk-text-right uk-margin-bottom" v-on:click="removeBag(bag.id, bag.name)">REMOVE</a>
                        </form>
                        </td>
                        <td class="uk-text-nowrap">
                        <ul class="uk-grid-small uk-flex-middle" uk-grid>
                          <li><a class="uk-icon-link" uk-icon="icon: minus" v-on:click.prevent="min(bag.id, bag.qty, bag.name)"></a></li>
                          <li><input type="text" name="qty" class="uk-input uk-form-width-xsmall uk-form-small" :value="bag.qty" v-on:keyup="countQty(bag.id, $event)"></li>
                          <li><a class="uk-icon-link" uk-icon="icon: plus" v-on:click.prevent="plus(bag.id)"></a></li>
                        </ul>
                        </td>
                        <td class="uk-text-nowrap"><h4>{{ bag.price | round }}</h4></td>
                    </tr>
                </tbody>
                <tbody v-if="bags == 0">
                    <tr><td colspan="6" align="center"><p>You have no items in the shopping bag</p></td></tr>
                </tbody>
            </table>
        </div>
      </div>
      <div class="uk-width-1-3@m">
        <div class="uk-card uk-card-default uk-background-muted uk-card-small uk-box-shadow-small">
          <div class="uk-card-header">
            <h4>SUMMARY</h4>
          </div>
          <div class="uk-card-body">
            <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
              <div class="uk-text-small"><h6>SUBTOTAL</h6></div>
              <div class="uk-text-right">{{ subtotal | round }}</div>
            </div>
          </div>
          <div class="uk-card-footer">
            <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
              <div><h4> <b>TOTAL</b></h4></div>
              <div class="uk-text-right"><h4>{{ subtotal | round }}</h4></div>
            </div>
          </div>
          <div class="uk-card-footer">
            <a :href="checkout_link" class="uk-button uk-button-secondary uk-width-1-1">
               checkout
            </a>
          </div>
          </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    import VueLazyBackgroundImage from '../components/VueLazyBackgroundImage.vue';

    export default {
        props: ['bag_link', 'wishlist_link', 'auth', 'checkout_link', 'aws_link','default_image'],
        created () {
            var self = this;
            Event.listen('bags', function (response) {
                self.bags = response.data.bags;
                self.subtotal = parseFloat(response.data.subtotal.replace(/,/g, ''));
            });

            Event.listen('removeBag', function (response) {
                self.bags = response.data.bags;
                self.subtotal = parseFloat(response.data.subtotal.replace(/,/g, ''));
            });

            Event.listen('addBag', function (response) {
                self.bags = response.data.bags;
                self.subtotal = parseFloat(response.data.subtotal.replace(/,/g, ''));
            });

            self.errorImage = this.aws_link+'/images/'+this.defaultImage.image_2;      
            self.loadingImage = this.aws_link+'/images/loading-image.gif'; 

        },

        data () {
            return {
                bags: {},
                subtotal: {},
                defaultImage: JSON.parse(this.default_image,true),
                errorImage: {},
                loadingImage: {}
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
