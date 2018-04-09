<template>
    <ul class="uk-list uk-footer-nav">
        <li>
            <span class="footer_title">{{ trans.stay_update }}</span>
        </li>
        <li class="uk-text-meta" v-if="messages">
            <i v-if="messages">{{ messages }}</i>
        </li>
        <li class="uk-text-meta" v-if="errors.has('email')">
            <i v-if="errors.has('email')">{{ errors.first('email') }}</i>
        </li>
        <li>
            <input type="text" :class="{'uk-input uk-form-small uk-form-width-medium uk-first-column': true, 'uk-form-danger': errors.has('email') }" name="email" value="" v-model="email" v-validate="'required|email'" :placeholder="trans.subscribe_placeholder">
            <button type="button" name="button" class="uk-button uk-button-small uk-button-secondary uk-text-uppercase" v-on:click="subscriber">{{ trans.subscribe_button }}</button>
        </li>
        <li class="uk-text-meta">
            <i>{{ trans.news}}</i>
        </li>
    </ul>
</template>

<script>
    import axios from 'axios';
    export default {

        props: ['api','locale'],
        data () {
            return {
                messages: '',
                trans: JSON.parse(this.locale,true)
            }
        },

        methods: {
            subscriber: function (event) {
                var self = this;
                var email = this.email;
                axios.post(this.api, {
                    email: email
                })
                .then(function (response) {
                    if (typeof response.data.message !== 'undefined') {
                        if (response.data.message.toLowerCase() == 'success') {
                            UIkit.notification("<span uk-icon='icon: check'></span> Thanks for subscribe");
                        }
                    }

                })
                .catch(function (error) {
                    var error = JSON.parse(JSON.stringify(error));
                    if (typeof error.response.data.message !== 'undefined') {
                        UIkit.notification(error.response.data.message.email[0], {
                            status:'danger'
                        });
                    }
                    if (typeof error.response.data.message !== 'undefined') {
                        self.messages = error.response.data.message.email[0];
                    }
                });
            }
        }
    }
</script>
