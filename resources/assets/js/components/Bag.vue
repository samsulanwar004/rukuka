<template>
    <div class="uk-margin-large" v-if="bagCount <= 0">
        <h3 align="center"><p>{{ trans.no_bag }}</p></h3>
    </div>
    <div class="uk-margin-top" uk-grid v-else>
      <div class="uk-width-2-3@m">
        <div class="uk-overflow-auto">
          <h4 class="uk-margin-remove uk-text-uppercase">{{ trans.your_bag }}({{ bags.length }}) </h4>
          <table class="uk-table uk-table-small uk-margin-remove-bottom">
            <tr>
                <td colspan="2" class="uk-table-expand uk-text-uppercase">{{ trans.item }}</td>
                <td class="uk-width-medium uk-text-uppercase uk-text-center">{{ trans.qty }}</td>
                <td class="uk-table-shrink uk-text-nowrap uk-text-uppercase uk-text-center">{{ trans.unit_price }}</td>
            </tr>
          </table>
            <table class="uk-table uk-table-striped uk-margin-top-remove">
                <tbody v-for="bag in bags">
                    <tr>
                        <td>
                            <lazy-background
                              :image-source="bag.options.photo | awsLink(aws_link)"
                              :alt="bag.name"
                              :loading-image="loadingImage"
                              :error-image="errorImage"
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
                          <form v-on:submit.prevent="moveWishlist">
                              <input type="hidden" name="product_id" :value="bag.options.product_id">
                              <input type="hidden" name="move" :value="bag.id">
                              <button class="uk-button uk-button-small uk-button-default-warm uk-padding-small-right uk-margin-bottom uk-text-uppercase" type="submit">{{ trans.move_wishlist}}</button>
                              <a class="uk-button uk-button-small uk-button-default-warm uk-padding-small-right uk-text-right uk-margin-bottom" v-on:click="removeBag(bag.id, bag.name)">{{ trans.remove }}</a>
                          </form>
                        </td>
                        <td class="uk-text-nowrap">
                          <ul class="uk-grid-small uk-flex-middle" uk-grid>
                            <li><a class="uk-icon-link" uk-icon="icon: minus" v-on:click.prevent="min(bag.id, bag.qty, bag.name)"></a></li>
                            <li><input type="text" name="qty" class="uk-input uk-form-width-xsmall uk-form-small" :value="bag.qty" v-on:keyup="countQty(bag.id, $event)"></li>
                            <li><a class="uk-icon-link" uk-icon="icon: plus" v-on:click.prevent="plus(bag.id)"></a></li>
                          </ul>
                        </td>
                        <td class="uk-text-nowrap">
                          <span>{{ bag.price | round(exchangeRate.symbol, exchangeRate.value) }}</span><br>
                          <span class="uk-text-danger" v-if="bag.options.price_sale > 0 ">
                            <del>{{ bag.options.price_sale | round(exchangeRate.symbol, exchangeRate.value) }}</del>
                          </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
      <div class="uk-width-1-3@m">
        <div class="uk-card uk-card-default uk-background-muted uk-card-small uk-box-shadow-small">
          <div class="uk-card-header">
            <h4 class="uk-text-uppercase">{{ trans.summary }}</h4>
          </div>
          <div class="uk-card-body">
            <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid v-if="youSave > 0">
              <div class="uk-text-small"><h6 class="uk-text-danger">{{ trans.you_save }}</h6></div>
              <div class="uk-text-right uk-text-danger">{{ youSave | round(exchangeRate.symbol, exchangeRate.value) }}</div>
            </div>
            <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
              <div class="uk-text-small"><h6>{{ trans.subtotal }}</h6></div>
              <div class="uk-text-right">{{ subtotal | round(exchangeRate.symbol, exchangeRate.value) }}</div>
            </div>
          </div>
          <div class="uk-card-footer">
            <div class="uk-grid uk-child-width-1-2 uk-margin-small" uk-grid>
              <div><h4 class="uk-text-uppercase"> <b>{{ trans.total }}</b></h4></div>
              <div class="uk-text-right"><h4>{{ subtotal | round(exchangeRate.symbol, exchangeRate.value) }}</h4></div>
            </div>
          </div>
          <div class="uk-card-footer">
            <a :href="checkout_link" class="uk-button uk-button-secondary uk-width-1-1">
               {{ trans.checkout}}
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
        props: ['bag_link', 'wishlist_link', 'auth', 'checkout_link', 'aws_link','default_image','locale', 'bag_count', 'discount'],

        components: {
          'lazy-background': VueLazyBackgroundImage
        },

        created () {
            var self = this;

            Event.listen('exchange', function (response) {
              self.exchangeRate = response.data.data;
            });

            Event.listen('bags', function (response) {
                self.bags = response.data.bags;
                self.bagCount = response.data.bags.length;
                self.subtotal = parseFloat(response.data.subtotal.replace(/,/g, ''));
                self.youSave = response.data.discount;
            });

            Event.listen('removeBag', function (response) {
                self.bags = response.data.bags;
                self.bagCount = response.data.bags.length;
                self.subtotal = parseFloat(response.data.subtotal.replace(/,/g, ''));
                self.youSave = response.data.discount;
            });

            Event.listen('addBag', function (response) {
                self.bags = response.data.bags;
                self.bagCount = response.data.bags.length;
                self.subtotal = parseFloat(response.data.subtotal.replace(/,/g, ''));
                self.youSave = response.data.discount;
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
                loadingImage: {},
                trans: JSON.parse(this.locale,true),
                exchangeRate: {},
                bagCount: this.bag_count,
                youSave: this.discount
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
                  var error = JSON.parse(JSON.stringify(error));
                  if (typeof error.response.data.message !== 'undefined') {
                      UIkit.notification(error.response.data.message, {
                          status:'danger'
                      });
                  }
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
                      var error = JSON.parse(JSON.stringify(error));
                      if (typeof error.response.data.message !== 'undefined') {
                          UIkit.notification(error.response.data.message, {
                              status:'danger'
                          });
                      }
                    });
                }
            },

            moveWishlist: function (event) {
                var productId = event.target.elements.product_id.value;
                var move = event.target.elements.move.value;

                if (this.auth == 1) {

                    axios.post(this.wishlist_link, {
                        products_id: productId,
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

                                var _like = document.getElementById('like-related-'+productId);

                                _like ? _like.textContent = "favorite" : '';
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
