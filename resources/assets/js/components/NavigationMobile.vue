<template>
    <div class="uk-offcanvas-bar uk-text-left uk-flex uk-flex-wrap uk-flex-wrap-between">
        <div class="uk-width-1-1">
            <a href="/" class="uk-link-reset"><h4 class="uk-margin-remove">{{ trans.rukuka }}</h4></a>
            <hr class="uk-margin-small">
            <ul class="uk-nav uk-nav-primary uk-nav-default uk-nav-left uk-margin-auto-vertical uk-nav-parent-icon" uk-nav>
                <li :class="{'uk-parent': true , 'uk-open uk-active': category == 'designers' }">
                    <a :href="designerLink" class="uk-text-uppercase">{{ trans.designers_nav }}</a>
                    <ul class="uk-nav-sub">
                        <li class="uk-parent">
                            <a :href="'/shop?menu=designers&gender='+navigation+'&category=all'">
                              <span :class="{'text-underline': category == 'designers' }">
                                {{ trans.all }}
                               </span>
                            </a>
                        </li>
                        <li class="uk-parent" v-for="design in designers">
                            <a :href="'/shop?menu=designers&gender='+navigation+'&category='+ design.slug ">
                            <span>
                                {{ design.name }}
                            </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li :class="{'uk-parent': true , 'uk-open uk-active': navigation == 'womens' }">
                    <a :href="womenLink" class="uk-text-uppercase">{{ trans.women_nav }}</a>
                    <ul class="uk-nav uk-nav-sub uk-nav-default uk-nav-left uk-margin-auto-vertical uk-nav-parent-icon" uk-nav>
                        <li>
                            <a :href="womenLink">
                            <span :class="{'text-underline': segmentPage == 'women' }">
                                {{ trans.new_arrival}}
                            </span>
                            </a>
                        </li>
                        <li :class="{'uk-parent': true , 'uk-open': segmentShop == 'womens' && segmentCategory == 'clothing' }">
                            <a >{{ trans.clothing }}</a>
                            <ul class="uk-nav-sub">
                            <span>
                                <li>
                                    <a href="/shop?menu=womens&parent=clothing&category=all">
                                        <span :class="{'text-underline': segmentShop == 'womens' && segmentCategory == 'clothing' && segmentSlug == 'all' }">
                                            {{ trans.all }}
                                        </span>
                                    </a>
                                </li>
                                <li v-for="cat in categories.clothing" v-if="cat.menu == 'womens' || cat.menu == null">
                                    <a :href="'/shop?menu=womens&parent=clothing&category='+ cat.slug ">
                                        <span :class="{'text-underline': segmentShop == 'womens' && segmentCategory == 'clothing' && segmentSlug == cat.slug }">
                                            {{ cat.name }}
                                        </span>
                                    </a>
                                </li>
                            </span>
                            </ul>
                        </li>
                        <li :class="{'uk-parent': true , 'uk-open': segmentShop == 'womens' && segmentCategory == 'accessories' }">
                            <a>{{ trans.accessories }}</a>
                            <ul class="uk-nav-sub">
                            <span>
                                <li>
                                  <a href="/shop?menu=womens&parent=accessories&category=all">
                                      <span :class="{'text-underline': segmentShop == 'womens' && segmentCategory == 'accessories' && segmentSlug == 'all' }">
                                          {{ trans.all }}
                                      </span>
                                  </a>
                                </li>
                                <li v-for="cat in categories.accessories" v-if="cat.menu == 'womens' || cat.menu == null">
                                    <a :href="'/shop?menu=womens&parent=accessories&category='+ cat.slug ">
                                        <span :class="{'text-underline': segmentShop == 'womens' && segmentCategory == 'accessories' && segmentSlug == cat.slug }">
                                            {{ cat.name }}
                                        </span>
                                    </a>
                                </li>
                            </span>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li :class="{'uk-parent': true , 'uk-open uk-active': segmentPage == 'men' || segmentShop == 'mens' }">
                    <a :href="menLink" class="uk-text-uppercase">{{ trans.men_nav }}</a>
                    <ul class="uk-nav uk-nav-sub uk-nav-default uk-nav-left uk-margin-auto-vertical uk-nav-parent-icon" uk-nav>
                        <li>
                            <a class="uk-text-bold" :href="menLink">
                                <span :class="{'text-underline': segmentPage == 'men' }">
                                    {{ trans.new_arrival}}
                                </span>
                            </a>
                        </li>
                        <li :class="{'uk-parent': true , 'uk-open': segmentShop == 'mens' && segmentCategory == 'clothing' }">
                        <a>{{ trans.clothing }}</a>
                            <ul class="uk-nav-sub">
                            <span>
                                <li>
                                    <a href="/shop?menu=mens&parent=clothing&category=all">
                                        <span :class="{'text-underline': segmentShop == 'mens' && segmentCategory == 'clothing' && segmentSlug == 'all' }">
                                            {{ trans.all }}
                                        </span>
                                    </a>
                                </li>
                                <li v-for="cat in categories.clothing" v-if="cat.menu == 'mens' || cat.menu == null">
                                    <a :href="'/shop?menu=mens&parent=clothing&category='+ cat.slug ">
                                        <span :class="{'text-underline': segmentShop == 'mens' && segmentCategory == 'clothing' && segmentSlug == cat.slug }">
                                            {{ cat.name }}
                                        </span>
                                    </a>
                                </li>
                            </span>
                            </ul>
                        </li>
                        <li :class="{'uk-parent': true , 'uk-open': segmentShop == 'mens' && segmentCategory == 'accessories' }">
                            <a>{{ trans.accessories }}</a>
                            <ul class="uk-nav-sub">
                            <span>
                                <li>
                                  <a href="/shop?menu=mens&parent=accessories&category=all">
                                      <span :class="{'text-underline': segmentShop == 'mens' && segmentCategory == 'accessories' && segmentSlug == 'all' }">
                                          {{ trans.all }}
                                      </span>
                                  </a>
                                </li>
                                <li v-for="cat in categories.accessories" v-if="cat.menu == 'mens' || cat.menu == null">
                                    <a :href="'/shop?menu=mens&parent=accessories&category='+ cat.slug ">
                                         <span :class="{'text-underline': segmentShop == 'mens' && segmentCategory == 'accessories' && segmentSlug == cat.slug }">
                                            {{ cat.name }}
                                         </span>
                                    </a>
                                </li>
                            </span>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li :class="{'uk-open uk-active': segmentShop == 'home' }">
                    <a href="/shop?menu=home&parent=all&category=all" class="uk-text-uppercase">{{ trans.home_nav }}</a>
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
                <li :class="{'uk-open uk-active': segmentPage == 'editorial' }">
                    <a href="/editorial" class="uk-text-uppercase">{{ trans.blog_nav }}</a>
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
            'segment_page',
            'segment_shop',
            'segment_category',
            'segment_slug',
            'navigation',
            'category'
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
                segmentCategory: this.segment_category,
                segmentSlug: this.segment_slug,
            }
        }
    }
</script>
