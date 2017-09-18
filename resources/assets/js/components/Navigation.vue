<script>
    export default {
        props: ['api'],
        created() {
            var self = this;
            var api = this.api;
            $.get(api, function(navigations) {
              if (typeof navigations.data !== 'undefined') {
                if (typeof navigations.data.mens !== 'undefined') {

                    $.each( navigations.data.mens, function( key, value ) {
                      if(value.name == 'Clothing') {
                        self.menCloths = value.child;
                      }
                    });

                }

                if (typeof navigations.data.womens !== 'undefined') {
                    $.each( navigations.data.womens, function( key, value ) {
                      if(value.name == 'Clothing') {
                        self.womenCloths = value.child;
                      }
                    });
                }

                if (typeof navigations.data.kids !== 'undefined') {
                    $.each( navigations.data.kids, function( key, value ) {
                      if(value.name == 'Clothing') {
                        self.kidCloths = value.child;
                      }
                    });
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
                designers: {}
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
              <li>
                  <a href="/landing/women"><h5 class="uk-margin-remove">WOMEN</h5></a>
                  <div class="uk-navbar-dropdown uk-navbar-dropdown-width-5">
                      <div class="uk-navbar-dropdown-grid" uk-grid>
                        <div class="uk-width-1-5@m">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-active">What's New</li>
                                <li class="uk-parent"><a href="#">New Arrival</a></li>
                                <li class="uk-nav-header">Featured Style Story</li>
                                <li><img src="/images/coll-women.jpg" alt=""></li>
                                <li><a href="#" class="uk-text-danger"><b>SEE ALL STYLE STORY</b></a></li>
                            </ul>
                        </div>
                          <div class="uk-width-2-5@m uk-child-width-1-2 uk-margin-remove uk-padding-remove" uk-grid>
                            <div>
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                  <li class="uk-active">Clothing</li>
                                  <li class="uk-parent" v-for="cloth in womenCloths">
                                    <a :href="'/shop/womens/clothing/'+ cloth.slug ">{{ cloth.name }}</a>
                                  </li>
                              </ul>
                            </div>

                            <div>
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                  <li class="uk-active">More Clothing</li>
                                  <li class="uk-parent"><a href="#">Skirts</a></li>
                                  <li class="uk-parent"><a href="#">Shorts</a></li>
                                  <li class="uk-parent"><a href="#">Sport</a></li>
                                  <li class="uk-parent"><a href="#">Swim</a></li>
                                  <li class="uk-parent"><a href="#">Beach Cover-Ups</a></li>
                                  <li class="uk-parent"><a href="#">KuKa In Good Company</a></li>
                                  <li class="uk-parent"><a href="#">Pajamas</a></li>
                                  <li class="uk-parent"><a href="#">Collection</a></li>
                                  <li class="uk-parent"><a href="#">Sweatshirts & Sweatpants</a></li>
                              </ul>
                          </div>
                        </div>
                          <div class="uk-width-1-5@m">
                              <ul class="uk-nav uk-navbar-dropdown-nav">
                                  <li class="uk-active">SHOES & ACCESSORIES</li>
                                  <li class="uk-parent"><a href="#">Shoes</a></li>
                                  <li class="uk-parent"><a href="#">Sunglasses</a></li>
                                  <li class="uk-parent"><a href="#">Jewelry</a></li>
                                  <li class="uk-parent"><a href="#">Bags</a></li>
                                  <li class="uk-parent"><a href="#">Accessories</a></li>
                                  <li class="uk-parent"><a href="#">Socks & Tights</a></li>

                              </ul>
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
              <li><a href="/landing/men"><h5 class="uk-margin-remove">MEN</h5></a>
                <div class="uk-navbar-dropdown uk-navbar-dropdown-width-5">
                    <div class="uk-navbar-dropdown-grid" uk-grid>
                      <div class="uk-width-1-5@m uk-margin-remove uk-padding-remove">
                          <ul class="uk-nav uk-navbar-dropdown-nav">
                              <li class="uk-active">What's New</li>
                              <li class="uk-parent"><a href="#">New Arrival</a></li>
                              <li class="uk-nav-header">Featured Style Story</li>
                              <li><img src="/images/coll-men.jpg" alt=""></li>
                              <li><a href="#" class="uk-text-danger"><b>SEE ALL STYLE STORY</b></a></li>
                          </ul>
                      </div>
                        <div class="uk-width-2-5@m uk-child-width-1-2 uk-margin-remove uk-padding-remove" uk-grid>
                          <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-active">Clothing</li>
                                <li class="uk-parent" v-for="cloth in menCloths">
                                  <a :href="'/shop/mens/clothing/'+ cloth.slug ">{{ cloth.name }}</a>
                                </li>
                            </ul>
                          </div>

                          <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-active">More Clothing</li>
                                <li class="uk-parent"><a href="#">Skirts</a></li>
                                <li class="uk-parent"><a href="#">Shorts</a></li>
                                <li class="uk-parent"><a href="#">Sport</a></li>
                                <li class="uk-parent"><a href="#">Swim</a></li>
                                <li class="uk-parent"><a href="#">Beach Cover-Ups</a></li>
                                <li class="uk-parent"><a href="#">KuKa In Good Company</a></li>
                                <li class="uk-parent"><a href="#">Pajamas</a></li>
                                <li class="uk-parent"><a href="#">Collection</a></li>
                                <li class="uk-parent"><a href="#">Sweatshirts & Sweatpants</a></li>
                            </ul>
                        </div>
                      </div>
                        <div class="uk-width-1-5@m">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-active">SHOES & ACCESSORIES</li>
                                <li class="uk-parent"><a href="#">Shoes</a></li>
                                <li class="uk-parent"><a href="#">Sunglasses</a></li>
                                <li class="uk-parent"><a href="#">Jewelry</a></li>
                                <li class="uk-parent"><a href="#">Bags</a></li>
                                <li class="uk-parent"><a href="#">Accessories</a></li>
                                <li class="uk-parent"><a href="#">Socks & Tights</a></li>

                            </ul>
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
              <li><a href="/landing/kids"><h5 class="uk-margin-remove">KIDS</h5></a>
                <div class="uk-navbar-dropdown uk-navbar-dropdown-width-3">
                    <div class="uk-navbar-dropdown-grid uk-child-width-1-3" uk-grid>
                        <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-active">Clothing</li>
                                <li class="uk-parent" v-for="cloth in kidCloths">
                                  <a :href="'/shop/kids/clothing/'+ cloth.slug ">{{ cloth.name }}</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-active"><a href="#">Active</a></li>
                                <li class="uk-parent"><a href="#">Parent</a></li>
                                <li class="uk-nav-header">Header</li>
                                <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Item</a></li>
                                <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Item</a></li>
                            </ul>
                        </div>
                        <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                    </div>
                </div>
              </li>
              <li><a href="#"><h5 class="uk-margin-remove">DESIGNERS</h5></a>
                <div class="uk-navbar-dropdown uk-navbar-dropdown-width-3">
                    <div class="uk-navbar-dropdown-grid uk-child-width-1-3" uk-grid>
                        <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                              <li class="uk-parent" v-for="design in designers">
                                <a :href="'/shop/designers/'+ design.slug ">{{ design.name }}</a>
                              </li>
                            </ul>
                        </div>
                        <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-active"><a href="#">Active</a></li>
                                <li class="uk-parent"><a href="#">Parent</a></li>
                                <li class="uk-nav-header">Header</li>
                                <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Item</a></li>
                                <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Item</a></li>
                            </ul>
                        </div>
                        <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                    </div>
                </div>
              </li>
              <li><a href="#"><h5 class="uk-margin-remove">HOME</h5></a>
                <div class="uk-navbar-dropdown uk-navbar-dropdown-width-3">
                    <div class="uk-navbar-dropdown-grid uk-child-width-1-3" uk-grid>
                        <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-active"><a href="#">Active</a></li>
                                <li class="uk-parent"><a href="#">Parent</a></li>
                                <li class="uk-nav-header">Header</li>
                                <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Item</a></li>
                                <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Item</a></li>
                            </ul>
                        </div>
                        <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-active"><a href="#">Active</a></li>
                                <li class="uk-parent"><a href="#">Parent</a></li>
                                <li class="uk-nav-header">Header</li>
                                <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Item</a></li>
                                <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Item</a></li>
                            </ul>
                        </div>
                        <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                    </div>
                </div>
              </li>
              <li><a href="#"><h5 class="uk-margin-remove">CULINARRY</h5></a>
                <div class="uk-navbar-dropdown uk-navbar-dropdown-width-3">
                    <div class="uk-navbar-dropdown-grid uk-child-width-1-3" uk-grid>
                        <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-active"><a href="#">Active</a></li>
                                <li class="uk-parent"><a href="#">Parent</a></li>
                                <li class="uk-nav-header">Header</li>
                                <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Item</a></li>
                                <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Item</a></li>
                            </ul>
                        </div>
                        <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-active"><a href="#">Active</a></li>
                                <li class="uk-parent"><a href="#">Parent</a></li>
                                <li class="uk-nav-header">Header</li>
                                <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Item</a></li>
                                <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Item</a></li>
                            </ul>
                        </div>
                        <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                    </div>
                </div>
              </li>
              <li><a href="#"><h5 class="uk-margin-remove">ECO TOURISM</h5></a>
                <div class="uk-navbar-dropdown uk-navbar-dropdown-width-3">
                    <div class="uk-navbar-dropdown-grid uk-child-width-1-3" uk-grid>
                        <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-active"><a href="#">Active</a></li>
                                <li class="uk-parent"><a href="#">Parent</a></li>
                                <li class="uk-nav-header">Header</li>
                                <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Item</a></li>
                                <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Item</a></li>
                            </ul>
                        </div>
                        <div>
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-active"><a href="#">Active</a></li>
                                <li class="uk-parent"><a href="#">Parent</a></li>
                                <li class="uk-nav-header">Header</li>
                                <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Item</a></li>
                                <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Item</a></li>
                            </ul>
                        </div>
                        <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                    </div>
                </div>
              </li>
          </ul>
      </div>
  <!-- </div> -->
    </nav>
</template>
