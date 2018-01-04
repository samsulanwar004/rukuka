<template>
    <ul  class="uk-nav uk-footer-nav">
        <li><b>POPULAR SEARCHES</b></li>
        <ul class="uk-nav uk-navbar-dropdown-nav" v-for="cloth in womenCloths" v-if="cloth.name.toLowerCase() == 'clothing'">
            <li class="uk-parent" v-for="cat in cloth.child" >
                <a v-for="data in popularSearch" :href="'/shop/womens/'+cloth.name.toLowerCase()+'/'+ cat.slug" v-if="data.slug == cat.slug">{{ cat.name }}</a>
            </li>
        </ul>
        <ul class="uk-nav uk-navbar-dropdown-nav" v-for="cloth in womenCloths" v-if="cloth.name.toLowerCase() == 'accessories'">
            <li class="uk-parent" v-for="cat in cloth.child">
                <a v-for="data in popularSearch" :href="'/shop/womens/'+cloth.name.toLowerCase()+'/'+ cat.slug " v-if="data.slug == cat.slug">{{ cat.name }}</a>
            </li>
        </ul>
        <ul class="uk-nav uk-navbar-dropdown-nav" v-for="cloth in menCloths" v-if="cloth.name.toLowerCase() == 'clothing'">
            <li class="uk-parent" v-for="cat in cloth.child">
                <a v-for="data in popularSearch" :href="'/shop/mens/'+cloth.name.toLowerCase()+'/'+ cat.slug " v-if="data.slug == cat.slug">{{ cat.name }}</a>
            </li>
        </ul>
        <ul class="uk-nav uk-navbar-dropdown-nav" v-for="cloth in menCloths" v-if="cloth.name.toLowerCase() == 'accessories'">
            <li class="uk-parent" v-for="cat in cloth.child">
                <a v-for="data in popularSearch" :href="'/shop/mens/'+cloth.name.toLowerCase()+'/'+ cat.slug " v-if="data.slug == cat.slug">{{ cat.name }}</a>
            </li>
        </ul>
        <ul class="uk-nav uk-navbar-dropdown-nav" v-for="cloth in kidCloths" v-if="cloth.name.toLowerCase() == 'clothing'">
            <li class="uk-parent" v-for="cat in cloth.child">
                <a v-for="data in popularSearch" :href="'/shop/kids/'+cloth.name.toLowerCase()+'/'+ cat.slug " v-if="data.slug == cat.slug">{{ cat.name }}</a>
            </li>
        </ul>
        <ul class="uk-nav uk-navbar-dropdown-nav" v-for="cloth in kidCloths" v-if="cloth.name.toLowerCase() == 'accessories'">
            <li class="uk-parent" v-for="cat in cloth.child">
                <a v-for="data in popularSearch" :href="'/shop/kids/'+cloth.name.toLowerCase()+'/'+ cat.slug " v-if="data.slug == cat.slug">{{ cat.name }}</a>
            </li>
        </ul>
    </ul>

</template>

<script>
    import axios from 'axios';
    export default {
        props: ['popular_search','api'],
        created() {
            var self = this;
            var api = this.api;
            let popular_search = this.popular_search;
            axios.get(popular_search)
                .then(function (response) {
                    if (response.data.data !== 'undefined') {
                        self.popularSearch= response.data.data;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });

            $.get(api, function(response) {

                if (typeof response.data.mens !== 'undefined') {
                    self.menCloths = response.data.mens;
                }
                if (typeof response.data.womens !== 'undefined') {
                    self.womenCloths = response.data.womens;
                }
                if (typeof response.data.kids !== 'undefined') {
                    self.kidCloths = response.data.kids;
                }

            });
        },

        data() {
            return {
                popularSearch: {},
                menCloths: {},
                womenCloths: {},
                kidCloths: {},
            }
        },

    }
</script>
