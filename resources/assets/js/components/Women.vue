<script>
    export default {
        props: ['api'],
        created() {
            var self = this;
            var api = this.api;
            $.get(api, function(womens) {
                if (typeof womens.data !== 'undefined') {
                    self.clothings = womens.data.clothing;
                }                  
              });
        },

        data() {
            return {
                clothings: {}
            }
        }
    }
</script>

<template>
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
                <li class="uk-parent" v-for="clothing in clothings">
                  <a :href="'/shop/womens/'+ clothing.slug ">{{ clothing.name }}</a>
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
</template>
