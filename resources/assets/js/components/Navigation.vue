<template>
    <nav class="uk-container uk-section-default uk-background-default" uk-navbar="dropbar: true; align: center; boundary-align: true; duration:100">
      <div class="uk-navbar-center">

          <ul class="uk-navbar-nav">
              <!--Start Designer-->
              <li>
                  <a :href="designerLink">{{ trans.designers_nav }}</a>
                  <div class="uk-navbar-dropdown" uk-drop="boundary: !nav; delay-show:200; delay-hide:200; boundary-align: true; pos: bottom-justify;">
                      <div class="uk-grid uk-grid-small" uk-grid>
                        <div class="uk-width-3-5@m uk-margin-remove uk-padding-remove-vertical uk-padding-small" uk-grid>
                          <div class="uk-width-1-1">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                              <li><h5 class="uk-margin-small uk-text-uppercase">{{ trans.designers_nav }}</h5></li>
                            </ul>
                            <ul class="uk-nav uk-navbar-dropdown-nav uk-column-1-2 uk-width-1-2">
                                <li class="uk-parent uk-active">
                                    <a href="/shop?menu=designers&category=all">{{ trans.all }} </a>
                                </li>
                              <li class="uk-parent" v-for="design in designers">
                                  <a :href="'/shop?menu=designers&category='+ design.slug ">{{ design.name }}</a>
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
                                                  image-style="height: 400px; width:400px">
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
              <li>
                  <a :href="womenLink">{{ trans.women_nav }}</a>
                  <div class="uk-navbar-dropdown" uk-drop="boundary: !nav; delay-show:200; delay-hide:200; boundary-align: true; pos: bottom-justify;">
                      <div class="uk-grid uk-grid-small" uk-grid>
                        <div class="uk-width-3-5@m uk-margin-remove uk-padding-remove-vertical uk-padding-small" uk-grid>
                            <div class="uk-width-1-3">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li ><h5 class="uk-margin-small uk-text-uppercase">{{ trans.clothing }}</h5></li>
                              </ul>
                              <ul class="uk-nav uk-navbar-dropdown-nav uk-column-1-1">
                                <li class="uk-parent uk-active">
                                  <a href="/shop?menu=womens&parent=clothing&category=all">{{ trans.all }}</a>
                                </li>
                                <li class="uk-parent" v-for="cat in categories.clothing">
                                    <a :href="'/shop?menu=womens&parent=clothing&category='+ cat.slug ">{{ cat.name }}</a>
                                </li>
                              </ul>
                            </div>
                            <div class="uk-width-1-3">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li><h5 class="uk-margin-small uk-text-uppercase">{{ trans.accessories }}</h5></li>
                              </ul>
                              <ul class="uk-nav uk-navbar-dropdown-nav uk-column-1-1">
                                <li class="uk-parent uk-active">
                                  <a href="/shop?menu=womens&parent=accessories&category=all">{{ trans.all }}</a>
                                </li>
                                <li class="uk-parent" v-for="cat in categories.accessories">
                                    <a :href="'/shop?menu=womens&parent=accessories&category='+ cat.slug ">{{ cat.name }}</a>
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
                                                  image-style="height: 400px; width:400px">
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
              <li>
                <a :href="menLink">{{ trans.men_nav }}</a>
                <div class="uk-navbar-dropdown" uk-drop="boundary: !nav; delay-show:200; delay-hide:200; boundary-align: true; pos: bottom-justify;">
                    <div class="uk-grid uk-grid-small" uk-grid>
                        <div class="uk-width-3-5@m uk-margin-remove uk-padding-remove-vertical uk-padding-small" uk-grid>
                            <div class="uk-width-1-3">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li><h5 class="uk-margin-small uk-text-uppercase">{{ trans.clothing }}</h5></li>
                              </ul>
                              <ul class="uk-nav uk-navbar-dropdown-nav uk-column-1-1">
                                <li class="uk-parent uk-active">
                                  <a href="/shop?menu=mens&parent=clothing&category=all">{{ trans.all }}</a>
                                </li>
                                <li class="uk-parent" v-for="cat in categories.clothing">
                                    <a :href="'/shop?menu=mens&parent=clothing&category='+ cat.slug ">{{ cat.name }}</a>
                                </li>
                              </ul>
                            </div>
                            <div class="uk-width-1-3">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li><h5 class="uk-margin-small uk-text-uppercase">{{ trans.accessories }}</h5></li>
                              </ul>
                              <ul class="uk-nav uk-navbar-dropdown-nav uk-column-1-1">
                                <li class="uk-parent uk-active">
                                  <a href="/shop?menu=mens&parent=accessories&category=all">{{ trans.all }}</a>
                                </li>
                                <li class="uk-parent" v-for="cat in categories.accessories">
                                    <a :href="'/shop?menu=mens&parent=accessories&category='+ cat.slug ">{{ cat.name }}</a>
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
                                                image-style="height: 400px; width:400px">
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
              <li>
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
              <li>
                  <a href="/editorial">{{ trans.blog_nav }}</a>
              </li>
              <!--End Editorial-->

          </ul>
      </div>
    </nav>
</template>

<script>
    import axios from 'axios';
    import VueLazyBackgroundImage from '../components/VueLazyBackgroundImage.vue';

    export default {
        props: [
          'api',
          'men_link',
          'women_link',
          'kid_link',
          'designer_link',
          'aws_link',
          'default_image',
          'locale',
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
                  })).slice(0,27);
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
                kidLink: this.kid_link,
                designerLink: this.designer_link,
                designersNav: {},
                womensNav: {},
                mensNav: {},
                kidsNav: {},
                salesNav: {},
                defaultImage: JSON.parse(this.default_image,true),
                trans: JSON.parse(this.locale,true),
                errorImage: {},
                loadingImage: {},
                errorImageSale: {},
            }
        },

        filters: {
          awsLink: function (value, aws) {
            var link = value == null ? '#' : aws+'/'+value;
            return link;
          }
        }
    }
</script>
