<script>
    export default {
        props: ['api'],
        created() {
            var self = this;
            var api = this.api;
            $.get(api, function(products) {
                if (products.data !== 'undefined') {
                    self.products = products.data;
                }
              });
        },

        data() {
            return {
                products: {}
            }
        }
    }
</script>

<template>
    <div class="uk-grid-small uk-child-width-1-4@m uk-margin-large-bottom" uk-grid>
        <!-- start product -->
        <div class="uk-panel uk-text-left" v-for="product in products">
          <div class="uk-card uk-card-small uk-padding-remove">
              <div class="uk-card-media-top uk-inline-clip uk-transition-toggle">
                <a :href="'/product/'+ product.slug">
                <img :src="'/'+ product.photo" :alt="product.name">
              </a>
                <div class="uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-default">
                  <div class="uk-text-center">
                    <a href="#modal-overflow" class="uk-button uk-button-small uk-button-secondary" uk-toggle>QUICK SHOP</a>
                  </div>
                </div>
                <div id="modal-overflow" class="uk-modal-container-small" uk-modal="center: true">
            <div class="uk-modal-dialog">

                <button class="uk-modal-close-default" type="button" uk-close></button>

                <div class="uk-modal-header">
                    <h3 class="uk-margin-remove">Keiro Cullotes Linen</h3>
                    <span>USD 345</span>
                </div>

                <div class="uk-modal-body" uk-overflow-auto>
                  <div class="uk-grid" uk-grid>
                    <div class="uk-width-1-2@m">
                      <div class="uk-inline">
                        <div class="">
                        <ul class="uk-switcher uk-margin" id="component-tab-left">
                          <li>
                            <img src="/images/1-sq.jpg" alt="">
                            <div class="uk-position uk-position-small uk-position-center-left">
                              <a href="#" class="uk-icon uk-icon-button" uk-switcher-item="previous" uk-icon="icon: chevron-left"></a>
                            </div>
                            <div class="uk-position uk-position-small uk-position-center-right">
                              <a href="#" class="uk-icon uk-icon-button" uk-switcher-item="next" uk-icon="icon: chevron-right"></a>
                            </div>
                          </li>
                          <li>
                            <img src="/images/2-sq.jpg" alt="">
                            <div class="uk-position uk-position-small uk-position-center-left">
                              <a href="#" class="uk-icon uk-icon-button" uk-switcher-item="previous" uk-icon="icon: chevron-left"></a>
                            </div>
                            <div class="uk-position uk-position-small uk-position-center-right">
                              <a href="#" class="uk-icon uk-icon-button" uk-switcher-item="next" uk-icon="icon: chevron-right"></a>
                            </div>
                          </li>
                          <li>
                            <img src="/images/3-sq.jpg" alt="">
                            <div class="uk-position uk-position-small uk-position-center-left">
                              <a href="#" class="uk-icon uk-icon-button" uk-switcher-item="previous" uk-icon="icon: chevron-left"></a>
                            </div>
                            <div class="uk-position uk-position-small uk-position-center-right">
                              <a href="#" class="uk-icon uk-icon-button" uk-switcher-item="next" uk-icon="icon: chevron-right"></a>
                            </div>
                          </li>
                        </ul>
                        </div>
                        <div class="">
                        <ul class="uk-grid-small uk-flex-middle uk-flex-center uk-margin-remove uk-padding-remove" uk-switcher="connect: #component-tab-left; animation: uk-animation-fade" uk-grid>
                          <li class="uk-padding-remove"><a href="#"  class="uk-padding-remove"><img src="/images/1-sq.jpg" width="55"></a></li>
                          <li class="uk-padding-remove"><a href="#"  class="uk-padding-remove"><img src="/images/2-sq.jpg" width="55"></a></li>
                          <li class="uk-padding-remove"><a href="#"  class="uk-padding-remove"><img src="/images/3-sq.jpg" width="55"></a></li>
                        </ul>
                      </div>
                      </div>
                    </div>
                    <div class="uk-width-1-2@m">
                      <div class="uk-grid uk-child-width-1-2">
                        <div>
                            <b>Color :</b> Grey
                        </div>
                        <div>
                          <div uk-form-custom="target: > * > span:first">
                              <select>
                                  <option value="">Choose Size</option>
                                  <option value="1">Option 01</option>
                                  <option value="2">Option 02</option>
                                  <option value="3">Option 03</option>
                                  <option value="4">Option 04</option>
                              </select>
                              <button class="uk-button uk-button-default" type="button" tabindex="-1">
                                  <span uk-icon="icon: chevron-down"></span>
                              </button>
                          </div>

                        </div>
                      </div>
                      <ul uk-accordion="animation: true; multiple: false">
                          <li class="uk-open">

                              <h5 class="uk-accordion-title"><b>EDITORS NOTES</b></h5>
                              <div class="uk-accordion-content uk-text-muted">
                                lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor
                              </div>

                          </li>
                          <li>

                              <h5 class="uk-accordion-title"><b>SIZE & FIT</b></h5>
                              <div class="uk-accordion-content  uk-text-muted">
                                lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor
                              </div>

                          </li>
                          <li>

                              <h5 class="uk-accordion-title"><b>DETAILS & CARE</b></h5>
                              <div class="uk-accordion-content uk-text-muted">
                                lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor
                              </div>

                          </li>
                          <li>

                              <h5 class="uk-accordion-title"><b>DELIVERY & FREE RETURNS</b></h5>
                              <div class="uk-accordion-content uk-text-muted">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                              </div>

                          </li>
                      </ul>

                    </div>
                  </div>
                </div>

                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-secondary" type="button">ADD TO BAG</button>
                    <button class="uk-button uk-button-default" type="button">ADD TO WISHLIST</button>
                </div>

            </div>
        </div>
              </div>
              <div class="uk-card-body uk-padding-remove uk-margin-small-top">
                <a :href="'/product/'+ product.slug" class="uk-text-muted">{{ product.name }}</a>
                <br>
                {{ product.currency }} {{ product.price }}
              </div>
              <!-- <div class="uk-card-footer">
                <span class="uk-text-meta">Shirt<h4 class="uk-card-price">$400</h4></span>
              </div> -->
          </div>
        </div>
        <!-- end product single -->
    </div>
</template>
