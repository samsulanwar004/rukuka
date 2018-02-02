<template>
    <ul class="uk-nav uk-footer-nav">
        <li class="uk-text-uppercase"><b>{{ trans.popular_searches}}</b></li>
        <ul class="uk-nav uk-footer-nav" v-for="cloth in womenCloths" v-if="cloth.name.toLowerCase() == 'clothing'">
            <li class="uk-parent" v-for="cat in cloth.child" >
                <a v-for="data in popularSearch" :href="'/shop/womens/'+cloth.name.toLowerCase()+'/'+ cat.slug" v-if="data.slug == cat.slug">{{ cat.name }}</a>
            </li>
        </ul>
        <ul class="uk-nav uk-footer-nav" v-for="cloth in womenCloths" v-if="cloth.name.toLowerCase() == 'accessories'">
            <li class="uk-parent" v-for="cat in cloth.child">
                <a v-for="data in popularSearch" :href="'/shop/womens/'+cloth.name.toLowerCase()+'/'+ cat.slug " v-if="data.slug == cat.slug">{{ cat.name }}</a>
            </li>
        </ul>
        <ul class="uk-nav uk-footer-nav" v-for="cloth in menCloths" v-if="cloth.name.toLowerCase() == 'clothing'">
            <li class="uk-parent" v-for="cat in cloth.child">
                <a v-for="data in popularSearch" :href="'/shop/mens/'+cloth.name.toLowerCase()+'/'+ cat.slug " v-if="data.slug == cat.slug">{{ cat.name }}</a>
            </li>
        </ul>
        <ul class="uk-nav uk-footer-nav" v-for="cloth in menCloths" v-if="cloth.name.toLowerCase() == 'accessories'">
            <li class="uk-parent" v-for="cat in cloth.child">
                <a v-for="data in popularSearch" :href="'/shop/mens/'+cloth.name.toLowerCase()+'/'+ cat.slug " v-if="data.slug == cat.slug">{{ cat.name }}</a>
            </li>
        </ul>
        <ul class="uk-nav uk-footer-nav" v-for="cloth in kidCloths" v-if="cloth.name.toLowerCase() == 'clothing'">
            <li class="uk-parent" v-for="cat in cloth.child">
                <a v-for="data in popularSearch" :href="'/shop/kids/'+cloth.name.toLowerCase()+'/'+ cat.slug " v-if="data.slug == cat.slug">{{ cat.name }}</a>
            </li>
        </ul>
        <ul class="uk-nav uk-footer-nav" v-for="cloth in kidCloths" v-if="cloth.name.toLowerCase() == 'accessories'">
            <li class="uk-parent" v-for="cat in cloth.child">
                <a v-for="data in popularSearch" :href="'/shop/kids/'+cloth.name.toLowerCase()+'/'+ cat.slug " v-if="data.slug == cat.slug">{{ cat.name }}</a>
            </li>
        </ul>
    </ul>

</template>

<script>
    import axios from 'axios';
    export default {
        props: ['popular_search','locale'],
        created() {
            var self = this;

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

            Event.listen('navigation', function (response) {

                if (typeof response.mens !== 'undefined') {
                    self.menCloths = response.mens;
                }
                if (typeof response.womens !== 'undefined') {
                    self.womenCloths = response.womens;
                }
                if (typeof response.kids !== 'undefined') {
                    self.kidCloths = response.kids;
                }

            });

        },

        data() {
            return {
                popularSearch: {},
                menCloths: {},
                womenCloths: {},
                kidCloths: {},
                trans: JSON.parse(this.locale,true)
            }
        },

    }
</script>
