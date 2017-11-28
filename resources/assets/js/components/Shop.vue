<template>
    <div class="uk-grid-small uk-child-width-1-3@m uk-child-width-1-2 uk-flex-center" uk-grid>
        <!-- start product -->
        <div class="uk-panel uk-text-left" v-for="product in products">
            <div class="uk-card uk-card-small uk-card-default">
                <div class="uk-card-media-top uk-inline-clip uk-transition-toggle">
                    <a :href="'/product/'+ product.slug">
                        <img :src="'/'+ product.photo" :alt="product.name">
                    </a>
                    <div class="uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-default">
                        <div class="uk-text-center">
                            <a href="#modal-overflow" class="uk-button uk-button-small uk-button-secondary" uk-toggle v-on:click.prevent="quick(product.id)">QUICK SHOP</a>
                        </div>
                    </div>
                </div>
                <div class="uk-card-body uk-padding-small">
                    <a :href="'/product/'+ product.slug" class="uk-text-muted">{{ product.name }}</a>
                    <br>
                    {{ product.currency }} {{ product.price }}
                </div>
            </div>
        </div>
        <!-- end product single -->
        <div id="modal-overflow" class="uk-modal-container-small" uk-modal="center: true">
            <div class="uk-modal-dialog">

                <button class="uk-modal-close-default" type="button" uk-close></button>

                <div class="uk-modal-header">
                    <h3 class="uk-margin-remove">{{ name }}</h3>
                    <span>{{ currency }} {{ price }}</span>
                </div>

                <div class="uk-modal-body" uk-overflow-auto>
                    <div class="uk-grid" uk-grid>
                        <div class="uk-width-1-2@m">
                            <div class="uk-inline">
                                <div class="">
                                    <ul class="uk-switcher uk-margin" id="component-tab-left">
                                        <li v-for="image in images">
                                            <img :src="'/'+image.photo" :alt="image.name">
                                            <div class="uk-position uk-position-small uk-position-center-left">
                                                <a href="#" class="uk-icon uk-icon-button" uk-switcher-item="previous" uk-icon="icon: chevron-left"></a>
                                            </div>
                                            <div class="uk-position uk-position-small uk-position-center-right">
                                                <a href="#" class="uk-icon uk-icon-button" uk-switcher-item="next" uk-icon="icon: chevron-right"></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="">
                                    <ul class="uk-grid-small uk-flex-middle uk-flex-center uk-margin-remove uk-padding-remove" uk-switcher="connect: #component-tab-left; animation: uk-animation-fade" uk-grid>
                                        <li class="uk-padding-remove" v-for="image in images"><a href="#"  class="uk-padding-remove">
                                            <img :src="'/'+image.photo" width="55"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-2@m">
                            <div class="uk-grid uk-child-width-1-2">
                                <div>
                                    <b>Color :</b> {{ color }}
                                </div>
                                <div>
                                    <div uk-form-custom="target: > * > span:first">
                                        <select name="size" v-model="size" v-validate="'required'">
                                            <option :value="null" disabled>Choose Size</option>
                                            <option v-for="stock in stocks" :value="stock.sku">
                                                {{ stock.size }}
                                            </option>
                                        </select>
                                        <button class="uk-button uk-button-default" type="button" tabindex="-1">
                                            <span uk-icon="icon: chevron-down"></span>
                                        </button>
                                    </div>

                                </div>
                            </div>
                            <ul uk-accordion="animation: true; multiple: false">
                                <li class="uk-open">

                                    <h5 class="uk-accordion-title"><b>EDITORS NOTES</b></h5>
                                    <div class="uk-accordion-content uk-text-muted">
                                        {{ content }}
                                    </div>

                                </li>
                                <li>

                                    <h5 class="uk-accordion-title"><b>SIZE & FIT</b></h5>
                                    <div class="uk-accordion-content  uk-text-muted">
                                        {{ sizAndFit }}
                                    </div>

                                </li>
                                <li>

                                    <h5 class="uk-accordion-title"><b>DETAILS & CARE</b></h5>
                                    <div class="uk-accordion-content uk-text-muted">
                                        {{ detailAndCare }}
                                    </div>

                                </li>
                                <li>

                                    <h5 class="uk-accordion-title"><b>DELIVERY & FREE RETURNS</b></h5>
                                    <div class="uk-accordion-content uk-text-muted">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </div>

                                </li>
                            </ul>

                        </div>
                    </div>
                </div>

                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-secondary" type="button" v-on:click="bag">ADD TO BAG</button>
                    <button class="uk-button uk-button-default" type="button" v-on:click="wishlist">ADD TO WISHLIST</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props: ['shops', 'product_api', 'bag_api', 'wishlist_api', 'auth'],

        created () {
            var self = this;
            self.products = this.shops ? JSON.parse(this.shops) : {};
        },

        data () {
            return {
                products: {},
                name: {},
                currency: {},
                price: {},
                color: {},
                images: {},
                stocks: {},
                content: {},
                sizeAndFit: {},
                detailAndCare: {},
                size: null
            }
        },

        methods: {
            quick: function (e) {
                var self = this;
                self.size = null;
                axios.get(this.product_api+'/'+e)
                    .then(function (response) {
                        if (typeof response.data.data !== 'undefined') {
                            var data = response.data.data;
                            self.name = data.name;
                            self.currency = data.currency;
                            self.price = data.sell_price;
                            self.color = data.color;
                            self.images = data.images;
                            self.stocks = data.stocks;
                            self.content = data.content;
                            self.sizeAndFit = data.size_and_fit;
                            self.detailAndCare = data.detail_and_care;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            bag: function (event) {
                this.$validator.validateAll().then((result) => {
                    if (result) {

                        var size = this.size;
                        axios.post(this.bag_api, {
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

            wishlist: function (event) {
                this.$validator.validateAll().then((result) => {
                    if(result) {
                        if (this.auth == 1) {
                            var size = this.size;

                            axios.post(this.wishlist_api, {
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
            }
        }
    }
</script>
