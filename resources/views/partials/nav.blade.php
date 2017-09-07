<div class="uk-section-xsmall uk-box-shadow-medium uk-margin-remove uk-padding-remove" uk-sticky="bottom: #hash; animation: uk-animation-slide-top;" id="menu">
    <div class="uk-section uk-section-default uk-section-xsmall uk-padding-small">
        <div class="uk-container uk-container-small">
          <div class="uk-grid-small uk-grid-divider" uk-grid>
              <div class="uk-width-1-5@m">
                <div class="uk-panel">
                  <form class="uk-search uk-search-default">
                      <span class="uk-search-icon-flip" uk-search-icon></span>
                      <input class="uk-search-input" type="search" placeholder="Search">
                  </form>
                </div>
              </div>
              <div class="uk-width-3-5@m">
                <div class="uk-panel uk-text-center">
                  <h2><b>KUKA</b> INDONESIA</h2>
                </div>
              </div>
              <div class="uk-width-1-5@m">
                <ul class="uk-grid-small uk-flex-middle" uk-grid>
                  <li><a class="uk-icon-button" uk-icon="icon: user"></a></li>
                  <li><a class="uk-icon-button" uk-icon="icon: heart"></a></li>
                  <li><a class="uk-icon-button" uk-icon="icon: cart" href="bag.html"></a></li>

                </ul>

              </div>
          </div>

        </div>
    </div>
    <nav class="uk-container uk-container-small uk-section-default" uk-navbar="dropbar: true; align: center; boundary-align: true; delay-hide: 100; duration:50">
            <!-- <div uk-navbar> -->
                <div class="uk-navbar-center">

                    <!-- <a class="uk-navbar-item uk-logo" href="#"><img src="images/logo.png" alt="" width="60"></a> -->

                    <ul class="uk-navbar-nav">
                        <li>
                            <a href="#"><h5 class="uk-margin-remove">WOMEN</h5></a>
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
                                          <li class="uk-parent" v-for="women in womens">
                                            <a href="/shop/women/@{{ women.slug }}">@{{ women.name }}</a>
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
                        <li><a href="#"><h5 class="uk-margin-remove">MEN</h5></a>
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
                                            <li class="uk-parent" v-for="men in mens">
                                              <a href="/shop/men/@{{ men.slug }}">@{{ men.name }}</a>
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
                        <li><a href="#"><h5 class="uk-margin-remove">KIDS</h5></a>
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
                        <li><a href="#"><h5 class="uk-margin-remove">DESIGNERS</h5></a>
                          <div class="uk-navbar-dropdown uk-navbar-dropdown-width-3">
                              <div class="uk-navbar-dropdown-grid uk-child-width-1-3" uk-grid>
                                  <div>
                                      <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <li class="uk-parent" v-for="designer in designers">
                                          <a href="/shop/designer/@{{ designer.slug }}">@{{ designer.name }}</a>
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

  </div>