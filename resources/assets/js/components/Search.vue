<script>
    export default {
        props: ['api','keyword'],
        created() {
            var self = this;
            var api = this.api;
            var sort_by = function(field, reverse, primer){

                var key = primer ?
                    function(x) {return primer(x[field])} :
                    function(x) {return x[field]};

                reverse = !reverse ? 1 : -1;

                return function (a, b) {
                    return a = key(a), b = key(b), reverse * ((a > b) - (b > a));
                }
            }

            $.get(api, function(navigations) {
                if (typeof navigations.data !== 'undefined') {
                    if (typeof navigations.data.mens !== 'undefined') {
                        self.menCloths = navigations.data.mens;
                    }

                    if (typeof navigations.data.womens !== 'undefined') {
                        self.womenCloths = navigations.data.womens;
                    }

                    if (typeof navigations.data.kids !== 'undefined') {
                        self.kidCloths = navigations.data.kids;
                    }

                    if (typeof navigations.data.designers !== 'undefined') {
                        self.designers = navigations.data.designers.sort(sort_by('created_at', true, function(result){
                            return result;
                        })).slice(0,17);
                    }
                }
            });
        },

        data() {
            return {
                menCloths: {},
                womenCloths: {},
                kidCloths: {},
                designers: {},
            }
        }
    }
</script>

<template>
        <ul class="uk-nav uk-nav-small uk-nav-default uk-nav-left uk-margin-auto-vertical uk-nav-parent-icon" uk-nav>
            <li class="uk-parent">
                <a>DESIGNERS ({{designers.length}})</a>
                <ul class="uk-nav-sub">
                    <li class="uk-parent" v-for="design in designers">
                        <a :href="'/shop/designers/'+ design.slug ">{{ design.name }}</a>
                    </li>
                </ul>
            </li>
            <li>
                <a :href="'/search?keyword='+keyword+'&category=womens'">WOMEN ({{womenCloths}})</a>
            </li>
            <li>
                <a :href="'/search?keyword='+keyword+'&category=mens'">MEN ({{menCloths}})</a>
            </li>
            <li>
                <a :href="'/search?keyword='+keyword+'&category=kids'">KIDS ({{kidCloths}})</a>
            </li>
        </ul>

</template>


