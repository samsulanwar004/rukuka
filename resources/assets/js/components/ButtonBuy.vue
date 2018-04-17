<template>
    <div>
        <h6 class="uk-margin-small">{{ trans.color_label}} :
            <lazy-background
              :image-source="prod.color_palette | awsLink(aws_link)"
              alt="rukuka palette"
              :error-image="aws_link+'/images/default-600x600.jpg'"
              width="20px"
              image-class="uk-border-circle uk-box-shadow-small uk-margin-small-right uk-margin-small-left">
            </lazy-background>
            {{ prod.color }}
        </h6>
        <div v-if="stocks.length > 0">
            <div v-if="stocks[0].size == 'none'">
                <span class="uk-text-meta"><i class="uk-text-success">{{ trans.product_available }} ({{ stocks[0].unit }})</i>
            </div>
            <div v-else>
              <div class="uk-grid uk-child-width-1-2 uk-margin-small-bottom" uk-grid>
                <div>
                  <h6> <b> {{ trans.european }} </b></h6>
                </div>
                <div class="uk-text-right">
                  <a href="#size-charts" class="uk-link-reset" uk-toggle> <span class="uk-badge">{{ trans.size_chart}}</span></a>

                </div>
              </div>
                <select :class="{'uk-select uk-form-width-small uk-form-small uk-margin-small-right': true, 'uk-form-danger': errors.has('size') }" name="size" v-model="size" v-validate="'required'">
                    <option v-for="stock in stocks" :value="stock.sku" :disabled="stock.unit <= 0">{{ stock.size }} {{ stock.unit | unit }}</option>
                </select>
            </div>
        </div>
        <div v-else>
            <span class="uk-text-meta"><i class="uk-text-danger">{{ trans.no_size }} </i> <br>{{ trans.contact_cs }} </span>
        </div>
        <div v-if="prod.is_preorder == 1">
            <span class="uk-text-meta"><i class="uk-text-danger">Pre Order {{ prod.preorder_day }} days</i>
        </div>
        <ul uk-accordion="animation: true; multiple: false">
            <li class="uk-open">
                <span class="uk-accordion-title">{{ trans.editors_notes }}</span>
                <div class="uk-accordion-content">
                    <span v-html="prod.content"></span>
                </div>
            </li>
            <li>
                <span class="uk-accordion-title">{{ trans.size_fit }}</span>
                <div class="uk-accordion-content">
                    <span v-html="prod.size_and_fit"></span>
                </div>
            </li>
            <li>
                <span class="uk-accordion-title">{{ trans.detail_care }}</span>
                <div class="uk-accordion-content">
                    <span v-html="prod.detail_and_care"></span>
                </div>
            </li>
          </ul>
        <div class="uk-margin-small-top" v-if="method == 'bag'">
          <button class="uk-width-1-1 uk-button uk-button-secondary uk-text-bold uk-padding-small-right uk-text-uppercase" v-on:click="updateBag(sku)"> {{ trans.update_bag }} </button>
        </div>
        <div class="uk-margin-small-top" v-else>
          <button v-if="prod.is_preorder == 0" class="uk-width-1-1 uk-button uk-button-secondary uk-text-bold uk-padding-small-right uk-text-uppercase" v-on:click="bag"> {{ trans.add_to_bag }} </button>
          <button v-else class="uk-width-1-1 uk-button uk-button-secondary uk-text-bold uk-padding-small-right uk-text-uppercase" v-on:click="bag"> Pre Order </button>
        </div>
        <div class="uk-margin-small-top" v-if="method == 'wishlist'">
            <button class="uk-width-1-1 uk-button uk-button-default uk-text-bold uk-padding-small-right uk-text-uppercase" v-on:click="updateWishlist(id)">{{ trans.update_wishlist }}</button>
        </div>
        <div class="uk-margin-small-top" v-else>
            <button class="uk-width-1-1 uk-button uk-button-default uk-text-bold uk-padding-small-right uk-text-uppercase" v-on:click="wishlist">{{ trans.wishlist_label }}</button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import VueLazyBackgroundImage from '../components/VueLazyBackgroundImage.vue';

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
            'locale',
            'aws_link'
        ],

        components: {
          'lazy-background': VueLazyBackgroundImage
        },

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
                size: {},
                trans: JSON.parse(this.locale,true)
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
            },

            awsLink: function (value, aws) {
                var link = value == null ? '#' : aws+'/'+value;
                return link;
            }
        }
    }
</script>
