<template>
    <div class="uk-offcanvas-bar uk-text-left uk-flex uk-flex-wrap uk-flex-wrap-between">
        <div class="uk-width-1-1">
            <ul uk-tab="animation: uk-animation-slide-left-small" uk-grid class="uk-child-width-1-2">
                <li :class="{'uk-active': navigation == 'mens' }">
                  <a href="/men" class=""><h4>{{ trans.men_nav}}</h4></a>
                </li>
                <li :class="{'uk-active': navigation == 'womens' }">
                  <a href="/women" class=""><h4>{{ trans.women_nav}}</h4></a>
                </li>
            </ul>
            <ul class="uk-switcher uk-margin">

                <!-- men section start -->
                <li>
                  <span class="uk-text-danger uk-text-small uk-text-bold">Shop</span>
                  <ul class="uk-nav uk-nav-primary uk-nav-default uk-nav-left uk-margin-auto-vertical uk-nav-parent-icon" uk-nav>
                      <li>
                        <a href="/men">Men Page</a>
                      </li>
                      <li :class="{'uk-open uk-active': category == 'all' }">
                          <a class="uk-parent " :href="'/shop?menu=mens&parent=all'">
                              <span>
                                  {{ trans.new_arrival}}
                              </span>
                          </a>
                      </li>

                      <li :class="{'uk-parent': true , 'uk-open uk-active': designer }">
                          <a :href="designerLink+'?menu=mens'" class="">{{ trans.designers_nav }}</a>
                          <ul class="uk-nav-sub">
                              <li class="uk-parent" v-for="design in designers" v-if="design.gender == 'mens' || design.gender == 'unisex'">
                                  <a :href="'/shop?menu=mens&designer='+ design.slug ">
                                  <span>
                                      {{ design.name }}
                                  </span>
                                  </a>
                              </li>
                          </ul>
                      </li>

                      <li :class="{'uk-parent': true , 'uk-open uk-active': category == 'clothing' }">
                          <a class="">{{ trans.clothing }}</a>
                          <ul class="uk-nav-sub">
                          <span>
                              <li>
                                  <a :href="'/shop?menu=mens&parent=clothing&category=all'">
                                      <span>
                                          {{ trans.all }}
                                      </span>
                                  </a>
                              </li>
                              <li v-for="cat in categories.clothing" v-if="cat.menu == 'mens' || cat.menu == null">
                                  <div v-if="categoryArrMens.includes(cat.name)">
                                    <a :href="'/shop?menu=mens&parent=clothing&category='+ cat.slug ">{{ cat.name }}</a>
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
                          <a class="">{{ trans.accessories }}</a>
                          <ul class="uk-nav-sub">
                          <span>
                              <li>
                                <a :href="'/shop?menu=mens&parent=accessories&category=all'">
                                    <span>
                                        {{ trans.all }}
                                    </span>
                                </a>
                              </li>
                              <li v-for="cat in categories.accessories" v-if="cat.menu == 'mens' || cat.menu == null">
                                  <div v-if="categoryArrMens.includes(cat.name)">
                                      <a :href="'/shop?menu=mens&parent=accessories&category='+ cat.slug ">{{ cat.name }}</a>
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

                      <li :class="{'uk-parent': true , 'uk-open uk-active': category == 'homeware' }">
                          <a class="">{{ trans.home_nav }}</a>
                          <ul class="uk-nav-sub">
                          <span>
                              <li>
                                <a :href="'/shop?menu=mens&parent=homeware&category=all'">
                                    <span>
                                        {{ trans.all }}
                                    </span>
                                </a>
                              </li>
                              <li v-for="cat in categories.homeware" v-if="cat.menu == 'mens' || cat.menu == null">
                                  <div v-if="categoryArrMens.includes(cat.name)">
                                      <a :href="'/shop?menu=mens&parent=homeware&category='+ cat.slug ">{{ cat.name }}</a>
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

                      <li class="uk-parent">
                          <!--<a href="#" class=""> {{ trans.sale_nav }}</a>-->
                          <ul class="uk-nav-sub">
                              <li><a href="/shop/womens/sale">{{ trans.women_nav}}</a></li>
                              <li><a href="/shop/mens/sale">{{ trans.men_nav}}</a></li>
                              <li><a href="/shop/home/sale">{{ trans.home_nav}}</a></li>
                          </ul>
                      </li>
                      <hr class="uk-margin-small">
                      <span class="uk-text-danger uk-text-small uk-text-bold">Blog</span>
                      <li :class="{'uk-open uk-active': editorial }">
                          <a href="/editorial" class="">{{ trans.blog_nav }}</a>
                      </li>
                  </ul>
                </li>
                <!-- women section tab start -->
                <li>
                  <span class="uk-text-danger uk-text-small uk-text-bold">Shop</span>
                  <ul class="uk-nav uk-nav-primary uk-nav-default uk-nav-left uk-margin-auto-vertical uk-nav-parent-icon" uk-nav>
                      <li>
                        <a href="/women">Women Page</a>
                      </li>
                      <li :class="{'uk-open uk-active': category == 'all' }">
                          <a class="uk-parent " :href="'/shop?menu=womens&parent=all'">
                              <span>
                                  {{ trans.new_arrival}}
                              </span>
                          </a>
                      </li>

                      <li :class="{'uk-parent': true , 'uk-open uk-active': designer }">
                          <a :href="designerLink+'?menu=womens'" class="">{{ trans.designers_nav }}</a>
                          <ul class="uk-nav-sub">
                              <li class="uk-parent" v-for="design in designers" v-if="design.gender == 'womens' || design.gender == 'unisex'">
                                  <a :href="'/shop?menu=womens&designer='+ design.slug ">
                                  <span>
                                      {{ design.name }}
                                  </span>
                                  </a>
                              </li>
                          </ul>
                      </li>

                      <li :class="{'uk-parent': true , 'uk-open uk-active': category == 'clothing' }">
                          <a class="">{{ trans.clothing }}</a>
                          <ul class="uk-nav-sub">
                          <span>
                              <li>
                                  <a :href="'/shop?menu=womens&parent=clothing&category=all'">
                                      <span>
                                          {{ trans.all }}
                                      </span>
                                  </a>
                              </li>
                              <li v-for="cat in categories.clothing" v-if="cat.menu == 'womens' || cat.menu == null">
                                  <div v-if="categoryArrWomens.includes(cat.name)">
                                    <a :href="'/shop?menu=womens&parent=clothing&category='+ cat.slug ">{{ cat.name }}</a>
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
                          <a class="">{{ trans.accessories }}</a>
                          <ul class="uk-nav-sub">
                          <span>
                              <li>
                                <a :href="'/shop?menu=womens&parent=accessories&category=all'">
                                    <span>
                                        {{ trans.all }}
                                    </span>
                                </a>
                              </li>
                              <li v-for="cat in categories.accessories" v-if="cat.menu == 'womens' || cat.menu == null">
                                  <div v-if="categoryArrWomens.includes(cat.name)">
                                      <a :href="'/shop?menu=womens&parent=accessories&category='+ cat.slug ">{{ cat.name }}</a>
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

                      <li :class="{'uk-parent': true , 'uk-open uk-active': category == 'homeware' }">
                          <a class="">{{ trans.home_nav }}</a>
                          <ul class="uk-nav-sub">
                          <span>
                              <li>
                                <a :href="'/shop?menu=womens&parent=homeware&category=all'">
                                    <span>
                                        {{ trans.all }}
                                    </span>
                                </a>
                              </li>
                              <li v-for="cat in categories.homeware" v-if="cat.menu == 'womens' || cat.menu == null">
                                  <div v-if="categoryArrWomens.includes(cat.name)">
                                      <a :href="'/shop?menu=womens&parent=homeware&category='+ cat.slug ">{{ cat.name }}</a>
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

                      <li class="uk-parent">
                          <!--<a href="#" class=""> {{ trans.sale_nav }}</a>-->
                          <ul class="uk-nav-sub">
                              <li><a href="/shop/womens/sale">{{ trans.women_nav}}</a></li>
                              <li><a href="/shop/mens/sale">{{ trans.men_nav}}</a></li>
                              <li><a href="/shop/home/sale">{{ trans.home_nav}}</a></li>
                          </ul>
                      </li>
                      <hr class="uk-margin-small">
                      <span class="uk-text-danger uk-text-small uk-text-bold">Blog</span>
                      <li :class="{'uk-open uk-active': editorial }">
                          <a href="/editorial" class="">{{ trans.blog_nav }}</a>
                      </li>
                  </ul>
                </li>
                <!-- ends womens section tab -->
            </ul>
        </div>
        <div class="uk-width-1-1">
            <a v-if="auth == 0" :href="login_link" class="uk-link-reset"> <h4 class="uk-margin-small ">{{ trans.login }}</h4> </a>
            <a v-if="auth == 1" :href="profile_link" class="uk-link-reset"> <h4 class="uk-margin-small ">{{ trans.account }}</h4> </a>
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
                        self.categoryArrMens = response.category_mens_available;
                        self.categoryArrWomens = response.category_womens_available;
                    }

                    if (typeof response.designers_all !== 'undefined') {
                        self.designers = response.designers_all.sort(sort_by('created_at', true, function(result){
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
                categoryArrMens: {},
                categoryArrWomens: {}
            }
        }
    }
</script>
