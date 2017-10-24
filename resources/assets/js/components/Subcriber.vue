<template>
    <ul class="uk-nav uk-navbar-dropdown-nav">
        <li>
            STAY UPDATE WITH US
        </li>
        <li class="uk-text-meta" v-show="errors.has('email')">
            <i v-show="errors.has('email')">{{ errors.first('email') }}</i>
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
    export default {
        props: ['api'],
        methods: {
            subscriber: function (event) {
                var email = this.email;
            }
          }
    }
</script>
