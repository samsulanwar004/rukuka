<template>
    <nav class="uk-container" uk-navbar="dropbar: true; align: center; boundary-align: true; duration:100">
      <div class="uk-navbar-left">
          <ul class="uk-navbar-nav">
            <!-- New Arrival -->
            <li class="uk-margin-medium-right">
              <a href="#">New Arrival</a>
            </li>
              <!--Start Designer-->
              <li :class="{'uk-active': category == 'designers'}" class="uk-margin-medium-right">
                  <a :href="designerLink">{{ trans.designers_nav }}</a>
                  <div class="uk-navbar-dropdown" uk-drop="boundary: !nav; delay-show:200; delay-hide:200; boundary-align: true; pos: bottom-justify;">
                      <div uk-grid>
                        <div class="uk-width-3-5@m">
                          <div class="uk-width-3-4">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                              <li><h5 class="uk-margin-small uk-text-uppercase">{{ trans.designers_nav }}</h5></li>
                            </ul>
                            <ul class="uk-nav uk-navbar-dropdown-nav uk-column-1-3">
                                <li class="uk-parent uk-active">
                                    <a :href="'/shop?menu=designers&gender='+navigation+'&category=all'">{{ trans.all }} </a>
                                </li>
                              <li class="uk-parent" v-for="design in designers">
                                  <a :href="'/shop?menu=designers&gender='+navigation+'&category='+ design.slug ">{{ design.name }}</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="uk-width-2-5@m">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                  <h5 class="uk-margin-small uk-text-uppercase"> {{ trans.brand_focus }}</h5>
                              </ul>
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                  <li class="uk-parent">
                                    <div class="uk-inline">
                                      <a :href="designersNav.designer_shop_url">
                                          <lazy-background
                                                  :image-source="designersNav.designer_shop_image | awsLink(aws_link)"
                                                  :alt="designersNav.designer_designer_shop__text"
                                                  :loading-image="loadingImage"
                                                  :error-image="errorImage"
                                                  image-style="height: 250px; width:250px">
                                          </lazy-background>
                                      </a>
                                      <div class="uk-overlay-primary uk-position-cover"></div>
                                      <div class="uk-position-small uk-position-bottom uk-text-center uk-panel uk-light uk-visible@m">
                                      <a :href="designersNav.designer_shop_url">
                                         <h2 class="uk-margin-small uk-text-uppercase"> {{designersNav.designer_shop_text}} </h2>
                                         <a :href="designersNav.designer_shop_url" class="uk-button uk-button-small uk-button-default">{{ trans.shop_now}}</a>
                                      </a>
                                    </div>
                                    </div>
                              </ul>
                          </div>
                    </div>
                </div>
              </li>
              <!--End Designer-->

              <!--Start Womens-->
              <li :class="{'uk-active': category == 'clothing'}" class="uk-margin-medium-right">
                  <!-- <a :href="womenLink">{{ trans.women_nav }}</a> -->
                  <a href="#">{{ trans.clothing }}</a>
                  <div class="uk-navbar-dropdown" uk-drop="boundary: !nav; delay-show:200; delay-hide:200; boundary-align: true; pos: bottom-justify;">
                      <div uk-grid>
                        <div class="uk-width-3-5@m" uk-grid>
                            <div class="uk-width-3-4">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li ><h5 class="uk-margin-small uk-text-uppercase">{{ trans.clothing }}</h5></li>
                              </ul>
                              <ul class="uk-nav uk-navbar-dropdown-nav uk-column-1-2">
                                <li class="uk-parent uk-active">
                                  <a :href="'/shop?menu='+navigation+'&parent=clothing&category=all'">{{ trans.all }}</a>
                                </li>
                                  <li class="uk-parent" v-for="cat in categories.clothing" v-if="cat.menu == navigation || cat.menu == null">
                                    <a :href="'/shop?menu='+navigation+'&parent=clothing&category='+ cat.slug ">{{ cat.name }}</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="uk-width-2-5@m">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                  <h5 class="uk-margin-small uk-text-uppercase"> {{ trans.spotlight }}</h5>
                              </ul>
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                  <li class="uk-parent">
                                    <div class="uk-inline">
                                      <a :href="womensNav.women_shop_url">
                                          <lazy-background
                                                  :image-source="womensNav.women_shop_image | awsLink(aws_link)"
                                                  :alt="womensNav.women_shop_text"
                                                  :loading-image="loadingImage"
                                                  :error-image="errorImage"
                                                  image-style="height: 250px; width:250px">
                                          </lazy-background>
                                      </a>
                                      <div class="uk-overlay-primary uk-position-cover"></div>
                                      <div class="uk-position-small uk-position-bottom uk-text-center uk-panel uk-light uk-visible@m">
                                      <a :href="womensNav.women_shop_url">
                                         <h2 class="uk-margin-small uk-text-uppercase"> {{womensNav.women_shop_text}} </h2>
                                         <a :href="womensNav.women_shop_url" class="uk-button uk-button-small uk-button-default">{{ trans.shop_now}}</a>
                                      </a>
                                    </div>
                                    </div>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </li>
              <!--End Womens-->

              <!--Start Mens-->
              <li :class="{'uk-active': category == 'accessories'}" class="uk-margin-medium-right">
                <!-- <a :href="menLink">{{ trans.men_nav }}</a> -->
                <a href="#">{{ trans.accessories }}</a>
                <div class="uk-navbar-dropdown" uk-drop="boundary: !nav; delay-show:200; delay-hide:200; boundary-align: true; pos: bottom-justify;">
                    <div uk-grid>
                        <div class="uk-width-3-5@m" uk-grid>
                            <div class="uk-width-1-3">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li><h5 class="uk-margin-small uk-text-uppercase">{{ trans.accessories }}</h5></li>
                              </ul>
                              <ul class="uk-nav uk-navbar-dropdown-nav uk-column-1-1">
                                <li class="uk-parent uk-active">
                                  <a :href="'/shop?menu='+navigation+'&parent=accessories&category=all'">{{ trans.all }}</a>
                                </li>
                                  <li class="uk-parent" v-for="cat in categories.accessories" v-if="cat.menu == navigation || cat.menu == null">
                                      <a :href="'/shop?menu='+navigation+'&parent=accessories&category='+ cat.slug ">{{ cat.name }}</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        <div class="uk-width-2-5@m">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <h5 class="uk-margin-small uk-text-uppercase"> {{ trans.spotlight }}</h5>
                            </ul>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-parent">
                                  <div class="uk-inline">
                                    <a :href="mensNav.men_shop_url">
                                        <lazy-background
                                                :image-source="mensNav.men_shop_image | awsLink(aws_link)"
                                                :alt="mensNav.men_shop_text"
                                                :loading-image="loadingImage"
                                                :error-image="errorImage"
                                                image-style="height: 250px; width:250px">
                                        </lazy-background>
                                    </a>
                                    <div class="uk-overlay-primary uk-position-cover"></div>
                                    <div class="uk-position-small uk-position-bottom uk-text-center uk-panel uk-light uk-visible@m">
                                    <a :href="mensNav.men_shop_url">
                                       <h2 class="uk-margin-small uk-text-uppercase"> {{mensNav.men_shop_text}} </h2>
                                       <a :href="mensNav.men_shop_url" class="uk-button uk-button-small uk-button-default">{{ trans.shop_now}}</a>
                                    </a>
                                  </div>
                                  </div>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
              </li>
              <!--End Mens-->
              <!--Start Home-->
              <li :class="{'uk-active': category == 'home'}" class="uk-margin-medium-right">
                  <a href="/shop?menu=home&parent=all">{{ trans.home }}</a>
              </li>
              <!--End Home-->
              <!--Start Sale-->
              <li>
                  <!--<a class="uk-text-danger"><b>{{ trans.sale_nav }}</b></a>-->
                  <div class="uk-navbar-dropdown" uk-drop="boundary: !nav; delay-show:200; delay-hide:200; boundary-align: true; pos: bottom-justify;">
                      <div uk-grid>
                          <div class="uk-width-4-5@m uk-margin-remove">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                  <li><h5 class="uk-margin-small">{{salesNav.sale_text}}</h5></li>
                              </ul>
                              <a :href="salesNav.sale_url">
                                  <lazy-background
                                    :image-source="salesNav.sale_image | awsLink(aws_link)"
                                    :alt="salesNav.sale_text"
                                    :loading-image="loadingImage"
                                    :error-image="errorImageSale"
                                    image-style="height: 100px; width: 800px">
                                  </lazy-background>
                              </a>
                          </div>
                          <div class="uk-width-1-5@m" uk-grid>
                              <div>
                                  <ul class="uk-nav uk-navbar-dropdown-nav">
                                      <li><h5 class="uk-margin-small uk-text-uppercase">{{ trans.on_sale }}</h5></li>
                                  </ul>
                                  <ul class="uk-nav uk-navbar-dropdown-nav">
                                      <li>
                                          <a href="/shop/womens/sale" class="uk-text-danger">{{ trans.women_nav }}</a>
                                          <a href="/shop/mens/sale" class="uk-text-danger">{{ trans.men_nav }}</a>
                                          <a href="/shop/home/sale" class="uk-text-danger">{{ trans.home_nav }}</a>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
              </li>
              <!--End Sale-->

              <!--Start Editorial-->
              <li :class="{'uk-active': segmentPage == 'editorial'}" class="uk-margin-medium-right">
                  <a href="/editorial">{{ trans.blog_nav }}</a>
              </li>
              <!--End Editorial-->

          </ul>
      </div>
      <div class="uk-navbar-right user_panel_vis">
        <ul class="uk-navbar-nav">


          <li class="uk-margin-left">
            <a href="#flag-modal" uk-toggle><img :src="flagImage+language+'.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt="">
            <span class="uk-text-uppercase uk-margin-small-left">{{ currencyCode }}</span>
            </a>
            <div id="flag-modal" class="uk-modal-full" uk-modal>
                <div class="uk-modal-dialog uk-flex uk-flex-center uk-flex-middle" uk-height-viewport>
                    <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                    <div class="uk-width-xxlarge uk-padding-large uk-text-center">
                        <h3 class="uk-text-uppercase">{{ trans.currency_title }}</h3>
                        <button class="uk-button uk-button-small uk-button-default uk-text-uppercase" disabled>{{ trans.currency_set }} <img :src="flagImage+language+'.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt="">
                          {{ currencyCode }}
                        </button>
                        <h5 class="uk-text-uppercase">{{ trans.usca }}</h5>
                        <div class="uk-grid uk-child-width-1-2@m uk-gird-small" uk-grid>
                          <div>
                            <a href="/lang/ca"><h6>{{ trans.cad }} <img :src="flagImage+'ca.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.ca }}</h6></a>
                          </div>
                          <div>
                            <a href="/lang/en"><h6>{{ trans.usd }} <img :src="flagImage+'en.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.us }}</h6></a>
                          </div>
                        </div>
                        <h5 class="uk-text-uppercase">{{ trans.asea }}</h5>
                        <div class="uk-grid uk-child-width-1-3@m uk-grid-small" uk-grid>
                          <div>
                            <a href="/lang/id"><h6>{{ trans.idr }} <img :src="flagImage+'id.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.id }}</h6></a>
                          </div>
                          <div>
                            <a href="/lang/sg"><h6>{{ trans.sgd }} <img :src="flagImage+'sg.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.sg }}</h6></a>
                          </div>
                          <div>
                            <a href="/lang/my"><h6>{{ trans.myr }} <img :src="flagImage+'my.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.my }}</h6></a>
                          </div>
                          <div>
                            <a href="/lang/bn"><h6>{{ trans.bnd }} <img :src="flagImage+'bn.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.bn }}</h6></a>
                          </div>
                          <div>
                            <a href="/lang/jp"><h6>{{ trans.jpy }} <img :src="flagImage+'jp.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.jp }}</h6></a>
                          </div>
                          <div>
                            <a href="/lang/kr"><h6>{{ trans.krw }} <img :src="flagImage+'kr.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.kr }}</h6></a>
                          </div>
                          <div>
                            <a href="/lang/cn"><h6>{{ trans.cny }} <img :src="flagImage+'cn.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.cn }}</h6></a>
                          </div>
                          <div>
                            <a href="/lang/hk"><h6>{{ trans.hkd }} <img :src="flagImage+'hk.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.hk }}</h6></a>
                          </div>
                        </div>
                        <h5 class="uk-text-uppercase">{{ trans.euro }}</h5>
                          <a href="/lang/eu"><h6>{{ trans.eur }} <img :src="flagImage+'eu.svg'" width="16" class="uk-border-circle uk-box-shadow-small" alt=""> {{ trans.eu }}</h6></a>
                    </div>
                </div>
            </div>
          </li>
          <li v-if="auth == 1"  class="uk-margin-left">
            <a :href="wishlist_link"><i class="material-icons" style="font-size: 18px">favorite</i>
              <div class="uk-badge" v-if="wishlistCount > 0">
                {{ wishlistCount }}
              </div>
            </a>
          </li>
          <li  class="uk-margin-left">
            <a href="#" v-on:click.prevent="goBag"><i class="material-icons" style="font-size: 18px">shopping_basket</i>
              <div class="uk-badge" v-if="bagCount > 0">
                {{ bagCount }}
              </div>
            </a>
          </li>
          <li v-if="auth == 0"  class="uk-margin-left">
            <a :href="login_link"><i class="material-icons" style="font-size: 18px">person</i></a>
          </li>
          <li v-if="auth == 1"  class="uk-margin-left">
            <a :href="profile_link"> <i class="material-icons" style="font-size: 18px; vertical-align:middle">person</i> {{ accounts.first_name }}</a>
          </li>

        </ul>

      </div>
      <div class="uk-navbar-right search_vis">
          <div class="uk-navbar-item">

              <form class="uk-search">
                  <button class="uk-search-icon-flip" uk-search-icon uk-icon="ratio: 0.3"></button>
                  <input class="uk-search-input" type="search" placeholder="Search ">
              </form>

          </div>
      </div>
    </nav>
