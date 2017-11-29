<script>
    export default {
        props: ['api', 'men_link', 'women_link', 'kid_link'],
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

                if (typeof navigations.data.designers_nav !== 'undefined') {
                   self.designersNav = navigations.data.designers_nav;
                }

                if (typeof navigations.data.womens_nav !== 'undefined') {
                   self.womensNav = navigations.data.womens_nav;
                }

                if (typeof navigations.data.mens_nav !== 'undefined') {
                  self.mensNav = navigations.data.mens_nav;
                }

                if (typeof navigations.data.kids_nav !== 'undefined') {
                  self.kidsNav = navigations.data.kids_nav;
                }

                if (typeof navigations.data.sales_nav !== 'undefined') {
                  self.salesNav = navigations.data.sales_nav;
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
                designersNav: {},
                womensNav: {},
                mensNav: {},
                kidsNav: {},
                salesNav: {},
            }
        }
    }
</script>

<template>
    <nav class="uk-container uk-container-small uk-section-default uk-background-default" uk-navbar="dropbar: true; align: center; boundary-align: true; delay-hide: 100; duration:50">
  <!-- <div uk-navbar> -->
      <div class="uk-navbar-center">

          <!-- <a class="uk-navbar-item uk-logo" href="#"><img src="images/logo.png" alt="" width="60"></a> -->

          <ul class="uk-navbar-nav">
              <li><a href="/shop/designers/all">DESIGNERS</a>
                <div class="uk-navbar-dropdown uk-navbar-dropdown-width-5">
                    <div class="uk-navbar-dropdown-grid" uk-grid>
                        <div class="uk-width-3-5@m uk-margin-remove uk-padding-remove-vertical uk-padding-small" uk-grid>
                          <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                              <li class="uk-text-bold">DESIGNERS</li>
                            </ul>
                            <hr class="uk-margin-small">
                            <ul class="uk-nav uk-navbar-dropdown-nav uk-column-1-3">
                                <li class="uk-parent uk-active">
                                    <a href="/shop/designers/all">All</a>
                                </li>
                              <li class="uk-parent" v-for="design in designers">
                                  <a :href="'/shop/designers/'+ design.slug ">{{ design.name }}</a>
                              </li>
                            </ul>
                          </div>
                      </div>
                        <div class="uk-width-2-5@m uk-margin-remove">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-text-bold">{{designersNav.designer_designer_of_the_week_text}}</li>
                            </ul>
                            <hr class="uk-margin-small">
                            <a :href="designersNav.designer_designer_of_the_week_url">
                              <img v-if="designersNav.designer_of_the_week != null" style="height: 150px" :src="'/'+designersNav.designer_of_the_week" :alt="designersNav.designer_designer_of_the_week_text">
                            </a>
                        </div>
                    </div>
                </div>
              </li>
              <li>
                  <a :href="womenLink">WOMEN</a>
                  <div class="uk-navbar-dropdown uk-navbar-dropdown-width-5">
                      <div class="uk-navbar-dropdown-grid" uk-grid>
                        <div class="uk-width-1-5@m">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-nav-header uk-text-bold">What's New</li>
                                <li class="uk-parent"><a href="/landing/women">New Arrival</a></li>
                                <li class="uk-nav-header uk-text-bold">Featured Style Story</li>
                                <li>
                                    <a :href="womensNav.women_blog_url">
                                        <img v-if="womensNav.women_blog_image != null" style="height: 150px" :src="'/'+womensNav.women_blog_image" :alt="Rukuka">
                                    </a>
                                </li>
                                <li><a href="/blog" class="uk-text-danger"><b>SEE ALL STYLE STORY</b></a></li>
                            </ul>
                        </div>
                          <div class="uk-width-3-5@m uk-margin-remove uk-padding-remove-vertical uk-padding-small" uk-grid>
                            <div class="uk-width-2-3">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li v-for="cloth in womenCloths" v-if="cloth.name.toLowerCase() == 'clothing'" class="uk-text-bold" >{{ cloth.name.toUpperCase() }}</li>
                              </ul>
                              <hr class="uk-margin-small">
                              <ul class="uk-nav uk-navbar-dropdown-nav uk-column-1-2" v-for="cloth in womenCloths" v-if="cloth.name.toLowerCase() == 'clothing'">
                                <li class="uk-parent uk-active">
                                  <a href="/shop/womens/all">All</a>
                                </li>
                                <li class="uk-parent" v-for="cat in cloth.child">
                                    <a :href="'/shop/womens/'+cloth.name.toLowerCase()+'/'+ cat.slug ">{{ cat.name }}</a>
                                </li>
                              </ul>
                            </div>
                            <div class="uk-width-1-3">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li v-for="cloth in womenCloths" v-if="cloth.name.toLowerCase() == 'accessories'" class="uk-text-bold">{{ cloth.name.toUpperCase() }}</li>
                              </ul>
                              <hr class="uk-margin-small">
                              <ul class="uk-nav uk-navbar-dropdown-nav" v-for="cloth in womenCloths" v-if="cloth.name.toLowerCase() == 'accessories'">
                                <li class="uk-parent uk-active">
                                  <a href="/shop/womens/all">All</a>
                                </li>
                                <li class="uk-parent" v-for="cat in cloth.child">
                                    <a :href="'/shop/womens/'+cloth.name.toLowerCase()+'/'+ cat.slug ">{{ cat.name }}</a>
                                </li>
                              </ul>
                            </div>
                          </div>

                          <div class="uk-width-1-5@m uk-margin-remove">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-nav-header uk-text-bold">Our Designers</li>
                                <li class="uk-parent"><a :href="womensNav.women_designer_1_url" >{{womensNav.women_designer_1_text}}</a></li>
                                <li class="uk-parent"><a :href="womensNav.women_designer_2_url" >{{womensNav.women_designer_2_text}}</a></li>
                                <li class="uk-parent"><a :href="womensNav.women_designer_3_url" >{{womensNav.women_designer_3_text}}</a></li>
                                <li class="uk-parent"><a :href="womensNav.women_designer_4_url" >{{womensNav.women_designer_4_text}}</a></li>
                                <li class="uk-parent"><a :href="womensNav.women_designer_5_url" >{{womensNav.women_designer_5_text}}</a></li>
                                <li class="uk-parent"><a href="/shop/womens/sale" class="uk-text-danger"><b>ALL WOMEN'S SALE</b></a></li>
                            </ul>
                          </div>
                      </div>
                  </div>
              </li>
              <li><a :href="menLink">MEN</a>
                <div class="uk-navbar-dropdown uk-navbar-dropdown-width-5">
                    <div class="uk-navbar-dropdown-grid" uk-grid>
                      <div class="uk-width-1-5@m">
                          <ul class="uk-nav uk-navbar-dropdown-nav">
                              <li class="uk-nav-header uk-text-bold">What's New</li>
                              <li class="uk-parent"><a href="/landing/men">New Arrival</a></li>
                              <li class="uk-nav-header uk-text-bold">Featured Style Story</li>
                              <li>
                                  <a :href="mensNav.men_blog_url">
                                      <img v-if="mensNav.men_blog_image != null" style="height: 150px" :src="'/'+mensNav.men_blog_image" :alt="Rukuka">
                                  </a>
                              </li>
                              <li><a href="/blog" class="uk-text-danger"><b>SEE ALL STYLE STORY</b></a></li>
                          </ul>
                      </div>

                        <div class="uk-width-3-5@m uk-margin-remove uk-padding-remove-vertical uk-padding-small" uk-grid>
                            <div class="uk-width-2-3">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li v-for="cloth in menCloths" v-if="cloth.name.toLowerCase() == 'clothing'" class="uk-text-bold">{{ cloth.name.toUpperCase() }}</li>
                              </ul>
                              <hr class="uk-margin-small">
                              <ul class="uk-nav uk-navbar-dropdown-nav uk-column-1-2" v-for="cloth in menCloths" v-if="cloth.name.toLowerCase() == 'clothing'">
                                <li class="uk-parent uk-active">
                                  <a href="/shop/mens/all">All</a>
                                </li>
                                <li class="uk-parent" v-for="cat in cloth.child">
                                    <a :href="'/shop/mens/'+cloth.name.toLowerCase()+'/'+ cat.slug ">{{ cat.name }}</a>
                                </li>
                              </ul>
                            </div>
                            <div class="uk-width-1-3">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li v-for="cloth in menCloths" v-if="cloth.name.toLowerCase() == 'accessories'" class="uk-text-bold">{{ cloth.name.toUpperCase() }}</li>
                              </ul>
                              <hr class="uk-margin-small">
                              <ul class="uk-nav uk-navbar-dropdown-nav" v-for="cloth in menCloths" v-if="cloth.name.toLowerCase() == 'accessories'">
                                <li class="uk-parent uk-active">
                                  <a href="/shop/mens/all">All</a>
                                </li>
                                <li class="uk-parent" v-for="cat in cloth.child">
                                    <a :href="'/shop/mens/'+cloth.name.toLowerCase()+'/'+ cat.slug ">{{ cat.name }}</a>
                                </li>
                              </ul>
                            </div>
                          </div>

                        <div class="uk-width-1-5@m uk-margin-remove">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-nav-header uk-text-bold">Our Designers</li>
                                <li class="uk-parent"><a :href="mensNav.men_designer_1_url" >{{mensNav.men_designer_1_text}}</a></li>
                                <li class="uk-parent"><a :href="mensNav.men_designer_2_url" >{{mensNav.men_designer_2_text}}</a></li>
                                <li class="uk-parent"><a :href="mensNav.men_designer_3_url" >{{mensNav.men_designer_3_text}}</a></li>
                                <li class="uk-parent"><a :href="mensNav.men_designer_4_url" >{{mensNav.men_designer_4_text}}</a></li>
                                <li class="uk-parent"><a :href="mensNav.men_designer_5_url" >{{mensNav.men_designer_5_text}}</a></li>
                                <li class="uk-parent"><a href="/shop/mens/sale" class="uk-text-danger"><b>ALL MEN'S SALE</b></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
              </li>
              <li><a :href="kidLink">KIDS</a>
                  <div class="uk-navbar-dropdown uk-navbar-dropdown-width-5">
                      <div class="uk-navbar-dropdown-grid" uk-grid>
                          <div class="uk-width-1-5@m">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                  <li class="uk-nav-header uk-text-bold">What's New</li>
                                  <li class="uk-parent"><a href="/landing/kids">New Arrival</a></li>
                                  <li class="uk-nav-header uk-text-bold">Featured Style Story</li>
                                  <li>
                                      <a :href="kidsNav.kid_blog_url">
                                          <img v-if="kidsNav.kid_blog_image != null" style="height: 150px" :src="'/'+kidsNav.kid_blog_image" :alt="Rukuka">
                                      </a>
                                  </li>
                                  <li><a href="/blog" class="uk-text-danger"><b>SEE ALL STYLE STORY</b></a></li>
                              </ul>
                          </div>

                          <div class="uk-width-3-5@m uk-margin-remove uk-padding-remove-vertical uk-padding-small" uk-grid>
                              <div class="uk-width-2-3">
                                  <ul class="uk-nav uk-navbar-dropdown-nav">
                                      <li v-for="cloth in kidCloths" v-if="cloth.name.toLowerCase() == 'clothing'" class="uk-text-bold">{{ cloth.name.toUpperCase() }}</li>
                                  </ul>
                                  <hr class="uk-margin-small">
                                  <ul class="uk-nav uk-navbar-dropdown-nav uk-column-1-2" v-for="cloth in kidCloths" v-if="cloth.name.toLowerCase() == 'clothing'">
                                      <li class="uk-parent uk-active">
                                          <a href="/shop/kids/all">All</a>
                                      </li>
                                      <li class="uk-parent" v-for="cat in cloth.child">
                                          <a :href="'/shop/kids/'+cloth.name.toLowerCase()+'/'+ cat.slug ">{{ cat.name }}</a>
                                      </li>
                                  </ul>
                              </div>
                              <div class="uk-width-1-3">
                                  <ul class="uk-nav uk-navbar-dropdown-nav">
                                      <li v-for="cloth in kidCloths" v-if="cloth.name.toLowerCase() == 'accessories'" class="uk-text-bold">{{ cloth.name.toUpperCase() }}</li>
                                  </ul>
                                  <hr class="uk-margin-small">
                                  <ul class="uk-nav uk-navbar-dropdown-nav" v-for="cloth in kidCloths" v-if="cloth.name.toLowerCase() == 'accessories'">
                                      <li class="uk-parent uk-active">
                                          <a href="/shop/kids/all">All</a>
                                      </li>
                                      <li class="uk-parent" v-for="cat in cloth.child">
                                          <a :href="'/shop/kids/'+cloth.name.toLowerCase()+'/'+ cat.slug ">{{ cat.name }}</a>
                                      </li>
                                  </ul>
                              </div>
                          </div>

                          <div class="uk-width-1-5@m uk-margin-remove">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                  <li class="uk-nav-header uk-text-bold">Our Designers</li>
                                  <li class="uk-parent"><a :href="kidsNav.kid_designer_1_url" >{{kidsNav.kid_designer_1_text}}</a></li>
                                  <li class="uk-parent"><a :href="kidsNav.kid_designer_2_url" >{{kidsNav.kid_designer_2_text}}</a></li>
                                  <li class="uk-parent"><a :href="kidsNav.kid_designer_3_url" >{{kidsNav.kid_designer_3_text}}</a></li>
                                  <li class="uk-parent"><a :href="kidsNav.kid_designer_4_url" >{{kidsNav.kid_designer_4_text}}</a></li>
                                  <li class="uk-parent"><a :href="kidsNav.kid_designer_5_url" >{{kidsNav.kid_designer_5_text}}</a></li>
                                  <li class="uk-parent"><a href="/shop/kids/sale" class="uk-text-danger"><b>ALL KID'S SALE</b></a></li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </li>
              </li>
              <li><a href="">SALE</a>
                  <div class="uk-navbar-dropdown uk-navbar-dropdown-width-5">
                      <div class="uk-navbar-dropdown-grid" uk-grid>
                          <div class="uk-width-4-5@m uk-margin-remove">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                  <li class="uk-text-bold">{{salesNav.sale_text}}</li>
                              </ul>
                              <hr class="uk-margin-small">
                              <a :href="salesNav.sale_url">
                                  <img v-if="salesNav.sale_image != null" style="height: 100px; width: 800px" :src="'/'+salesNav.sale_image" :alt="salesNav.sale_text">
                              </a>
                          </div>
                          <div class="uk-width-1-5@m uk-margin-remove uk-padding-remove-vertical uk-padding-small" uk-grid>
                              <div>
                                  <ul class="uk-nav uk-navbar-dropdown-nav">
                                      <li class="uk-text-bold">ON SALE</li>
                                  </ul>
                                  <hr class="uk-margin-small">

                                  <ul class="uk-nav uk-navbar-dropdown-nav">
                                      <li>
                                          <a href="/shop/womens/sale">Womens</a>
                                          <a href="/shop/mens/sale">Mens</a>
                                          <a href="/shop/kids/sale">Kids</a>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
              </li>
              <li><a href="/blog">BLOG</a>
              </li>
          </ul>
      </div>
  <!-- </div> -->
    </nav>
</template>
