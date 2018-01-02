<script>
    export default {
        props: ['api', 'men_link', 'women_link', 'kid_link','designer_link'],
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
                menLink: this.men_link,
                womenLink: this.women_link,
                kidLink: this.kid_link,
                designerLink: this.designer_link,
            }
        }
    }
</script>

<template>
    <div class="uk-offcanvas-bar uk-flex uk-flex-column uk-text-left">
        <button class="uk-offcanvas-close uk-close-large" type="button" uk-close></button>
        <ul class="uk-nav uk-nav-primary uk-nav-default uk-nav-left uk-margin-auto-vertical uk-nav-parent-icon" uk-nav>
            <li> <a href="/">HOME</a></li>
            <li class="uk-parent">
                <a :href="designerLink">DESIGNERS</a>
                <ul class="uk-nav-sub">
                    <li class="uk-parent uk-active">
                        <a href="/shop/designers/all">All</a>
                    </li>
                    <li class="uk-parent" v-for="design in designers">
                        <a :href="'/shop/designers/'+ design.slug ">{{ design.name }}</a>
                    </li>
                </ul>
            </li>
            <li class="uk-parent">
                <a :href="womenLink">WOMEN</a>
                <ul class="uk-nav uk-nav-sub uk-nav-default uk-nav-left uk-margin-auto-vertical uk-nav-parent-icon" uk-nav>
                    <li>
                        <a class="uk-text-bold uk-text-uppercase" :href="womenLink">What's New</a>
                    </li>
                    <li class="uk-parent">
                        <a v-for="cloth in womenCloths" v-if="cloth.name.toLowerCase() == 'clothing'" class="uk-text-bold" >{{ cloth.name.toUpperCase() }}</a>
                        <ul class="uk-nav-sub">
                            <span v-for="cloth in womenCloths" v-if="cloth.name.toLowerCase() == 'clothing'">
                                <li>
                                    <a href="/shop/womens/all">All</a>
                                </li>
                                <li v-for="cat in cloth.child">
                                    <a :href="'/shop/womens/'+cloth.name.toLowerCase()+'/'+ cat.slug ">{{ cat.name }}</a>
                                </li>
                            </span>
                        </ul>
                    </li>
                    <li class="uk-parent">
                        <a v-for="cloth in womenCloths" v-if="cloth.name.toLowerCase() == 'accessories'" class="uk-text-bold">{{ cloth.name.toUpperCase() }}</a>
                        <ul class="uk-nav-sub">
                            <span v-for="cloth in womenCloths" v-if="cloth.name.toLowerCase() == 'accessories'">
                                <li>
                                  <a href="/shop/womens/all">All</a>
                                </li>
                                <li v-for="cat in cloth.child">
                                    <a :href="'/shop/womens/'+cloth.name.toLowerCase()+'/'+ cat.slug ">{{ cat.name }}</a>
                                </li>
                            </span>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="uk-parent">
                <a :href="menLink">MEN</a>
                <ul class="uk-nav uk-nav-sub uk-nav-default uk-nav-left uk-margin-auto-vertical uk-nav-parent-icon" uk-nav>
                    <li>
                        <a class="uk-text-bold uk-text-uppercase" :href="menLink">What's New</a>
                    </li>
                    <li class="uk-parent">
                        <a v-for="cloth in menCloths" v-if="cloth.name.toLowerCase() == 'clothing'" class="uk-text-bold" >{{ cloth.name.toUpperCase() }}</a>
                        <ul class="uk-nav-sub">
                            <span v-for="cloth in menCloths" v-if="cloth.name.toLowerCase() == 'clothing'">
                                <li>
                                    <a href="/shop/mens/all">All</a>
                                </li>
                                <li v-for="cat in cloth.child">
                                    <a :href="'/shop/mens/'+cloth.name.toLowerCase()+'/'+ cat.slug ">{{ cat.name }}</a>
                                </li>
                            </span>
                        </ul>
                    </li>
                    <li class="uk-parent">
                        <a v-for="cloth in menCloths" v-if="cloth.name.toLowerCase() == 'accessories'" class="uk-text-bold">{{ cloth.name.toUpperCase() }}</a>
                        <ul class="uk-nav-sub">
                            <span v-for="cloth in menCloths" v-if="cloth.name.toLowerCase() == 'accessories'">
                                <li>
                                  <a href="/shop/mens/all">All</a>
                                </li>
                                <li v-for="cat in cloth.child">
                                    <a :href="'/shop/mens/'+cloth.name.toLowerCase()+'/'+ cat.slug ">{{ cat.name }}</a>
                                </li>
                            </span>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="uk-parent">
                <a :href="kidLink">KIDS</a>
                <ul class="uk-nav uk-nav-sub uk-nav-default uk-nav-left uk-margin-auto-vertical uk-nav-parent-icon" uk-nav>
                    <li>
                        <a class="uk-text-bold uk-text-uppercase" :href="kidLink">What's New</a>
                    </li>
                    <li class="uk-parent">
                        <a v-for="cloth in kidCloths" v-if="cloth.name.toLowerCase() == 'clothing'" class="uk-text-bold" >{{ cloth.name.toUpperCase() }}</a>
                        <ul class="uk-nav-sub">
                            <span v-for="cloth in kidCloths" v-if="cloth.name.toLowerCase() == 'clothing'">
                                <li>
                                    <a href="/shop/kids/all">All</a>
                                </li>
                                <li v-for="cat in cloth.child">
                                    <a :href="'/shop/kids/'+cloth.name.toLowerCase()+'/'+ cat.slug ">{{ cat.name }}</a>
                                </li>
                            </span>
                        </ul>
                    </li>
                    <li class="uk-parent">
                        <a v-for="cloth in kidCloths" v-if="cloth.name.toLowerCase() == 'accessories'" class="uk-text-bold">{{ cloth.name.toUpperCase() }}</a>
                        <ul class="uk-nav-sub">
                            <span v-for="cloth in kidCloths" v-if="cloth.name.toLowerCase() == 'accessories'">
                                <li>
                                  <a href="/shop/kids/all">All</a>
                                </li>
                                <li v-for="cat in cloth.child">
                                    <a :href="'/shop/kids/'+cloth.name.toLowerCase()+'/'+ cat.slug ">{{ cat.name }}</a>
                                </li>
                            </span>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="uk-parent">
                <a href="#">SALE</a>
                <ul class="uk-nav-sub">
                    <li><a href="/shop/womens/sale">Womens</a></li>
                    <li><a href="/shop/mens/sale">Mens</a></li>
                    <li><a href="/shop/kids/sale">Kids</a></li>
                </ul>
            </li>
            <li><a href="/blog">BLOG</a></li>
        </ul>
    </div>

</template>


