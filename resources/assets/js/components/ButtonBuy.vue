<template>
    <div class="uk-child-width-1-2 uk-margin-small-top" uk-grid>
        <div class="">
            Color : {{ color }}
        </div>
        <div class="">
            <select :class="{'uk-select': true, 'uk-form-danger': errors.has('size') }" name="size" v-model="size" v-validate="'required'">
              <option :value="null" disabled>Select Size</option>
              <option v-for="stock in stocks" :value="stock.sku">{{ stock.size }}</option>
            </select>
        </div>
        <div class="">
          <button class="uk-width-1-1 uk-button uk-button-secondary uk-text-bold uk-padding-small-right" v-on:click="bag"><span class="uk-margin-small-right uk-icon" uk-icon="icon: cart; ratio:0.8"></span> ADD TO BAG </button>
        </div>
        <div class="">
            <button class="uk-width-1-1 uk-button uk-button-default uk-text-bold uk-padding-small-right" v-on:click="wishlist">ADD TO WISHLIST</button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props: ['api_bag', 'api_wishlist', 'color', 'sizes'],
        created () {
            var self = this;
            self.stocks = this.sizes ? JSON.parse(this.sizes) : {};
        },

        data () {
            return {
                stocks: {},
                size: null,
            }
        },

        methods: {
            bag: function (event) {
                this.$validator.validateAll().then((result) => {});
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
                            UIkit.notification("<span uk-icon='icon: check'></span> Add product successfully", {
                                status:'success'
                            });
                        }
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            wishlist: function  (event) {
                console.log(event);
            }
        }
    }
</script>
