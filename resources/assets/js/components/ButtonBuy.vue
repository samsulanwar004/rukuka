<template>
    <div>
        <h5 class="uk-margin-small">Color : {{ prod.color }}</h5>
        <div v-if="stocks.length > 0">
            <select :class="{'uk-select uk-form-width-small uk-form-small': true, 'uk-form-danger': errors.has('size') }" name="size" v-model="size" v-validate="'required'">
              <option v-for="stock in stocks" :value="stock.sku" :disabled="stock.unit <= 0">{{ stock.size }} {{ stock.unit | unit }}</option>
            </select>
            <span class="uk-text-meta"><i> Choose your size</i> </span>
        </div>
        <div v-else>
            <span class="uk-text-meta"><i class="uk-text-danger">No size available </i> <br>Please, contact our cuctomer service! </span>
        </div>
        <ul uk-accordion="animation: true; multiple: false">
                  <li class="uk-open">
                      <h5 class="uk-accordion-title">Editors Notes</h5>
                      <div class="uk-accordion-content">
                          {{ prod.content }}
                      </div>
                  </li>
                  <li>
                      <h5 class="uk-accordion-title">Size & Fit</h5>
                      <div class="uk-accordion-content">
                          {{ prod.size_and_fit }}
                      </div>
                  </li>
                  <li>
                      <h5 class="uk-accordion-title">Details & Care</h5>
                      <div class="uk-accordion-content">
                          {{ prod.detail_and_care }}
                      </div>
                  </li>
                </ul>
        <div class="uk-margin-small-top" v-if="method == 'bag'">
          <button class="uk-width-1-1 uk-button uk-button-secondary uk-text-bold uk-padding-small-right" v-on:click="updateBag(sku)"> UPDATE BAG </button>
        </div>
        <div class="uk-margin-small-top" v-else>
          <button class="uk-width-1-1 uk-button uk-button-secondary uk-text-bold uk-padding-small-right" v-on:click="bag"> ADD TO BAG </button>
        </div>
        <div class="uk-margin-small-top" v-if="method == 'wishlist'">
            <button class="uk-width-1-1 uk-button uk-button-default uk-text-bold uk-padding-small-right" v-on:click="updateWishlist(id)">UPDATE WISHLIST</button>
        </div>
        <div class="uk-margin-small-top" v-else>
            <button class="uk-width-1-1 uk-button uk-button-default uk-text-bold uk-padding-small-right" v-on:click="wishlist">WISHLIST</button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props: [
            'api_bag',
            'api_wishlist',
            'product',
            'sizes',
            'auth',
            'method',
            'sku',
            'id',
            'bag_link',
            'wishlist_link',
        ],

        created () {
            var self = this;
            self.stocks = this.sizes ? JSON.parse(this.sizes) : {};
            self.prod = this.product ? JSON.parse(this.product) : {};
            var sku = self.stocks.length > 0 ? self.stocks[0].sku : null;
            self.size = this.sku ? this.sku : sku;
        },

        data () {
            return {
                prod: {},
                stocks: {},
                size: {} 
            }
        },

        methods: {
            bag: function (event) {
                this.$validator.validateAll().then((result) => {
                    if (result) {

                        var size = this.size;
                        axios.post(this.api_bag, {
                            size: size
                        })
                        .then(function (response) {
                            if (typeof response.data.message !== 'undefined') {
                                if (response.data.status.toLowerCase() == 'error') {
                                    UIkit.notification(response.data.message.size[0], {
                                        status:'danger'
                                    });
                                }
                                if (response.data.status.toLowerCase() == 'ok') {
                                    UIkit.notification("<span uk-icon='icon: check'></span> Add product to bag successfully", {
                                        status:'success'
                                    });

                                    Event.fire('addBag', response);
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
                        var items = this.errors.items;
                        $.each(items, function (index, item) {
                            UIkit.notification(item.msg, {
                                status:'danger'
                            });
                        });
                    }
                });
            },
            wishlist: function  (event) {
                this.$validator.validateAll().then((result) => {
                    if(result) {
                        if (this.auth == 1) {
                            var size = this.size;

                            axios.post(this.api_wishlist, {
                                size: size
                            })
                            .then(function (response) {
                                if (typeof response.data.message !== 'undefined') {
                                    if (response.data.status.toLowerCase() == 'error') {
                                        UIkit.notification(response.data.message.size[0], {
                                            status:'danger'
                                        });
                                    }
                                    if (response.data.status.toLowerCase() == 'ok') {
                                        UIkit.notification("<span uk-icon='icon: check'></span> Add product to wishlist successfully", {
                                            status:'success'
                                        });

                                        Event.fire('addWishlist', response);
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
                    } else {
                        var items = this.errors.items;
                        $.each(items, function (index, item) {
                            UIkit.notification(item.msg, {
                                status:'danger'
                            });
                        });
                    }
                });
            },

            updateBag: function (update) {
                this.method = 'none';
                let afterUpdateBag = this.bag_link;
                this.$validator.validateAll().then((result) => {
                    if (result) {

                        var size = this.size;
                        axios.post(this.api_bag, {
                            size: size,
                            update: update
                        })
                        .then(function (response) {
                            if (typeof response.data.message !== 'undefined') {
                                if (response.data.status.toLowerCase() == 'error') {
                                    UIkit.notification(response.data.message.size[0], {
                                        status:'danger'
                                    });
                                }
                                if (response.data.status.toLowerCase() == 'ok') {
                                    UIkit.notification("<span uk-icon='icon: check'></span> Update bag successfully", {
                                        status:'success'
                                    });

                                    Event.fire('addBag', response);

                                    window.location.href = afterUpdateBag;
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
                        var items = this.errors.items;
                        $.each(items, function (index, item) {
                            UIkit.notification(item.msg, {
                                status:'danger'
                            });
                        });
                    }
                });
            },

            updateWishlist: function (update) {
                this.method = 'none';
                let afterUpdateWishlist = this.wishlist_link;
                this.$validator.validateAll().then((result) => {
                    if(result) {
                        if (this.auth == 1) {
                            var size = this.size;

                            axios.post(this.api_wishlist, {
                                size: size,
                                update: update
                            })
                            .then(function (response) {
                                if (typeof response.data.message !== 'undefined') {
                                    if (response.data.status.toLowerCase() == 'error') {
                                        UIkit.notification(response.data.message.size[0], {
                                            status:'danger'
                                        });
                                    }
                                    if (response.data.status.toLowerCase() == 'ok') {
                                        UIkit.notification("<span uk-icon='icon: check'></span> Update product wishlist successfully", {
                                            status:'success'
                                        });

                                        Event.fire('addWishlist', response);

                                        window.location.href = afterUpdateWishlist;
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
                    } else {
                        var items = this.errors.items;
                        $.each(items, function (index, item) {
                            UIkit.notification(item.msg, {
                                status:'danger'
                            });
                        });
                    }
                });
            }
        },

        filters: {
            unit: function (unit) {
                if (unit < 10) {
                    if (unit <= 0) {
                        return '(Sold Out)';
                    } else {
                        return '(Only '+unit+' Left)';
                    }
                }
            }
        }
    }
</script>
