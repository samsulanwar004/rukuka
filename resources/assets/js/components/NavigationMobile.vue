<template>
    <div class="uk-offcanvas-bar uk-flex uk-flex-column uk-text-left">
        <button class="uk-offcanvas-close uk-close-large" type="button" uk-close></button>
        <ul class="uk-nav uk-nav-primary uk-nav-default uk-nav-left uk-margin-auto-vertical uk-nav-parent-icon" uk-nav>
            <li class="uk-text-uppercase"> <a href="/">{{ trans.home }}</a></li>
            <li class="uk-parent">
                <a :href="designerLink" class="uk-text-uppercase" >{{ trans.designers_nav }}</a>
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
                <a :href="womenLink" class="uk-text-uppercase">{{ trans.women_nav }}</a>
                <ul class="uk-nav uk-nav-sub uk-nav-default uk-nav-left uk-margin-auto-vertical uk-nav-parent-icon" uk-nav>
                    <li>
                        <a class="uk-text-bold uk-text-uppercase" :href="womenLink">{{ trans.whats_new}}</a>
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
                <a :href="menLink" class="uk-text-uppercase">{{ trans.men_nav }}</a>
                <ul class="uk-nav uk-nav-sub uk-nav-default uk-nav-left uk-margin-auto-vertical uk-nav-parent-icon" uk-nav>
                    <li>
                        <a class="uk-text-bold uk-text-uppercase" :href="menLink">{{ trans.whats_new}}</a>
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
                <a :href="kidLink" class="uk-text-uppercase">{{ trans.kids_nav }}</a>
                <ul class="uk-nav uk-nav-sub uk-nav-default uk-nav-left uk-margin-auto-vertical uk-nav-parent-icon" uk-nav>
                    <li>
                        <a class="uk-text-bold uk-text-uppercase" :href="kidLink">{{ trans.whats_new}}</a>
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
                <a href="#" class="uk-text-uppercase"> {{ trans.sale_nav }}</a>
                <ul class="uk-nav-sub uk-text-uppercase">
                    <li><a href="/shop/womens/sale">{{ trans.women_nav}}</a></li>
                    <li><a href="/shop/mens/sale">{{ trans.men_nav}}</a></li>
                    <li><a href="/shop/kids/sale">{{ trans.kids_nav}}</a></li>
                </ul>
            </li>
            <li><a href="/blog" class="uk-text-uppercase">{{ trans.blog_nav }}</a></li>
        </ul>
    </div>

</template>

<script>
    export default {
        props: ['men_link', 'women_link', 'kid_link','designer_link','locale'],
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

            Event.listen('navigation', function (response) {

                if (typeof response !== 'undefined') {
                    if (typeof response.mens !== 'undefined') {
                        self.menCloths = response.mens;
                    }

                    if (typeof response.womens !== 'undefined') {
                        self.womenCloths = response.womens;
                    }

                    if (typeof response.kids !== 'undefined') {
                        self.kidCloths = response.kids;
                    }

                    if (typeof response.designers !== 'undefined') {
                        self.designers = response.designers.sort(sort_by('created_at', true, function(result){
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
                trans: JSON.parse(this.locale,true),
            }
        }
    }
</script>