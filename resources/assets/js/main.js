import Vue from 'vue';
import VueResource from 'vue-resource-2';
import VeeValidate from 'vee-validate';
import ES6Promise from 'es6-promise';
import VueLazyImage from "vue-lazy-images";
ES6Promise.polyfill();

import UserPanel from './components/UserPanel.vue';
import Navigation from './components/Navigation.vue';

import Popular from './components/Popular.vue';
import Related from './components/Related.vue';
import Categories from './components/Categories.vue';
import CategoriesMobile from './components/CategoriesMobile.vue';
import Subcriber from './components/Subcriber.vue';
import ButtonBuy from './components/ButtonBuy.vue';
import Bag from './components/Bag.vue';
import Wishlist from './components/Wishlist.vue';
import Shop from './components/Shop.vue';
import Item from './components/ItemCheckout.vue';
import Summary from './components/Summary.vue';
import Address from './components/Address.vue';
import CreditCard from './components/CreditCard.vue';
import NavigationMobile from './components/NavigationMobile.vue';
import UserPanelMobile from './components/UserPanelMobile.vue';
import Search from './components/Search.vue';
import SearchMobile from './components/SearchMobile.vue';
import PopularSearch from './components/PopularSearch.vue';
import ColorPalette from './components/ColorPalette.vue';
import ColorPaletteMobile from './components/ColorPaletteMobile.vue';
import Lookbook from './components/Lookbook.vue';


Vue.config.devtools = false
Vue.config.debug = false
Vue.config.silent = true
Vue.config.productionTip = false

Vue.use(VueResource);
Vue.use(VeeValidate);
Vue.use(VueLazyImage);

window.Event = new class {

  constructor() {
    this.vue = new Vue();
  }

  fire(event, data = null) {
    this.vue.$emit(event, data);
  }

  listen(event, callback) {
    this.vue.$on(event, callback);
  }
};

new Vue({
  el: '#app',
  components: {
    'user-panel': UserPanel,
    'navigation': Navigation,
    'popular': Popular,
    'related': Related,
    'categories': Categories,
    'categories-mobile': CategoriesMobile,
    'button-buy': ButtonBuy,
    'subcriber': Subcriber,
    'bag': Bag,
    'wishlist': Wishlist,
    'shop': Shop,
    'item-checkout' : Item,
    'summary-checkout' : Summary,
    'address-list' : Address,
    'credit-card' : CreditCard,
    'navigation-mobile' : NavigationMobile,
    'user-panel-mobile' : UserPanelMobile,
    'search' : Search,
    'search-mobile' : SearchMobile,
    'popular-search' : PopularSearch,
    'color-palette' : ColorPalette,
    'color-palette-mobile' : ColorPaletteMobile,
    'lookbook' : Lookbook,
	}
});