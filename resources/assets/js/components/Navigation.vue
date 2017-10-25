<script>
    export default {
        props: ['api', 'men_link', 'women_link', 'kid_link'],
        created() {
            var self = this;
            var api = this.api;
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
                   self.designers = navigations.data.designers;
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
            }
        }
    }
</script>

<template>
    <nav class="uk-container uk-container-small uk-section-default" uk-navbar="dropbar: true; align: center; boundary-align: true; delay-hide: 100; duration:50">
  <!-- <div uk-navbar> -->
      <div class="uk-navbar-center">

          <!-- <a class="uk-navbar-item uk-logo" href="#"><img src="images/logo.png" alt="" width="60"></a> -->

          <ul class="uk-navbar-nav">
              <li><a href="#"><h5 class="uk-margin-remove">DESIGNERS</h5></a>
                <div class="uk-navbar-dropdown uk-navbar-dropdown-width-5">
                    <div class="uk-navbar-dropdown-grid" uk-grid>
                      <div class="uk-width-1-5@m">
                          <ul class="uk-nav uk-navbar-dropdown-nav">
                              <li class="uk-active">What's New</li>
                              <li class="uk-parent"><a href="#">New Arrival</a></li>
                              <li class="uk-nav-header">Featured Style Story</li>
                              <li><img src="images/coll-women.jpg" alt=""></li>
                              <li><a href="#" class="uk-text-danger"><b>SEE ALL STYLE STORY</b></a></li>
                          </ul>
                      </div>
                        <div class="uk-width-3-5@m uk-margin-remove uk-padding-remove-vertical uk-padding-small" uk-grid>
                          <div>
                            <ul class="uk-list uk-column-1-3">
                              <li class="uk-parent" v-for="design in designers">
                                  <a :href="'/shop/designers/'+ design.slug ">{{ design.name }}</a>
                              </li>
                            </ul>
                          </div>
                      </div>

                        <div class="uk-width-1-5@m uk-margin-remove">
                          <ul class="uk-nav uk-navbar-dropdown-nav">
                              <li class="uk-active">SPECIAL SIZE</li>
                              <li class="uk-parent"><a href="#">Petite</a></li>
                              <li class="uk-parent"><a href="#">Tall</a></li>
                              <li class="uk-parent"><a href="#">Size 16</a></li>
                              <li class="uk-nav-header">Our Shops</li>
                              <li class="uk-parent"><a href="#">Mother's Day Shop</a></li>
                              <li class="uk-parent"><a href="#">Ready-To-Party Collection</a></li>
                              <li class="uk-parent"><a href="#">Wear-To-Work Shop</a></li>
                              <li class="uk-parent"><a href="#">Garments For Good</a></li>
                              <li class="uk-parent"><a href="#">Vacation Shop</a></li>
                              <li class="uk-parent"><a href="#" class="uk-text-danger"><b>VISIT OUR SALE</b></a></li>
                          </ul>
                        </div>
                    </div>
                </div>
              </li>
              <li>
                  <a :href="womenLink"><h5 class="uk-margin-remove">WOMEN</h5></a>
                  <div class="uk-navbar-dropdown uk-navbar-dropdown-width-5">
                      <div class="uk-navbar-dropdown-grid" uk-grid>
                        <div class="uk-width-1-5@m">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-active">What's New</li>
                                <li class="uk-parent"><a href="#">New Arrival</a></li>
                                <li class="uk-nav-header">Featured Style Story</li>
                                <li><img src="images/coll-women.jpg" alt=""></li>
                                <li><a href="#" class="uk-text-danger"><b>SEE ALL STYLE STORY</b></a></li>
                            </ul>
                        </div>
                          <div class="uk-width-3-5@m uk-margin-remove uk-padding-remove-vertical uk-padding-small" uk-grid>
                            <div class="uk-width-2-3">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li v-for="cloth in womenCloths" v-if="cloth.name.toLowerCase() == 'clothing'">{{ cloth.name.toUpperCase() }}</li>
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
                                <li v-for="cloth in womenCloths" v-if="cloth.name.toLowerCase() == 'shoes & accessories'">{{ cloth.name.toUpperCase() }}</li>
                              </ul>
                              <hr class="uk-margin-small">
                              <ul class="uk-nav uk-navbar-dropdown-nav" v-for="cloth in womenCloths" v-if="cloth.name.toLowerCase() == 'shoes & accessories'">
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
                                <li class="uk-active">SPECIAL SIZE</li>
                                <li class="uk-parent"><a href="#">Petite</a></li>
                                <li class="uk-parent"><a href="#">Tall</a></li>
                                <li class="uk-parent"><a href="#">Size 16</a></li>
                                <li class="uk-nav-header">Our Shops</li>
                                <li class="uk-parent"><a href="#">Mother's Day Shop</a></li>
                                <li class="uk-parent"><a href="#">Ready-To-Party Collection</a></li>
                                <li class="uk-parent"><a href="#">Wear-To-Work Shop</a></li>
                                <li class="uk-parent"><a href="#">Garments For Good</a></li>
                                <li class="uk-parent"><a href="#">Vacation Shop</a></li>
                                <li class="uk-parent"><a href="#" class="uk-text-danger"><b>VISIT OUR SALE</b></a></li>
                            </ul>
                          </div>
                      </div>
                  </div>
              </li>
              <li><a :href="menLink"><h5 class="uk-margin-remove">MEN</h5></a>
                <div class="uk-navbar-dropdown uk-navbar-dropdown-width-5">
                    <div class="uk-navbar-dropdown-grid" uk-grid>
                      <div class="uk-width-1-5@m">
                          <ul class="uk-nav uk-navbar-dropdown-nav">
                              <li class="uk-active">What's New</li>
                              <li class="uk-parent"><a href="#">New Arrival</a></li>
                              <li class="uk-nav-header">Featured Style Story</li>
                              <li><img src="images/coll-women.jpg" alt=""></li>
                              <li><a href="#" class="uk-text-danger"><b>SEE ALL STYLE STORY</b></a></li>
                          </ul>
                      </div>

                        <div class="uk-width-3-5@m uk-margin-remove uk-padding-remove-vertical uk-padding-small" uk-grid>
                            <div class="uk-width-2-3">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li v-for="cloth in menCloths" v-if="cloth.name.toLowerCase() == 'clothing'">{{ cloth.name.toUpperCase() }}</li>
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
                                <li v-for="cloth in menCloths" v-if="cloth.name.toLowerCase() == 'shoes & accessories'">{{ cloth.name.toUpperCase() }}</li>
                              </ul>
                              <hr class="uk-margin-small">
                              <ul class="uk-nav uk-navbar-dropdown-nav" v-for="cloth in menCloths" v-if="cloth.name.toLowerCase() == 'shoes & accessories'">
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
                              <li class="uk-active">SPECIAL SIZE</li>
                              <li class="uk-parent"><a href="#">Petite</a></li>
                              <li class="uk-parent"><a href="#">Tall</a></li>
                              <li class="uk-parent"><a href="#">Size 16</a></li>
                              <li class="uk-nav-header">Our Shops</li>
                              <li class="uk-parent"><a href="#">Mother's Day Shop</a></li>
                              <li class="uk-parent"><a href="#">Ready-To-Party Collection</a></li>
                              <li class="uk-parent"><a href="#">Wear-To-Work Shop</a></li>
                              <li class="uk-parent"><a href="#">Garments For Good</a></li>
                              <li class="uk-parent"><a href="#">Vacation Shop</a></li>
                              <li class="uk-parent"><a href="#" class="uk-text-danger"><b>VISIT OUR SALE</b></a></li>
                          </ul>
                        </div>
                    </div>
                </div>
              </li>
              <li><a :href="kidLink"><h5 class="uk-margin-remove">KIDS</h5></a>
                <div class="uk-navbar-dropdown uk-navbar-dropdown-width-5">
                    <div class="uk-navbar-dropdown-grid" uk-grid>
                      <div class="uk-width-1-5@m">
                          <ul class="uk-nav uk-navbar-dropdown-nav">
                              <li class="uk-active">What's New</li>
                              <li class="uk-parent"><a href="#">New Arrival</a></li>
                              <li class="uk-nav-header">Featured Style Story</li>
                              <li><img src="images/coll-women.jpg" alt=""></li>
                              <li><a href="#" class="uk-text-danger"><b>SEE ALL STYLE STORY</b></a></li>
                          </ul>
                      </div>

                        <div class="uk-width-3-5@m uk-margin-remove uk-padding-remove-vertical uk-padding-small" uk-grid>
                            <div class="uk-width-2-3">
                              <span v-for="cloth in kidCloths" v-if="cloth.name.toLowerCase() == 'clothing'">{{ cloth.name }}</span>
                              <hr class="uk-padding-remove">
                              <ul class="uk-list uk-column-1-2" v-for="cloth in kidCloths" v-if="cloth.name.toLowerCase() == 'clothing'">
                                <li class="uk-parent uk-active">
                                  <a href="/shop/kids/all">All</a>
                                </li>
                                <li class="uk-parent" v-for="cat in cloth.child">
                                    <a :href="'/shop/kids/'+cloth.name.toLowerCase()+'/'+ cat.slug ">{{ cat.name }}</a>
                                </li>
                              </ul>
                            </div>
                            <div class="uk-width-1-3">

                            </div>
                        </div>

                        <div class="uk-width-1-5@m uk-margin-remove">
                          <ul class="uk-nav uk-navbar-dropdown-nav">
                              <li class="uk-active">SPECIAL SIZE</li>
                              <li class="uk-parent"><a href="#">Petite</a></li>
                              <li class="uk-parent"><a href="#">Tall</a></li>
                              <li class="uk-parent"><a href="#">Size 16</a></li>
                              <li class="uk-nav-header">Our Shops</li>
                              <li class="uk-parent"><a href="#">Mother's Day Shop</a></li>
                              <li class="uk-parent"><a href="#">Ready-To-Party Collection</a></li>
                              <li class="uk-parent"><a href="#">Wear-To-Work Shop</a></li>
                              <li class="uk-parent"><a href="#">Garments For Good</a></li>
                              <li class="uk-parent"><a href="#">Vacation Shop</a></li>
                              <li class="uk-parent"><a href="#" class="uk-text-danger"><b>VISIT OUR SALE</b></a></li>
                          </ul>
                        </div>
                    </div>
                </div>
              </li>
              <li><a href="#"><h5 class="uk-margin-remove">ECO TRAVEL</h5></a>
              </li>
              <li><a href="#"><h5 class="uk-margin-remove">SALE</h5></a>
              </li>
              <li><a href="#"><h5 class="uk-margin-remove">BLOG</h5></a>
              </li>
          </ul>
      </div>
  <!-- </div> -->
    </nav>
</template>