</template>

<style>
  #bag-hidden {
    display: none;
  }
</style>

<script>
    import axios from 'axios';
    import VueLazyBackgroundImage from '../components/VueLazyBackgroundImage.vue';

    export default {
        props: [
          'api',
          'men_link',
          'women_link',
          'designer_link',
          'aws_link',
          'default_image',
          'locale',
          'profile_link',
          'history_link',
          'wishlist_link',
          'bag_link',
          'login_link',
          'auth',
          'wishlist_api',
          'bag_api',
          'account',
          'product_link',
          'checkout_link',
          'api_token',
          'logout_link',
          'exchange_api',
          'currency_code',
          'language',
          'navigation',
          'category'
        ],

        components: {
          'lazy-background': VueLazyBackgroundImage
        },

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
            axios.get(api)
            .then(function (navigations) {
              if (typeof navigations.data.data !== 'undefined') {
                Event.fire('navigation', navigations.data.data);

                if (typeof navigations.data.data !== 'undefined') {
                  self.categories = navigations.data.data;
                }

                if (typeof navigations.data.data.designers !== 'undefined') {
                   self.designers = navigations.data.data.designers.sort(sort_by('created_at', true, function(result){
                    return result;
                  })).slice(0,37);
                }

                if (typeof navigations.data.data.designers_nav !== 'undefined') {
                   self.designersNav = navigations.data.data.designers_nav;
                }

                if (typeof navigations.data.data.womens_nav !== 'undefined') {
                   self.womensNav = navigations.data.data.womens_nav;
                }

                if (typeof navigations.data.data.mens_nav !== 'undefined') {
                  self.mensNav = navigations.data.data.mens_nav;
                }

                if (typeof navigations.data.data.kids_nav !== 'undefined') {
                  self.kidsNav = navigations.data.data.kids_nav;
                }

                if (typeof navigations.data.data.sales_nav !== 'undefined') {
                  self.salesNav = navigations.data.data.sales_nav;
                }
              }
            })
            .catch(function (error) {
              console.log(error);
            });

            // userpanel
            if (this.auth == 1) {
              self.getWishlist();
            }

            self.getExchange();

            self.accounts = this.account ? JSON.parse(this.account) : {};

            self.getBag();

            Event.listen('addBag', function (response) {
              self.bagCount = response.data.bagCount;
              self.bags = response.data.bags;
              self.subtotal = parseFloat(response.data.subtotal.replace(/,/g, ''));
            });

            Event.listen('removePopUp', function (response) {
              self.bagCount = response.data.bagCount;
              self.bags = response.data.bags;
              self.subtotal = parseFloat(response.data.subtotal.replace(/,/g, ''));
            });

            Event.listen('addWishlist', function (response) {
              self.wishlistCount = response.data.wishlistCount;
            });

            Event.fire('user', this.accounts);

            self.errorImagePanel = this.aws_link+'/images/'+this.defaultImage.image_2;
            self.flagImage = this.aws_link+'/images/flag1x1/';

            self.errorImage = this.aws_link+'/images/'+this.defaultImage.image_7;
            self.errorImageSale = this.aws_link+'/images/'+this.defaultImage.image_5;
            self.loadingImage = this.aws_link+'/images/loading-image.gif';
        },

        data() {
            return {
                categories: {},
                designers: {},
                menLink: this.men_link,
                womenLink: this.women_link,
                designerLink: this.designer_link,
                designersNav: {},
                womensNav: {},
                mensNav: {},
                kidsNav: {},
                salesNav: {},
                errorImage: {},
                errorImagePanel: {},
                loadingImage: {},
                errorImageSale: {},
                wishlistCount: {},
                bagCount: {},
                bags: {},
                accounts: {},
                subtotal: {},
                defaultImage: JSON.parse(this.default_image,true),
                trans: JSON.parse(this.locale,true),
                currencyCode: this.currency_code,
                language: this.language,
                exchangeRate: {},
                flagImage:{}
            }
        },
        methods: {
          removeBag: function (sku) {
            var self = this;
            axios.get(this.bag_api, {
              params: {
                remove: sku
              }
            })
            .then(function (response) {
              self.bagCount = response.data.bagCount;
              self.bags = response.data.bags;
              self.subtotal = parseFloat(response.data.subtotal.replace(/,/g, ''));

              Event.fire('removeBag', response);
            })
            .catch(function (error) {
              console.log(error);
            });
          },

          getBag: function () {
            var self = this;
            axios.get(this.bag_api, {
            })
            .then(function (response) {
              self.bagCount = response.data.bagCount;
              self.bags = response.data.bags;
              self.subtotal = parseFloat(response.data.subtotal.replace(/,/g, ''));

              Event.fire('bags', response);
            })
            .catch(function (error) {
              console.log(error);
            });
          },

          getWishlist: function () {
            var self = this;
            var api_token = this.api_token;
            axios.post(this.wishlist_api, {
              api_token: api_token
            })
            .then(function (response) {
              if (typeof response.data.data !== 'undefined') {
                self.wishlistCount = response.data.data.length;
              }
            })
            .catch(function (error) {
              console.log(error);
            });
          },

          getExchange: function () {
            var self = this;
            axios.get(this.exchange_api, {
            })
            .then(function (response) {
              self.exchangeRate = response.data.data;

              Event.fire('exchange', response);
            })
            .catch(function (error) {
              console.log(error);
            });
          },

          goBag: function () {
            window.location.href = this.bag_link;
          }
        },

        computed: {
          filteredBags: function () {
            return typeof this.bags[0] !== 'undefined' ? this.bags.slice(0,2) : {};
          }
        },

        filters: {
          awsLink: function (value, aws) {
            var link = value == null ? '#' : aws+'/'+value;
            return link;
          },

          round: function(value, currency, rate) {
            var value = value / rate;
            var money = function(n, currency) {
              return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
            };

            return money(Number(Math.round(value+'e'+2)+'e-'+2), currency);
          }
        }
    }
</script>
