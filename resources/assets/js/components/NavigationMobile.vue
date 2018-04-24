<template>
    <div class="uk-offcanvas-bar uk-text-left uk-flex uk-flex-wrap uk-flex-wrap-between">
        <div class="uk-width-1-1">
            <a :href="'/'+navigation.replace('s', '')" class="uk-link-reset"><h4 class="uk-margin-remove">{{ trans.rukuka }}</h4></a>
            <hr class="uk-margin-small">
            <ul class="uk-nav uk-nav-primary uk-nav-default uk-nav-left uk-margin-auto-vertical uk-nav-parent-icon" uk-nav v-if="navigation">
                <li :class="{'uk-open uk-active': category == 'all' }">
                    <a class="uk-parent uk-text-uppercase" :href="'/shop?menu='+navigation+'&parent=all'">
                        <span>
                            {{ trans.new_arrival}}
                        </span>
                    </a>
                </li>

                <li :class="{'uk-parent': true , 'uk-open uk-active': designer }">
                    <a :href="designerLink+'?menu='+navigation" class="uk-text-uppercase">{{ trans.designers_nav }}</a>
                    <ul class="uk-nav-sub">
                        <li class="uk-parent" v-for="design in designers">
                            <a :href="'/shop?menu='+navigation+'&designer='+ design.slug ">
                            <span>
                                {{ design.name }}
                            </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li :class="{'uk-parent': true , 'uk-open uk-active': category == 'clothing' }">
                    <a class="uk-text-uppercase">{{ trans.clothing }}</a>
                    <ul class="uk-nav-sub">
                    <span>
                        <li>
                            <a :href="'/shop?menu='+navigation+'&parent=clothing&category=all'">
                                <span>
                                    {{ trans.all }}
                                </span>
                            </a>
                        </li>
                        <li v-for="cat in categories.clothing" v-if="cat.menu == navigation || cat.menu == null">
                            <div v-if="categoryArr.includes(cat.name)">
                              <a :href="'/shop?menu='+navigation+'&parent=clothing&category='+ cat.slug ">{{ cat.name }}</a>
                            </div>
                            <div v-else>
                                <span class="cat-disabled-mobile">
                                    {{ cat.name }}
                                </span>
                            </div>
                        </li>
                    </span>
                    </ul>
                </li>

                <li :class="{'uk-parent': true , 'uk-open uk-active': category == 'accessories' }">
                    <a class="uk-text-uppercase">{{ trans.accessories }}</a>
                    <ul class="uk-nav-sub">
                    <span>
                        <li>
                          <a :href="'/shop?menu='+navigation+'&parent=accessories&category=all'">
                              <span>
                                  {{ trans.all }}
                              </span>
                          </a>
                        </li>
                        <li v-for="cat in categories.accessories" v-if="cat.menu == navigation || cat.menu == null">
                            <div v-if="categoryArr.includes(cat.name)">
                                <a :href="'/shop?menu='+navigation+'&parent=accessories&category='+ cat.slug ">{{ cat.name }}</a>
                            </div>
                            <div v-else>
                                <span class="cat-disabled-mobile">
                                    {{ cat.name }}
                                </span>
                            </div>
                        </li>
                    </span>
                    </ul>
                </li>

                <li :class="{'uk-open uk-active': category == 'homeware' }">
                    <a :href="'/shop?menu='+navigation+'&parent=homeware&category=all'" class="uk-text-uppercase">{{ trans.home_nav }}</a>
                </li>

                <li class="uk-parent">
                    <!--<a href="#" class="uk-text-uppercase"> {{ trans.sale_nav }}</a>-->
                    <ul class="uk-nav-sub">
                        <li><a href="/shop/womens/sale">{{ trans.women_nav}}</a></li>
                        <li><a href="/shop/mens/sale">{{ trans.men_nav}}</a></li>
                        <li><a href="/shop/home/sale">{{ trans.home_nav}}</a></li>
                    </ul>
                </li>
                <hr class="uk-margin-small">
                <li :class="{'uk-open uk-active': editorial }">
                    <a href="/editorial" class="uk-text-uppercase">{{ trans.blog_nav }}</a>
                </li>
            </ul>
            <ul class="uk-nav uk-nav-primary uk-nav-default uk-nav-left uk-margin-auto-vertical uk-nav-parent-icon" uk-nav v-else>
                <li>
                    <a href="/women" class="uk-text-uppercase">{{ trans.women_nav}}</a>
                </li>
                <li>
                    <a href="/men" class="uk-text-uppercase">{{ trans.men_nav}}</a>
                </li>
            </ul>
        </div>
        <div class="uk-width-1-1">
            <a v-if="auth == 0" :href="login_link" class="uk-link-reset"> <h4 class="uk-margin-small uk-text-uppercase">{{ trans.login }}</h4> </a>
            <a v-if="auth == 1" :href="profile_link" class="uk-link-reset"> <h4 class="uk-margin-small uk-text-uppercase">{{ trans.account }}</h4> </a>
        </div>
    </div>

</template>

<script>
    export default {
        props: [
            'men_link', 
            'women_link',
            'designer_link',
            'auth',
            'login_link',
            'profile_link',
            'locale',
            'navigation',
            'category',
            'designer',
            'editorial'
        ],

        created() {
            var self = this;
            var sort_by = function(field, reverse, primer){

                var key = primer ?
                    function(x) {return primer(x[field])} :
                    function(x) {return x[field]};

                reverse = !reverse ? 1 : -1;

                return function (a, b) {
                    return a = key(a), b = key(b), reverse * ((a > b) - (b > a));
                }
            };

            Event.listen('navigation', function (response) {

                if (typeof response !== 'undefined') {
                    if (typeof response !== 'undefined') {
                        self.categories = response;
                        self.categoryArr = response.category_available;
                    }

                    if (typeof response.designers !== 'undefined') {
                        self.designers = response.designers.sort(sort_by('created_at', true, function(result){
                            return result;
                        })).slice(0,37);
                    }
                }

            });
        },

        data() {
            return {
                categories: {},
                designers: {},
                menLink: this.men_link,
                womenLink: this.women_link,
                designerLink: this.designer_link,
                trans: JSON.parse(this.locale,true),
                categoryArr: {}
            }
        }
    }
</script>
