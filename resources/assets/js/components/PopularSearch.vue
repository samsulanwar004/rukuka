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
        props: ['api','popular_search','locale'],
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

            axios.get(api)
                .then(function (navigations) {
                    if (typeof navigations.data.data !== 'undefined') {
                        Event.fire('navigation', navigations.data.data);

                        if (typeof navigations.data.data.mens !== 'undefined') {
                            self.menCloths = navigations.data.data.mens;
                        }

                        if (typeof navigations.data.data.womens !== 'undefined') {
                            self.womenCloths = navigations.data.data.womens;
                        }

                        if (typeof navigations.data.data.kids !== 'undefined') {
                            self.kidCloths = navigations.data.data.kids;
                        }
                    }
                })
                .catch(function (error) {
                    console.log(error);
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
