import Vue from 'vue';
import VueResource from 'vue-resource-2';

import Navigation from './components/Men.vue';

Vue.use(VueResource);

Vue.component('men', Navigation);

new Vue({
    el: '#menu'
});
