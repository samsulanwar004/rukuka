<template>
  <div class="uk-grid-small uk-child-width-1-3@m uk-child-width-1-2 uk-flex-left" uk-grid>
    <div class="uk-panel uk-visible-toggle list-item" v-for="wish in wishlists" v-bind:key="wish">

        <!-- start product -->
        <div class="uk-card uk-card-small uk-padding-remove uk-visible@m">
            <div class="uk-card-media-top">
                <img v-if="wish.photo" :src="wish.photo | awsLink(aws_link)" :alt="wish.name">
                <img v-else :src="aws_link+'/'+'images/'+defaultImage.image_2" :alt="rukuka">
            </div>
            <div class="uk-card-body uk-padding-remove uk-margin-small-top">

            </div>
            <!-- <div class="uk-card-footer">
              <span class="uk-text-meta">Shirt<h4 class="uk-card-price">$400</h4></span>
            </div> -->
        </div>
        <!-- end product single -->
        <div class="uk-panel uk-position-cover-card uk-invisible-hover uk-visible@m">
          <!-- start product -->
            <div class="uk-box-shadow-large uk-padding-remove">
                <div class="uk-card-media-top uk-inline">
                  <div class="uk-position-small uk-position-top-right">
                    <ul class="uk-list">
                      <li><a :href="product_link+'/'+wish.slug+'/wishlist/'+wish.sku+'/'+wish.id" class="uk-icon-button"  uk-icon="icon: pencil"></a></li>
                      <li>
                        <a v-on:click.prevent="removeWishlist(wish.id)" class="uk-icon-button"  uk-icon="icon: trash"></a>
                      </li>
                    </ul>
                  </div>
                    <img v-if="wish.photo" :src="wish.photo | awsLink(aws_link)" :alt="wish.name">
                    <img v-else :src="aws_link+'/'+'images/'+defaultImage.image_2" :alt="rukuka">
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
        <div class="uk-box-shadow-large uk-padding-remove uk-hidden@m">
            <div class="uk-card-media-top uk-inline">
              <div class="uk-position-small uk-position-top-right">
                <ul class="uk-list">
                  <li><a :href="product_link+'/'+wish.slug+'/wishlist/'+wish.sku+'/'+wish.id" class="uk-icon-button"  uk-icon="icon: pencil"></a></li>
                  <li>
                    <a v-on:click.prevent="removeWishlist(wish.id)" class="uk-icon-button"  uk-icon="icon: trash"></a>
                  </li>
                </ul>
              </div>
                <img v-if="wish.photo" :src="wish.photo | awsLink(aws_link)" :alt="wish.name">
                <img v-else :src="aws_link+'/'+'images/'+defaultImage.image_2" :alt="rukuka">
            </div>
            <div class="uk-card-body uk-background-default uk-padding-small">
                <a :href="'/product/'+wish.slug" class="uk-text-meta">{{ wish.name }}</a>
                <br>
                <span></span>
                <br>
                <form v-on:submit.prevent="addBag">
                  <input type="hidden" name="size" :value="wish.sku">
                  <input type="hidden" name="qty" :value="wish.qty">
                  <input type="hidden" name="move" :value="wish.id">
                  <button type="submit" class="uk-button uk-button-secondary uk-button-small uk-width-1-1"><span class="uk-icon" uk-icon="icon: cart"></span> cart</button>
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
    </div>
      <div v-if="wishlists == 0" class="uk-text-center"><h3>You have no items in your wishlist</h3></div>
  </div>
</template>

<script>
  import axios from 'axios';
  export default {
    props: ['wishlist_api', 'bag_api', 'wishlist_delete', 'product_link', 'aws_link','default_image','locale'],
    created () {
      var self = this;
      self.getWishlist();
    },

    data () {
      return {
        wishlists: {},
        defaultImage: JSON.parse(this.default_image,true),
        trans: JSON.parse(this.locale,true)
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
      },

      removeWishlist: function (id) {
        var self = this;
        var id = id;

        axios.post(this.wishlist_delete, {
            _method: 'DELETE',
            id: id,
        })
        .then(function (response) {
            if (typeof response.data.message !== 'undefined') {
                if (response.data.status.toLowerCase() == 'ok') {
                    UIkit.notification("<span uk-icon='icon: check'></span> Delete product from wishlist successfully", {
                        status:'success'
                    });

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
    },

    filters: {
      awsLink: function (value, aws) {
        var link = value == null ? '#' : aws+'/'+value;
        return link;
      }
    }
  }
</script>
