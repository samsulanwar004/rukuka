<template>
    <ul  class="uk-nav uk-navbar-dropdown-nav">
        <li>POPULAR SEARCHES</li>
        <li v-for="data in popularSearch"><a href="#">{{data.name}}</a></li>
    </ul>
</template>

<script>
    import axios from 'axios';
    export default {
        props: ['popular_search'],
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
            }
        },

    }
</script>
