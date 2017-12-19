<template>
    <ul class="uk-list uk-footer-nav">
        <li>
            <b>STAY UPDATE WITH US</b>
        </li>
        <li class="uk-text-meta" v-if="messages">
            <i v-if="messages">{{ messages }}</i>
        </li>
        <li class="uk-text-meta" v-if="errors.has('email')">
            <i v-if="errors.has('email')">{{ errors.first('email') }}</i>
        </li>
        <li>
            <input type="text" :class="{'uk-input uk-form-small uk-form-width-medium uk-first-column': true, 'uk-form-danger': errors.has('email') }" name="email" value="" v-model="email" v-validate="'required|email'" placeholder="ENTER YOUR EMAIL">
            <button type="button" name="button" class="uk-button uk-button-small uk-button-secondary" v-on:click="subscriber">subscribe</button>
        </li>
        <li class="uk-text-meta">
            <i>Then get your can't-miss style news, before everybody else.</i>
        </li>
    </ul>
</template>

<script>
    import axios from 'axios';
    export default {

        props: ['api'],
        data () {
            return {
                messages: ''
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
                        if (typeof response.data.message.email !== 'undefined') {
                            self.messages = response.data.message.email[0];
                        }
                        if (response.data.message.toLowerCase() == 'success') {
                            UIkit.notification("<span uk-icon='icon: check'></span> Thanks for subscriber");
                        }
                    }

                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>
