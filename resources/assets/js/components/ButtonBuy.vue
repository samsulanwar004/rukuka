<template>
    <div class="uk-child-width-1-2 uk-margin-small-top" uk-grid>
        <div class="">
            Color : {{ color }}
        </div>
        <div class="">
            <select :class="{'uk-select': true, 'uk-form-danger': errors.has('size') }" name="size" v-model="size" v-validate="'required'">
              <option :value="null" disabled>Select Size</option>
              <option v-for="stock in stocks" :value="stock.sku" :selected="sku ==  stock.sku">{{ stock.size }}</option>
            </select>
        </div>
        <div class="" v-if="method == 'bag'">
          <button class="uk-width-1-1 uk-button uk-button-secondary uk-text-bold uk-padding-small-right" v-on:click="updateBag(sku)"><span class="uk-margin-small-right uk-icon" uk-icon="icon: cart; ratio:0.8"></span> UPDATE BAG </button>
        </div>
        <div class="" v-else>
          <button class="uk-width-1-1 uk-button uk-button-secondary uk-text-bold uk-padding-small-right" v-on:click="bag"><span class="uk-margin-small-right uk-icon" uk-icon="icon: cart; ratio:0.8"></span> ADD TO BAG </button>
        </div>
        <div class="" v-if="method == 'wishlist'">
            <button class="uk-width-1-1 uk-button uk-button-default uk-text-bold uk-padding-small-right" v-on:click="updateWishlist(sku)">UPDATE WISHLIST</button>
        </div>
        <div class="" v-else>
            <button class="uk-width-1-1 uk-button uk-button-default uk-text-bold uk-padding-small-right" v-on:click="wishlist">ADD TO WISHLIST</button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props: ['api_bag', 'api_wishlist', 'color', 'sizes', 'auth', 'method', 'sku'],
        created () {
            var self = this;
            self.stocks = this.sizes ? JSON.parse(this.sizes) : {};
        },

        data () {
            return {
                stocks: {},
                size: this.sku ? this.sku : null
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
