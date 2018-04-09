<template>
    <ul class="uk-nav uk-footer-nav">
        <li><span class="footer_title">{{ trans.popular_searches}}</span></li>
        <ul class="uk-nav uk-footer-nav">
            <li class="uk-parent">
                <a :href="popularSearch.popular_url_1">{{ popularSearch.popular_name_1 }}</a>
            </li>
            <li class="uk-parent">
                <a :href="popularSearch.popular_url_2">{{ popularSearch.popular_name_2 }}</a>
            </li>
            <li class="uk-parent">
                <a :href="popularSearch.popular_url_3">{{ popularSearch.popular_name_3 }}</a>
            </li>
            <li class="uk-parent">
                <a :href="popularSearch.popular_url_4">{{ popularSearch.popular_name_4 }}</a>
            </li>
            <li class="uk-parent">
                <a :href="popularSearch.popular_url_5">{{ popularSearch.popular_name_5 }}</a>
            </li>
            <li class="uk-parent">
                <a :href="popularSearch.popular_url_6">{{ popularSearch.popular_name_6 }}</a>
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

        },

        data() {
            return {
                popularSearch: {},
                trans: JSON.parse(this.locale,true)
            }
        },

    }
</script>
