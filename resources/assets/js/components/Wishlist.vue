<template>
    <div class="uk-grid-small uk-child-width-1-3@m uk-flex-left" uk-grid>
        <div class="uk-panel uk-visible-toggle" v-for="wish in wishlists">

            <!-- start product -->
            <div class="uk-card uk-card-small uk-padding-remove">
                <div class="uk-card-media-top">
                    <img :src="'/'+wish.photo" :alt="wish.name">

                </div>
                <div class="uk-card-body uk-padding-remove uk-margin-small-top">

                </div>
                <!-- <div class="uk-card-footer">
                  <span class="uk-text-meta">Shirt<h4 class="uk-card-price">$400</h4></span>
                </div> -->
            </div>
            <!-- end product single -->
            <div class="uk-panel uk-position-cover-card uk-invisible-hover">
              <!-- start product -->
                <div class="uk-box-shadow-large uk-padding-remove">
                    <div class="uk-card-media-top uk-inline">
                      <div class="uk-position-small uk-position-top-right">
                        <a href="#" class="uk-icon-button"  uk-icon="icon: triangle-down" title="Manage Your Cart" uk-tooltip="pos: right"></a>
                        <div id="parent-drop-click" uk-drop="mode: click">
                            <div id="parent-drop-card-click">
                              <ul class="uk-list">
                                <li><a href="/account/wishlist" class="uk-icon-button"  uk-icon="icon: pencil"></a></li>
                                <li>
                                  <a href="#destroy-" class="uk-icon-button"  uk-icon="icon: trash" uk-toggle></a>
                                  <!-- This is the modal -->
                                  <div id="destroy-" uk-modal>
                                      <div class="uk-modal-dialog uk-modal-body">
                                          <h2 class="uk-modal-title">Confirmation</h2>
                                          <p>Delete your wishlist ?</p>
                                          <form action="" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <p class="uk-text-right">
                                                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                                                <button class="uk-button uk-button-primary" type="submit">Save</button>
                                            </p>
                                          </form>

                                      </div>
                                  </div>
                                </li>

                              </ul>
                            </div>
                        </div>
                      </div>
                        <img :src="'/'+wish.photo" :alt="wish.photo">
                    </div>
                    <div class="uk-card-body uk-background-default uk-padding-small uk-margin-small-top">
                        <a :href="'/product/'+wish.slug">{{ wish.name }}</a>
                        <br>
                        <span></span>
                        <br>
                        <form v-on:submit.prevent="addBag">
                          <input type="hidden" name="size" :value="wish.sku">
                          <input type="hidden" name="qty" :value="wish.qty">
                          <input type="hidden" name="move" :value="wish.id">
                          <button type="submit" class="uk-button uk-button-secondary uk-button-small uk-width-1-1">Add to cart</button>
                        </form>
                    </div>
                    <hr class="uk-margin-remove">
                    <div class="uk-card-footer uk-background-default uk-remove-padding-vertical uk-text-meta uk-padding-small">
                        <div class="uk-child-width-1-3" uk-grid>
                          <div class="">
                            color: <br> {{ wish.color }}
                          </div>
                          <div class="">
                            size: <br> {{ wish.size }}
                          </div>
                          <div class="">
                            Qty: <br> {{ wish.qty }}
                          </div>
                        </div>
                    </div>
                    <!-- <div class="uk-card-footer">
                      <span class="uk-text-meta">Shirt<h4 class="uk-card-price">$400</h4></span>
                    </div> -->
                </div>

              <!-- end product single -->
            </div>
        </div>

        <center v-if="wishlists == 0">wishlist not found</center>
    </div>
</template>

<script>
  import axios from 'axios';
  export default {
    props: ['wishlist_api', 'bag_api'],
    created () {
      var self = this;
      self.getWishlist();
    },

    data () {
      return {
        wishlists: {}
      }
    },

    methods: {
      getWishlist: function () {
        var self = this;
        axios.get(this.wishlist_api)
        .then(function (response) {
          self.wishlists = response.data.wishlists;
        })
        .catch(function (error) {
          console.log(error);
        });
      },

      addBag: function (event) {
        var self = this;
        var size = event.target.elements.size.value;
        var qty = event.target.elements.qty.value;
        var move = event.target.elements.move.value;

        axios.post(this.bag_api, {
            size: size,
            qty: qty,
            move: move
        })
        .then(function (response) {
            if (typeof response.data.message !== 'undefined') {
                if (response.data.status.toLowerCase() == 'error') {
                    UIkit.notification(response.data.message.size[0], {
                        status:'danger'
                    });
                }
                if (response.data.status.toLowerCase() == 'ok') {
                    UIkit.notification("<span uk-icon='icon: check'></span> Add product to bag successfully", {
                        status:'success'
                    });

                    Event.fire('addBag', response);

                    self.getWishlist(); 

                    Event.fire('addWishlist', response);
                }
            }
        })
        .catch(function (error) {
            var error = JSON.parse(JSON.stringify(error));
            if (typeof error.response.data.message !== 'undefined') {
              UIkit.notification(error.response.data.message, {
                  status:'danger'
              });
            }
        });
      }
    }
  }
</script>
